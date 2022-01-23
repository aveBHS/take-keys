<?php
/**
 * @var string $name
 * @var bool $is_done
 */

$is_done = $is_done ?? false;
$continue = $continue ?? false;
$name = $name ?? "пользователь";
?>
<?php if(!$is_done) { ?>
<script>
    function stayFree(){
        window.location = "/catalog/recommendations"
    }
    document.addEventListener('DOMContentLoaded', () => {

        setTimeout(() => {
            let fiveMinutes = 60 * 40
            startTimer(fiveMinutes, $('.tarif-take-keys-vip-timer'))
        }, 2000);

        $('#open-purchase-form').submit(event => {
            event.preventDefault()
            event.stopPropagation()
            if (event.target.checkValidity()) {
                Modal.getOrCreateInstance($('#popup-tarif-take-keys')).hide()
                pay(user_id);
            }
        });
    });
</script>
<?php } ?>
<div class="modal fade tarif-take-keys" id="popup-tarif-take-keys" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="ratio ratio-21x9">
                <div class="tarif-take-keys__head" style="background-image: url('/images/dist/tarif-take-keys.jpg');"></div>
            </div>
            <div class="px-3 px-lg-4 pb-4">
                <div class="popup__title text-center">Только для тех, кто готов без проблем заселиться.<br />Получите лицензию
                    Take VIP Keys</div>

                <div class="fw-semibold fs-18 mb-3">Вы получаете:</div>

                <div class="tarif-take-keys__desc-1" data-parent="#tarif-take-keys__desc">
                    <div class="icon-list">
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M18.7779 5.65899C19.4832 6.17799 19.9158 6.94899 19.9895 7.78799L20 7.98899V16.098C20 18.188 18.2621 19.888 16.0842 19.998H13.9895C12.9884 19.979 12.1789 19.239 12.1053 18.309L12.0947 18.168V15.309C12.0947 14.998 11.8516 14.739 11.5263 14.688L11.4316 14.678H8.62C8.28421 14.688 8.01053 14.918 7.96842 15.218L7.95789 15.309V18.159C7.95789 18.218 7.94632 18.288 7.93684 18.338L7.92632 18.359L7.91474 18.428C7.78947 19.279 7.05263 19.928 6.13684 19.989L6 19.998H4.11579C1.91579 19.998 0.115789 18.359 0 16.298V7.98899C0.00947368 7.13799 0.4 6.34799 1.05263 5.79799L7.61053 0.787988C8.94737 -0.221012 10.8211 -0.261012 12.1989 0.667988L12.3684 0.787988L18.7779 5.65899ZM18.5253 16.2583L18.5369 16.0983V7.99831C18.5253 7.56931 18.3369 7.16831 18.0105 6.86931L17.8737 6.75831L11.4526 1.87831C10.6526 1.26831 9.5158 1.23931 8.6737 1.76831L8.51475 1.87831L2.11475 6.77931C1.74738 7.03831 1.52633 7.42831 1.4737 7.83831L1.46212 7.99831V16.0983C1.46212 17.4283 2.55685 18.5183 3.94738 18.5983H6.00001C6.23159 18.5983 6.43159 18.4493 6.46212 18.2393L6.48422 18.0593L6.49475 18.0083V15.3093C6.49475 14.2393 7.35791 13.3693 8.46317 13.2883H11.4316C12.5569 13.2883 13.4726 14.1093 13.5579 15.1593V18.1683C13.5579 18.3783 13.7158 18.5593 13.9263 18.5983H15.8832C17.2937 18.5983 18.4411 17.5693 18.5253 16.2583Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Статус VIP пользователя, заселение под ключ.</div>
                            </div>
                        </div>
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M3.55763 0.00138038L3.58038 0.00288871C3.99659 0.0387193 4.35897 0.246846 4.68852 0.570498L4.7904 0.673562C5.42274 1.33803 6.5616 2.86433 6.74741 3.40531L6.76742 3.47617C6.88069 4.02296 6.76013 4.37805 6.40048 5.00618L6.31355 5.16056C6.14855 5.46331 6.12333 5.58818 6.17433 5.73115C6.95877 7.66089 8.29738 9.00621 10.1957 9.78552C10.3755 9.85112 10.5111 9.81369 10.8906 9.59488L11.0893 9.48187C11.6229 9.18766 11.9612 9.09455 12.4601 9.19856C12.885 9.28786 14.2587 10.298 15.0522 11.0075L15.2713 11.2101L15.35 11.2884C15.6726 11.6203 15.8802 11.985 15.9164 12.4317C15.9545 13.5175 14.6365 15.0462 13.8328 15.5057C12.9187 16.1639 11.7584 16.1528 10.4567 15.5438C7.05442 14.1207 1.85012 8.92298 0.463212 5.50736L0.380234 5.3164C-0.146102 4.0518 -0.134514 2.95851 0.468204 2.13525C1.01752 1.21907 2.50415 -0.0476334 3.55763 0.00138038ZM3.53538 1.17942L3.49199 1.17109L3.42317 1.17472C2.88254 1.24705 1.79674 2.1867 1.43645 2.78327L1.37411 2.87656C1.06325 3.38592 1.09917 4.08598 1.53211 5.04357L1.6149 5.23838C3.01208 8.39031 7.84967 13.1854 10.9258 14.4725L11.0953 14.5483C11.9857 14.9278 12.6591 14.911 13.2044 14.5218L13.2447 14.4958C13.4135 14.3779 13.8027 14.0224 14.1025 13.6747C14.5236 13.1863 14.7621 12.7388 14.7544 12.5006C14.746 12.3987 14.6678 12.2614 14.5247 12.114L14.4599 12.0496C13.9052 11.5159 12.3919 10.3801 12.2228 10.3445C12.0497 10.3085 11.9075 10.3572 11.5192 10.5818L11.3232 10.6925C10.7509 11.0027 10.3469 11.0859 9.77713 10.8776C7.56779 9.97115 5.99929 8.39479 5.08798 6.15166C4.87209 5.55182 4.98838 5.12766 5.36406 4.46982L5.45332 4.31203C5.62392 4.00252 5.65992 3.87118 5.62737 3.71404C5.59292 3.54664 4.55132 2.14674 4.01368 1.55311L3.87508 1.40721L3.80165 1.34006C3.70083 1.25343 3.6113 1.20086 3.53538 1.17942Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Возможность связываться с владельцами без ограничений</div>
                            </div>
                        </div>
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M9.61154 0C4.30323 0 0 4.20819 0 9.39926C0 14.5903 4.30323 18.7985 9.61154 18.7985C11.8819 18.7985 13.9684 18.0287 15.613 16.7415L18.7371 19.7886L18.8202 19.8586C19.1102 20.0685 19.5214 20.0446 19.7839 19.7873C20.0726 19.5043 20.072 19.0459 19.7825 18.7636L16.6952 15.7523C18.2649 14.0794 19.2231 11.8487 19.2231 9.39926C19.2231 4.20819 14.9198 0 9.61154 0ZM9.61154 1.44774C14.1022 1.44774 17.7426 5.00776 17.7426 9.39926C17.7426 13.7908 14.1022 17.3508 9.61154 17.3508C5.12086 17.3508 1.48044 13.7908 1.48044 9.39926C1.48044 5.00776 5.12086 1.44774 9.61154 1.44774Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Доступ к эксклюзивным объектам недвижимости которых нет на бесплатных досках
                                    объявлений.</div>
                            </div>
                        </div>
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M0 12.3852C0 10.5593 1.44574 9.0791 3.22915 9.0791C5.01256 9.0791 6.4583 10.5593 6.4583 12.3852V15.7413C6.4583 17.5672 5.01256 19.0474 3.22915 19.0474C1.44574 19.0474 0 17.5672 0 15.7413V12.3852ZM3.22915 10.7934C2.37047 10.7934 1.67438 11.5061 1.67438 12.3852V15.7413C1.67438 16.6205 2.37047 17.3332 3.22915 17.3332C4.08783 17.3332 4.78393 16.6205 4.78393 15.7413V12.3852C4.78393 11.5061 4.08783 10.7934 3.22915 10.7934Z"
                                              fill="#A3CC4A" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M17.541 12.3852C17.541 10.5593 18.9868 9.0791 20.7702 9.0791C22.5536 9.0791 23.9993 10.5593 23.9993 12.3852V15.7413C23.9993 17.5672 22.5536 19.0474 20.7702 19.0474C18.9868 19.0474 17.541 17.5672 17.541 15.7413V12.3852ZM20.7702 10.7934C19.9115 10.7934 19.2154 11.5061 19.2154 12.3852V15.7413C19.2154 16.6205 19.9115 17.3332 20.7702 17.3332C21.6288 17.3332 22.3249 16.6205 22.3249 15.7413V12.3852C22.3249 11.5061 21.6288 10.7934 20.7702 10.7934Z"
                                              fill="#A3CC4A" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4.06695 8.2883V9.9366C4.06695 10.41 3.69213 10.7937 3.22977 10.7937C2.7674 10.7937 2.39258 10.41 2.39258 9.9366V8.28579H3.22977C2.39258 8.28579 2.39258 8.28635 2.39258 8.28579L2.39258 8.28342L2.39259 8.28036L2.39265 8.27218L2.393 8.24777C2.39338 8.22797 2.39409 8.20118 2.3954 8.16785C2.39802 8.10123 2.40307 8.00832 2.41281 7.89286C2.43226 7.66223 2.47055 7.33978 2.54611 6.95578C2.69663 6.19084 2.99877 5.16283 3.60959 4.1281C4.86381 2.00346 7.33429 0 12.0003 0C16.6663 0 19.1368 2.00346 20.391 4.1281C21.0018 5.16283 21.304 6.19084 21.4545 6.95578C21.5301 7.33978 21.5683 7.66223 21.5878 7.89286C21.5975 8.00832 21.6026 8.10123 21.6052 8.16785C21.6065 8.20118 21.6072 8.22797 21.6076 8.24777L21.608 8.27218L21.608 8.28036L21.608 8.28342L21.608 8.28469C21.608 8.28525 21.608 8.28579 20.7708 8.28579L21.608 8.28469V9.9366C21.608 10.41 21.2332 10.7937 20.7708 10.7937C20.3085 10.7937 19.9336 10.41 19.9336 9.9366L19.9336 8.28672L19.9335 8.28119C19.9334 8.27287 19.933 8.25795 19.9322 8.23687C19.9305 8.19467 19.927 8.12798 19.9196 8.04032C19.9048 7.86469 19.8746 7.60679 19.8131 7.29434C19.6895 6.66642 19.4435 5.83726 18.958 5.01483C18.0196 3.42515 16.1048 1.71428 12.0003 1.71428C7.89578 1.71428 5.98099 3.42515 5.04257 5.01483C4.55707 5.83726 4.31106 6.66642 4.1875 7.29434C4.12602 7.60679 4.09579 7.86469 4.08098 8.04032C4.07359 8.12798 4.07008 8.19467 4.06842 8.23687C4.06759 8.25795 4.06722 8.27287 4.06706 8.28119L4.06695 8.2883ZM19.9336 8.28828C19.9336 8.28875 19.9337 8.28867 19.9336 8.28828V8.28828Z"
                                              fill="#A3CC4A" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M18.3774 14.0312C18.8398 14.0312 19.2146 14.415 19.2146 14.8884V14.9145C19.2146 16.1327 19.2146 17.2993 19.1241 18.3432C19.0331 19.3936 18.8457 20.3922 18.4302 21.2525C18.0028 22.1374 17.3474 22.8475 16.386 23.3215C15.4472 23.7843 14.2626 23.9996 12.7962 23.9996C12.3338 23.9996 11.959 23.6158 11.959 23.1424C11.959 22.6691 12.3338 22.2853 12.7962 22.2853C14.1204 22.2853 15.0287 22.0879 15.6596 21.7769C16.268 21.477 16.659 21.0522 16.9293 20.4926C17.2114 19.9085 17.373 19.1531 17.4563 18.1916C17.5396 17.231 17.5402 16.137 17.5402 14.8884C17.5402 14.415 17.9151 14.0312 18.3774 14.0312Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Персонального менеджера который на себя возьмёт все телефонные переговоры</div>
                            </div>
                        </div>
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M9.12564 0.0106286C9.0882 0.00365127 9.04955 0 9.01004 0C8.97052 0 8.93188 0.00365127 8.89443 0.0106286H3.76355C1.72143 0.0106286 0 1.63582 0 3.61809V12.2465C0 14.341 1.64581 16.0005 3.76355 16.0005H10.3227C12.3369 16.0005 14 14.2593 14 12.2465V4.86406C14 4.70812 13.9385 4.55822 13.8284 4.44573L9.66998 0.196357C9.55387 0.077702 9.39345 0.0106286 9.22578 0.0106286H9.12564ZM8.39427 1.21697L3.76359 1.21761C2.39128 1.21761 1.23157 2.31249 1.23157 3.61695V12.2454C1.23157 13.68 2.33369 14.7913 3.76359 14.7913H10.3227C11.6382 14.7913 12.7685 13.6079 12.7685 12.2454L12.768 5.62429L12.0491 5.62669C11.7752 5.62636 11.4636 5.6258 11.1171 5.62502C9.66429 5.62201 8.47862 4.50492 8.39858 3.09875L8.39427 2.94702V1.21697ZM12.094 4.41677L11.1198 4.4169C10.2943 4.41519 9.6258 3.75763 9.6258 2.94702V1.89466L12.094 4.41677ZM8.85417 10.3154C9.19425 10.3154 9.46993 10.5859 9.46993 10.9195C9.46993 11.2253 9.23828 11.4781 8.93773 11.5181L8.85417 11.5236H4.42314C4.08306 11.5236 3.80737 11.2531 3.80737 10.9195C3.80737 10.6137 4.03903 10.361 4.33958 10.321L4.42314 10.3154H8.85417ZM7.79387 6.93084C7.79387 6.59722 7.51818 6.32677 7.17811 6.32677H4.42277L4.33921 6.33229C4.03866 6.37229 3.80701 6.62502 3.80701 6.93084C3.80701 7.26445 4.08269 7.5349 4.42277 7.5349H7.17811L7.26166 7.52938C7.56222 7.48938 7.79387 7.23665 7.79387 6.93084Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Юридический пакет документов (Договор найма, опись имущества, расписка, методичка по
                                    заселению за 24 часа)</div>
                            </div>
                        </div>
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8.04637 6.51476e-05C5.23708 -0.0112245 2.62843 1.44548 1.16848 3.83995C-0.291671 6.23474 -0.389694 9.21799 0.910122 11.7032L1.05718 11.9899C1.1134 12.0952 1.12424 12.2089 1.09167 12.314C0.881633 12.869 0.697091 13.4684 0.549838 14.0774L0.534205 14.2086C0.534205 14.8209 0.860925 15.2417 1.50937 15.2273L1.61734 15.2143C2.20638 15.0842 2.78648 14.9166 3.35408 14.7126C3.42932 14.6935 3.55256 14.7009 3.66377 14.7464L4.20979 15.0554C4.21102 15.0592 4.21194 15.0621 4.21766 15.0654L4.25431 15.0783C7.19435 16.6242 10.785 16.1977 13.2798 14.0062C15.7749 11.8143 16.656 8.31196 15.494 5.20297C14.3322 2.09429 11.3692 0.0244852 8.04637 6.51476e-05ZM7.81401 1.11916L8.0387 1.11564C10.8985 1.13739 13.4487 2.91883 14.4484 5.59381C15.448 8.2685 14.6901 11.2816 12.5431 13.1676L12.3669 13.3172C10.2901 15.0224 7.40659 15.366 4.98617 14.1974L4.75599 14.082L4.76585 14.0833L4.75129 14.0793L4.41344 13.8855C4.29178 13.8167 4.19528 13.7646 4.1175 13.7272C3.74698 13.5744 3.37085 13.5519 3.01709 13.6493L2.68219 13.7643C2.46086 13.8374 2.243 13.9035 2.0262 13.9632L1.71016 14.0458L1.63487 14.3399C1.77137 13.7753 1.94245 13.2196 2.14713 12.676C2.27884 12.2546 2.23856 11.8324 2.04606 11.4721L1.90132 11.1898C0.781034 9.04784 0.865359 6.48146 2.12159 4.42113C3.33872 2.4249 5.48397 1.18582 7.81401 1.11916ZM3.57969 8C3.57969 7.49584 3.98869 7.0875 4.49278 7.0875C4.99686 7.0875 5.40586 7.49584 5.40586 8C5.40586 8.50417 4.99686 8.91251 4.49278 8.91251C3.98869 8.91251 3.57969 8.50417 3.57969 8ZM7.12917 8.0001C7.12917 7.49594 7.53818 7.0876 8.04226 7.0876C8.54634 7.0876 8.95535 7.49594 8.95535 8.0001C8.95535 8.50427 8.54634 8.91261 8.04226 8.91261C7.53818 8.91261 7.12917 8.50427 7.12917 8.0001ZM11.5918 7.0876C11.0877 7.0876 10.6787 7.49594 10.6787 8.0001C10.6787 8.50427 11.0877 8.91261 11.5918 8.91261C12.0959 8.91261 12.5049 8.50427 12.5049 8.0001C12.5049 7.49594 12.0959 7.0876 11.5918 7.0876Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Адвоката по недвижимости на весь срок проживания</div>
                            </div>
                        </div>
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M2.27213 0H19.7279C20.9885 0 22 1.04352 22 2.32018V4.02151C22 4.6415 21.7586 5.23568 21.3281 5.66977L13.8846 13.2168L13.8852 18.9314C13.8852 19.1915 13.7538 19.4311 13.5407 19.5718L13.4446 19.6257L8.55719 21.926C8.04819 22.1656 7.46293 21.7942 7.46293 21.2317L7.4626 13.1994L0.605905 5.63882C0.258977 5.25706 0.0500701 4.76916 0.00792944 4.25451L0 4.06041V2.32018C0 1.04352 1.0115 0 2.27213 0ZM19.7279 1.53482H2.27213C1.87009 1.53482 1.53488 1.88064 1.53488 2.32018V4.06041C1.53488 4.26575 1.60958 4.46108 1.74234 4.60717L8.79884 12.3875C8.92689 12.5287 8.99781 12.7125 8.99781 12.9031L8.99749 20.0212L12.3497 18.4444L12.3503 12.9031C12.3503 12.7417 12.4011 12.5856 12.4939 12.4561L12.5713 12.3643L20.2367 4.59057C20.3818 4.44424 20.4651 4.23924 20.4651 4.02151V2.32018C20.4651 1.88064 20.1299 1.53482 19.7279 1.53482Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Автоматический подбор вариантов, вы будете первыми узнавать о новых вариантах.</div>
                            </div>
                        </div>
                        <div class="icon-list__item">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto lh-0">
                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M7.00815 4.1124e-05C9.39717 4.1124e-05 11.3458 1.80534 11.4418 4.06612L11.4455 4.2409V5.50165C12.9325 5.99498 14 7.34574 14 8.93521V12.3664C14 14.3736 12.2978 16 10.198 16H3.80197C1.70216 16 0 14.3736 0 12.3664V8.93521C0 7.3456 1.06765 5.99474 2.55493 5.50152L2.55494 4.22227C2.56566 1.87986 4.56043 -0.0101629 7.00815 4.1124e-05ZM10.1898 4.2409V5.30159H3.81054V4.2249L3.81539 4.06865C3.90793 2.46446 5.30333 1.19295 7.00541 1.20004C8.76497 1.20005 10.1898 2.56185 10.1898 4.2409ZM10.198 6.50154H3.8019C2.39549 6.50154 1.25553 7.59082 1.25553 8.93515V12.3664C1.25553 13.7107 2.39549 14.8 3.8019 14.8H10.198C11.6044 14.8 12.7443 13.7107 12.7443 12.3664V8.93515C12.7443 7.59082 11.6044 6.50154 10.198 6.50154ZM7.62225 9.68106C7.58068 9.3882 7.31801 9.16248 7.00018 9.16248C6.65345 9.16248 6.37238 9.43111 6.37238 9.76248V11.5393L6.37811 11.6207C6.41968 11.9136 6.68235 12.1393 7.00018 12.1393C7.3469 12.1393 7.62798 11.8707 7.62798 11.5393V9.76248L7.62225 9.68106Z"
                                              fill="#A3CC4A" />
                                    </svg>
                                </div>
                                <div class="col">Поддержка до полного заселения</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top border-4 px-4 tarif-take-keys-vip-margin mt-4"></div>
                <div class="text-center mt-4">
                    <div class="badge-yellow"><span class="tarif-take-keys-vip-timer fw-semibold">40:00</span> до конца акции
                    </div>
                </div>

                <div class="text-center text-uppercase text-muted mb-2 mt-4">Обычная цена: <s class="rub text-nowrap">12 900</s>
                    ₽</div>
                <div class="text-center text-uppercase mb-2 fw-bold">Ваша цена: <span class="rub text-nowrap">4 773</span> ₽
                </div>
                <div class="text-center small text-muted">Скидка 63%, экономия <span class="rub text-nowrap">8 127</span> ₽
                </div>

                <button class="btn px-1 fw-500 btn-primary w-100 rounded-pill mt-3 vibrate">
                    <span class="fs-18">Получить лицензию по специальной цене</span>
                </button>

                <div class="text-center text-uppercase fw-bold mt-4">Или воспользуйтесь рассрочкой:<br />3 платежа по <span
                            class="rub text-nowrap">1 591</span> ₽</div>
                <button class="btn px-1 fw-500 btn-danger w-100 rounded-pill mt-3">
                    <span class="fs-18">Получить лицензию за <span class="rub text-nowrap">1 591</span> ₽</span>
                </button>
                <div class="text-center mt-2 text-muted lh-sm"><small>* Для граждан РФ действуют и другие варианты рассрочки — <br/><a href="#">пишите
                            менеджеру в WhatsApp и он расскажет вам все подробности.</a></small></div>

                <div class="fw-semibold fs-18 mt-3 text-center">Посмотрите на отзывы и результаты,<br />98% пользователей
                    заселяются в день обращения:</div>

                <div class="slider">
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/X9IuWFbp7gM/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась всего-лишь за 2 часа, переехав из Казани в Москву!</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/ik5e2xaZYXE/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась.</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/Hv_P92E-8Es/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась.</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/rgaty5K-Sks/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась всего-лишь за 2 часа, переехав из Казани в Москву!</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/iAqPOvYpPos/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась всего-лишь за 2 часа.</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/IyqRp7UMOHY/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась.</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/_Lh6XaSf74M/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась всего-лишь за 2 часа, переехав из Казани в Москву!</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="slider__item-inner">
                            <div class="slider__video slider__video--enabled">
                                <img class="slider__img" src="https://img.youtube.com/vi/W2_X5T7SzJA/0.jpg">
                                <button class="slider__btn" aria-label="Запустить видео">
                                    <svg width="68" height="48" viewBox="0 0 68 48">
                                        <path class="slider__button-shape"
                                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
                                        </path>
                                        <path class="slider__button-icon" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="slider__heading">Соня заселилась всего-лишь за 2 часа.</h3>
                            <p class="slider__city">г. Краснодар</p>
                        </div>
                    </div>
                </div>

                <p class="mt-4 text-center">Программа заселения состоит из 5 шагов</p>

                <div class="border border-primary border-3 rounded-3">
                    <div class="p-3">
                        <p class="fw-semibold mt-3">1 ШАГ: ПОДКЛЮЧИТЕ ЛИЦЕНЗИЮ</p>
                        <p>1. Оплатив лицензию вы получаете полный доступ к системе недвижимости Take Keys и становитесь Vip клиентом</p>

                        <p>2. Система автоматически до полного заселения запрограммированна подбирать, проверять и уведомлять вас о
                            новых, горячих подходящих вариантах.</p>

                        <p class="fw-semibold mt-4">РЕЗУЛЬТАТ:</p>
                        <p>Вы получите VIP статус на 365 дней и сможете оставлять заявки на просмотр квартир, связываться с владельцами
                            без ограничений, договариваться о встрече и бронировать самый лучший вариант.</p>
                    </div>
                    <div class="bg-light p-3">
                        <p class="fw-semibold">2 ШАГ: ПРОВЕРКА ДОКУМЕНТОВ</p>
                        <p>1. Прежде чем заключить договор с владельцем необходимо проверить документы на право собственности это можно
                            легко сделать заказав выписку из ЕГРН</p>

                        <p class="fw-semibold mt-4">РЕЗУЛЬТАТ:</p>
                        <p>В результате вы гарантированно снимите квартиру от собственника. Будьте внимательны на бесплатных досках
                            объявлений часто встречаются сомнительные предложения, так одна девушка которая решила искать самостоятельно
                            жаловалась, как нашла квартиру на Avito, посмотрела, заплатила 30 000 руб за первый месяц + 100% залог, а на
                            следующий день в расчётный час в 12 пришёл настоящий собственник который сдаёт эту квартиру посуточно....
                            обязательно заказывайте выписку из ЕГРН!</p>
                    </div>
                    <div class="p-3">
                        <p class="fw-semibold mt-4">3 ШАГ: Юридическое оформление сделки</p>
                        <p>1. Можете заключить договор аренды онлайн не выходя из дома или на бумаге при личной встрече.</p>

                        <p>2. Сделайте короткую видео опись имущества, снимите на камеру ремонт, мебель, техрику, а так же показатели
                            счётчика чтобы сохранить начальное состояние квартиры и не допустить спорных вопросов при съезде.</p>

                        <p>3. Заполните бланки описи имущества в текстовом формате</p>

                        <p>4. Заполните бланки расписки, если будете оплачивать аренду наличными - берите с собственника каждый раз
                            подпись в получение денег.</p>
                    </div>

                </div>

                <p class="fw-semibold mt-4 fs-5 text-center">РЕЗУЛЬТАТ</p>

                <p class="border border-primary border-3 rounded-3 border-dashed text-center fw-semibold p-3">Вы снимите квартиру напрямую от собственника и будете довольны</p>

                <form id="open-purchase-form">
                    <button class="btn px-1 fw-500 btn-primary w-100 rounded-pill">
                        <span class="fs-18">Получить лицензию Take Vip Keys</span>
                    </button>
                </form>

                <div class="text-center fw-semibold mt-4">Мы настолько уверены в программе заселения Take-Keys, что гарантируем
                    <p class="fs-2 fw-lighter mt-3">100% ВОЗВРАТ СРЕДСТВ</p>
                    Если вы арендуете жильё которого нет в нашей системе, то мы просто вернём ваши деньги без лишних вопросов.</div>
            </div>
        </div>
    </div>
</div>