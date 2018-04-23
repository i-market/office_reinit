<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<section class="wrap_title wrap_title--pages">
    <div class="wrap_min">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "")?>
    </div>
</section>
<section class="prof_news">
  <div class="wrap_min">
    <?if($arResult["DETAIL_PICTURE"]):?>
        <div class="img">
            <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?=$arResult["NAME"] ?>">
        </div>
    <?endif?>
    <div class="info">
      <div class="inner">
        <p class="date"><?=$arResult["DATE"]?></p>
        <p class="title"><?=$arResult["NAME"]?></p>
        <p class="text"><?=$arResult["DETAIL_TEXT"]?></p>
      </div>
      <?/*
      <div class="prof_news_wrap_slider">
        <div class="prof_news_slider">
          <a class="gallery slide" data-fancybox="group" href="images/pic_6.jpg" style="background: url('images/pic_6.jpg') center center / cover"></a>
          <a class="gallery slide" data-fancybox="group" href="images/pic_6.jpg" style="background: url('images/pic_6.jpg') center center / cover"></a>
        </div>
        <div class="dots"></div>
      </div>*/?>
      <div class="prof_news_inner">
        <p class="prof_news_title">поделиться</p>
        <div class="inner social">
          <a class="vk" href="#"></a>
          <a class="fb" href="#"></a>
          <a class="gp" href="#"></a>
        </div>
      </div>
      <div class="prof_news_inner">
        <p class="prof_news_title">комментарии</p>
        <?if(!$USER->isAuthorized()):?>
            <div class="inner prof_news_sign_in">
              <p>Комментарии доступны только авторизованным пользователям!</p>
              <p><a href="/auth/">Авторизуйтесь</a> или <a href="/auth/signup/">зарегистрируйтесь</a></p>
            </div>
        <?endif?>
        <div class="inner">
          <div class="wrap_comments">
            <?if($arResult["COMMENTS"]):
                foreach($arResult["COMMENTS"] as $arComment):?>
                    <div class="comment">
                      <p class="name"><?=$arComment["NAME"]?></p>
                      <p class="text"><?=$arComment["PREVIEW_TEXT"]?></p>
                    </div>
                <?endforeach;
            else:?>
                <div class="comment">
                  <p class="name">Пока нет комментариев</p>
                </div>
            <?endif?>
          </div>
          <?/*
          <div class="show_more_comments">
            <span class="show_more">Показать еще</span>
          </div>*/?>
          <div class="write_new_coment">
            <span class="square_button" data-modal="leave_comment">
              <span>оставьте комментарий</span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>