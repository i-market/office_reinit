<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$mainPage = ($curPage = $APPLICATION->GetCurPage()) == SITE_DIR;
$userAuth = $USER->isAuthorized();
$logoSvg = '<svg version="1.1" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 444.4 116.1" style="enable-background:new 0 0 444.4 116.1;" xml:space="preserve" fill:#000="">
            <g>
                <g>
                    <g>
                        <path class="st0" d="M33.1,86.9c-1.9,0.3-3.9,0.5-5.9,0.5s-4-0.2-5.8-0.5l-0.6-0.1c-4.6-1-8.3-3.2-11.1-6.6v35.9H0V28.9h9.7V36
c2.8-3.3,6.5-5.4,11-6.5l0.6-0.1c1.9-0.4,3.9-0.5,6-0.5s4.1,0.2,6,0.5c0.2,0,0.4,0.1,0.6,0.1c6.5,1.3,11.5,4.5,15.2,9.6
c3.6,5.1,5.5,11.4,5.5,19s-1.8,14-5.5,19.1s-8.8,8.3-15.3,9.6L33.1,86.9z M27.2,77.6c5.7,0,10-1.7,13-5c3-3.4,4.5-8.2,4.5-14.5
S43.2,47,40.2,43.6s-7.4-5-13-5c-5.7,0-10,1.7-13,5c-3,3.4-4.6,8.2-4.6,14.5v0.1c0,6.3,1.5,11.1,4.6,14.4
C17.2,76,21.5,77.6,27.2,77.6z"></path>
                        <path class="st0" d="M73.8,87.3h-9.7V28.9h9.7V36c2.8-3.3,6.4-5.4,10.9-6.5l0.7-0.1c1.4-0.2,2.9-0.4,4.4-0.5v9.7
c-4.9,0.3-8.8,2-11.5,5c-2.8,3.1-4.2,7.4-4.5,12.9V87.3z"></path>
                        <path class="st0" d="M145.3,58.1c0,8.9-2.5,16-7.4,21.3s-11.6,8-19.8,8c-8.3,0-14.9-2.7-19.8-8c-4.9-5.3-7.4-12.4-7.4-21.3
c0-8.9,2.5-16,7.4-21.3s11.6-8,19.8-8c8.3,0,14.9,2.7,19.8,8C142.9,42.1,145.3,49.2,145.3,58.1z M100.6,58.1
c0,6.3,1.5,11.1,4.5,14.5s7.4,5,13.1,5c5.7,0,10-1.7,13.1-5c3-3.4,4.5-8.2,4.5-14.5s-1.5-11.1-4.5-14.5s-7.4-5-13.1-5
c-5.7,0-10,1.7-13.1,5C102,46.9,100.6,51.8,100.6,58.1z"></path>
                        <path class="st0" d="M157.8,87.3V38.5h-8.6v-9.7h8.6c0.1-8.5,2.5-15.3,7.2-20.5c4.6-5.2,10.8-7.9,18.6-8.3v9.7
c-5.1,0.3-9.1,2.1-11.8,5.3c-2.8,3.2-4.2,7.8-4.2,13.7h7.8v9.7h-7.8v48.9H157.8z"></path>
                    </g>
                    <g>
                        <path class="st0" d="M213.2,29.9c8.2,0,14.7,2.6,19.5,7.7s7.2,12.1,7.2,21s-2.4,15.9-7.2,21c-4.8,5.1-11.3,7.7-19.5,7.7
s-14.7-2.6-19.5-7.7c-4.8-5.1-7.2-12.1-7.2-21s2.4-15.9,7.2-21C198.5,32.5,205,29.9,213.2,29.9z M213.2,80.4
c6.3,0,11.1-1.9,14.6-5.7c3.4-3.8,5.2-9.2,5.2-16.1c0-6.9-1.7-12.3-5.2-16.1c-3.4-3.8-8.3-5.7-14.6-5.7s-11.1,1.9-14.6,5.7
c-3.4,3.8-5.2,9.2-5.2,16.1c0,6.9,1.7,12.3,5.2,16.1C202.1,78.5,206.9,80.4,213.2,80.4z"></path>
                        <path class="st0" d="M258.8,29.9h8.1v6.9h-8.1v50.5h-6.9V36.8H243v-6.9h8.9v-1c0-8.3,2.1-15,6.3-20c4.2-5.1,9.9-7.9,17.2-8.6v7
c-5.3,0.6-9.4,2.8-12.3,6.5s-4.4,8.8-4.4,15.1L258.8,29.9L258.8,29.9z"></path>
                        <path class="st0" d="M288.6,29.9h8.1v6.9h-8.1v50.5h-6.9V36.8h-8.9v-6.9h8.9v-1c0-8.3,2.1-15,6.3-20c4.2-5.1,9.9-7.9,17.2-8.6v7
c-5.3,0.6-9.4,2.8-12.3,6.5s-4.4,8.8-4.4,15.1L288.6,29.9L288.6,29.9z"></path>
                        <path class="st0" d="M314.2,15.7c-1.1,0-2.1-0.4-2.9-1.2c-0.8-0.8-1.2-1.8-1.2-2.9s0.4-2.1,1.2-2.9c0.8-0.8,1.8-1.2,2.9-1.2
s2.1,0.4,2.9,1.2c0.8,0.8,1.2,1.8,1.2,2.9s-0.4,2.1-1.2,2.9C316.3,15.3,315.3,15.7,314.2,15.7z M310.7,29.9h6.9v57.4h-6.9V29.9z"></path>
                        <path class="st0" d="M354.7,80.4c7.2,0,12.6-2.5,16-7.5l6.4,2.9c-2.3,3.7-5.3,6.5-9.2,8.6c-3.9,2-8.3,3-13.2,3
c-8.2,0-14.7-2.6-19.5-7.7c-4.8-5.1-7.2-12.1-7.2-21s2.4-15.9,7.2-21c4.8-5.1,11.3-7.7,19.5-7.7c4.9,0,9.2,1,13.1,3
c3.8,1.9,6.9,4.7,9.2,8.4l-6.4,2.9c-3.4-4.9-8.7-7.3-15.9-7.3c-6.3,0-11.1,1.9-14.6,5.7c-3.4,3.8-5.2,9.2-5.2,16.1
c0,6.9,1.7,12.3,5.2,16.1C343.6,78.5,348.4,80.4,354.7,80.4z"></path>
                        <path class="st0" d="M435.4,61.2h-46.3c0.1,1.5,0.3,2.7,0.5,3.7c1,5,3.2,8.8,6.6,11.5s7.8,4,13.2,4c7.8,0,13.6-2.4,17.4-7.3
l6.3,3.1c-2.4,3.5-5.6,6.3-9.7,8.2c-4.2,1.9-8.8,2.9-14,2.9c-8.3,0-15-2.5-19.8-7.5c-4.9-5.1-7.3-11.9-7.5-20.6v-0.6
c0-8.9,2.4-15.9,7.2-21c4.8-5.1,11.3-7.7,19.5-7.7c7.1,0,12.9,2,17.5,5.9c4.7,4,7.5,9.5,8.6,16.5c0.3,1.9,0.4,3.8,0.5,5.7
L435.4,61.2L435.4,61.2z M389.8,51.2c-0.3,1.1-0.5,2.4-0.6,3.8h39.1c0-0.6-0.1-1.2-0.2-1.9l-0.1-0.9c0-0.2-0.1-0.4-0.2-0.6
l-0.1-0.5c-1.1-4.6-3.3-8.2-6.6-10.6c-3.2-2.5-7.4-3.7-12.4-3.7s-9.1,1.2-12.4,3.7C393.1,43,390.9,46.6,389.8,51.2z"></path>
                    </g>
                </g>
                <g>
                    <path class="st0" d="M434.4,7.4v1.2h-3.2v9.6H430V8.6h-3.2V7.4H434.4z"></path>
                    <path class="st0" d="M444.4,7.4v10.8h-1.2v-7.4l-2.5,7.2h-1.4l0,0l-2.5-7.2v7.4h-1.2V7.4h1.3l3,8.4l0.2,0.5l3.1-8.9H444.4z"></path>
                </g>
            </g>
        </svg>';
?>
<!doctype html>
<html lang="<?=LANGUAGE_ID?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?$APPLICATION->ShowTitle()?></title>
        <?$APPLICATION->ShowHead()?>
    </head>
    <body>
        <?$APPLICATION->ShowPanel()?>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <header class="header">
            <div class="header_top">
                <div class="wrap">
                    <div class="left">
                        <div class="top">
                            <div class="choose_city_block">
                            <span class="choose_city">Москва</span>
                            <div class="dd_choose_city">
                                <span class="close"></span>
                                <h4>Выберите свой город</h4>
                                <ul class="dd_choose_city-list">
                                    <li><a href="#">Москва</a>
                                    </li>
                                    <li><a href="#">Уфа</a>
                                    </li>
                                    <li><a href="#">Питер</a>
                                    </li>
                                    <li><a href="#">Москва</a>
                                    </li>
                                    <li><a href="#" class="active">Уфа</a>
                                    </li>
                                    <li><a href="#">Питер</a>
                                    </li>
                                    <li><a href="#">Москва</a>
                                    </li>
                                    <li><a href="#">Уфа</a>
                                    </li>
                                    <li><a href="#">Питер</a>
                                    </li>
                                </ul>
                                <form class="dd_choose_city-bottom">
                                    <h4>Или укажите в поле</h4>
                                    <div class="inner">
                                        <input type="text" placeholder="Введите свой город">
                                        <button type="submit" class="square_button"><span>выбрать</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="date"><?=date("D, j F, H:i")?></span>
                            <span class="euro">65.54</span>
                            </div>
                        </div>

                        <div class="bottom">
                            <a class="tel" href="tel:<?=str_replace(" ", "", getOption("UF_PHONE"))?>"><?=getOption("UF_PHONE")?></a>
                        </div>
                    </div>
                    <div class="middle">
                        <?if($mainPage):?>
                            <div class="logo">
                                <?=$logoSvg?>
                            </div>
                        <?else:?>
                            <a class="logo" href="<?=SITE_DIR?>">
                                <?=$logoSvg?>
                            </a>
                        <?endif?>
                    </div>
                    <div class="right">
                        <?if($userAuth):?>
                            <div class="header-sign-out">
                                <a class="company" href="/account/"><?=$USER->GetFullName()?></a>
                                <a class="header-sign-out-link" href="?logout=yes">Выход</a>
                            </div>
                        <?else:?>
                            <a class="link" href="/partners/">Стать партнером</a>
                            <div class="sign_in_block">
                                <span class="link sign_in" href="javascript:">Вход</span>
                                <form class="sign_in_form ajaxform" data-type="json" data-mode="login">
                                    <strong>вход</strong>
                                    <div class="line">
                                        <span>логин</span>
                                        <input type="text" name="login">
                                    </div>
                                    <div class="line">
                                        <span>пароль</span>
                                        <input type="text" name="password">
                                    </div>
                                    <button type="submit" class="square_button">
                                        <span>Войти</span>
                                    </button>
                                    <div class="bottom">
                                        <a href="/auth/recovery/">Забыли пароль?</a>
                                        <a href="/partners/">РЕГИСТРАЦИЯ</a>
                                    </div>
                                </form>
                            </div>
                        <?endif?>
                        <div class="cart_block">
                        	<a class="cart" href="/cart/"></a>
                            <span class="cart_number"></span>
                        </div>
                        <div class="search_block">
                            <span class="search_btn"></span>
                            <form class="search_form" method="get" action="/search/">
                                <div class="search_form_main">
                                    <button type="submit" class="search_btn"></button>
                                    <input type="text" name="q" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" placeholder="поиск по сайту">
                                </div>
                                <div class="search_form_info">
                                    <p>
                                        кресло Palantin
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="wrap_hidden_logo">
                    <?if($mainPage):?>
                        <div class="logo_menu">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/logo_w.png" alt="Логотип ProfOffice">
                        </div>
                    <?else:?>
                        <a class="logo_menu" href="<?=SITE_DIR?>">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/logo_w.png" alt="Логотип ProfOffice">
                        </a>
                    <?endif?>
                </div>
                <div class="sign_in">
                    <?if($userAuth):?>
                        <a class="sign_in_btn" href="?logout=yes">Выход</a>
                    <?else:?>
                        <button class="sign_in_btn" type="button">Вход</button>
                        <form class="sign_in_hidden_form ajaxform" data-type="json" data-mode="login">
                            <strong>Вход</strong>
                            <label>
                                <span>логин</span>
                                <input type="text" name="login">
                            </label>
                            <label>
                                <span>пароль</span>
                                <input type="text" name="password">
                            </label>
                            <button class="square_button"><span>войти</span></button>
                            <div class="bottom">
                                <a href="/auth/recovery/">Забыли пароль?</a>
                                <a href="/partners/">РЕГИСТРАЦИЯ</a>
                            </div>
                        </form>
                    <?endif?>
                </div>

                <?$APPLICATION->IncludeComponent("bitrix:menu", "mega", Array(
                    "ROOT_MENU_TYPE" => "catalog",
                    "USE_EXT" => "Y",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "360000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    //"SHOW_LAST_LEVEL_BUTTONS" => "Y"
                ), false, Array("HIDE_ICONS"=>"N"))?>
            </div>
        </header>
        <main class="content">