<section class="news">
    <div class="wrap_min">
        <h2>новости компании</h2>
        <div class="grid">
            <?foreach($arResult["ITEMS" ] as $arItem):?>
                <div class="col col_3 item" id="<?=$arItem["EDIT_ID"]?>">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img" style="background: url('<?=$arItem["PICTURE"]["SRC"]?>')no-repeat center center / cover"></a>
                    <p class="date"><?=$arItem["DATE"]?></p>
                    <p class="title"><?=$arItem["NAME"]?></p>
                    <a class="link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Посмотреть </a>
                </div>
            <?endforeach?>
        </div>
    </div>
</section>