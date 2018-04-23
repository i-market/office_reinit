<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Юридические лица");?>
<section class="wrap_title wrap_title--pages">
    <div class="wrap_min">
        <div class="main_title">
            <span class="sub_link">
    <a href="#">личный&nbsp;кабинет&nbsp;/</a>
  </span>
            <h2>юридические лица</h2>
        </div>
    </div>
</section>
<section class="complaints">
    <div class="wrap">
        <div class="complaints-top">
            <span class="complaints__create-link add-ur-form">добавить юридическое лицо</span>
            <form action="" method="post" id="" class="ur-form">
                <span class="close"></span>
                <label class="long-text">
                    <span class="text">Название организации*</span>
                    <input type="text">
                </label>
                <label class="half">
                    <span class="text">индекс*</span>
                    <input type="text">
                </label>
                <label class="half">
                    <span class="text">Почтовый код*</span>
                    <input type="text">
                </label>
                <label class="small">
                    <span class="text">город*</span>
                    <input type="text">
                </label>
                <label>
                    <span class="text">адрес*</span>
                    <input type="text">
                </label>
                <label>
                    <span class="text">юр.адрес*</span>
                    <input type="text">
                </label>
                <label>
                    <span class="text">ИНН*</span>
                    <input type="text">
                </label>
                <label>
                    <span class="text">КПП*</span>
                    <input type="text">
                </label>
                <label>
                    <span class="text">ОКПО*</span>
                    <input type="text">
                </label>
                <label class="half">
                    <span class="text">телефон*</span>
                    <input type="text">
                </label>
                <label class="half">
                    <span class="text">e-mail*</span>
                    <input type="text">
                </label>
                <label class="small">
                    <span class="text">контакт</span>
                    <input type="text">
                </label>
                <button type="submit" class="square_button"><span>добавить</span>
                </button>
            </form>
        </div>
        <div class="wrap-complaints-table wrap-complaints-table--istoria-zakazov">
            <div class="complaints-table complaints-table--ur-list">
                <div class="tbody">
                    <div class="tr">
                        <div class="tr-line">
                            <div>
                                <span class="number"></span>
                                <span class="open-table-inner">ООО „Дизайн Шайн”</span>
                            </div>
                            <div>неактивно</div>
                            <div>
                                <span class="square_button add-ur-form"><span>редактировать</span></span>
                            </div>
                            <div>
                                <input type="checkbox" id="1" hidden="hidden" class="radio-check-input">
                                <label for="1" class="radio-check">Сделать неактивным</label>
                            </div>
                            <div>
                                <span class="delete-history delete-tr">Удалить</span>
                            </div>
                        </div>
                        <div class="complaints-table__inner">
                            <div class="complaints-table__inner-block">
                                <span class="close"></span>
                                <div class="ur-list">
                                    <p>
                                        <span>ГОРОД</span>
                                        <span>Москва</span>
                                    </p>
                                    <p>
                                        <span>ИНДЕКС</span>
                                        <span>234890</span>
                                    </p>
                                    <p>
                                        <span>ПОЧТОВЫЙ КОД</span>
                                        <span>345</span>
                                    </p>

                                    <p>
                                        <span>АДРЕС</span>
                                        <span>г. Москва, 124346, Сенная набережная., 34, склад 123</span>
                                    </p>
                                    <p>
                                        <span>ЮР. АДРЕС</span>
                                        <span>г. Москва, 124346, Сенная набережная., 34</span>
                                    </p>
                                    <p>
                                        <span>ИНН</span>
                                        <span>56464884648</span>
                                    </p>
                                    <p>
                                        <span>КПП</span>
                                        <span>097854</span>
                                    </p>

                                    <p>
                                        <span>ОКПО</span>
                                        <span>564634563</span>
                                    </p>
                                    <p>
                                        <span>ТЕЛЕФОН</span>
                                        <span>+7 495 345-67-89 </span>
                                    </p>
                                    <p>
                                        <span>EMAIL</span>
                                        <span>info@designg-shine.ru</span>
                                    </p>
                                    <p>
                                        <span>КОНТАКТ</span>
                                        <span>Михайлова Ольга Вячеславовна</span>
                                    </p>
                                </div>
                            </div>
                            <div class="ur-documents">
                                <div class="top">
                                    <div class="item">
                                        <span class="title">документы</span>
                                    </div>
                                    <div class="item">
                                        <label class="complaints__create-link">
                                            <input type="file" hidden="hidden">загрузить документы
                                        </label>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="ur-download-item">
                                        <div class="ico"></div>
                                        <p class="name">Устав</p>
                                        <p class="info">
                                            <span class="size">12mb</span>
                                            <span class="separator">/</span>
                                            <span class="extension">pdf</span>
                                        </p>
                                        <span class="delete-history delete-ur-item">Удалить</span>
                                    </div>
                                    <div class="ur-download-item">
                                        <div class="ico"></div>
                                        <p class="name">Устав</p>
                                        <p class="info">
                                            <span class="size">12mb</span>
                                            <span class="separator">/</span>
                                            <span class="extension">pdf</span>
                                        </p>
                                        <span class="delete-history delete-ur-item">Удалить</span>
                                    </div>
                                    <!--сообщение-->
                                    <div class="rating_thanks">
                                        <span class="close"></span>
                                        <div class="text">
                                            <strong>ошибка!</strong>
                                            <p>Вес документа не должен превышать
                                                <br> <strong>10mb</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pages-bottom-square-link">
    <a class="square_button" href="#"><span>кабинет</span></a>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>