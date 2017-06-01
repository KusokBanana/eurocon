$(document).ready(function() {

    var pagination = $('.pagination');

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var additionData = $(this).closest('.pagination').attr('data-addition');
        additionData = JSON.parse(additionData);
        additionData.action = 'pagination';
        additionData = JSON.stringify(additionData);

        ajaxReload(additionData, $(this), $(this).attr('href'));

    }).on('keyup', '.search-ajax-field', function(e) {
        if(e.keyCode === 13){
            e.preventDefault();
            var additionData = $(this).attr('data-addition');
            additionData = JSON.parse(additionData);
            additionData.action = 'search';
            additionData.search = $(this).val();
            additionData = JSON.stringify(additionData);

            ajaxReload(additionData, $(this), $(this).attr('data-href'));

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

    });

    function ajaxReload(additionData, element, href) {

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
                    element.closest('.tab-pane').empty().append(data);
                }
            }
        })
    }



});