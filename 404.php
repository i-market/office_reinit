<?include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");?>
<section class="wrap_title wrap_title--pages">
    <div class="wrap_min">
        <div class="main_title">
            <h2>ОШИБКА!</h2>
            <p class="sub-title">Запрашиваемая вами страница не найдена</p>
        </div>
    </div>
</section>
<section class="page-404">
    <div class="wrap">
        <div class="inner">
            <div class="picture">404</div>
        </div>
    </div>
</section>
<?$APPLICATION->IncludeComponent("bitrix:main.map", ".default", array(
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"SET_TITLE" => "N",
	"LEVEL" => "3",
	"COL_NUM" => "2",
	"SHOW_DESCRIPTION" => "Y"
), false, Array("ACTIVE_COMPONENT" => "N"));?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>