<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!isset($arParams["CACHE_TIME"])) {
	$arParams["CACHE_TIME"] = 3600;
}
global $USER;
$userId = $USER->getId();
$arUser = $USER->getById($userId)->fetch();
$dealerId = $arUser["UF_DEALER"];

if($this->StartResultCache(false, $userId))
{
    if(!$dealerId):
        $this->abortResultCache();
        return;
    endif;

    $arResult = Array(
        "DEALER_ID" => $dealerId,
        "USER_ID" => $userId,
        "USER" => $arUser,
        "DEALER_ADMIN" => !!($arUser["UF_ACCESS"] == BX_DEALER_ADMIN),
        "FILTERS" => Array(
            "DEALER" => Array(
                "IBLOCK_ID" => IB_DEALERS,
                "ID" => $dealerId
            ),
            "ENTITIES" => Array(
                "IBLOCK_ID" => IB_LEGAL,
                "=PROPERTY_DEALER" => $dealerId
            ),
            "EMPLOYEES" => Array(
                "UF_DEALER" => $dealerId
            ),
            "MANAGERS" => Array()
        ),
        "SELECTS" => Array(
            "ENTITIES" => Array(
                "ID",
                "IBLOCK_ID",
                "NAME",
                "ACTIVE",
                "PROPERTY_DEALER",
                "PROPERTY_COMPANY",
                "PROPERTY_CODE",
                "PROPERTY_CITY",
                "PROPERTY_ZIP",
                "PROPERTY_ADDRESS",
                "PROPERTY_LEGAL_ADDRESS",
                "PROPERTY_INN",
                "PROPERTY_KPP",
                "PROPERTY_OKPO",
                "PROPERTY_PHONE",
                "PROPERTY_CONTACT",
                "PROPERTY_EMAIL"
            ),
            "DEALER" => Array(
                "ID",
                "IBLOCK_ID",
                "NAME",
                "PREVIEW_PICTURE",
                "PROPERTY_COMPANY",
                "PROPERTY_ZIP",
                "PROPERTY_CITY",
                "PROPERTY_ADDRESS",
                "PROPERTY_PHONE",
                "PROPERTY_EMAIL",
                "PROPERTY_WEB",
                "PROPERTY_CONTACT_PERSON",
                "PROPERTY_CAREER",
                "PROPERTY_ESHOP",
                "PROPERTY_CORP",
                "PROPERTY_EXHIBITION",
                "PROPERTY_EXHIBITION_SQUARE",
                "PROPERTY_EXHIBITION_FURNITURE",
                "PROPERTY_SEO",
                "PROPERTY_COMPANY_DAY",
                "PROPERTY_EMPLOYEES",
                "PROPERTY_SUPPLIERS",
                "PROPERTY_INFO",
                "PROPERTY_CODE",
                "PROPERTY_MANAGERS"
            ),
            "EMPLOYEES" => Array(
                "SELECT" => Array(
                    "UF_SKYPE",
                    "UF_ACCESS",
                    "UF_PERMISSION"
                ),
                "FIELDS" => Array(
                    "ID",
                    "NAME",
                    "LAST_NAME",
                    "EMAIL",
                    "PERSONAL_PHOTO",
                    "PERSONAL_PHONE",
                    "PERSONAL_ICQ",
                    "PERSONAL_STREET",
                    "PERSONAL_CITY",
                )
            ),
            "MANAGERS" => Array(
                "SELECT" => Array(
                    "UF_SKYPE"
                ),
                "FIELDS" => Array(
                    "ID",
                    "NAME",
                    "LAST_NAME",
                    "EMAIL",
                    "PERSONAL_PHOTO",
                    "PERSONAL_PHONE",
                    "PERSONAL_ICQ",
                    "PERSONAL_STREET",
                    "PERSONAL_CITY",
                )
            )
        ),
        "DEALER" => Array(),
        "MANAGERS" => Array(),
        "EMPLOYEES" => Array(),
        "ENTITIES" => Array()
    );
    $arResult["DEALER"] = CIBlockElement::GetList(Array(), $arResult["FILTERS"]["DEALER"], false, Array("nTopCount"=>1), $arResult["SELECTS"]["DEALER"])->fetch();
    $arResult["DEALER"]["PICTURE"] = getPhoto($arResult["DEALER"]["PREVIEW_PICTURE"]);
    $arResult["FILTERS"]["MANAGERS"] = Array(
        "ID" => implode(" | ", $arResult["DEALER"]["PROPERTY_MANAGERS_VALUE"])
    );

    $obEmployees = CUser::GetList(($by = "UF_ACCESS"), ($order = "desc"), $arResult["FILTERS"]["EMPLOYEES"], $arResult["SELECTS"]["EMPLOYEES"]);
    while($arEmployee = $obEmployees->Fetch()):
        $arEmployee["PICTURE"] = getPhoto($arEmployee["PERSONAL_PHOTO"]);
        $arEmployee["NAME"] = implode(" ", cleanArray(Array($arEmployee["NAME"], $arEmployee["LAST_NAME"])));
        $arEmployee["ADDRESS"] = implode(", ", cleanArray(Array($arEmployee["PERSONAL_CITY"], $arEmployee["PERSONAL_STREET"])));
        $arResult["EMPLOYEES"][$arEmployee["ID"]] = $arEmployee;
    endwhile;

    $obManagers = CUser::GetList(($by = "ID"), ($order = "asc"), $arResult["FILTERS"]["MANAGERS"], $arResult["SELECTS"]["MANAGERS"]);
    while($arManager = $obManagers->fetch()):
        $arManager["PICTURE"] = getPhoto($arManager["PERSONAL_PHOTO"]);
        $arManager["NAME"] = implode(" ", cleanArray(Array($arManager["NAME"], $arManager["LAST_NAME"])));
        $arManager["ADDRESS"] = implode(", ", cleanArray(Array($arManager["PERSONAL_CITY"], $arManager["PERSONAL_STREET"])));
        $arResult["MANAGERS"][$arManager["ID"]] = $arManager;
    endwhile;

    $obEntities = CIBlockElement::GetList(Array(), $arResult["FILTERS"]["ENTITIES"], false, false, $arResult["SELECTS"]["ENTITIES"]);
    while($arEntity = $obEntities->fetch()):
        $arResult["ENTITIES"][$arEntity["ID"]] = $arEntity;
    endwhile;

	$this->SetResultCacheKeys(array(
		"USER",
		"MANAGERS",
		"EMPLOYEES",
		"DEALER"
	));

	$this->IncludeComponentTemplate();
}

?>