<?require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$arResult = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IB_COLORS, "ACTIVE"=>"Y"), false, false, Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_BRAND"));
$arElement = new CIBlockElement;
while($arItem = $arResult->Fetch()):
    if(in_array($arItem["ID"], $idList))
        continue;
    $arCopyFilter = Array("IBLOCK_ID"=>IB_COLORS, "!ID"=>$arItem["ID"], "NAME"=>$arItem["NAME"], "PROPERTY_BRAND"=>$arItem["PROPERTY_BRAND_VALUE"], "ACTIVE"=>"Y");
    $arCopyItem = CIBlockElement::GetList(Array(), $arCopyFilter, false, Array("nTopCount"=>"1"), Array("ID"))->Fetch();
    if($arCopyItem):
        $arElement->Update($arCopyItem["ID"], Array("ACTIVE"=>"N"));
        $idList[$arCopyItem["ID"]] = $arCopyItem["ID"];
    endif;
endwhile;
require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>