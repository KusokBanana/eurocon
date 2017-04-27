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
    });

    function ajaxReload(additionData, element, href) {

        if (!href || href === undefined)
            return false;

        $.ajax({
            url: href,
            type: 'POST',
            data: {
                'data': additionData
            },
            success: function (data) {
                if (data) {
                    element.closest('.tab-pane').empty().append(data);
                }
            }
        })
    }


});