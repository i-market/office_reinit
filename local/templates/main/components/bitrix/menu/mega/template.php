<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$previousLevel = 0;?>
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
            endif;

            if($previousLevel == 2 && $arItem["DEPTH_LEVEL"] == 1 || $previousLevel == 2 && $arItem["DEPTH_LEVEL"] == 2)
                echo "</ul>
                    </div>";

            if ($arItem["DEPTH_LEVEL"] == 1):
                if($arItem["IS_PARENT"]):?>
                    <li>
                        <a class="is_parent" href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                        <div class="dd_main_menu">
                            <div class="some_class_item">
                                <div class="wrap_min">
                                    <div class="close">×</div>
                                    <div class="grid">
                <?else:?>
                    <li>
                        <a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
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
                    <div class="col col_4 item">
                        <ul>
                            <li><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
                 <?endif?>
            <?else:?>
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