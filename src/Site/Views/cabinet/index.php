<?php
/**
 * @var object $object
 * @var array $images
 * @var string VIEW_PATH
 * @var bool $purchased
 **/

global $auth;
?>

<?=view("layout.header", ["_page_title" => "Личный Кабинет | Take-Keys"])?>

<style>
    span.active{
        display: none;
    }
    .setting-item.active span.active{
        display: inline;
    }
    .setting-item.active span{
        display: none;
    }
</style>

<div class="main-container container mt-5">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 gy-3">


        <div class="col">
            <div class="setting-item active">
                <div class="setting-item__icon">
                    <button class="btn btn-primary btn-icon btn-aura">
                        <i class="icon"><img src="/images/icons/bell.svg"></i>
                    </button>
                </div>
                <div class="setting-item__title mt-5">
                    <span class="active">Выключить персонализированную подборку вариантов и уведомлений</span>
                    <span>Включить персонализированную подборку вариантов и уведомлений</span>
                </div>
                <div class="setting-item__desc mt-3">
                    <span class="active">Вы перестанете получать персонализированную подборку и уведомления</span>
                    <span>Вы будете получать персонализированную подборку и уведомления</span>
                </div>
                <div class="setting-item__btn">
                    <button class="btn btn-outline-dark rounded-pill px-4 mt-3 btn-switch">
                        <span class="active">Отключить</span>
                        <span>Включить</span>
                    </button>
                </div>
            </div>
        </div>


    </div>
</div>

<?=view("layout.footer")?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('.btn-switch').click(function(e) {
            console.log('click');
            $(this).parents('.setting-item').toggleClass('active')
        })
    })
</script>
