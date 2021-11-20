<?php
/**
 * @var bool $render
 */
if(!isset($render))
    $render = true;
?>
</div>
<?php if($render) { ?>
<div class="footer">
    <div class="container pb-3">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gy-4">
            <div class="col">
                <div class="logo-wrp">
                    <a class="logo logo-footer" href="/"><img src="/images/icons/logo.svg" alt="Take Keys"></a>
                    <a target="_blank" class="mail-link" href="mailto:suport@take-keys.ru">support@take-keys.com</a>
                </div>
            </div>
            <div class="col">
                <h5>Арендаторам</h5>
                <ul class="list-unstyled">
                    <li><a class="foot-link" href="/catalog">Снять</a></li>
                    <li><a class="foot-link" href="/catalog">Купить</a></li>
                    <li><a class="foot-link" href="https://take-keys.com/price">Тарифы</a></li>
                    <li><a class="foot-link" href="https://take-keys.com/documents">Документы</a></li>
                </ul>
            </div>
            <div class="col">
                <h5>Собственникам</h5>
                <ul class="list-unstyled">
                    <li><a class="foot-link" href="https://take-keys.com/#popup:ads">Сдать</a></li>
                    <li><a class="foot-link" href="https://take-keys.com/#popup:ads">Продать</a></li>
                    <li><a class="foot-link" href="https://take-keys.com/documents">Документы</a></li>
                </ul>
            </div>
            <div class="col">
                <h5>Take Keys</h5>
                <ul class="list-unstyled">
                    <li><a class="foot-link" href="https://take-keys.com/#rec356317620">О сервисе</a></li>
                    <li><a class="foot-link" href="https://take-keys.com/contacts">Контакты</a></li>
                    <li><a class="foot-link" href="https://take-keys.com/documents">Правила сервиса</a></li>
                    <li><a class="foot-link" href="https://take-keys.com/help">Помощь</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="soc">
                        <a href="#" class="soc-link"><img src="/images/icons/facebook.svg"></a>
                        <a href="#" class="soc-link"><img src="/images/icons/youtube.svg"></a>
                        <a href="#" class="soc-link"><img src="/images/icons/instagram.svg"></a>
                        <a href="#" class="soc-link"><img src="/images/icons/telegram.svg"></a>
                        <a href="https://vk.com/takekeyscom" class="soc-link"><img src="/images/icons/vk.svg"></a>
                    </div>
                </div>
                <div class="col text-center fs-12">
                    <a href="https://take-keys.com/documents">Политика конфиденциальности</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<script src="/js/app.min.js?6"></script>
<script src="/js/catalog.js?6"></script>

</body>

</html>