(function () {
    $(function () {
        $('.filterContainer .filterBlock').on('click', 'span', function() {
            var $filterContainer = $(this).parents('.filterBlock');

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).parents('.filterBlock').find('.cfb').removeClass('active');
            } else {
                $('span', $filterContainer).removeClass('active');
                $(this).addClass('active');
            }

            if (!$filterContainer.attr('data-clear'))
                $('[data-clear=true] span').removeClass('active');

            filterApply();
        });

        $('.clearColorsFilter').on('click', function() {
            $('[data-color]', '.category-colors').removeClass('active');
            $(this).parents('.filterBlock').find('.cfb').addClass('active');
            $(this).removeClass('active');
            filterApply();
        });
        $('.clearFilter').on('click', function() {
            $('[data-color], [data-category], .clearColorsFilter, .clearFilter').removeClass('active');
            $('.category-item', '.category-items').removeClass('hide');
            filterApply();
        });

        $('[data-category], [data-color]').on('click', function() {
            $(this).parents('.filterBlock').find('.cfb').addClass('active');
        });

        $('.color-check').on('click', function(){
            var $this = $(this),
                $item = $this.closest('.prof_catalog_box'),
                $offers = $item.find('.offer'),
                offerId = $this.data('offer');

            $offers.addClass('hide');
            $offers.filter('[data-offer="' + offerId + '"]').removeClass('hide');
        });

        $('select.offer_size').on('change', function(){
            var $this = $(this),
                $item = $this.closest('.category-item'),
                $offers = $item.find('.offer'),
                offerId = $this.val();

            $offers.addClass('hide');
            $offers.filter('[data-offer="' + offerId + '"]').removeClass('hide');
        });

        $(".modal").click(function (e) {
            $(e.target).closest(".modal>.block").length || ($(".modal>.block, .modal").fadeOut(100), $("html, body").removeClass("open"), e.stopPropagation())
        });
        $(".modal .close").click(function () {
            $(".modal, .modal>.block").fadeOut(100),
            $("html, body").removeClass("open")
        });
        $("[data-modal]").on("click", function () {
            var e = $(this).attr("data-modal"),
            t = $("#" + e);
            t.fadeIn(100),
            $(t).find(".block").fadeIn(100),
            $("html, body").addClass("open")
        });
        $(document).click(function (e) {
            $(e.target).closest(".dd_choose_city, .sign_in_form, .search_form, .sign_in_hidden_form").length || ($(".dd_choose_city, .sign_in_form, .search_form, .sign_in_hidden_form").fadeOut(150), $(".choose_city").removeClass("open"), e.stopPropagation())
        });
        $(".choose_city").on("click", function () {
            return $(this).parent().find(".dd_choose_city").fadeIn(150),
            !1
        });
        $(".dd_choose_city .close").on("click", function () {
            return $(".dd_choose_city").fadeOut(150),
            !1
        });
        $(".project-search-results .close").on("click", function () {
            $(".project-search-results").fadeOut(150)
        });
        $(".proizvoditeli_btns .btn").on("click", function () {
            $(this).parent().find(".btn").removeClass("active"),
            $(this).parent().next().toggleClass("proizvoditeli_letters--list"),
            $(this).addClass("active"),
            $(".proizvoditeli_letters--list ul").each(function () {
                var e = $("li", this).length;
                e > 3 ? $(this).addClass("more_links") : $(this).removeClass("more_links")
            })
        });
        $(".main_menu a").on("click", function () {
            $(".main_menu a").removeClass("active"),
            $(".dd_main_menu").hide(),
            $(this).addClass("active").parent().find(".dd_main_menu").show()
            if($(".dd_main_menu").is(":visible") && $(this).hasClass('is_parent'))
                return false;
        });
        $(".dd_main_menu .close").on("click", function () {
            $(".main_menu a").removeClass("active"),
            $(".dd_main_menu").hide()
        });
        $(".hiddenItem").on("click", function () {
            var e = $(this).attr("data-hiddenItem");
            $(".description_grid").hide(),
            $("." + e).show()
        });
        $(".hidden_box .close").on("click", function () {
            $(".hidden_box").hide(),
            $(".description_grid").show()
        });
        $(".search_btn").on("click", function () {
            return $(this).next().fadeIn(150),
            !1
        });
        $(".company-employees-add-btn").on("click", function () {
            $(this).parents(".company-employees-add").fadeOut(100),
            $(this).parent().next().fadeIn(150)
        });
        $(".sertificate .click").on("click", function () {
            $(this).toggleClass("open").next().slideToggle(150)
        });
        $(".hamburger").on("click", function () {
            $(".hamburger, body, html").toggleClass("open"),
            $(".header_bottom").fadeToggle(300),
            $(".sign_in_hidden_form").fadeOut(300)
        });
        $(".archive .now").on("click", function () {
            $(this).toggleClass("open"),
            $(".dd_archive_block").slideToggle(300)
        });
        $(".link.sign_in").on("click", function () {
            return $(".sign_in_form").fadeIn(300),
            !1
        });
        $(".rating_thanks").on("click", function () {
            $(".rating_thanks").fadeOut(300)
        });
        $(".your-data-edit").on("click", function () {
            $(this).parents(".your-data-item").find(".company-employees-add").fadeIn(150)
        });
        $(".prof_project_info_links_wrap_inner .inner").length > 3 ? $(".prof_project_info_links_open").show() : $(".prof_project_info_links_open").hide(),
        $(".prof_project_info_links_open").on("click", function () {
            $(this).toggleClass("open"),
            $(".prof_project_info_links_wrap_inner .inner").fadeToggle(0)
        });
        $(".table-legal-entities .tr").length > 3 ? $(".table-legal-entities-btn").show() : $(".table-legal-entities-btn").hide(),
        $(".table-legal-entities-btn").on("click", function () {
            $(this).toggleClass("open"),
            $(".table-legal-entities .tr").fadeToggle(0)
        });
        $(".sign_in_btn").on("click", function () {
            return $(".sign_in_hidden_form").fadeIn(300),
            !1
        });
        $(".contacts_form .square_button").on("click", function () {
            $(".hidden_message").addClass("open")
        });
        $(".accordeon p").hide().prev().on("click", function () {
            $("p", ".accordeon").not(this).slideUp(),
            $(this).next().not(":visible").slideDown(),
            $("strong", ".accordeon").not(this).removeClass("active"),
            $(this).toggleClass("active")
        });
        $(".employees-add-btn").on("click", function () {
            $(this).next(".company-employees-add").fadeIn(150)
        });
        $(".company-employees-add .close").on("click", function () {
            $(".company-employees-add").fadeOut(150)
        });
        $(".write-message-thanks .close").on("click", function () {
            $(this).parent().hide()
        });
        $(".contacts_managers_item .tools").on("click", function () {
            $(this).parent().prev().fadeIn(150)
        });
        $(".wrap-complaints-table--basket .delete").on("click", function () {
            $(this).parents(".tr").remove()
        });
        $(".contacts_managers_item .delete").on("click", function () {
            $(this).parents(".col_4").remove()
        });
        $(".edit-managers_item .close").on("click", function () {
            $(this).parent().fadeOut(150)
        });
        $(".lk-open-table").on("click", function () {
            $(".lk-hidden-table").fadeIn(150)
        });
        $(".lk-hidden-table .close").on("click", function () {
            $(".lk-hidden-table").fadeOut(150)
        });
        $(".send-manager-form").on("click", function () {
            $(".manager-content").hide(),
            $(".personal-manager textarea").show(0)
        });
        $(".lk-title-text").on("click", function () {
            $(this).toggleClass("open"),
            $(this).parent().next().slideToggle(150)
        });
        $(".add-ur-form").on("click", function () {
            $(this).next(".ur-form").css("display", "flex")
        });
        $(".ur-form .close").on("click", function () {
            $(".ur-form").fadeOut(150)
        });
        $(".delete-tr").on("click", function () {
            $(this).parents(".tr").remove()
        });
        $(".delete-line").on("click", function () {
            $(this).parents(".line").remove()
        });
        $(".delete-ur-item").on("click", function () {
            $(this).parents(".ur-download-item").remove()
        });
        $(".katalog_prise_katalog_prof_inner .line").each(function () {
            var e = $(this).index();
            $(this).find(".number").text(e + 1)
        });
        $(".not_registered .close").on("click", function () {
            $(this).parent().fadeOut()
        });
        $("[data-tabLinks]").on("click", function () {
            var e = $("[data-tabContent=" + $(this).attr("data-tabLinks") + "]");
            $(this).parent().find("[data-tabLinks]").removeClass("active").filter(this).addClass("active"),
            e.parent().find("[data-tabContent]").hide().filter(e).show(),
            $(".slider_section_tabs, .thumbs_slider_section_tabs").slick("setPosition");
            history.replaceState(null,null, '?tab='+$(this).attr("data-tabLinks"));
        });
        if(!$(".active[data-tabLinks]").length)
            $("[data-tabLinks]").parent().find("[data-tabLinks]").filter(":first-child").trigger("click");

        $(".specification .title").on("click", function () {
            $(this).toggleClass("open"),
            $(".specification .inner").slideToggle(300)
        });
        $(".spec").on("click", function () {
            $(this).toggleClass("open");
            $(this)/*.parent()*/.next().slideToggle(150);
        });
        $(".selected_color").on("click", function () {
            $(this).removeClass("gray brown white black orange haki red blue green")
        });
        $(".choose-color").on("click", function () {
            var e = $(this).data("bg");
            $(this).parents(".line").find(".selected_color").addClass(e).fadeIn(300)
        });
        $(".zoom").hover(function () {
            $(this).find(".zoom_img").fadeIn(250)
        }, function () {
            $(this).find(".zoom_img").fadeOut(50)
        });
        $(".colors_wood .item").on("click", function () {
            $(".colors_wood .item").removeClass("active"),
            $(this).addClass("active")
        });
        $(".kit_includes .title").on("click", function () {
            $(".kit_includes .text").slideToggle(250),
            $(this).toggleClass("active")
        });
        $(".coordinates").on("click", function () {
            var e = $(this).data("item");
            $(".prof_catalog_box", ".hidden_slider_box").fadeOut(400),
            $("." + e).fadeIn(300)
        });
        $(".prof_catalog_box .close").on("click", function () {
            $(this).parent().fadeOut(300)
        });
        $(".wrap-add-foto-btn").on("click", function () {
            $(".add-foto-item:first").clone(!0).appendTo(".add-foto"),
            $(".add-foto-item:last").find(".new-value").val("Файл не выбран"),
            $(".add-foto-item:last").find(".delete-file").hide()
        });
        $(".type-file").on("change", function () {
            var e = $(this).val();
            $(this).parents(".left").find(".new-value").val(e),
            "" != $(this).val() && $(this).parents(".left").find(".delete-file").show()
        });
        $(".delete-file").on("click", function () {
            $(this).parents(".left").find(".type-file").val(""),
            $(this).parents(".left").find(".new-value").val("Файл не выбран"),
            $(this).hide()
        });
        $(".tbody .tr").each(function () {
            var e = $(this).index();
            $(this).find(".number").text(e + 1)
        });
        $(".open-table-inner").on("click", function () {
            $(this).addClass("open"),
            $(this).parents(".tr").find(".complaints-table__inner").slideDown(100)
        });
        $(".complaints-table__inner-block .close").on("click", function () {
            $(this).parents(".tr").find(".open-table-inner").removeClass("open"),
            $(this).parents(".tr").find(".complaints-table__inner").slideUp(100)
        });
        $(".input-number").inputNumber(),
        $("select").dropdown({
            mobile: !0
        });
        $(".prof_news_slider").slick({
            infinite: !0,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: !1,
            dots: !0,
            appendDots: $(".prof_news_wrap_slider .dots"),
            responsive: [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        $(".slider_index").slick({
            infinite: !0,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: !0,
            appendDots: $(".slider_index_wrap .dots"),
            prevArrow: $(".slider_index_wrap .prev"),
            nextArrow: $(".slider_index_wrap .next")
        });
        $(".novelties_slider").slick({
            arrows: !1,
            infinite: !0,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: !0,
            appendDots: $(".novelties_wrap_slider .dots")
        });
        $(".prof_slider_main").slick({
            arrows: !1,
            fade: !0,
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".prof_slider_thums",
            dots: !0,
            appendDots: $(".wrap_prof_slider .dots")
        });
        $(".prof_slider_thums").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            focusOnSelect: !0,
            asNavFor: ".prof_slider_main",
            prevArrow: $(".wrap_prof_slider_thums .prev"),
            nextArrow: $(".wrap_prof_slider_thums .next"),
            responsive: [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: 3
                    }
                }
            ]
        });
        $(".prof_slider_main_kabinet").slick({
            arrows: !1,
            fade: !0,
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".prof_slider_thums_kabinet",
            dots: !0,
            appendDots: $(".wrap_prof_slider_kabinet .dots")
        });
        $(".prof_slider_thums_kabinet").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            focusOnSelect: !0,
            asNavFor: ".prof_slider_main_kabinet",
            prevArrow: $(".wrap_prof_slider_kabinet .prev"),
            nextArrow: $(".wrap_prof_slider_kabinet .next"),
            responsive: [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: 3
                    }
                }
            ]
        });
        $(".slider_section_main").slick({
            arrows: !1,
            fade: !0,
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".thumbs_slider_section_main"
        });
        $(".thumbs_slider_section_main").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            focusOnSelect: !0,
            vertical: !0,
            asNavFor: ".slider_section_main",
            prevArrow: $(".wrap_thumbs_slider_section_main .prev"),
            nextArrow: $(".wrap_thumbs_slider_section_main .next"),
            dots: !0,
            appendDots: $(".wrap_slider_section_main .dots"),
            responsive: [{
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: 3,
                        vertical: !1
                    }
                }
            ]
        });
        $(".slider_section_tabs").slick({
            arrows: !1,
            fade: !0,
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".thumbs_slider_section_tabs"
        });
        $(".thumbs_slider_section_tabs").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            focusOnSelect: !0,
            vertical: !0,
            asNavFor: ".slider_section_tabs",
            prevArrow: $(".wrap_thumbs_slider_section_tabs .prev"),
            nextArrow: $(".wrap_thumbs_slider_section_tabs .next"),
            dots: !0,
            appendDots: $(".wrap_slider_section_tabs .dots"),
            responsive: [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: 3,
                        vertical: !1
                    }
                }
            ]
        });
        $(".gallery").fancybox({
            slideShow: !1,
            fullScreen: !1,
            thumbs: !1
        });
        $(".tooltip:not(.number)").tooltipster({
            theme: ["tooltipster-noir", "tooltipster-noir-customized"],
            maxWidth: 210,
            minWidth: 100,
            zIndex: 11,
            trigger: "custom",
            arrow: !1,
            side: "right",
            triggerOpen: {
                mouseenter: !0,
                click: !0,
                tap: !0
            },
            triggerClose: {
                click: !0,
                scroll: !0,
                tap: !0,
                mouseleave: !0
            }
        });
        $(".tooltip.number").tooltipster({
            theme: ["tooltipster-noir", "tooltipster-noir-customized"],
            /*maxWidth: 210,*/
            minWidth: 100,
            zIndex: 11,
            trigger: "custom",
            arrow: !1,
            contentAsHTML: true,
            interactive: true,
            functionPosition: function(instance, helper, position){
                position.coord.top += 40;
                position.coord.left += 0;
                return position;
            },
            side: 'top',
            triggerOpen: {
                mouseenter: !0,
                click: !0,
                tap: !0
            },
            triggerClose: {
                click: !1,
                scroll: !0,
                tap: !1,
                mouseleave: !0
            }
        });
        $("#phone1").mask("99_9999", {
            placeholder: ""
        });
        $(".open-color-modal").on("click", function() {
            $(".color-modal").hide();
            $('#' + $(this).parent('.inner').data('id')).fadeIn(150);
            $(".color-modal-slider").slick("setPosition");
            $(".color-modal-slider .slide[data-material=" + $(this).data("material") + "]").trigger("click");
            $("html, body").addClass('open');
        });
        $(".color-modal-slider .slide").on("click", function() {
            var e = $(this).data("src"),
                t = $(this).data("title"),
                i = $(this).data("text");

            $(".color-modal__bg").attr("style", e).show();
            //$(".inner-info__title").text(t);
            $(".inner-info__text").html(i);
        });
        $(".color-modal__close").on("click", function() {
            $(".color-modal").fadeOut(150);
            $("html, body").removeClass('open');
        });

        $(".color-modal-slider").each(function(e, t) {
            var i = "carousel" + e;
            this.id = i, $(this).slick({
                slidesToShow: 5, slidesToScroll: 1, focusOnSelect: !0, infinite: !1, prevArrow: $(this).parents(".wrap-color-modal-slider").find(".prev"), nextArrow: $(this).parents(".wrap-color-modal-slider").find(".next"), responsive: [{
                    breakpoint: 767, settings: {
                        slidesToShow: 4
                    }
                }]
            })
        });
        $.extend(Tipped.Behaviors, {
            "custom-slow": {
                fadeIn: 150,
                fadeOut: 150
            }
        }), Tipped.create(".simple-tooltip", {
            close: !0,
            behavior: "custom-slow",
                close: true,
            showOn: 'click',
            hideOn: 'click'
        });
    });

    function filterApply() {
        var $parentContainer = $('.filterContainer'),
            selectedAtts = [],
            selectedCategories = [],
            selectedColors = [],
            length,
            categoriesCount,
            colorsCount;

        $('.filterBlock', $parentContainer).each(function(idx, block) {
            $('span', block).each(function(idx, item) {
                if ($(item).hasClass('active')) {
                    selectedAtts.push($(item).attr('data-category'));
                    if($(item).attr('data-category')){
                        selectedAtts.push($(item).attr('data-category'));
                        selectedCategories.push($(item).attr('data-category'));
                    }

                    if ($(item).attr('data-color')) {
                        selectedAtts.push($(item).attr('data-color'));
                        selectedColors.push($(item).attr('data-color'));
                    }
                }
            });
        });
        length = selectedAtts.length;
        categoriesCount = selectedCategories.length;
        colorsCount = selectedColors.length;

        if (categoriesCount === 0) {
            $('.category-item', '.category-items').removeClass('hide');
            $('.category-colors .category-color').removeClass('hide');
        } else {
            $('.category-color', '.category-colors').addClass('hide').each(function(idx, color) {
                var $color = $(color),
                    showColor = false;
                for (var i = 0; i < categoriesCount; i++) {
                    if (!$color.hasClass(selectedCategories[i])) {
                        showColor = false;
                        break;
                    }
                    showColor = true;
                }
                showColor ? $color.removeClass('hide') : null;
            });
            $('.category-item', '.category-items').addClass('hide').each(function(idx, item) {
                var $item = $(item),
                    show = false;
                for (var i = 0; i < categoriesCount; i++) {
                    if (!$item.hasClass(selectedCategories[i])) {
                        show = false;
                        break;
                    }
                    show = true;
                }
                show ? $item.removeClass('hide') : null;
            });
        }
        if (colorsCount === 0) {
            $('.offer', '.category-item', '.category-items').addClass('hide');
            $('.offer:first-child, .color-check', '.category-item', '.category-items').removeClass('hide');
        } else {
            $('.offer, .color-check', '.category-item', '.category-items').addClass('hide');
            $('.category-item', '.category-items').each(function(idx, item) {
                var $item = $(item),
                    itemShow = false;

                $('.offer, .color-check', item).each(function(idxOffer, offer) {
                    var $offer = $(offer),
                        offerShow = false;

                    for (var i = 0; i < colorsCount; i++) {
                        if (!$offer.hasClass(selectedColors[i])) {
                            offerShow = false;
                            break;
                        }
                        offerShow = true;
                    }
                    offerShow ? $offer.removeClass('hide') : null;
                });

                if($item.find('.offer').not('.hide').length == 0)
                    $item.addClass('hide');
            });
        }
    }
    (function($) {
        "use strict";

        function InputNumber(element) {
            this.$el = $(element);
            this.$input = this.$el.find('[type=text]');
            this.$inc = this.$el.find('[data-increment]');
            this.$dec = this.$el.find('[data-decrement]');
            this.min = this.$el.attr('min') || false;
            this.max = this.$el.attr('max') || false;
            this.init();
        }


        InputNumber.prototype = {
            init : function() {
                this.$dec.on('click', $.proxy(this.decrement, this));
                this.$inc.on('click', $.proxy(this.increment, this));
            },

            increment : function(e) {
                var value = this.$input[0].value;
                value++;
                console.log(value, this.max);
                if (!this.max || value <= this.max) {
                    this.$input[0].value = value++;
                }
            },

            decrement : function(e) {
                var value = this.$input[0].value;
                value--;
                if (!this.min || value >= this.min) {
                    this.$input[0].value = value;
                }
            }
        };

        $.fn.inputNumber = function(option) {
            return this.each(function() {
                var $this = $(this),
                    data = $this.data('inputNumber');

                if (!data) {
                    $this.data('inputNumber', ( data = new InputNumber(this)));
                }
            });
        };

        $.fn.inputNumber.Constructor = InputNumber;
    })(jQuery);
}());