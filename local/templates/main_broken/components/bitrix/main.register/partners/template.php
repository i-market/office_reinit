<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
_c($arResult);
if($USER->IsAuthorized()) return;
if (count($arResult["ERRORS"]) > 0):
    foreach ($arResult["ERRORS"] as $key => $error)
        if (intval($key) == 0 && $key !== 0)
            $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

    ShowError(implode("<br />", $arResult["ERRORS"]));
endif?>
<div class="partners_form relative">
    <strong class="title">шаг 1: анкета дилера</strong>

    <div class="hidden_message">
        <div class="inner">
            <strong>Спасибо!</strong>
            <p>Данные анкеты отправлены. В течении 1 недели мы проверим данные и оповестим вас по электронной почте!</p>
            <p>Команда Profoffice</p>
        </div>
    </div>

    <form class="" data-type="json" data-mode="userRegister" data-result="hidden" name="regform" method="post" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">
        <input type="hidden" name="register_submit_button" value="y">
        <input type="hidden" name="LOGIN">
        <input type="hidden" name="EMAIL">
        <input type="hidden" name="PASSWORD" value="<?=$arResult["PASSWORD_RANDOM"]?>">
        <input type="hidden" name="CONFIRM_PASSWORD" value="<?=$arResult["PASSWORD_RANDOM"]?>">

        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Название организации <sup>*</sup></span>
                <input name="REGISTER[WORK_COMPANY]" type="text" class="long" value="<?=$arResult["VALUES"]["WORK_COMPANY"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Индекс <sup>*</sup></span>
                <input name="REGISTER[WORK_ZIP]" type="text" class="short" value="<?=$arResult["VALUES"]["WORK_ZIP"]?>">
            </div>
            <div class="wrap_input">
                <span class="text">Город <sup>*</sup></span>
                <input name="REGISTER[WORK_CITY]" type="text" class="long" value="<?=$arResult["VALUES"]["WORK_CITY"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">адрес <sup>*</sup></span>
                <input name="REGISTER[WORK_STREET]" type="text" class="super_long" value="<?=$arResult["VALUES"]["WORK_STREET"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Телефон <sup>*</sup></span>
                <input name="REGISTER[WORK_PHONE]" type="text" class="short" value="<?=$arResult["VALUES"]["WORK_PHONE"]?>">
            </div>
            <div class="wrap_input">
                <span class="text">E-Mail <sup>*</sup></span>
                <input name="REGISTER[UF_WORK_EMAIL]" type="text" class="long" value="<?=$arResult["VALUES"]["UF_WORK_EMAIL"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">сайт <sup>*</sup></span>
                <input name="REGISTER[WORK_WWW]" type="text" class="long" value="<?=$arResult["VALUES"]["WORK_WWW"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Контактное лицо <sup>*</sup></span>
                <input name="REGISTER[UF_WORK_PERSON]" type="text" class="long" value="<?=$arResult["VALUES"]["UF_WORK_PERSON"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Род деятельности <sup>*</sup></span>
                <input name="REGISTER[WORK_PROFILE]" type="text" class="little_long" value="<?=$arResult["VALUES"]["WORK_PROFILE"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Наличие интернет-магазина</span>
                <div class="wrap_radio">
                    <input type="radio" name="REGISTER[UF_ESHOP]" id="UF_ESHOP_OFF" checked>
                    <label for="UF_ESHOP_OFF">Нет</label>
                    <input type="radio" name="REGISTER[UF_ESHOP]" value="1" id="UF_ESHOP_ON">
                    <label for="UF_ESHOP_ON">Есть</label>
                </div>
            </div>
            <div class="wrap_input">
                <span class="text first_text">Проектно-ориентированный</span>
                <div class="wrap_radio">
                    <input type="radio" name="REGISTER[UF_ESHOP_ORIENTIR]" id="UF_ESHOP_ORIENTIR_OFF" checked>
                    <label for="UF_ESHOP_ORIENTIR_OFF">Нет</label>
                    <input type="radio" name="REGISTER[UF_ESHOP_ORIENTIR]" value="1" id="UF_ESHOP_ORIENTIR_ON">
                    <label for="UF_ESHOP_ORIENTIR_ON">Да</label>
                </div>
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Наличие выставки</span>
                <div class="wrap_radio">
                    <input type="radio" name="REGISTER[UF_EXHIBITION]" id="UF_EXHIBITION_OFF" checked>
                    <label for="UF_EXHIBITION_OFF">Нет</label>
                    <input type="radio" name="REGISTER[UF_EXHIBITION]" value="1" id="UF_EXHIBITION_ON">
                    <label for="UF_EXHIBITION_ON">Есть</label>
                </div>
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Площадь выставки</span>
                <input name="REGISTER[UF_EXHIBITION_SQUARE]" type="text" class="middle_short" value="<?=$arResult["VALUES"]["UF_EXHIBITION_SQUARE"]?>">
            </div>
            <div class="wrap_input">
                <span class="text">Мебель на выставке</span>
                <input name="REGISTER[UF_EXHIBITION_FURNITURE]" type="text" class="short" value="<?=$arResult["VALUES"]["UF_EXHIBITION_FURNITURE"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Руководитель (ФИО, должность) <sup>*</sup></span>
                <input name="REGISTER[UF_WORK_SEO]" type="text" class="super_long" value="<?=$arResult["VALUES"]["UF_WORK_SEO"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Дата основания компании</span>
                <input name="REGISTER[UF_WORK_DATE]" type="text" class="middle_short" value="<?=$arResult["VALUES"]["UF_WORK_DATE"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Количество сотрудников</span>
                <input name="REGISTER[UF_WORK_EMPLOYEES]" type="text" class="middle_short" value="<?=$arResult["VALUES"]["UF_WORK_EMPLOYEES"]?>">
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Ваши постоянные поставщики офисной мебели <sup>*</sup></span>
                <br>
                <br>
                <textarea name="REGISTER[UF_SUPPLIERS]"><?=$arResult["VALUES"]["UF_SUPPLIERS"]?></textarea>
            </div>
        </div>
        <div class="line">
            <div class="wrap_input">
                <span class="text first_text">Как вы о нас узнали</span>
                <input name="REGISTER[WORK_NOTES]" type="text" class="middle_short" value="<?=$arResult["VALUES"]["WORK_NOTES"]?>">
            </div>
        </div>
        <div class="line">
            <div class="captcha">
                <div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_KEY?>"></div>
            </div>
        </div>
        <div class="line status">
            <div class="allert">
                <span class="allert_text"></span>
            </div>
        </div>
        <button type="submit" class="square_button">
            <span>К партнерству готов</span>
        </button>
    </form>
</div>