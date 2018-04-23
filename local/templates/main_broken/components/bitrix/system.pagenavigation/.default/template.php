<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arResult["NavShowAlways"] || $arResult["NavPageCount"] > 1):?>
    <section class="paginator">
        <ul>
            <?for ($PAGE_NUMBER = $arResult["NAV"]["START_PAGE"]; $PAGE_NUMBER <= $arResult["NAV"]["END_PAGE"]; $PAGE_NUMBER++):
                if ($PAGE_NUMBER == $arResult["NAV"]["PAGE_NUMBER"]):?>
                    <li><a class="active" href="<?=$arResult["NAV"]["URL"]["SOME_PAGE"][$PAGE_NUMBER]?>"><?=$PAGE_NUMBER?></a></li>
                <?else:?>
                    <li>
                        <a href="<?=$arResult["NAV"]["URL"]["SOME_PAGE"][$PAGE_NUMBER]?>"><?=$PAGE_NUMBER?></a>
                    </li>
                <?endif;
            endfor?>
        </ul>
    </section>
<?endif;?>