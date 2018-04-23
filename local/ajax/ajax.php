<?define("NO_AGENT_CHECK", true);
define('STOP_STATISTICS', true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Sender,
    \Bitrix\Sender\ContactTable,
    \Bitrix\Catalog\SubscribeTable,
    \Bitrix\Catalog\Product\SubscribeManager,
    \Bitrix\Main\Mail\Event,
    \Bitrix\Sale\Internals\DiscountCouponTable;

global $APPLICATION;
global $USER;
$arResult = Array();
$arEmpty = Array();

$obUser = new CUser;
$arElement = new CIBlockElement;
if($USER->isAuthorized()):
    $userAuth = true;
    $userId = $USER->getId();
    $arUser = CUser::getById($userId)->fetch();
    $userTitle = $USER->GetFullName();
    $userEmail = $arUser["EMAIL"];
else:
    $userAuth = false;
endif;

$currentCurrency  = CCurrency::GetBaseCurrency();
$itemId = intVal($_REQUEST["id"]);
$quantity = intVal($_REQUEST["quantity"]) ? intVal($_REQUEST["quantity"]) : 1;
$iblockId = CIBlockElement::GetIBlockByID($itemId);
$basketUserId = CSaleBasket::GetBasketUserID();
$cartCount = getCartCount();
$compareCount = intVal(count($_SESSION["COMPARE_LIST"]["ITEMS"]));


switch($_REQUEST["mode"]):
    case "unsubscribe":
        $arFields = Array("UF_SUBSCRIBE"=>$_REQUEST["value"] != "true" ? "0" : "1");
        exitJson(array(
            "id"=>$userId,
            "fields"=>$arFields,
            "result"=>$USER->Update($userId, $arFields)
        ));
        break;

    case "changeActive":
        $arFields = Array("ACTIVE"=>$_REQUEST["value"] != "true" ? "N" : "Y");
        exitJson(array(
            "id"=>$_REQUEST["id"],
            "fields"=>$arFields,
            "result"=>$arElement->Update($_REQUEST["id"], $arFields)
        ));
        break;

    case "entityAdd":
        $arFields = Array(
            "IBLOCK_ID"=>IB_LEGAL,
            "NAME"=>$_REQUEST["name"],
            "ACTIVE" => "Y",
            "PROPERTY_VALUES"=>Array(
                "DEALER" => $_REQUEST["dealer"],
                "COMPANY"=>$_REQUEST["name"],
                "CODE"=>$_REQUEST["code"],
                "CITY" => $_REQUEST["city"],
                "ZIP" => $_REQUEST["zip"],
                "ADDRESS" => $_REQUEST["address"],
                "LEGAL_ADDRESS" => $_REQUEST["legal-address"],
                "INN" => $_REQUEST["inn"],
                "KPP" => $_REQUEST["kpp"],
                "OKPO" => $_REQUEST["okpo"],
                "PHONE" => $_REQUEST["phone"],
                "CONTACT" => $_REQUEST["contact"],
                "EMAIL" => $_REQUEST["email"]
            )
        );
        $arElement->Add($arFields);
        exitJson(array(
            "result" => true,
            "reload" => true,
            "title" => "Добавление юридического лица",
            "message" => "Юридическое лицо успешно добавлено"
        ));
        break;
    case "deleteUr":
        exitJson($arElement->Delete($itemId));
        break;
    case "entityEdit":
        $itemId = $_REQUEST["entity"];
        $arFields = Array(
            "IBLOCK_ID"=>IB_LEGAL,
            "NAME"=>$_REQUEST["name"]
        );
        $arProp = Array(
            "DEALER" => $_REQUEST["dealer"],
            "COMPANY"=>$_REQUEST["name"],
            "CODE"=>$_REQUEST["code"],
            "CITY" => $_REQUEST["city"],
            "ZIP" => $_REQUEST["zip"],
            "ADDRESS" => $_REQUEST["address"],
            "LEGAL_ADDRESS" => $_REQUEST["legal-address"],
            "INN" => $_REQUEST["inn"],
            "KPP" => $_REQUEST["kpp"],
            "OKPO" => $_REQUEST["okpo"],
            "PHONE" => $_REQUEST["phone"],
            "CONTACT" => $_REQUEST["contact"],
            "EMAIL" => $_REQUEST["email"]
        );
        $arElement->Update($itemId, $arFields);
        CIBlockElement::SetPropertyValuesEx($itemId, IB_LEGAL, $arProp);
        exitJson(array(
            "result" => true,
            "reload" => true,
            "title" => "Изменение юридического лица",
            "message" => "Юридическое лицо успешно изменено"
        ));
        break;
    case "employeeSetPermission":
        $USER->Update($_REQUEST["employee"], Array("UF_PERMISSION"=>$_REQUEST["permission"]));
        exitJson(array(
            "result" => true,
            "title" => "Права сотрудника",
            "message" => "Изменения успешно сохранены"
        ));
        break;
    case "employeeAdd":
        $arFields = Array(
            "NAME" => $_REQUEST["name"],
            "LAST_NAME" => $_REQUEST["last_name"],
            "EMAIL" => $_REQUEST["email"],
            "LOGIN" => $_REQUEST["email"],
            "PASSWORD" => randString(8),
            "PERSONAL_CITY" => $_REQUEST["city"],
            "PERSONAL_PHONE" => $_REQUEST["phone"],
            "PERSONAL_ICQ" => $_REQUEST["icq"],
            "UF_SKYPE" => $_REQUEST["skype"],
            "UF_DEALER" => $_REQUEST["dealer"],
            "UF_ACCESS" => BX_DEALER_USER,
            "UF_PERMISSION" => array(BX_RESTRICT_OFF)
        );
        if($userId = $obUser->Add($arFields)):
            exitJson(Array(
                "result" => true,
                "userId" => $userId
            ));
        else:
            exitJson(Array(
                "result" => false,
                "message" => $obUser->LAST_ERROR
            ));
        endif;

        break;

	case "buy":
		exitJson(Array(
			"result"=>Add2BasketByProductID($itemId, $quantity)
		));
		break;
	case "cartUpdate":
        exitJson(Array(
        	"result" => true,
        	"quantity" => $cartCount
		));
		break;
	case "login":
	    $arResult = $USER->Login($_REQUEST["login"], $_REQUEST["password"], "Y");
	    exitJson(Array(
            "result" => !is_array($arResult),
            "reload" => !is_array($arResult),
            "message" => is_array($arResult) ? $arResult["MESSAGE"] : "Успешная авторизация"
	    ));
	    break;
    case "userRegister":
        if($userId = $obUser->Add($_REQUEST)):
            exitJson(Array(
                "result" => true,
                "message" => "Данные анкеты отправлены. В течении 1 недели мы проверим данные и оповестим вас по электронной почте"
            ));
        else:
            exitJson(Array(
                "result" => true,
                "message" => $obUser->LAST_ERROR
            ));
        endif;
    break;

    case "commentNews":
        if(!checkCaptcha())
            exitJson(Array(
                "result" => false,
                "message" => "Вы не прошли проверку reCAPTCHA"
            ));

        $arFields = Array(
            "IBLOCK_ID" => IB_NEWS_COMMENTS,
            "NAME" => $_REQUEST["name"],
            "PREVIEW_TEXT" => $_REQUEST["message"],
            "PROPERTY_VALUES" => Array(
                "USER" => $userId,
                "ITEM" => $itemId,
                "EMAIL" => $_REQUEST["email"]
            )
        );
        if($arElement->Add($arFields)):
            exitJson(Array(
                "result" => true,
                "reload" => true,
                "message" => "Комментарий опубликован"
            ));
        else:
            exitJson(Array(
                "result" => false,
                "message" => $arElement->LAST_ERROR
            ));
        endif;
    break;

    default: break;
endswitch;