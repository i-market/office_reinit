<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (strlen($arResult["ERROR_MESSAGE"]) <= 0):?>
        <section class="wrap_title wrap_title--pages">
            <div class="wrap_min">
                <div class="main_title">
                    <span class="sub_link">
                        <a href="/account/">личный&nbsp;кабинет&nbsp;/</a>
                      </span>
                    <h2>корзина</h2>
                </div>
            </div>
        </section>
        <section class="complaints">
            <div class="wrap">
                <div class="wrap-complaints-table wrap-complaints-table--basket">
                    <div class="complaints-table complaints-table--basket">
                        <div class="thead">
                            <div class="tr-line">
                                <div>Наименование товара</div>
                                <div class="wrap-tr-line-inner">
                                    <div>цена</div>
                                    <div>количество</div>
                                    <div>сумма
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/euro_2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tbody">
                            <div class="istoria-zakazov-cart">
                                <?foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem):_c($arItem)?>
                                    <div class="line">
                                        <div class="img">
                                            <a class="gallery slide<?if($arItem["PROMO"]):?>  share<?endif?>" href="<?=$arItem["PICTURE"]["ORIGINAL"]?>">
                                                <img src="<?=$arItem["PICTURE"]["SRC"]?>" alt="">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <div class="top">
                                                <div class="item">
                                                    <p class="title"><?=$arItem["NAME"]?></p>
                                                    <p class="art">Артикул <span><?=$arItem["PROPERTY_ARTICUL_VALUE"]?></span>
                                                    </p>
                                                </div>
                                                <div class="item">
                                                    <span class="price<?/* green*/?>">
                                                        <?=$arItem["PRICE_FORMATED"]?>
                                                        <?/*<span class="price-discount">-33%</span>*/?>
                                                    </span>
                                                    <?/*
                                                    <p class="old-price">74 342</p>
                                                     */?>
                                                </div>
                                                <div class="item">
                                                    <span class="total"><?=$arItem["QUANTITY"]?></span>
                                                </div>
                                                <div class="item">
                                                    <p class="price"><?=$arItem["SUM"]?></p>
                                                    <?/*<p class="old-price">74 342</p>*/?>
                                                </div>
                                                <div class="item">
                                                    <span class="delete-history delete-line" data-id="<?=$arItem["ID"]?>">Удалить</span>
                                                </div>
                                            </div>
                                            <div class="bottom">
                                                <?if($arItem["SPECIFICATION"]):?>
                                                    <span class="spec">Спецификация</span>
                                                    <div class="basket-hidden-table-small">
                                                        <?foreach($arItem["SPECIFICATION"] as $arParam):?>
                                                            <div class="tr-small">
                                                                <div class="td-small"><?=$arParam["NAME"]?></div>
                                                                <div class="td-small">
                                                                    <?=$arParam["VALUE"]?>
                                                                </div>
                                                            </div>
                                                        <?endforeach?>
                                                    </div>
                                                <?else:?>
                                                    <div class="color">
                                                        <span class="text">Цвет</span>
                                                        <span class="circle" title="<?=$arItem["COLOR"]["NAME"]?>" style="background: url(<?=$arItem["COLOR"]["PICTURE"]["SRC"]?>) no-repeat"></span>
                                                    </div>
                                                <?endif?>
                                            </div>
                                        </div>
                                    </div>
                                <?endforeach?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="basket-bottom-info">
                    <div class="basket-bottom-info-top">
                        <div class="left">
                            <div class="item">
                                <div class="inner">
                                    <p class="text">максимально доступная скидка на данный объём для конечного клиента</p>
                                    <span class="percent"><?/*15%*/?></span>
                                </div>
                                <div class="wrap-btn">
                                    <a class="square_button" href="#"><span>создать спецификацию</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="item">
                                <div class="inner">
                                    <div class="total">
                                        <span class="total-text">итого:</span>
                                        <p class="price">
                                            <span class="new"><?=$arResult["allSum"]?></span>
                                            <?/*<span class="rouble">123 567руб.</span>*/?>
                                        </p>
                                    </div>
                                </div>
                                <a class="square_button" href="#"><span>сохранить заказ</span></a>
                            </div>
                            <div class="item">
                                <div class="inner">
                                    <strong class="green">со скидкой:</strong>
                                    <div class="wrap-price wrap-price--with-out-old-price">
                                        <div class="price">
                                            <div class="new"><?=$arResult["allSum"]?></div>
                                            <?/*<div class="rouble">345 345руб.</div>*/?>
                                        </div>
                                        <div class="old"></div>
                                    </div>
                                </div>
                                <a class="square_button square_button-hidden" href="#"><span>сохранить сет</span></a>
                                <a class="square_button" href="#"><span>выставить счет</span></a>
                            </div>
                        </div>
                    </div>
                    <form class="basket-bottom-info-bottom">
                        <p class="text">комментарии к заказу</p>
                        <textarea></textarea>
                    </form>
                </div>
            </div>
        </section>

<?/*    <section class="cart-point">
        <span class="cart-point-text active">1. корзина</span>
        <span class="cart-point-text">2. доставка и оплата</span>
    </section>
    <section class="cart-section">
        <div class="cart-items">
            <?foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem):?>
                <div class="cart-box">
                    <span class="close basket-delete" data-basket-id="<?=$arItem["ID"]?>"></span>
                    <div class="cart-item__img">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["PRODUCT"]["NAME"]?>">
                            <img src="<?=$arItem["PICTURE"]["SRC"]?>" alt="<?=$arItem["PRODUCT"]["NAME"]?>">
                        </a>
                    </div>
                    <div class="cart-item__info">
                        <div class="cart-item__info-top">
                            <?if($arItem["DISCOUNT_PRICE"]):?>
                                <span class="new">Sale <?=intVal($arItem["DISCOUNT_PRICE_PERCENT"])?>%</span>
                            <?endif?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="cart-item__name" title="<?=$arItem["PRODUCT"]["NAME"]?>"><?=$arItem["NAME"]?></a>
                        </div>
                        <div class="cart-item__info-bottom">
                            <div class="cart-item__inner">
                                <p class="cart-text">
                                    Размер
                                </p>
                                <span class="cart-size"><?=$arItem["OFFER"]["PROPERTY_RAZMER_VALUE"]?></span>
                            </div>
                            <div class="cart-item__inner">
                                <p class="cart-text">
                                    Цвет
                                </p>
                                <span class="cart-color" title="<?=$arItem["PRODUCT"]["PROPERTY_TSVET_1_VALUE"]?>" style="<?=$arItem["COLOR"]["STYLE"]?>"></span>
                            </div>
                            <div class="cart-item__inner">
                                <p class="cart-text">
                                    Количество
                                </p>
                                <div class="input-number" min="1" max="10" data-id="<?=$arItem["ID"]?>">
                                    <span class="input-number-decrement" data-decrement></span>
                                    <input type="text" value="<?=$arItem["QUANTITY"]?>" readonly class="basket-change" data-basket-id="<?=$arItem["ID"]?>">
                                    <span class="input-number-increment" data-increment></span>
                                </div>
                            </div>
                            <div class="cart-item__inner">
                                <p class="cart-text">
                                    Цена
                                </p>
                                <p class="catalog-item-price">
                                    <?if($arItem["DISCOUNT_PRICE"]):?>
                                        <span class="old-price"><?=$arItem["BASE_PRICE"] * $arItem["QUANTITY"]?></span>
                                    <?endif?>
                                    <span class="cart-item__price rouble<?if($arItem["DISCOUNT_PRICE"]):?> new-price<?endif?>"><?=$arItem["PRICE"] * $arItem["QUANTITY"]?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?endforeach?>
        </div>

        <?if($arResult["DISCOUNT_PRICE_ALL"]):?>
            <div class="cart-total">
                <span class="cart-total-text">Стоимость товаров:</span>
                <span class="cart-total-price">
                    <span class="rouble"><?=$arResult["allSum"] + $arResult["DISCOUNT_PRICE_ALL"]?></span>
                </span>
            </div>

            <div class="cart-total">
                <span class="cart-total-text">Скидка:</span>
                <span class="cart-total-price new-price">
                    <span class="rouble"><?=$arResult["DISCOUNT_PRICE_ALL"]?></span>
                </span>
            </div>
        <?endif?>
        <div class="cart-total">
            <span class="cart-total-text">Итого:</span>
            <span class="cart-total-price">
                <span class="rouble"><?=$arResult["allSum"]?></span>
            </span>
        </div>
    </section>
    <section class="cart-btns">
        <p>
            <a class="btn-big" href="/catalog/">←&nbsp;&nbsp;ПЕРЕЙТИ В КАТАЛОГ</a>
        </p>
        <p>
            <a class="btn-peach" href="/account/cart/order/" onclick="fbOrderInit()">продолжить</a>
        </p>
    </section>
<?else:
    $APPLICATION->SetPageProperty("content_mode", "center-mode");?>
    <section class="empty">
        <div class="empty-inner">
            <span class="empty-ico"></span>
            <h2 class="h2">ваша корзина пуста</h2>
            <a class="btn-peach" href="/catalog/">перейти в каталог</a>
        </div>
    </section>*/
endif?>