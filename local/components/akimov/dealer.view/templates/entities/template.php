<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
_c($arResult);
_c($_REQUEST);
?>
<section class="wrap_title wrap_title--pages">
    <div class="wrap_min">
        <div class="main_title">
            <span class="sub_link">
                <a href="/account/">Личный кабинет /</a>
            </span>
            <h2>Юридические лица</h2>
        </div>
    </div>
</section>
<section class="complaints">
    <div class="wrap">
        <div class="complaints-top">
            <span class="complaints__create-link add-ur-form">Добавить юридическое лицо</span>
            <form class="ur-form" data-mode="entityAdd">
                <input type="hidden" name="user" value="<?=$arResult["USER_ID"]?>">
                <input type="hidden" name="dealer" value="<?=$arResult["DEALER_ID"]?>">
                <span class="close"></span>
                <label class="long-text">
                    <span class="text">Название организации*</span>
                    <input type="text" name="name" required>
                </label>
                <label class="half">
                    <span class="text">индекс*</span>
                    <input type="text" name="zip" required>
                </label>
                <label class="half">
                    <span class="text">Почтовый код*</span>
                    <input type="text" name="code" required>
                </label>
                <label class="small">
                    <span class="text">город*</span>
                    <input type="text" name="city" required>
                </label>
                <label>
                    <span class="text">адрес*</span>
                    <input type="text" name="address" required>
                </label>
                <label>
                    <span class="text">юр.адрес*</span>
                    <input type="text" name="legal-address" required>
                </label>
                <label>
                    <span class="text">ИНН*</span>
                    <input type="text" name="inn" required>
                </label>
                <label>
                    <span class="text">КПП*</span>
                    <input type="text" name="kpp" required>
                </label>
                <label>
                    <span class="text">ОКПО*</span>
                    <input type="text" name="okpo" required>
                </label>
                <label class="half">
                    <span class="text">телефон*</span>
                    <input type="text" name="phone" required>
                </label>
                <label class="half">
                    <span class="text">e-mail*</span>
                    <input type="text" name="email" required>
                </label>
                <label class="small">
                    <span class="text">контакт</span>
                    <input type="text" name="contact">
                </label>
                <button type="submit" class="square_button">
                    <span>добавить</span>
                </button>
            </form>
        </div>
        <div class="wrap-complaints-table wrap-complaints-table--istoria-zakazov">
            <div class="complaints-table complaints-table--ur-list">
                <div class="tbody">
                    <?foreach($arResult["ENTITIES"] as $arEntity):?>
                        <div class="tr">
                            <div class="tr-line">
                                <div>
                                    <span class="number"></span>
                                    <span class="open-table-inner"><?=$arEntity["NAME"]?></span>
                                </div>
                                <div class="table-legal-entities">
                                    <input type="checkbox" name="active" value="<?=$arEntity["ID"]?>" hidden="hidden" class="ios-toggle" id="entity_<?=$arEntity["ID"]?>"<?if($arEntity["ACTIVE"] == "Y"):?> checked<?endif?>>
                                    <label for="entity_<?=$arEntity["ID"]?>" class="checkbox-label" data-off="Не активно" data-on="Активно"></label>

                                    <?/*<?=$arEntity["ACITVE"] == "Y" ? "активно" : "неактивно"?>*/?>
                                </div>
                                <div>
                                    <span class="square_button edit-ur-form" data-id="<?=$arEntity["ID"]?>"><span>редактировать</span></span>
                                    <form class="ur-form" data-mode="entityEdit" data-id="<?=$arEntity["ID"]?>">
                                        <input type="hidden" name="user" value="<?=$arResult["USER_ID"]?>">
                                        <input type="hidden" name="dealer" value="<?=$arResult["DEALER_ID"]?>">
                                        <input type="hidden" name="entity" value="<?=$arEntity["ID"]?>">
                                        <span class="close"></span>
                                        <label class="long-text">
                                            <span class="text">Название организации*</span>
                                            <input type="text" name="name" value="<?=$arEntity["NAME"]?>" required>
                                        </label>
                                        <label class="half">
                                            <span class="text">индекс*</span>
                                            <input type="text" name="zip" value="<?=$arEntity["PROPERTY_ZIP_VALUE"]?>" required>
                                        </label>
                                        <label class="half">
                                            <span class="text">Почтовый код*</span>
                                            <input type="text" name="code" value="<?=$arEntity["PROPERTY_CODE_VALUE"]?>" required>
                                        </label>
                                        <label class="small">
                                            <span class="text">город*</span>
                                            <input type="text" name="city" value="<?=$arEntity["PROPERTY_CITY_VALUE"]?>" required>
                                        </label>
                                        <label>
                                            <span class="text">адрес*</span>
                                            <input type="text" name="address" value="<?=$arEntity["PROPERTY_ADDRESS_VALUE"]?>" required>
                                        </label>
                                        <label>
                                            <span class="text">юр.адрес*</span>
                                            <input type="text" name="legal-address" value="<?=$arEntity["PROPERTY_LEGAL_ADDRESS_VALUE"]?>" required>
                                        </label>
                                        <label>
                                            <span class="text">ИНН*</span>
                                            <input type="text" name="inn" value="<?=$arEntity["PROPERTY_INN_VALUE"]?>" required>
                                        </label>
                                        <label>
                                            <span class="text">КПП*</span>
                                            <input type="text" name="kpp" value="<?=$arEntity["PROPERTY_KPP_VALUE"]?>" required>
                                        </label>
                                        <label>
                                            <span class="text">ОКПО*</span>
                                            <input type="text" name="okpo" value="<?=$arEntity["PROPERTY_OKPO_VALUE"]?>" required>
                                        </label>
                                        <label class="half">
                                            <span class="text">телефон*</span>
                                            <input type="text" name="phone" value="<?=$arEntity["PROPERTY_PHONE_VALUE"]?>" required>
                                        </label>
                                        <label class="half">
                                            <span class="text">e-mail*</span>
                                            <input type="text" name="email" value="<?=$arEntity["PROPERTY_EMAIL_VALUE"]?>" required>
                                        </label>
                                        <label class="small">
                                            <span class="text">контакт</span>
                                            <input type="text" name="contact" value="<?=$arEntity["PROPERTY_CONTACT_VALUE"]?>">
                                        </label>
                                        <button type="submit" class="square_button">
                                            <span>Сохранить</span>
                                        </button>
                                    </form>
                                </div>
                                <div>

                                </div>
                                <div>
                                    <span class="delete-history delete-tr ur-delete" data-id="<?=$arEntity["ID"]?>">Удалить</span>
                                </div>
                            </div>
                            <div class="complaints-table__inner">
                                <div class="complaints-table__inner-block">
                                    <span class="close"></span>
                                    <div class="ur-list">
                                        <p>
                                            <span>ГОРОД</span>
                                            <span><?=$arEntity["PROPERTY_CITY_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>ИНДЕКС</span>
                                            <span><?=$arEntity["PROPERTY_ZIP_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>ПОЧТОВЫЙ КОД</span>
                                            <span><?=$arEntity["PROPERTY_CODE_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>АДРЕС</span>
                                            <span><?=$arEntity["PROPERTY_ADDRESS_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>ЮР. АДРЕС</span>
                                            <span><?=$arEntity["PROPERTY_LEGAL_ADDRESS_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>ИНН</span>
                                            <span><?=$arEntity["PROPERTY_INN_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>КПП</span>
                                            <span><?=$arEntity["PROPERTY_KPP_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>ОКПО</span>
                                            <span><?=$arEntity["PROPERTY_OKPO_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>ТЕЛЕФОН</span>
                                            <span><?=$arEntity["PROPERTY_PHONE_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>EMAIL</span>
                                            <span><?=$arEntity["PROPERTY_EMAIL_VALUE"]?></span>
                                        </p>
                                        <p>
                                            <span>КОНТАКТ</span>
                                            <span><?=$arEntity["PROPERTY_CONTACT_VALUE"]?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="ur-documents">
                                    <div class="top">
                                        <div class="item">
                                            <span class="title">документы</span>
                                        </div>
                                        <div class="item">
                                            <label class="complaints__create-link">
                                                <input type="file" hidden="hidden">загрузить документы
                                            </label>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <?/*
                                        <div class="ur-download-item">
                                            <div class="ico"></div>
                                            <p class="name">Устав</p>
                                            <p class="info">
                                                <span class="size">12mb</span>
                                                <span class="separator">/</span>
                                                <span class="extension">pdf</span>
                                            </p>
                                            <span class="delete-history delete-ur-item">Удалить</span>
                                        </div>
                                        </div>
                                        <!--сообщение-->
                                        <div class="rating_thanks">
                                            <span class="close"></span>
                                            <div class="text">
                                                <strong>ошибка!</strong>
                                                <p>Вес документа не должен превышать
                                                    <br> <strong>10mb</strong>
                                                </p>
                                            </div>
                                        </div>*/?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pages-bottom-square-link">
    <a class="square_button" href="/account/"><span>кабинет</span></a>
</section>