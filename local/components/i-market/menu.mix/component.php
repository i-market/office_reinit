<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval($arParams["ID"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
if($arParams["DEPTH_LEVEL"]<=0)
	$arParams["DEPTH_LEVEL"]=1;

$arResult["SECTIONS"] = array();
$arResult["ELEMENT_LINKS"] = array();

if($this->StartResultCache())
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
			"<="."DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"],
		);
		$arOrder = array(
			"left_margin"=>"asc",
		);

		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
			"ID",
			"DEPTH_LEVEL",
			"NAME",
			"SECTION_PAGE_URL",
			"PICTURE",
			"UF_NOT_DEPTH"
		));

		$rsSections->SetUrlTemplates("", $arParams["IS_SEF"] !== "Y" ? $arParams["SECTION_URL"] : $arParams["SEF_BASE_URL"].$arParams["SECTION_PAGE_URL"]);

		while($arSection = $rsSections->GetNext()):
			$arResult["SECTIONS"][] = array(
				"ID" => $arSection["ID"],
				"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
				"PICTURE" => $arSection["PICTURE"],
				"~NAME" => $arSection["~NAME"],
				"~SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"],
				"UF_NOT_DEPTH" => $arSection["UF_NOT_DEPTH"]
			);
			$arResult["ELEMENT_LINKS"][$arSection["ID"]] = array();
        endwhile;

        $aMenuLinksNew = array();
        $menuIndex = 0;
        $previousDepthLevel = 1;

        foreach($arResult["SECTIONS"] as $arSection):
            if ($menuIndex > 0)
                $aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;

            $previousDepthLevel = $arSection["DEPTH_LEVEL"];

            $arResult["ELEMENT_LINKS"][$arSection["ID"]][] = urldecode($arSection["~SECTION_PAGE_URL"]);
            $aMenuLinksNew[$menuIndex++] = array(
                htmlspecialcharsbx($arSection["~NAME"]),
                $arSection["~SECTION_PAGE_URL"],
                $arResult["ELEMENT_LINKS"][$arSection["ID"]],
                array(
                    "FROM_IBLOCK" => true,
                    "IS_PARENT" => false,
                    "UF_NOT_DEPTH" => $arSection["UF_NOT_DEPTH"],
                    "DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
                    "SECTION_ID" => $arSection["ID"],
                    "PICTURE" => $arSection["PICTURE"] ? Array(
                        "ID" => $arSection["PICTURE"],
                        "SRC" => CFile::GetPath($arSection["PICTURE"])
                    ) : false
                ),
            );
            $arItems = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>$arSection["ID"]), false, false, Array("ID", "NAME", "DETAIL_PAGE_URL"));
            if(!$arSection["UF_NOT_DEPTH"] && $arItems->SelectedRowsCount() > 0):
                $aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = true;
                while($arItem = $arItems->getNext())
                    $aMenuLinksNew[$menuIndex++] = array(
                        htmlspecialcharsbx($arItem["~NAME"]),
                        $arItem["~DETAIL_PAGE_URL"],
                        Array(urldecode($arItem["~DETAIL_PAGE_URL"])),
                        array(
                            "FROM_IBLOCK" => true,
                            "IS_PARENT" => false,
                            "DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"] + 1,
                            "UF_NOT_DEPTH" => $arSection["UF_NOT_DEPTH"],
                            "SECTION_ID" => $arSection["ID"],
                            "ELEMENT_ID" => $arItem["ID"]
                        ),
                );
            endif;
        endforeach;

		$this->EndResultCache();
	}
}


return $aMenuLinksNew;
?>
