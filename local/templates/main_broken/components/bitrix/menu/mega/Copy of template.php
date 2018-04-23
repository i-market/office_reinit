<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$previousLevel = 0;
_c($arResult)?>
<nav class="main_menu">
    <ul>
        <?foreach($arResult as $arItem):
            if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
                if($arItem["DEPTH_LEVEL"] == 2 && $previousLevel == 3)
                    echo "</ul>
                        </div>";
                elseif($arItem["DEPTH_LEVEL"] == 1 && $previousLevel == 3)
                    echo "</ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>";
                elseif($arItem["DEPTH_LEVEL"] == 1 && $previousLevel == 2)
                    echo "</ul>
                                </div>
                            </div>
                        </div>
                    </li>";
            endif;

            if((!$arItem["PARAMS"]["UF_NOT_DEPTH"] && $previousLevel == 2 && $arItem["DEPTH_LEVEL"] == 1) || $previousLevel == 2 && $arItem["DEPTH_LEVEL"] == 2)
                echo "</ul>
                    </div>";

            if ($arItem["DEPTH_LEVEL"] == 1):
                if($arItem["PARAMS"]["UF_NOT_DEPTH"]):?>
                    <li>
                        <a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                        <div class="dd_main_menu">
                            <div class="some_class_item">
                                <div class="wrap_min">
                                    <ul>
                <?else:?>
                    <li>
                        <a href="javascript:" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                        <div class="dd_main_menu">
                            <div class="some_class_item">
                                <div class="wrap_min">
                                    <div class="close">×</div>
                                    <div class="grid">
                <?endif;
            elseif($arItem["DEPTH_LEVEL"] == 2):
                if($arItem["IS_PARENT"]):?>
                    <div class="col col_4 item">
                        <p class="title"><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></p>
                        <?if($arItem["PARAMS"]["PICTURE"]):?>
                            <div class="img">
                                <a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>">
                                    <img src="<?=$arItem["PARAMS"]["PICTURE"]["SRC"]?>" alt="<?=$arItem["TEXT"]?>">
                                </a>
                            </div>
                        <?endif?>
                        <ul>
                    <?else:?>
                        <li>
                            <a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                        </li>
                    <?endif;
            else:?>
                <li>
                    <a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                </li>
            <?endif;

            $previousLevel = $arItem["DEPTH_LEVEL"];
        endforeach;

        if ($previousLevel > 1)
            echo str_repeat("</ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>", ($previousLevel-1) );?>
    </ul>
</nav>