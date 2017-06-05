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

    }).on('keyup', '.search-ajax-field', function(e) {
        if(e.keyCode === 13){
            e.preventDefault();
            var additionData = $(this).attr('data-addition'),
                wrapSelector = $(this).attr('data-wrap'),
                wrap = (wrapSelector) ? $(wrapSelector) : false;
                // wrap = (wrapSelector) ? $(wrapSelector) : $(this).closest('.tab-pane');

            additionData = JSON.parse(additionData);
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

                }
            }
        })
    }



});