<section class="slider_index_wrap">
    <div class="controls">
        <span class="arrows prev"></span>
        <span class="arrows next"></span>
    </div>
    <div class="slider_index">
        <?foreach($arResult["ITEMS" ] as $arItem):?>
            <div class="slide" id="<?=$arItem["EDIT_ID"]?>" style="background: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')no-repeat center center / cover"></div>
        <?endforeach?>
    </div>
    <div class="dots"></div>
</section>