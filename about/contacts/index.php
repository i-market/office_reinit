<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
$cpt = new CCaptcha();
$captchaPass = COption::GetOptionString("main", "captcha_password", "");
if(strlen($captchaPass) <= 0):
    $captchaPass = randString(10);
    COption::SetOptionString("main", "captcha_password", $captchaPass);
endif;
$cpt->SetCodeCrypt($captchaPass);?>
<section class="wrap_title wrap_title--pages">
    <div class="wrap_min">
        <div class="main_title">
            <h2>контакты</h2>
        </div>
    </div>
</section>
<section class="contacts">
    <div class="wrap">
        <div class="contacts_maps">
            <div class="grid">
                <div class="col col_2 item">
                    <p class="title">
                        офис
                    </p>
                    <div class="info">
                        <p>
                            123022, Москва, ул. 1905 года, д.7, корп."Е"
                        </p>
                        <p>
                            тел.: +7 (495) 925-10-25
                        </p>
                        <a href="#">info@profoffice.ru</a>
                    </div>
                    <a class="download" download href="#">скачать карту проезда</a>
                    <div class="map">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/map_1.jpg" alt="">
                    </div>
                </div>
                <div class="col col_2 item">
                    <p class="title">
                        склад
                    </p>
                    <div class="info">
                        <p>
                            Московская обл., г. Щелково, ул.Заречная, д.151
                        </p>
                        <p>
                            тел.: +7(495) 605-23-72
                        </p>
                    </div>
                    <a class="download" download href="#">скачать карту проезда</a>
                    <div class="map">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/map_1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="contacts_managers">
            <?$arSelect = Array(
                "ID",
                "IBLOCK_ID",
                "NAME",
                "PREVIEW_PICTURE",
                "PROPERTY_TITLE",
                "PROPERTY_PHONE",
                "PROPERTY_EMAIL",
                "PROPERTY_ICQ",
                "PROPERTY_SKYPE",
                "PROPERTY_REGION"
            );
            $arResult = CIBlockElement::getList(Array("PROPERTY_POSITION"=>"ASC", "SORT"=>"ASC", "NAME"=>"ASC"), Array("IBLOCK_ID"=>IB_EMPLOYES, "ACTIVE"=>"Y"), false, false, $arSelect);
            $position = null;
            $arCompanySeo = Array();
            while($arItem = $arResult->fetch()):
                if($arItem["PROPERTY_POSITION_VALUE"] == "Директор ProfOffice"):
                    $arCompanySeo = $arItem;
                    continue;
                endif;
                if($position != $arItem["PROPERTY_POSITION_VALUE"]):
                    if($position):?>
                        </div>
                    </div>
                    <?endif;
                    $position = $arItem["PROPERTY_POSITION_VALUE"];?>
                    <div class="contacts_managers_block">
                        <h4><?=$position?></h4>
                        <div class="grid">
                <?endif?>
                        <div class="col col_3 contacts_managers_item">
                            <div class="img">
                                <img src="<?=CFile::GetPath($arItem["PREVIEW_PICTURE"])?>" alt="<?=$arItem["NAME"]?>">
                            </div>
                            <p class="name">
                                <?=$arItem["NAME"]?>
                            </p>
                            <?if($arItem["PROPERTY_REGION_VALUE"]):?>
                                <p class="city">
                                    <?=$arItem["PROPERTY_REGION_VALUE"]?>
                                </p>
                            <?endif;
                            if($arItem["PROPERTY_EMAIL_VALUE"]):?>
                                <p class="mail">
                                    <a href="mailto:<?=$arItem["PROPERTY_EMAIL_VALUE"]?>"><?=$arItem["PROPERTY_EMAIL_VALUE"]?></a>
                                </p>
                            <?endif?>

                            <ul class="info">
                                <?if($arItem["PROPERTY_PHONE_VALUE"]):?>
                                    <li>
                                        <span>Tel</span>
                                        <span><?=$arItem["PROPERTY_PHONE_VALUE"]?></span>
                                    </li>
                                <?endif;
                                if($arItem["PROPERTY_ICQ_VALUE"]):?>
                                <li>
                                    <span>ICQ</span>
                                    <span><?=$arItem["PROPERTY_ICQ_VALUE"]?></span>
                                </li>
                                <?endif;
                                if($arItem["PROPERTY_SKYPE_VALUE"]):?>
                                    <li>
                                        <span>Skype</span>
                                        <span><?=$arItem["PROPERTY_SKYPE_VALUE"]?></span>
                                    </li>
                                <?endif?>
                            </ul>
                        </div>
                    <?endwhile?>
                </div>
            </div>
        </div>
        <div class="contacts_form_block">
            <div class="left">
                <h4><?=$arCompanySeo["PROPERTY_POSITION_VALUE"]?></h4>
                <div class="contacts_managers_item">
                    <div class="img">
                        <img src="<?=CFile::GetPath($arCompanySeo["PREVIEW_PICTURE"])?>" alt="<?=$arCompanySeo["NAME"]?>">
                    </div>
                    <p class="name">
                        <?=$arCompanySeo["NAME"]?>
                    </p>
                    <?if($arCompanySeo["PROPERTY_REGION_VALUE"]):?>
                        <p class="city">
                            <?=$arCompanySeo["PROPERTY_REGION_VALUE"]?>
                        </p>
                    <?endif;
                    if($arCompanySeo["PROPERTY_EMAIL_VALUE"]):?>
                        <p class="mail">
                            <a href="mailto:<?=$arCompanySeo["PROPERTY_EMAIL_VALUE"]?>"><?=$arCompanySeo["PROPERTY_EMAIL_VALUE"]?></a>
                        </p>
                    <?endif?>
                </div>
            </div>
            <div class="right">
                <h4>По вопросам сотрудничества</h4>
                <form class="contacts_form">
                    <div class="top">
                        <label>
                            <span>Имя</span>
                            <input type="text" name="name" value="<?=$USER->GetFullName()?>">
                        </label>
                        <label>
                            <span>E-Mail</span>
                            <input type="text" name="email" value="<?=$USER->GetEmail()?>">
                        </label>
                        <label>
                            <span>Телефон</span>
                            <input type="text" name="phone" value="">
                        </label>
                    </div>
                    <div class="middle">
                        <textarea placeholder="Сообщение" name="message"></textarea>
                    </div>
                    <div class="bottom">
                        <div class="bottom_left">
                            <div class="img">
                                <input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
                                <input id="captcha_word" name="captcha_word" type="text">
                                <img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt())?>">
                            </div>
                        </div>
                        <div class="bottom_right">
                            <span class="square_button square_button--green" type=""><span>Отправить</span></span>
                        </div>
                    </div>
                    <div class="hidden_message">
                        <div class="inner">
                            <strong>Спасибо!</strong>
                            <p>
                                Ваше обращение будет рассмотрено!
                            </p>
                            <p>
                                Команда Profoffice
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>