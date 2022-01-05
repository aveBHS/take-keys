<?php global $auth; ?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Главное</div>
                <a class="nav-link" href="/panel/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Главная страница
                </a>
                <div class="sb-sidenav-menu-heading">Взаимодействие</div>
                <a class="nav-link" href="/panel/">
                    <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                    Клиенты
                </a>
                <a class="nav-link" href="/panel/">
                    <div class="sb-nav-link-icon"><i class="fas fa-phone"></i></div>
                    Звонки
                </a>
                <a class="nav-link" href="/panel/">
                    <div class="sb-nav-link-icon"><i class="fas fa-sms"></i></div>
                    СМС
                </a>
                <div class="sb-sidenav-menu-heading">Недвижимость</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#objects" aria-expanded="false" aria-controls="objects">
                    <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                    Объекты
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="objects" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Продажа
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Аренда
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#adsObjects" aria-expanded="false" aria-controls="adsObjects">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Реклама
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="adsObjects" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a href="/panel/objects/catalog_sell" class="nav-link" aria-expanded="false">
                            Продажа
                        </a>
                        <a href="/panel/objects/catalog_rent" class="nav-link" aria-expanded="false">
                            Аренда
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Вы вошли как:</div>
            <?=$auth()->name?>
        </div>
    </nav>
</div>