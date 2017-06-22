$(document).ready(function() {

    var pagination = $('.pagination');

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var additionData = $(this).closest('.pagination').attr('data-addition'),
            wrapSelector = $(this).closest('ul').attr('data-wrapSelector');
        additionData = JSON.parse(additionData);
        additionData.action = 'pagination';
        additionData = JSON.stringify(additionData);

        var wrap = (wrapSelector) ? $(wrapSelector) : false;

        ajaxReload(additionData, $(this), $(this).attr('href'), wrap);

    }).on('keyup focusout', '.search-ajax-field', function(e) {
        if((e.type === 'keyup' && e.keyCode === 13) || e.type === 'focusout'){
            e.preventDefault();
            var additionData = $(this).attr('data-addition'),
                wrapSelector = $(this).attr('data-wrap'),
                wrap = (wrapSelector) ? $(wrapSelector) : false;
                // wrap = (wrapSelector) ? $(wrapSelector) : $(this).closest('.tab-pane');

            additionData = JSON.parse(additionData);
            additionData = (additionData.length === 0) ? {} : additionData;
            additionData.action = 'search';
            additionData.search = $(this).val();
            additionData = JSON.stringify(additionData);

            ajaxReload(additionData, $(this), $(this).attr('data-href'), wrap);

        }
    }).on('click change', '.filter-ajax-tabs', function(e) {

        var name = $(this).attr('name'),
            value = $(this).val(),
            infoBlock = $(this).closest('.filter-tab-info'),
            additionData = infoBlock.attr('data-addition'),
            href = infoBlock.attr('data-href');

        additionData = JSON.parse(additionData);
        additionData[name] = value;
        additionData = JSON.stringify(additionData);

        ajaxReload(additionData, $(this), href);

    }).on('change', 'form.ajax-reload-filter', function(e) {
        var form = $(this),
            additionData = form.attr('data-addition'),
            formData = form.serializeArray(),
            wrapSelector = form.attr('data-wrapSelector');

        additionData = JSON.parse(additionData);
        additionData.filter = formData;
        additionData = JSON.stringify(additionData);

        var wrap = (wrapSelector) ? $(wrapSelector) : false;

        ajaxReload(additionData, $(this), form.attr('action'), wrap);

    });

    function ajaxReload(additionData, element, href, wrap) {

        if (!href || href === undefined)
            return false;

        $.ajax({
            url: href,
            type: 'POST',
            data: {
                data: additionData
            },
            success: function (data) {
                if (data) {
                    wrap = (wrap) ? wrap : element.closest('.tab-pane');
                    wrap.empty().append(data);

                    if (typeof initSwitcheries === 'function') {
                        initSwitcheries();
                    }
                }
            }
        })
    }


    $('.modal').on('shown.bs.modal', function () {
        if (typeof initialize === 'function') {
            initialize();
        }
    })

    // Another ajax function (for download preview images after change file input)
    function handleFileSelect(e) {
        var files = e.target.files; // FileList object
        var input = $(e.target),
            previewBlock = input.closest('.form-group').next('.image-input-preview-block').empty();

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {
            // Only process image files.
            if (!f.type.match('image.*')) {
                alert("Image only please....");
            }
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    var preview = '<div class="col-md-4 col-xs-12"><div class="example">';
                    preview += '<img class="img-rounded img-bordered img-bordered-primary" '+
                        'src="' + e.target.result + '" title="'+theFile.name+'">';
                    preview += '</div></div>';
                    previewBlock.append(preview);
                };
            })(f);
            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
    $('body').on('change', '.image-input-with-preview', handleFileSelect);


    $('body').on('click', 'a.link-disallow, button.link-disallow', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var href = $(this).attr('href');

        var isModal = ($(this).attr('data-toggle') === 'modal');
        if (isModal) {
            var removingModal = $($(this).attr('data-target'));
            if (removingModal.length) {
                $($(this).attr('data-target')).remove();
            }
        }

        $.ajax({
            url: '/site/ajax-sign?type=login',
            success: function(data) {
                if (data) {
                    var $modal = $('#ajaxSignModal');
                    $modal.remove();
                    $('body').append(data);
                    $('#ajaxSignModal').attr('data-href', href).modal();
                    initGeoSignupSelects();
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log("Ошибка '" + jqXhr.status + "' (textStatus: '" + textStatus + "', errorThrown: '" + errorThrown + "')");
            }
        });

        return false;

    }).on('submit', '#ajaxSignModal form', function(e) {
        e.preventDefault();
        var form = $(this),
            serialize = $(this).serialize(),
            modal = form.closest('#ajaxSignModal'),
            type = form.attr('data-type');

        $.ajax({
            url: '/site/ajax-sign?action=send&type='+type,
            type: "POST",
            data: serialize,
            success: function (data) {
                if (data) {
                    data = JSON.parse(data);
                    var content = data.content;
                    if (data.success) {
                        form.closest('.ajax-content-block').replaceWith(content);
                        initGeoSignupSelects();
                        var href = modal.attr('data-href');
                        if (!!href) {
                            window.location.href = href;
                        } else {
                            modal.modal('hide');
                            modal.remove();
                        }
                    } else {
                        form.closest('.ajax-content-block').replaceWith(content);
                    }
                }
            }
        })
    }).on('click', '#ajaxSignModal .ajax-sign-toggle', function(e) {
        e.preventDefault();

        var button = $(this),
            type = button.attr('data-type');

        $.ajax({
            url: '/site/ajax-sign?action=toggle&type='+type,
            success: function(data) {
                if (data) {
                    button.closest('.ajax-content-block').replaceWith(data);
                    initGeoSignupSelects();
                }
            }
        })

    }).on('click', '.input-search button.input-search-close.icon.wb-close', function() {
        var $prevInput = $(this).prev('input');
        if ($prevInput.length) {
            $prevInput.val('').trigger('focusout');
        }
    });

    renderMiniChat();

    function renderMiniChat() {

        var $miniChat = $('#miniChat'),
            $liChat = $miniChat.closest('li.nav-item'),
            $contentBlock = $miniChat.find('.mini-chat-content'),
            $countNew = $liChat.find('.mini-chat-count'),
            isNeedUpdate = 1;

        function updateContent(open) {
            if (!isNeedUpdate)
                return false;

            var isOpen = (open !== undefined) ? open : $liChat.is('.open');

            $.ajax({
                url: '/chat/mini/render?isOnlyCount=' + (!isOpen),
                success: function(data) {
                    if (data) {
                        if (data === 'quest') {
                            isNeedUpdate = 0;
                        } else {
                            data = JSON.parse(data);
                            var count = data.count;
                            if (+count) {
                                $countNew.text(count).parent().show();
                            } else {
                                $countNew.text('').parent().hide();
                            }
                            if (isOpen) {
                                var content = data.content;
                                $contentBlock.empty();
                                if (content) {
                                    $contentBlock.append(content);
                                }
                                $contentBlock.closest('[data-role="container"]').css('height', 'auto');
                            }

                        }
                    }
                }
            });
        }

        $('body').on('click', '#miniChatLink', function() {
            updateContent(true);
        });

        setInterval(updateContent, 4000);

    }

    function initGeoSignupSelects() {
        var geoCountrySelect = $('#geoCountry');
        var geoCitySelect = $('#geoCity');
        if (geoCountrySelect.length) {

            var select2Data = [];
            $.ajax({
                url: '/site/get-countries',
                dataType: 'json',
                async: false,
                success: function(data) {
                    select2Data = data;
                }
            });

            geoCountrySelect.select2({
                data: select2Data,
                placeholder: 'Select a country ...'
            });
            geoCitySelect.select2();

            $('body').on('change', '#geoCountry', function(e) {
                var value = $(this).val();
                if (value) {
                    geoCitySelect.select2().val(null).select2({
                        ajax: {
                            url: '/site/get-countries?country='+value,
                            dataType: 'json',
                            delay: 250,
                            cache: true
                        }
                    });
                }
            })

        }
    }


});