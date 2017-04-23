$(document).ready(function() {

    var pagination = $('.pagination');

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var btn = $(this);
        var additionData = $(this).closest('.pagination').attr('data-addition');
        var href = btn.attr('href');
        if (!href || href === undefined)
            return false;

        $.ajax({
            url: href,
            type: 'POST',
            data: {
                'data': additionData
            },
            success: function(data) {
                console.log(data);
                if (data) {
                    btn.closest('.tab-pane').empty().append(data);
                }
            }
        })

    })


});