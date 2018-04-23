<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнеры");?>
<section class="banner">
    <div class="wrap">
        <img src="<?=SITE_TEMPLATE_PATH?>/images/pic_14.jpg" alt="">
    </div>
</section>
<section class="wrap_title">
    <div class="wrap_min">
        <div class="main_title">
            <h2>партнерам</h2>
        </div>
    </div>
</section>
<section class="partners">
    <div class="wrap_min">
        <p class="partners_text">
            Уважаемый посетитель сайта, если Ваша компания профессионально занимается продажами офисной мебели на территории Российской Федерации, мы готовы рассмотреть возможность сотрудничества. Уважаемый посетитель сайта, если Ваша компания профессионально занимается
            продажами офисной мебели возможность сотрудничества.
        </p>
        <div class="partners_steps">
            <div class="grid">
                <div class="col col_3">
                    <div class="item">
                        <div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/images/partners-1.png" alt=""></div>
                        <p class="title">шаг 1</p>
                        <p class="text">Для начала <b>заполните, пожалуйста</b>, <b>on-line анкету</b> ниже на участие в партнерской программе Profoffice</p>
                    </div>
                </div>
                <div class="col col_3">
                    <div class="item">
                        <div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/images/partners-2.png" alt=""></div>
                        <p class="title">шаг 2</p>
                        <p class="text">По оставленным контактным телефонам с Вами <b>связывается ведущий менеджер</b> и сообщает о принятом решении</p>
                    </div>
                </div>
                <div class="col col_3">
                    <div class="item">
                        <div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/images/partners-3.png" alt=""></div>
                        <p class="title">шаг 3</p>
                        <p class="text">В случае, если Вас устроят условия сотрудничества, на Ваш e-mail будет высланы: договор сотрудничества с дополнительными приложениями, а также <b>логин и пароль к сайту</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"partners",
	array(
		"SHOW_FIELDS" => array(
			0 => "WORK_COMPANY",
			1 => "WORK_WWW",
			2 => "WORK_PHONE",
			3 => "WORK_STREET",
			4 => "WORK_CITY",
			5 => "WORK_ZIP",
			6 => "WORK_PROFILE",
			7 => "WORK_NOTES",
		),
		"REQUIRED_FIELDS" => array(
			0 => "WORK_COMPANY",
			1 => "WORK_PHONE",
			2 => "WORK_STREET",
			3 => "WORK_CITY",
			4 => "WORK_ZIP",
			5 => "WORK_PROFILE",
		),
		"AUTH" => "N",
		"USE_BACKURL" => "N",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(
			0 => "UF_WORK_EMAIL",
			1 => "UF_WORK_PERSON",
			2 => "UF_ESHOP",
			3 => "UF_ESHOP_ORIENTIR",
			4 => "UF_EXHIBITION",
			5 => "UF_EXHIBITION_SQUARE",
			6 => "UF_EXHIBITION_FURNIT",
			7 => "UF_WORK_SEO",
			8 => "UF_WORK_DATE",
			9 => "UF_WORK_EMPLOYEES",
			10 => "UF_SUPPLIERS",
		),
		"USER_PROPERTY_NAME" => "",
		"COMPONENT_TEMPLATE" => "partners"
	),
	false,
	array(
		"HIDE_ICONS" => "N"
	)
);?>
    </div>
</section>
<section class="partners_hidden_text">
    <div class="wrap_min">
        <p class="title">шаг 1: анкета дилера</p>
        <p class="text">
            для заполнения анкеты вам нужно перейти на полноэкранную версию сайта, которая доступна с планшета или десктопа.
            <br>
            <br>
            <br>Спасибо!
        </p>
    </div>
</section>
<div class="modal" id="userRegisterModal" style="display: none">
    <div class="block">
        <span class="close">×</span>
        <strong>Сообщение</strong>
        <div class="status">
            <div class="allert_text"></div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>