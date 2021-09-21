<?php
/**
 * @var object $object
 * @var array $images
 * @var string VIEW_PATH
 **/
$page_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$page_url = explode('?', $page_url);
$page_url = $page_url[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/swiper.min.css">
    <link rel="stylesheet" href="/css/settings.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta property="og:title" content="<?=$object->title?><?=strlen($object->title) > 0 ? " | " : ""?>Take Keys">
    <meta property="og:description" content="<?=substr($object->description, 0, 100)?>...">
    <meta property="og:image" content="<?=$images[0]->path?>">
    <meta property="og:url" content="<?=$page_url?>">
    
    <title><?=$object->title?><?=strlen($object->title) > 0 ? " | " : ""?>Take Keys</title>
</head>
<body>
<symbol style="display: none;">
    <svg id="iconEye" viewBox="0 0 48 48">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.2882 16.0048L24.002 16C19.8611 16 16.1293 18.9231 14.0609 23.7058C13.9797 23.8936 13.9797 24.1064 14.0609 24.2942L14.2042 24.6168C16.2464 29.0931 19.7754 31.8644 23.7118 31.9952L23.998 32C28.1389 32 31.8707 29.0769 33.9391 24.2942C34.0213 24.104 34.0202 23.8884 33.9361 23.699L33.7968 23.3856C31.7497 18.9009 28.2192 16.1355 24.2882 16.0048ZM24.009 17.4894L24.2479 17.4946L24.5149 17.5085C27.7122 17.7348 30.6525 20.1055 32.429 23.9991L32.4197 24.0231C30.5987 28.0005 27.5569 30.3853 24.2589 30.505L24.004 30.5088L23.7469 30.5054L23.4806 30.4915C20.3827 30.2721 17.5264 28.0344 15.7391 24.3597L15.57 23.9991L15.7266 23.6662C17.6112 19.7731 20.6915 17.4903 24.009 17.4894ZM23.9995 20.1135C21.8391 20.1135 20.0885 21.8531 20.0885 24.0002C20.0885 26.1465 21.8393 27.8859 23.9995 27.8859C26.1598 27.8859 27.9115 26.1463 27.9115 24.0002C27.9115 21.8532 26.16 20.1135 23.9995 20.1135ZM23.9995 21.6038C25.3317 21.6038 26.4115 22.6764 26.4115 24.0002C26.4115 25.3231 25.3316 26.3956 23.9995 26.3956C22.6677 26.3956 21.5885 25.3234 21.5885 24.0002C21.5885 22.6761 22.6676 21.6038 23.9995 21.6038Z"/>
    </svg>
    <svg id="iconInfo" viewBox="0 0 24 24">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.99988 12.0002C1.99988 6.47803 6.47766 2.00024 11.9999 2.00024C17.5228 2.00024 21.9999 6.4777 21.9999 12.0002C21.9999 17.5228 17.5228 22.0002 11.9999 22.0002C6.47766 22.0002 1.99988 17.5225 1.99988 12.0002ZM20.4999 12.0002C20.4999 7.3061 16.6943 3.50024 11.9999 3.50024C7.30609 3.50024 3.49988 7.30646 3.49988 12.0002C3.49988 16.694 7.30609 20.5002 11.9999 20.5002C16.6943 20.5002 20.4999 16.6944 20.4999 12.0002ZM11.995 7.45434C12.3747 7.45434 12.6885 7.7365 12.7381 8.10257L12.745 8.20434V12.6233C12.745 13.0376 12.4092 13.3733 11.995 13.3733C11.6153 13.3733 11.3015 13.0912 11.2518 12.7251L11.245 12.6233V8.20434C11.245 7.79013 11.5808 7.45434 11.995 7.45434ZM12.755 15.7961C12.755 15.3819 12.4192 15.0461 12.005 15.0461L11.8932 15.053C11.5271 15.1027 11.245 15.4164 11.245 15.7961C11.245 16.2104 11.5808 16.5461 11.995 16.5461L12.1067 16.5393C12.4728 16.4896 12.755 16.1758 12.755 15.7961Z"/>
    </svg>
    <svg id="iconArrowDown" viewBox="0 0 24 24">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 9.46967C16.8232 9.76256 16.8232 10.2374 16.5303 10.5303L12.5303 14.5303C12.3897 14.671 12.1989 14.75 12 14.75C11.8011 14.75 11.6103 14.671 11.4697 14.5303L7.46967 10.5303C7.17678 10.2374 7.17678 9.76256 7.46967 9.46967C7.76256 9.17678 8.23744 9.17678 8.53033 9.46967L12 12.9393L15.4697 9.46967C15.7626 9.17678 16.2374 9.17678 16.5303 9.46967Z"/>
    </svg>
    <svg id="iconNotify" viewBox="0 0 24 24">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2973 5.25428C17.5242 5.94696 18.4643 7.0682 18.4643 8.62952V13.8761L21.0888 16.8398C22.0889 17.9691 21.2871 19.75 19.7787 19.75H4.22131C2.71286 19.75 1.91113 17.9691 2.91119 16.8398L5.53571 13.8761V8.62945C5.53571 7.06816 6.47583 5.94693 7.7027 5.25427C8.91595 4.56929 10.4807 4.25 12 4.25C13.5193 4.25 15.084 4.56929 16.2973 5.25428ZM8.44016 6.56047C7.52417 7.07762 7.03571 7.77112 7.03571 8.62945V13.9713C7.03571 14.2774 6.9235 14.5715 6.72152 14.7996L4.03415 17.8343C3.89129 17.9956 4.00582 18.25 4.22131 18.25H19.7787C19.9942 18.25 20.1087 17.9956 19.9658 17.8343L17.2785 14.7996C17.0765 14.5715 16.9643 14.2774 16.9643 13.9713V8.62952C16.9643 7.77115 16.4758 7.07763 15.5598 6.56047C14.6302 6.03563 13.3378 5.75 12 5.75C10.6622 5.75 9.36976 6.03563 8.44016 6.56047Z"/>
        <path d="M14 3.5C14 4.60457 13.1046 5.5 12 5.5C10.8954 5.5 10 4.60457 10 3.5C10 2.39543 10.8954 1.5 12 1.5C13.1046 1.5 14 2.39543 14 3.5Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.75 18.25H16.2496V19C16.2496 20.0351 15.7689 20.9996 14.9626 21.6908C14.1598 22.3789 13.0926 22.75 11.9996 22.75C10.9117 22.75 9.81814 22.3819 9.01181 21.6908C8.19323 20.9891 7.75 20.0198 7.75 19L7.75 18.25ZM9.39798 19.75C9.51935 20.0445 9.71565 20.3184 9.988 20.5519C10.4944 20.986 11.231 21.25 11.9996 21.25C12.7631 21.25 13.4764 20.989 13.9864 20.5519C14.2624 20.3153 14.4642 20.0408 14.5908 19.75H9.39798Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8569 3.11424C17.07 2.75906 17.5307 2.64388 17.8859 2.85699C20.7354 4.5667 21.25 7.42301 21.25 10.0001C21.25 10.4143 20.9142 10.7501 20.5 10.7501C20.0858 10.7501 19.75 10.4143 19.75 10.0001C19.75 7.57722 19.2646 5.43353 17.1141 4.14323C16.7589 3.93012 16.6438 3.46943 16.8569 3.11424Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.14313 3.11424C6.93002 2.75906 6.46932 2.64388 6.11414 2.85699C4.74385 3.67917 3.87548 4.67203 3.369 5.90205C2.87437 7.1033 2.75001 8.47298 2.75001 10.0001C2.75001 10.4143 3.0858 10.7501 3.50001 10.7501C3.91422 10.7501 4.25001 10.4143 4.25001 10.0001C4.25001 8.52724 4.37565 7.39693 4.75602 6.47318C5.12454 5.5782 5.75617 4.82106 6.88588 4.14323C7.24107 3.93012 7.35624 3.46943 7.14313 3.11424Z"/>
    </svg>
    <svg id="iconBelay" viewBox="0 0 24 24">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3853 2.10169L4.74174 4.37005C3.99797 4.62306 3.5 5.30545 3.5 6.07198V12.7097C3.5 14.7315 4.2529 16.6789 5.60912 18.196C6.24795 18.9121 7.06192 19.5077 8.04931 20.0259L11.6466 21.9118C11.8711 22.0295 12.1414 22.0294 12.3658 21.9116L15.9568 20.0269C16.9415 19.5095 17.7555 18.9127 18.3944 18.1964C19.7486 16.6804 20.5 14.7342 20.5 12.7136V6.07198C20.5 5.30545 20.002 4.62306 19.2574 4.36977L12.6156 2.10202C12.218 1.96605 11.7837 1.96605 11.3853 2.10169ZM12.1131 3.48951L18.7563 5.75777C18.8945 5.80477 18.9861 5.9303 18.9861 6.07198V12.7136C18.9861 14.3792 18.3668 15.9832 17.2508 17.2327L17.0525 17.4427C16.5722 17.9246 15.9672 18.3492 15.2369 18.7329L12.005 20.4283L8.76848 18.7316C7.9313 18.2922 7.26044 17.8013 6.75256 17.232C5.63446 15.9813 5.01389 14.3761 5.01389 12.7097V6.07198C5.01389 5.9303 5.1055 5.80477 5.24283 5.75805L11.8866 3.48962C11.9599 3.46466 12.0404 3.46466 12.1131 3.48951ZM15.7553 9.2399C15.4597 8.95269 14.9804 8.95269 14.6848 9.2399L11.2854 12.5422L9.91181 11.2062L9.82693 11.1349C9.53066 10.9212 9.11013 10.9448 8.84132 11.2059C8.54564 11.493 8.54551 11.9587 8.84104 12.246L10.7506 14.1023L10.8355 14.1735C11.1318 14.3872 11.5524 14.3636 11.8212 14.1024L15.7553 10.28L15.8286 10.1975C16.0485 9.90959 16.024 9.501 15.7553 9.2399Z"/>
    </svg>
    <svg id="iconFavourite" viewBox="0 0 24 24">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48311 2.81529C2.81152 3.99738 1.17386 8.00569 2.40482 11.8295C3.02947 13.6301 4.04534 15.2485 5.38004 16.5762C7.21101 18.3545 9.22254 19.9194 11.3849 21.2491L11.6304 21.3961C11.8656 21.5369 12.1598 21.5344 12.3926 21.3897L12.6218 21.2473C14.7812 19.9194 16.7927 18.3545 18.6174 16.5824C19.9584 15.2485 20.9743 13.6301 21.5937 11.8452C22.8291 8.00801 21.1847 3.9978 17.512 2.81535L17.2463 2.73623C15.5624 2.27309 13.773 2.5013 12.2645 3.35535L11.9964 3.51429L11.733 3.35623C10.1419 2.45344 8.2404 2.25003 6.48311 2.81529ZM11.3746 4.85427L11.5714 4.99538C11.8307 5.18111 12.1806 5.17742 12.436 4.98625C13.766 3.99057 15.4873 3.70082 17.0641 4.20669C19.9097 5.12284 21.2047 8.28096 20.2064 11.382C19.665 12.9417 18.7687 14.3696 17.5916 15.5405L17.0636 16.0421C15.641 17.3642 14.1026 18.561 12.4691 19.6156L12.0013 19.9098L12.144 19.9998C10.0805 18.7308 8.15375 17.2319 6.40582 15.5343C5.23505 14.3696 4.33877 12.9417 3.79207 11.3664C2.79808 8.27801 4.08746 5.12212 6.93153 4.20646C8.43331 3.72339 10.0706 3.96289 11.3746 4.85427ZM15.8703 6.48374C15.4855 6.36093 15.0739 6.57304 14.951 6.95749C14.8281 7.34194 15.0404 7.75316 15.4252 7.87597C16.1814 8.11735 16.7206 8.79803 16.7881 9.60096C16.822 10.0031 17.1757 10.3017 17.5782 10.2679C17.9807 10.2341 18.2796 9.8807 18.2457 9.47853C18.1288 8.08859 17.1917 6.90551 15.8703 6.48374Z"/>
    </svg>
    <svg id="iconForward" viewBox="0 0 48 48">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7143 22.5359C15.6294 22.5359 14.75 23.4153 14.75 24.5002C14.75 25.585 15.6294 26.4645 16.7143 26.4645C17.7991 26.4645 18.6786 25.585 18.6786 24.5002C18.6786 23.4153 17.7991 22.5359 16.7143 22.5359ZM13.25 24.5002C13.25 22.5869 14.801 21.0359 16.7143 21.0359C18.6276 21.0359 20.1786 22.5869 20.1786 24.5002C20.1786 26.4134 18.6276 27.9645 16.7143 27.9645C14.801 27.9645 13.25 26.4134 13.25 24.5002Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M30.286 15.75C29.2012 15.75 28.3217 16.6294 28.3217 17.7143C28.3217 18.7991 29.2012 19.6786 30.286 19.6786C31.3708 19.6786 32.2503 18.7991 32.2503 17.7143C32.2503 16.6294 31.3708 15.75 30.286 15.75ZM26.8217 17.7143C26.8217 15.801 28.3727 14.25 30.286 14.25C32.1993 14.25 33.7503 15.801 33.7503 17.7143C33.7503 19.6276 32.1993 21.1786 30.286 21.1786C28.3727 21.1786 26.8217 19.6276 26.8217 17.7143Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M30.286 29.3213C29.2012 29.3213 28.3217 30.2007 28.3217 31.2856C28.3217 32.3704 29.2012 33.2499 30.286 33.2499C31.3708 33.2499 32.2503 32.3704 32.2503 31.2856C32.2503 30.2007 31.3708 29.3213 30.286 29.3213ZM26.8217 31.2856C26.8217 29.3723 28.3727 27.8213 30.286 27.8213C32.1993 27.8213 33.7503 29.3723 33.7503 31.2856C33.7503 33.1988 32.1993 34.7499 30.286 34.7499C28.3727 34.7499 26.8217 33.1988 26.8217 31.2856Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.219 18.6933C28.4277 19.0511 28.3068 19.5103 27.949 19.719L20.1783 24.2519V24.7475L27.949 29.2805C28.3068 29.4892 28.4277 29.9484 28.219 30.3062C28.0103 30.664 27.551 30.7849 27.1932 30.5761L19.1 25.8551C18.8389 25.7028 18.6783 25.4232 18.6783 25.1209V23.8786C18.6783 23.5763 18.8389 23.2967 19.1 23.1444L27.1932 18.4233C27.551 18.2146 28.0103 18.3355 28.219 18.6933Z"/>
    </svg>
    <svg id="iconLike" viewBox="0 0 48 48">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4048 23.3295C13.1739 19.5057 14.8115 15.4974 18.4831 14.3153C20.2404 13.75 22.1419 13.9534 23.733 14.8562L23.9964 15.0143L24.2645 14.8553C25.773 14.0013 27.5624 13.7731 29.2463 14.2362L29.512 14.3153C33.1847 15.4978 34.8291 19.508 33.5937 23.3452C32.9743 25.1301 31.9584 26.7485 30.6174 28.0824C28.7927 29.8545 26.7812 31.4194 24.6218 32.7473L24.3926 32.8897C24.1598 33.0344 23.8656 33.0369 23.6304 32.8961L23.3849 32.7491C21.2225 31.4194 19.211 29.8545 17.38 28.0762C16.0453 26.7485 15.0295 25.1301 14.4048 23.3295ZM23.5714 16.4954L23.3746 16.3543C22.0706 15.4629 20.4333 15.2234 18.9315 15.7065C16.0875 16.6221 14.7981 19.778 15.7921 22.8664C16.3388 24.4417 17.2351 25.8696 18.4058 27.0343C20.1537 28.7319 22.0805 30.2308 24.144 31.4998L24.0013 31.4098L24.4691 31.1156C26.1026 30.061 27.641 28.8642 29.0636 27.5421L29.5916 27.0405C30.7687 25.8696 31.665 24.4417 32.2064 22.882C33.2047 19.781 31.9097 16.6228 29.0641 15.7067C27.4873 15.2008 25.766 15.4906 24.436 16.4863C24.1806 16.6774 23.8307 16.6811 23.5714 16.4954Z"/>
    </svg>
    <svg id="iconAdd" viewBox="0 0 48 48">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.3588 14H19.6412C16.2559 14 14 16.4199 14 19.8932V28.1068C14 31.5833 16.2499 34 19.6412 34H28.3588C31.7501 34 34 31.5833 34 28.1068V19.8932C34 16.4167 31.7501 14 28.3588 14ZM19.6412 15.3953H28.3588C30.9563 15.3953 32.6047 17.1659 32.6047 19.8932V28.1068C32.6047 30.8341 30.9563 32.6047 28.3588 32.6047H19.6412C17.0437 32.6047 15.3953 30.8341 15.3953 28.1068V19.8932C15.3953 17.1695 17.0492 15.3953 19.6412 15.3953ZM24 19.8859C24.3532 19.8859 24.6451 20.1483 24.6913 20.4889L24.6977 20.5835V23.2935H27.4109C27.7962 23.2935 28.1085 23.6058 28.1085 23.9911C28.1085 24.3444 27.8461 24.6363 27.5055 24.6825L27.4109 24.6888H24.6977V27.3988C24.6977 27.7841 24.3853 28.0964 24 28.0964C23.6468 28.0964 23.3549 27.834 23.3087 27.4934L23.3023 27.3988V24.6888H20.5891C20.2038 24.6888 19.8915 24.3765 19.8915 23.9911C19.8915 23.6379 20.1539 23.346 20.4945 23.2998L20.5891 23.2935H23.3023V20.5835C23.3023 20.1982 23.6147 19.8859 24 19.8859Z"/>
    </svg>
    <svg id="iconPlus" viewBox="0 0 24 24">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8413 7.73442C12.7851 7.31967 12.4298 7 12 7C11.5311 7 11.1509 7.38044 11.1509 7.84973V11.1503H7.84906L7.73384 11.158C7.31942 11.2143 7 11.5698 7 12C7 12.4693 7.38014 12.8497 7.84906 12.8497H11.1509V16.1503L11.1587 16.2656C11.2149 16.6803 11.5701 17 12 17C12.4689 17 12.8491 16.6196 12.8491 16.1503V12.8497H16.1509L16.2662 12.842C16.6806 12.7857 17 12.4302 17 12C17 11.5307 16.6199 11.1503 16.1509 11.1503H12.8491V7.84973L12.8413 7.73442Z"/>
    </svg>
</symbol>
<section class="card">
    <div class="container">
        <div class="card__head">
            <div class="breadcrumb">
                <ul class="breadcrumb__list">
                    <li class="breadcrumb__unit">
                        <a class="breadcrumb__link">Каталог</a>
                    </li>
                    <li class="breadcrumb__unit">
                        <a class="breadcrumb__link">Аренда недвижимости</a>
                    </li>
                </ul>
            </div>
            <div class="card__head-wrapper">
                <div class="card__head-left">
                    <h1 class="card__title"><?=$object->title?></h1>
                    <ul class="card__head-list">
                        <li class="card__head-unit">
                            <span>Сегодня, 12:03</span>
                        </li>
                        <!--li class="card__head-unit _green">
                            <svg>
                                <use xlink:href="#iconEye"></use>
                            </svg>
                            <span>0 просмотров</span>
                        </li-->
                    </ul>
                </div>
                <div class="card__head-right">
                    <ul class="card__price-list">
                        <li class="card__price-unit _new"><?=$object->cost?> ₽/мес.</li>
                        <!--li class="card__price-unit _old"><?=$object->cost * 1.25?> ₽</li-->
                    </ul>
                    <div class="rent__select">
                        <div class="rent__select-overlay"></div>
                        <div class="rent__select-box">
                            <svg class="rent__select-icon">
                                <use xlink:href="#iconInfo"></use>
                            </svg>
                            <input class="rent__select-input" value="Долгострочная аренда" readonly>
                            <svg class="rent__select-arrow">
                                <use xlink:href="#iconArrowDown"></use>
                            </svg>
                        </div>
                        <div class="rent__select-dropdown">
                            <ul class="rent__select-list">
                                <li class="rent__select-unit">
                                    <label class="rent__select-label">
                                        <input class="rent__select-radio" type="radio" name="rent" checked value="Долгострочная аренда">
                                        <span class="rent__select-content">
												<span class="rent__select-name">Долгострочная аренда</span>
												<span class="rent__select-data"><?=$object->cost?> ₽</span>
											</span>
                                    </label>
                                </li>
                                <li class="rent__select-unit">
                                    <label class="rent__select-label">
                                        <input class="rent__select-radio" type="radio" name="rent" value="Посуточная аренда">
                                        <span class="rent__select-content">
												<span class="rent__select-name">Посуточная аренда</span>
												<span class="rent__select-data"><span style="color: silver">Не указана</span></span>
											</span>
                                    </label>
                                </li>
                                <li class="rent__select-unit">
                                    <label class="rent__select-label">
                                        <input class="rent__select-radio" type="radio" name="rent" value="Продажа">
                                        <span class="rent__select-content">
												<span class="rent__select-name">Продажа</span>
												<span class="rent__select-data"><span style="color: silver">Не указана</span></span>
											</span>
                                    </label>
                                </li>
                            </ul>
                            <p class="rent__select-description">*Информация указана на&nbsp;основание рыночной статистике. Окончательное решение о&nbsp;стоимости и&nbsp;типе сделки, а&nbsp;также удобства определяет собственник.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--div class="card-set">
        <div class="container">
            <div class="card-set__wrapper">
                <ul class="card-set__list">
                    <li class="card-set__unit">
                        <div class="card-set__unit-icon _green">
                            <svg>
                                <use xlink:href="#iconNotify"></use>
                            </svg>
                        </div>
                        <div class="card-set__unit-box">
                            <p class="card-set__unit-name">Уведомлять о похожих вариантах</p>
                            <button class="card-set__unit-btn">Включить</button>
                        </div>
                    </li>
                    <li class="card-set__unit">
                        <div class="card-set__unit-icon _blue">
                            <svg>
                                <use xlink:href="#iconBelay"></use>
                            </svg>
                        </div>
                        <div class="card-set__unit-box">
                            <p class="card-set__unit-name">Страховка</p>
                            <button class="card-set__unit-btn">Подробнее</button>
                        </div>
                    </li>
                    <li class="card-set__unit">
                        <div class="card-set__unit-icon _purple">
                            <svg>
                                <use xlink:href="#iconFavourite"></use>
                            </svg>
                        </div>
                        <div class="card-set__unit-box">
                            <p class="card-set__unit-name">Избранное</p>
                            <button class="card-set__unit-btn">Добавить</button>
                        </div>
                    </li>
                </ul>
                <ul class="card-set__btn-list">
                    <li class="card-set__btn-unit">
                        <button class="card-set__btn">
                            <svg>
                                <use xlink:href="#iconForward"></use>
                            </svg>
                        </button>
                    </li>
                    <!li class="card-set__btn-unit">
                        <button class="card-set__btn">
                            <svg>
                                <use xlink:href="#iconLike"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="card-set__btn-unit">
                        <button class="card-set__btn">
                            <svg>
                                <use xlink:href="#iconAdd"></use>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div-->
    <div class="separator"></div>
    <div class="container">
        <div class="card__wrapper">
            <div class="card__slider">
                <div class="card__slider-inner">
                    <?php
                    foreach($images as $image){ ?>
                        <div class="card__slider-item">
                            <img class="card__slider-img" style="height: 600px" src="<?=$image->path?>">
                        </div>
                    <?php }
                    ?>
                </div>
                <ul class="card__tag-list">
                    <!--li class="card__tag-unit _red">Лучшая цена</li-->
                    <li class="card__tag-unit _green">Новое</li>
                    <li class="card__tag-unit _yellow">Горячее</li>
                </ul>
            </div>
            <div class="card__cta">
                <form action="https://take-keys.com/go-buy" method="post">
                    <button class="card__cta-title">Связаться с продавцом</button>
                    <div class="card__cta-box">
                        <ul class="card__cta-list">
                            <li class="card__cta-unit _desktop">
                                <button class="card__cta-btn">Написать</button>
                            </li>
                            <li class="card__cta-unit _desktop">
                                <button class="card__cta-btn">Позвонить</button>
                            </li>
                            <li class="card__cta-unit">
                                <button class="card__cta-btn">Бронировать</button>
                            </li>
                        </ul>
                        <!--p class="card__cta-descr _desktop">
                            <span>Хватит тратить время на ручной поиск лучшего варианта, включите автоподбор </span>
                            <a class="card__cta-link" href="#">Подробнее</a>
                        </p>
                        <button class="card__notify-btn _desktop">
                                <span class="card__notify-icon">
                                    <svg>
                                        <use xlink:href="#iconPlus"></use>
                                    </svg>
                                </span>
                            <span class="card__notify-text">Включить уведомления</span>
                        </button-->
                    </div>
                </form>
            </div>
            <div class="card__pagination">
                <div class="card__pagination-box">
                    <svg>
                        <use xlink:href="#iconPhoto"></use>
                    </svg>
                    <span class="card__pagination-sum"></span>
                </div>
                <div class="card__pagination-slider" data-mobile="false">
                    <div class="card__pagination-inner">
                        <?php
                        foreach($images as $image){ ?>
                            <div class="card__pagination-item">
                                <img class="card__slider-img" src="<?=$image->path?>">
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="description-title address-title">Адрес: </h2>
        <ul class="card__head-list address">
            <li class="card__head-unit">
                <span style="line-height: 150%;margin-bottom: 10px;" class="address"><?=$object->address?></span>
            </li>
        </ul>
        <h2 class="description-title">Описание: </h2>
        <div class="description-content">
            <pre><?=trim($object->description)?></pre>
        </div>
    </div>
</section>    <br><br><br>
<script src="/js/swiper.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>