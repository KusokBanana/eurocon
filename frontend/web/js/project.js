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

    $('body')
        .on('change', '.project-timeline-radio', function() {
        var value = $(this).val();
        var blocks = $('.project-timeline-media-block');
        blocks.hide();
        $('.project-timeline-media-block[data-type="'+value+'"]').show();

    })
        .on('submit', '#add_project_post_form', function(e) {
            e.preventDefault();

            var form = $(this),
                data = form.serialize(),
                href = form.attr('action');

            var fd = new FormData(form[0]);
            fd.append('image_files', form.find('input[type="file"]').prop('files')[0]);

            if (!data) {
                return false;
            }

            $.ajax({
                url: href,
                data: fd,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $('#forum').empty().append(data);
                        form[0].reset();
                        form.closest('.modal').modal('hide')
                    }
                }
            })

        });

    $('#forum')
        .on('click', '.project-forum-reply', function(e) {
        e.preventDefault();

        var target = $('#'+$(this).attr('data-target'));
        $('.comment-form').not(target).hide();

        if (target.is(':hidden'))
            target.slideToggle('slow');

    })
        .on('click', '.comment-form-close', function(e) {
        $(this).closest('form').slideUp("slow");
    })
        .on('submit', 'form.comment-form', function(e) {
        e.preventDefault();

        var form = $(this),
            text = form.find('textarea').val(),
            href = form.attr('action'),
            target = form.attr('data-target');

        if (!text || !href)
            return false;

        $.ajax({
            url: href,
            data: {
                text: text
            },
            method: 'POST',
            success: function(data) {
                if (data) {
                    $('#' + target).empty().append(data);
                    form.find('textarea').val('');
                }
            }
        })

    })
        .on('click', '.project-forum-get-replies', function(e) {
        e.preventDefault();

        var href = $(this).attr('href'),
            target = $(this).attr('data-target'),
            isLoaded = $(this).attr('data-loaded');

        if (!isLoaded) {
            $.ajax({
                url: href,
                method: 'GET',
                success: function(data) {
                    if (data) {
                        $('#' + target).empty().append(data);
                        $(this).attr('data-loaded', true);
                    }
                }
            });
        }

        var title = $(this).attr('data-title');
        $(this).attr('data-title', $(this).text());
        $(this).text(title);
        $('#'+target).slideToggle('slow');

    })

});