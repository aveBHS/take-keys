<?php
/**
 * @var array $objects
 * @var array $reviews
 **/

$_page_title = "Поиск по карте | Take Keys";
?>

<?=view("layout.header", ["_page_title" => $_page_title])?>

<div class="position-relative h-100">

    <section class="map">
        <div id="map__all-offers" class="map__all-offers"></div>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&onload=map_all_offers" type="text/javascript"></script>

        <script>
            function map_all_offers(ymaps) {

                let boundschangeTimer = 0
                let map_scale = 13

                setTimeout(() => {
                    let map = new ymaps.Map('map__all-offers', {
                        center: [55.75809, 37.579909],
                        zoom: map_scale,
                        controls: ['zoomControl', 'geolocationControl', 'fullscreenControl', 'rulerControl']
                    }, {
                        geolocationControlFloat: 'right',
                        zoomControlPosition: {
                            bottom: 'auto',
                            left: 'auto',
                            right: 10,
                            top: 124
                        },
                        rulerControlPosition: {
                            bottom: 'auto',
                            left: 'auto',
                            right: 10,
                            top: 10
                        },
                        geolocationControlPosition: {
                            bottom: 'auto',
                            left: 'auto',
                            right: 10,
                            top: 48
                        },
                        fullscreenControlPosition: {
                            bottom: 'auto',
                            left: 'auto',
                            right: 10,
                            top: 86
                        }
                    })

                    objectManager = new ymaps.ObjectManager({
                        clusterize: true,
                    })
                    //window.objectManager = objectManager
                    //window.map = map
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

                    let clusterer = {
                        hasBalloon: false,
                        //viewportMargin: 30,
                        //clusterDisableClickZoom: true,
                        clusterIconLayout: ymaps.templateLayoutFactory.createClass('<div style="font-size: ' + sizePoints + 'px" class="map__house-cluster"><span>{{ properties.geoObjects.length }}</span></div>'),
                        clusterIconShape: {
                            type: 'Rectangle',
                            coordinates: [[-sizeArea, -sizeArea], [sizeArea, sizeArea]]
                        }
                    }
                    objectManager.clusters.options.set(clusterer)

                    map.geoObjects.add(objectManager)

                    objectManager.objects.events.add('click', function (e) {
                        let id = e.get('objectId')
                        getObjectContent([id])
                    })

                    objectManager.clusters.events.add('click', function (e) {
                        let id = e.get('objectId'),
                            cluster = objectManager.clusters.getById(id),
                            geoObjects = cluster.properties.geoObjects

                        ids = geoObjects.map(function (geoObject) {
                            return geoObject.id;
                        })
                        getObjectContent(ids)
                    });

                    function getObjectContent(id) {
                        let offCanvas = $('.offcanvas-map-content')
                        Offcanvas.getOrCreateInstance($('#offcanvas-map')).show()
                        offCanvas.addClass('active')
                        let limit = 20
                        let idLen = id.length
                        $('.offcanvas-map .offcanvas-body')[0].scrollTop = 0

                        $.ajax({
                            url: '/api/objects/map/view/',
                            type: 'POST',
                            data: { id: JSON.stringify(id.slice(0, limit)) }
                        }).done(function (data) {
                            $('#offcanvas-map-header').html(idLen > limit ? limit + " из " + idLen : idLen)
                            offCanvas.html(data)
                            lazySwiper()
                        }).always(function (data) {
                            offCanvas.removeClass('active')
                        })
                    }
                    $('.offcanvas-map .offcanvas-body').scroll(function () {
                        lazySwiper()
                    })

                    function getMapObjects(arrViewFrame = []) {
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
                            if(data.length > 0) {
                                map_loadedTiles = map_loadedTiles.concat(map_newTiles)
                                //console.log("Загруженные" ,map_loadedTiles)
                            }
                            map_newTiles = []
                        })
                    }

                    let map_loadedTiles = []
                    let map_newTiles = []
                    function calcTile() {
                        let viewTiles = []
                        let newBounds = map.getBounds()
                        let scale = map_scale

                        let lbPixelCoords = map._projection.toGlobalPixels(newBounds[0], scale)
                        let trPixelCoords = map._projection.toGlobalPixels(newBounds[1], scale)

                        //Посчитаем номер тайла на основе пиксельных координат.
                        let lbTileNumber = fromPixelsToTileNumber(lbPixelCoords)
                        let trTileNumber = fromPixelsToTileNumber(trPixelCoords)

                        let lbTilePixelCoords = fromTileNumberToPixels(lbTileNumber)
                        let trTilePixelCoords = fromTileNumberToPixels(trTileNumber)

                        let lbLoadPointPixelCoords = [lbTilePixelCoords[0], lbTilePixelCoords[1] + 256]
                        let trLoadPointPixelCoords = [trTilePixelCoords[0] + 256, trTilePixelCoords[1]]

                        let lbLoadPointMapCoords = map._projection.fromGlobalPixels(lbLoadPointPixelCoords, scale)
                        let trLoadPointMapCoords = map._projection.fromGlobalPixels(trLoadPointPixelCoords, scale)

                        //console.log(newBounds[0], lbLoadPointMapCoords)
                        //console.log(newBounds[1], trLoadPointMapCoords)

                        viewTiles.push(lbTileNumber, trTileNumber)

                        //console.log(viewTiles)
                        for (let x = viewTiles[0][0]; x <= viewTiles[1][0]; x++) {
                            for (let y = viewTiles[1][1]; y <= viewTiles[0][1]; y++) {
                                let keyTile = parseInt(x + '' + y)
                                if(!map_newTiles.includes(keyTile) && !map_loadedTiles.includes(keyTile)) {
                                    map_newTiles.push(keyTile)
                                }
                            }
                        }
                        if(map_newTiles.length > 0) {
                            //console.log("Новые" ,map_newTiles)
                            getMapObjects([lbLoadPointMapCoords, trLoadPointMapCoords])
                        }
                    }
                    calcTile()
                    map.events.add('boundschange', function (e) {
                        // После каждого сдвига карты...
                        clearTimeout(boundschangeTimer);
                        boundschangeTimer = setTimeout(function () {
                            if (e.originalEvent.newZoom <= e.originalEvent.oldZoom) {
                                calcTile()
                            }
                        }, 100);
                    });

                    // Функция для расчета номера тайла на основе глобальных пиксельных координат.
                    function fromPixelsToTileNumber(pixelCoords) {
                        return [
                            Math.floor(pixelCoords[0] / 256),
                            Math.floor(pixelCoords[1] / 256)
                        ];
                    }
                    function fromTileNumberToPixels(tileNumbers) {
                        return [
                            tileNumbers[0] * 256,
                            tileNumbers[1] * 256
                        ];
                    }

                }, 100);
            }




        </script>

        <div class="offcanvas offcanvas-start offcanvas-map" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
             id="offcanvas-map">
            <div class="offcanvas-header">
                <div class="h6 offcanvas-title">Объявлений: <span id="offcanvas-map-header"></span></div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
            </div>
            <div class="offcanvas-body px-2 pt-0">
                <div class="row row-cols-1 gy-3 gx-2 offcanvas-map-content loading"></div>
            </div>
        </div>

    </section>

</div>
<style>
    .footer {
        display: none !important;
    }
</style>

<button onclick="Chatra('openChat', true)" class="btn btn-dark btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>

<?=view("layout.footer")?>
