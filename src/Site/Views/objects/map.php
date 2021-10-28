<?php
/**
 * @var array $objects
 * @var array $reviews
 **/

$_page_title = "Поиск по карте | Take Keys";
?>

<?=view("layout.header", ["_page_title" => $_page_title])?>

<section class="map">
    <div id="map__all-offers" class="map__all-offers"></div>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&onload=map_all_offers" type="text/javascript"></script>

    <script>
        var boundschangeTimer = 0
        function map_all_offers(ymaps) {
            setTimeout(() => {

                let map = new ymaps.Map('map__all-offers', {
                    center: [55.75809, 37.579909],
                    zoom: 13,
                    controls: ['zoomControl', 'geolocationControl', 'fullscreenControl', 'rulerControl']
                })
                objectManager = new ymaps.ObjectManager({
                    clusterize: true,
                })
                //map.behaviors.disable("scrollZoom")

                let sizePoints = 12
                let sizeArea = sizePoints * 2

                let pointStyle = {
                    hasBalloon: false,
                    iconLayout: ymaps.templateLayoutFactory.createClass('<div style="font-size: ' + sizePoints + 'px" class="map__house-cluster"><span>1</span></div>'), // $[properties.iconContent]
                    hideIconOnBalloonOpen: false,
                    iconShape: {
                        type: 'Rectangle',
                        coordinates: [[-sizeArea, -sizeArea], [sizeArea, sizeArea]]
                    }
                }

                var clusterer = {
                    hasBalloon: false,
                    clusterIconLayout: ymaps.templateLayoutFactory.createClass('<div style="font-size: ' + sizePoints + 'px" class="map__house-cluster"><span>{{ properties.geoObjects.length }}</span></div>'),
                    clusterIconShape: {
                        type: 'Rectangle',
                        coordinates: [[-sizeArea, -sizeArea], [sizeArea, sizeArea]]
                    }
                }
                objectManager.clusters.options.set(clusterer)

                map.geoObjects.add(objectManager)

                getMapObjects()

                map.events.add('boundschange', function (e) {
                    // После каждого сдвига карты...
                    clearTimeout(boundschangeTimer);
                    boundschangeTimer = setTimeout(function () {
                        getMapObjects()
                    }, 500);
                    // objectManager.objects.each(function (object) {

                    // })
                });
                objectManager.objects.events.add('click', function (e) {
                    let id = e.get('objectId')
                    getObjectContent( [id] )
                })

                objectManager.clusters.events.add('click', function (e) {
                    let id = e.get('objectId'),
                        cluster = objectManager.clusters.getById(id),
                        geoObjects = cluster.properties.geoObjects

                    ids = geoObjects.map(function (geoObject) {
                        return geoObject.id;
                    })
                    getObjectContent( ids )
                });
                // objectManager.clusters.events.add('balloonopen', function (e) {
                // 	// Получим id кластера, на котором открылся балун.
                // 	var id = e.get('objectId'),
                // 		// Получим геообъекты внутри кластера.
                // 		cluster = objectManager.clusters.getById(id),
                // 		geoObjects = cluster.properties.geoObjects;

                // 	// Загрузим данные для объектов при необходимости.
                // 	downloadContent(geoObjects, id, true);
                // });

                function getObjectContent(id) {
                    let offCanvas = $('.offcanvas-map-content')
                    Offcanvas.getOrCreateInstance($('#offcanvas-map')).show()
                    offCanvas.addClass('active')

                    $.ajax({
                        url: '/api/objects/map/view/',
                        type: 'POST',
                        data: { id: JSON.stringify(id) }
                    }).done(function (data) {
                        offCanvas.html("<br>" + data)
                        lazySwiper()
                    }).always(function (data) {
                        offCanvas.removeClass('active')
                    })
                }

                function getMapObjects() {
                    let arrViewFrame = map.getBounds()
                    let strViewFrame = JSON.stringify(arrViewFrame)
                    mapPoints = {}

                    mapPoints.type = 'FeatureCollection'
                    $.ajax({
                        url: '/api/objects/map/',
                        method: 'POST',
                        data: { viewframe: strViewFrame }
                    }).done(function (data) {
                        data.forEach(element => {
                            element.type = 'Feature'
                            element.geometry.type = 'Point'
                            //element.properties.balloonContent = '<a href="' + element.properties.url + '" target="_blank" class="btn btn-outline-dark catalog__item__btn-show">Смотреть</a>'
                            //element.properties.balloonContentHeader = element.properties.price
                            //element.properties.hintContent = element.properties.price
                            element.options = pointStyle
                        })
                        mapPoints.features = data
                        objectManager.add(mapPoints)
                    })
                }

            }, 100);
        }
    </script>

    <div class="offcanvas offcanvas-start offcanvas-map" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
         id="offcanvas-map">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
        <div class="offcanvas-body py-0">
            <div class="row row-cols-1 gy-3 offcanvas-map-content loading"></div>
        </div>
    </div>

</section>

<style>
    .footer {
        display: none !important;
    }
</style>

<?=view("layout.footer")?>
