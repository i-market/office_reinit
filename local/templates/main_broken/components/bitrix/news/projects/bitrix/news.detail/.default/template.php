<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
foreach($arResult["PROPERTIES"] as $propertyCode=>$arProperty)
    if($arProperty["VALUE"])
        $arProperties[$propertyCode] = $arProperty["VALUE"];

_c($arProperties)?>
<section class="wrap_title wrap_title--pages">
    <div class="wrap_min">
        <div class="main_title">
            <span class="sub_link">
                <a href="/projects/">проекты</a>
            </span>
            <h2><?=$arResult["NAME"]?></h2>
        </div>
    </div>
</section>
<section class="prof_project">
    <div class="wrap_min">
        <div class="prof_project_info">
            <p class="title">
                Проект <?=$arResult["NAME"]?>
            </p>
            <ul prof_project_info_list>
                <li>
                    <span>Дизайн-бюро</span>
                    <span><?=$arProperties["COMPANY"]?></span>
                </li>
                <li>
                    <span>Город:</span>
                    <span><?=$arProperties["CITY"]?></span>
                </li>
                <li>
                    <span>Зоны:</span>
                    <span><?=implode("<br>", $arProperties["ZONE"])?></span>
                </li>
                <li>
                    <span>Клиент:</span>
                    <span><?=$arProperties["CLIENT"]?></span>
                </li>
                <li>
                    <span>Сфера бизнеса:</span>
                    <span><?=$arProperties["BUSINESS_AREA"]?></span>
                </li>
                <li>
                    <span>Площадь</span>
                    <span><?=$arProperties["SQUARE"]?></span>
                </li>
                <li>
                    <span>Год реализации</span>
                    <span><?=$arProperties["YEAR"]?></span>
                </li>
                <li>
                    <span>Менеджер проекта</span>
                    <span><?=$arProperties["MANAGER"]?></span>
                </li>
                <li>
                    <span>Дизайнер</span>
                    <span><?=$arProperties["DESIGNER"]?></span>
                </li>
                <li>
                    <span>Мебель</span>
                    <div class="prof_project_info_links">
                        <div class="prof_project_info_links_wrap_inner">
                            <?foreach($arResult["COLLECTIONS"] as $sectionName=>$arCollections):?>
                                <div class="inner">
                                    <strong><?=$sectionName?>: </strong>
                                    <?foreach($arCollections as $collectionId=>$arCollection):?>
                                        <p>
                                            <a href="<?=$arCollection["DETAIL_PAGE_URL"]?>"><?=$arCollection["NAME"]?></a>
                                        </p>
                                    <?endforeach?>
                                </div>
                            <?endforeach?>
                        </div>
                        <?/*
                        <div class="prof_project_info_links_open"></div>*/?>
                    </div>
                </li><?/*
                <li class="wrap_rating">
                    <span>Оценка</span>
                    <span class="rating">4.5</span>
                </li>*/?>
            </ul><?/*
            <div class="prof_project_info_rating">
                <h4>Оцените проект</h4>
                <div class="star-rating">
                    <div class="star-rating__wrap">
                        <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
                        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                        <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                        <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
                        <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
                        <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
                    </div>
                </div>
                <div class="rating_thanks">
                    <span class="close"></span>
                    <div class="text">
                        <strong>Спасибо</strong>
                        <p>
                            Но вы уже поставили оценку этому проекту!
                        </p>
                    </div>
                </div>
            </div>*/?>
        </div>
        <div class="prof_project_slider">
            <div class="wrap_prof_slider">
                <div class="prof_slider_main">
                    <?foreach($arResult["IMAGES"] as $arPicture):?>
                        <a class="gallery slide" data-fancybox="group" href="<?=$arPicture["ORIGINAL"]?>">
                            <img src="<?=$arPicture["SRC"]?>" alt="">
                        </a>
                    <?endforeach?>
                </div>
                <div class="dots"></div>
                <div class="wrap_prof_slider_thums">
                    <span class="arrow prev"></span>
                    <div class="prof_slider_thums">
                        <?foreach($arResult["IMAGES"] as $arPicture):?>
                            <div class="slide">
                                <img src="<?=$arPicture["THUMB"]?>" alt="">
                            </div>
                        <?endforeach?>
                    </div>
                    <span class="arrow next"></span>
                </div>
            </div>
            <div class="prof_project_slider_text">
                <?=$arResult["DETAIL_TEXT"]?>
            </div>
        </div>
    </div>
</section>
<section class="prof_project_comments">
    <div class="wrap_min">
        <div class="prof_news_inner">
            <p class="prof_news_title">
                комментарии
            </p>
            <?if(!$USER->isAuthorized()):?>
                <div class="inner prof_news_sign_in">
                    <p>
                        Комментарии доступны только авторизованным пользователям!
                    </p>
                    <p>
                        <a href="#">Авторизуйтесь</a> или <a href="#">зарегстрируйтесь</a>
                    </p>
                </div>
            <?endif?>

            <div class="inner">
                <div class="wrap_comments">
                    <div class="comment">
                        <p class="name">
                            Комментариев пока нет
                        </p>
                    </div>
                </div>
                <?/*
                <div class="show_more_comments">
                    <span class="show_more">Показать еще</span>
                </div>
                <div class="write_new_coment">
                    <span class="square_button" data-modal="leave_comment"> <span>оставьте комментарий</span> </span>
                </div>*/?>
            </div>
        </div>
    </div>
</section>
<?/*
<section class="prolect">
    <div class="wrap_min">
        <h3>другие проекты дилера</h3>
        <div class="project_items">
            <div class="grid">
                <div class="col col_3 project_box">
                    <div class="img">
                        <a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_17.jpg" alt=""> </a>
                    </div>
                    <div class="info">
                        <div class="inner">
                            <a href="#" class="title">White lotos</a>
                            <p class="name">
                                <a href="#">Дизайн-бюро “Alfa Architect”</a>
                            </p>
                            <p class="comments">
                                комментарии<span class="comments_number">23</span>
                            </p>
                        </div>
                        <div class="rating">
                            4.5
                        </div>
                    </div>
                </div>
                <div class="col col_3 project_box">
                    <div class="img">
                        <a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_17.jpg" alt=""> </a>
                    </div>
                    <div class="info">
                        <div class="inner">
                            <a href="#" class="title">White lotos</a>
                            <p class="name">
                                <a href="#">Дизайн-бюро “Alfa Architect” Дизайн-бюро “Alfa Architect”</a>
                            </p>
                            <p class="comments">
                                комментарии<span class="comments_number">23</span>
                            </p>
                        </div>
                        <div class="rating">
                            4.5
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
*/?>
 */