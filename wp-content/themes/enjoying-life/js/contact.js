(function ($) {
    let enjoying-life = {},
        $html = $('html'),
        $document = $(document),
        contactUsFormElement = $('#contact-form'),
        confirmSection = $('#c-confirm-section'),
        inputSection = $('#c-input-section'),
        pageContent = $('.c-po-05'),
        titleReplace = $('.c-peplace--text'),
        btnSubmit = $('#c-btn__submit--02'),
        buttonBack = $('#c-form__button_back'),
        descInput = $('#c-desc-input'),
        descConfirm = $('#c-desc-confirm'),
        form_submitting = false,
        is_dirty = false;
    /**
     * Check element exists
     * @returns {boolean}
     */
    $.fn.exists = function () {
        return this.length > 0;
    };

    /**
     * Scroll to element
     * @param element
     */
    let scrollToPageContent = function (element) {
        if (element.exists()) {
            let offsetDiv = $(element).first().offset().top;

            $('html,body').animate({
                scrollTop: offsetDiv
            }, 'fast');
        }
    };

    /**
     * loadingEffectStart
     * @param element
     */
    let loadingEffectStart = function (element) {
        buttonBack.attr('disabled', 'disabled');
        element.attr('disabled', 'disabled').addClass("o-animation__loader");
    };

    /**
     * loadingEffectStop
     * @param element
     */
    let loadingEffectStop = function (element) {
        element.removeAttr('disabled').removeClass('o-animation__loader').empty().append('送信する');

        buttonBack.removeAttr('disabled');
    };

    /**
     * Data blind
     * @returns {*}
     */
   
    $.fn.sfbind = function () {
        return this.each(function () {
            let $this = $(this);
            
            $this.find('[data-sf-bind]').each(function () {
                let fieldName = $(this).data('sf-bind');
                let fieldValue = $this.find('[name="' + fieldName + '"]').val();
                if(fieldValue == '') {
                    fieldValue = $this.find('[name="' + fieldName + '"]').text();
                }
                let defaultValue = fieldValue !== '' ? fieldValue : '-';
                $this.on('change keyup keydown', '[name="' + fieldName + '"]', function (e) {
                    let value = $(this).val() !== '' ? $(this).val() : '-';

                    $this.find('[data-sf-bind="' + fieldName + '"]').text(value);
                });
                
                // set default
                $this.find('[data-sf-bind="' + fieldName + '"]').text(defaultValue);
            })
        });
    };

    /**
     * setFormSubmitting
     */
    let setFormSubmitting = function () {
        form_submitting = true;
    };

    /**
     * setIsDirty
     */
    let setIsDirty = function () {
        is_dirty = true;
    };

    /**
     * goToStep
     * @param $step
     */
    enjoying-life.goToStep = function ($step) {
        let stepElement = $("#stepbystep");
        let nextText = stepElement.find("[data-step='" + $step + "']").attr('title');

        $("#stepbystep .c-timeline__item").removeClass('active');
        stepElement.find("[data-step='" + $step + "']").addClass('active');       

        if (titleReplace.exists()) {
            titleReplace.first().text(nextText);
        }
    };

    /**
     * alertLeave
     */
    enjoying-life.alertLeave = function () {
        if (!form_submitting) {
            contactUsFormElement.on('keyup', 'textarea', function () {
                setIsDirty();
            });

            contactUsFormElement.on('keyup', 'input[type=text]', function () {
                setIsDirty();
            });

            contactUsFormElement.on('keyup', 'input[type=tel]', function () {
                setIsDirty();
            });

            contactUsFormElement.on('keyup', 'input[type=email]', function () {
                setIsDirty();
            });

            contactUsFormElement.on('change', 'input[type=radio]', function () {
                setIsDirty();
            });

            contactUsFormElement.on('change', 'select', function () {
                setIsDirty();
            });

            window.addEventListener('beforeunload', function (e) {
                var message = 'このページから離れてもよろしいですか?' + '';

                if (form_submitting || !is_dirty) {
                    return undefined;
                }

                (e || window.event).returnValue = message;
                return message;
            });
        }
    };

    /**
     * Contact Us
     */
    enjoying-life.execContactUs = function () {
        if (contactUsFormElement.exists()) {
            // call init
            contactUsFormElement.sfbind();
            confirmSection.hide();
            descConfirm.hide();
            $.validator.addMethod('email', function (value) {
                return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
            }, "データは無効です。");

            $.validator.addMethod("haftwidth", function (value, element) {
                let regex = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g;
                if (regex.test(value)) return false;

                return true;
            }, "データは無効です。");
            
            // Validate form
            contactUsFormElement.validate({
                ignore: [],
                rules: {
                    inquiry_item: {
                        required: true
                    },
                    fullname: {
                        required: true,
                        maxlength: 50
                    },
                    phonenumber: {
                        required: true,
                        number: true,
                        minlength: 11,
                        maxlength: 11
                    },
                    mailaddress: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    message: {
                        maxlength: 50
                    }
                },
                messages: {
                    inquiry_item: {
                        required: "「ラジオボタン」を入力してください"
                    },
                    fullname: {
                        required: "「名前」を入力してください"
                    },
                    phonenumber: {
                        required: "半角英数(ハイフン無し)で「電話番号」を入力してください",
                        number: "半角英数(ハイフン無し)で「電話番号」を入力してください",
                        minlength: "半角英数(ハイフン無し)で「電話番号」を入力してください",
                        maxlength: "半角英数(ハイフン無し)で「電話番号」を入力してください"
                    },
                    mailaddress: {
                        required: "半角英数で「メールアドレス」を入力してください",
                        email: "半角英数で「メールアドレス」を入力してください",
                        haftwidth: "半角英数で「メールアドレス」を入力してください"
                    },  
                    message: {
                        maxlength: "フリーフォームは1000文字を超えてはいけません。"
                    }
                },
                
                errorPlacement: function (error, element) {
                    if (element.attr("name") === 'inquiry_item') {
                        $(element).parents('.c-form__group').append(error);
                        $(element).parents('.c-form__group').find('.error').addClass('u-text--error u-display--block');
                    } else {
                        error.addClass('u-text--error u-display--block');
                        error.insertAfter($(element));
                    }
                },
                success: function (error, element) {                    
                    error.remove();
                },
                submitHandler: function (form) {
                    let SfAction = $(form).attr('data-sf-action');                    
                    $('.c-section__heading__title').html(' 確認'); // Changing page title becomes "Name of step 2"
                    // handle
                    if (SfAction === 'completed') {                        
                        let formData = $(form).serializeArray();
                        loadingEffectStart(btnSubmit);
                        $.ajax({
                            type: 'post',
                            dataType: 'json',
                            url: WPObj.ajaxurl,
                            data: formData,
                            context: this,
                            success: function (response) {   
                                                  
                                if (response.success && response.data.redirect_url) {
                                    setFormSubmitting();
                                    window.location.href = response.data.redirect_url;
                                } else {
                                    loadingEffectStop(btnSubmit);
                                }
                            }
                        });
                    } else {
                        let content = $("textarea[name=message]").val().replace(/\r?\n/g, "<br>");
                        if (content !== '') {
                            $html.find('[data-sf-bind="message"]').html(content);
                        }

                        inputSection.fadeOut(170);
                        confirmSection.fadeIn(170);
                        descConfirm.fadeIn(170);
                        descInput.hide();
                        
                        enjoying-life.goToStep(2);
                        
                        // scroll to page content
                        setTimeout(function () {
                            scrollToPageContent(pageContent);
                        }, 300);

                        // set form action
                        $(form).attr('data-sf-action', 'completed');
                    }

                    return false;
                }
            });
        }
    };

    /**
     * Load init
     */
    $document.ready(function () {
        enjoying-life.execContactUs();
        enjoying-life.alertLeave();

        buttonBack.on('click', function () {
            if ($(this).attr('disabled') !== 'disabled') {
                inputSection.fadeIn(170);
                confirmSection.fadeOut(170);
                descInput.fadeIn(170);
                descConfirm.hide();
                // scroll to page content
                scrollToPageContent(pageContent);

                // set form action
                contactUsFormElement.attr('data-sf-action', 'input');
                enjoying-life.goToStep(1);
            }
        });

        $('#c-btn__submit--01, #c-btn__submit--02').on('click', function (event) {
            event.preventDefault();
            contactUsFormElement.submit();
        });
    });
})(jQuery);
