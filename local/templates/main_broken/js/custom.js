var ajaxPath = "/local/ajax/ajax.php",
    $document = $(document),
    $window = $(window),
    patternMail = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

(function () {
    $(function () {
        cartUpdate();
        //$document.on('click', '.fancy', ;);
        $('.fancy').fancybox();

        // Off events
        $(".company-employees-add-btn").off("click");
        $(".edit-ur-form").on("click", function () {
            $(this).next(".ur-form").css("display", "flex")
        });
        $document
            .on('change', '.table-legal-entities input[type=checkbox]', function(){
                $.getJSON(ajaxPath, {
                    mode:  'changeActive',
                    value: $(this).prop('checked'),
                    id: $(this).val()
                });
            })
            .on('change', '.unsubscribe form input[type=checkbox]', function(){
                $.getJSON(ajaxPath, {
                    mode:  'unsubscribe',
                    value: $(this).prop('checked')
                });
            });
        $document.on('click', '.change-configuration', function(){
            var $this = $(this),
                offerId = $this.data('offer'),
                $configurations = $('.configurator').find('.configuration');

            $configurations.removeClass('active');
            $configurations.filter('[data-offer="' + offerId + '"]').addClass('active');
        })

        $document
            .on('submit', 'form.ajaxform', ajaxForm)
            .on('click', '.buy', buy)
            .on('submit', '.company-employees-add', employeeAdd)
            .on('submit', '.edit-managers_item', employeeSetPermission)
            .on('click', '.employee-data-edit', employeeDataEdit)
            .on('click', '.copy', selectText);

        $('.ur-form').on('submit', function(){
            var $this = $(this),
                valid = true,
                $required = $this.find('[required]'),
                jsonData = $this.serialize() + "&mode=" + $this.data('mode');

            $required.each(function(){
                if(!$(this).val()) {
                    valid = false;
                    $(this).parent('label').addClass('error');
                }
            });
            if(valid)
                $.getJSON(ajaxPath, jsonData, function(jsonResult){
                    $this.fadeOut(150);
                    showModal(jsonResult.title, jsonResult.message);
                    if(jsonResult.reload)
                        location.reload();
                });

            return false;
        });
        $(".company-entity-add .close").on("click", function () {
            $(".company-entity-add").fadeOut(150)
        });
        $('form[name="regform"]').on('submit', function(){
            var $form = $(this),
                $email = $form.find('input[name="REGISTER[UF_WORK_EMAIL]"]').val();

            $form.find('input[name="REGISTER[LOGIN]"], input[name="REGISTER[EMAIL]"]').val($email);
        });

    });

    function employeeSetPermission() {
        var $form = $(this),
            jsonData = $form.serialize() + "&mode=" + $form.data('mode');

        $.getJSON(ajaxPath, jsonData, function(jsonResult){
            $form.fadeOut(150);
            showModal(jsonResult.title, jsonResult.message);
        });

        return false;
    }

    function employeeAdd() {
        var $form = $(this),
            $permissionForm = $form.next('.edit-managers_item'),
            $required = $form.find('[required]'),
            $message = $form.find('.message').empty(),
            jsonData = $form.serialize() + "&mode=" + $form.data('mode'),
            valid = true;

        $required.each(function(){
            var $error = $(this).closest('.item').find('.error').removeClass('show');
            if(!$(this).val()) {
                valid = false;
                $error.addClass('show');
            }
        });

        if(valid)
            $.getJSON(ajaxPath, jsonData, function(jsonResult){
                if(jsonResult.result === true && jsonResult.userId) {
                    $form.fadeOut(100);
                    $permissionForm.fadeIn(150).find('input[name=employee]').val(jsonResult.userId);
                } else {
                    $message.html(jsonResult.message);
                    console.error(jsonResult.message);
                }
            });

        return false;
    }

    function employeeDataEdit() {
        $(this).closest(".wrap-managers_item").find(".company-employees-add").fadeIn(150);
    }
    function selectText(event) {
        var rng,
            sel,
            result,
            elem = document.getElementById($(this).data('id'));

        if (document.createRange) {
            rng = document.createRange();
            rng.selectNode(elem)
            sel = window.getSelection();
            sel.removeAllRanges();
            var strSel = '' + sel;
            sel.addRange(rng);
        } else {
            var rng = document.body.createTextRange();
            rng.moveToElementText(elem);
            rng.select();
        }
         try {
            console.log(document.execCommand('copy') ? 'Артикул скопирован' : 'Не удалось скопировать артикул');
        } catch(err) {
            console.log('Не удалось скопировать артикул');
        }

        event.stopPropagation();
    }
    function fancyBox(event) {
        var $this = $(this),
            href = $this.data('href') ? $this.data('href') : $this.attr('href');

        if(href)
            $.fancybox(href);

        event.stopPropagation();
    }
    function buy(event) {
        var $this = $(this),
            id = $this.data('id'),
            quantity = $('.quantity[data-id=' + id + ']').val(),
            jsonData = {
                mode: 'buy',
                id: id,
                quantity: quantity
            };
        $.getJSON(ajaxPath, jsonData, cartUpdate);

        event.stopPropagation();
    }
    function cartUpdate() {
        var jsonData = {
                mode: 'cartUpdate'
            };
        $.getJSON(ajaxPath, jsonData, function(jsonResult) {
            $('.cart_number').empty().html(jsonResult.quantity);
        });
    }
    function getModal($modal) {
        $('.modal, .modal > .block').fadeOut(100);
        $modal.fadeIn(100).find('.block').fadeIn(100);
        $('html, body').addClass('open');
    }
    function showModal(title, text) {
        var $modal = $('#modal');

        $modal.find('.title').html(title);
        $modal.find('.allert_text').html(text);
        $('.modal, .modal > .block').fadeOut(100);
        $modal.fadeIn(100).find('.block').fadeIn(100);
        $('html, body').addClass('open');
    }

    function ajaxForm(event) {
        var $this = $(this),
            mode = $this.data('mode'),
            jsonData = $this.serialize() + "&mode=" + mode,
            type = $this.data('type'),
            typeResult = $this.data('result'),
            $modal = typeResult === 'modal' ? $('#' + mode + 'Modal') : false,
            $hidden = $this.prev('.hidden_message').removeClass('open'),
            $alert = $modal ? $modal.find('.status') : $this.find('.status'),
            $alertText = $alert.find('.allert_text').empty(),
            $required = $this.find('[required]').removeClass('error'),
            valid = true;

        console.log(event);

        $required.each(function(){
            if(!$(this).val()) {
                valid = false;
                $(this).addClass('error');
            }
        })

        if(!valid)
            return false;

        if(type == "json") {
            $.getJSON(ajaxPath, jsonData, function(jsonResult){
                if(jsonResult.result === true) {
                    if(jsonResult.reload === true)
                        location.reload();
                    else {
                        $this.css('height', $this.height());
                        $hidden.addClass('open');
                    }
                } else {
                    $alertText.html(jsonResult.message);
                    console.error(jsonResult.message);

                    if($modal)
                        getModal($modal);
                }
            });
        } else {
            $.post(ajaxPath, jsonData, function(htmlResult){
                $this.empty().html(htmlResult)
            });
        }

        //event.originalEvent.stopPropagation();
        return false;
    }
}());