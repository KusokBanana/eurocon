$(document).ready(function() {

    $('#project_timeline').on('click', '.timeline-edit', function(e) {
        e.preventDefault();

        var href = $(this).attr('href');
        var type = $(this).attr('data-type');

        const ACT = 'activate';
        const DE = 'deactivate';

        if (type === ACT || type === DE) {

            var items = $('#project_timeline').find('.timeline-item');
            if (items.length) {
                items.find('.timeline-info.tool-container').toggle('slow');
            }
            $(this).attr('data-type', type === ACT ? DE : ACT);
            $(this).text(type === ACT ? 'Done' : 'Edit');

        } else {
            $.ajax({
                url: href,
                method: 'POST',
                data: {
                    'type': type
                },
                success: function(data) {
                    if (data) {

                        var modal = $('#project_timeline_edit');
                        if (modal.length)
                            modal.remove();

                        if (type === 'delete') {
                            $('#project_timeline').empty().append(data)
                                .find('.timeline-edit[data-type="'+ACT+'"]').trigger('click');
                        } else {
                            $('body').append(data);
                            $('#project_timeline_edit').modal();
                        }

                    }
                }
            })

        }

    });

    $('body').on('change', '.project-timeline-radio', function() {
        var value = $(this).val();
        var blocks = $('.project-timeline-media-block');
        blocks.hide();
        $('.project-timeline-media-block[data-type="'+value+'"]').show();

    })

});