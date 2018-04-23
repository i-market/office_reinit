<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
if(empty($arResult))
    return "";
$strReturn = "<div class=\"main_title\">\n";
$itemSize = count($arResult);
if($itemSize == 2):
    $strReturn .= '<a href="'.$arResult[0]["LINK"].'" class="sub_link">'.htmlspecialcharsex($arResult[0]["TITLE"]).' /</a>'."\n";
else:
    $strReturn .= '<span class="sub_link">'."\n";
    for($index = 0; $index < $itemSize; $index++):
        $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
        if($index < $itemSize - 1):
            if($arResult[$index]["LINK"] <> "")
                $strReturn .= '<a href="'.$arResult[$index]["LINK"].'"> '.$title.' / </a>'."\n";
            else
                $strReturn .= '<span> '.$title.' / </span>'."\n";
        endif;
    endfor;
    $strReturn .= '</span>'."\n";
endif;
$strReturn .= '<h2>'.$APPLICATION->GetTitle(false).'</h2>'."\n".
            '</div>'."\n";

return $strReturn;