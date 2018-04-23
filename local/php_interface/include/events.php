<?
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "codeGeneration");
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "codeGeneration");
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "codeGeneration");
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "codeGeneration");
function codeGeneration(&$arFields) {
    if($arFields["IBLOCK_ID"] == IB_CATALOG):
        if((!isset($arFields["CODE"]) || strlen($arFields["CODE"]) <= 0) && strlen($arFields["NAME"]) > 0):
            $itemCode = getCode($arFields["NAME"]);
            if(count($arFields["PROPERTY_VALUES"]) && strlen($arFields["PROPERTY_VALUES"][29]) > 0)
                $itemCode .= "_" . getCode($arFields["PROPERTY_VALUES"][29]);

            $arFields["CODE"] = $itemCode;
         endif;
    endif;
}
?>