$(document).ready(function() {

    $('body').on('submit', '#forum_add_post_form:not(.link-disallow)', function(e) {
        e.preventDefault();

        var form = $(this),
            href = form.attr('action');

        var fd = new FormData(form[0]);
        fd.append('image_files', form.find('input[type="file"]').prop('files')[0]);

        $.ajax({
            url: href,
            data: fd,
            type: "POST",
            processData: false,
            contentType: false,
            success: function (data) {
                if (data) {
                    $('#forum').empty().append(data);
                    form[0].reset();
                    form.closest('.modal').modal('hide')
                }
            }
        })

    });

    $('#forum')
        .on('click', '.forum-post-reply:not(.link-disallow)', function(e) {
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
                        var targetBlock = $('#' + target);
                        targetBlock.empty().append(data);
                        form.find('textarea').val('');
                        var newForm = targetBlock.find('form');

                        var commentsCount = newForm.attr('data-comments_count'),
                            seeAll = newForm.closest('.forum-post').find('.forum-see-all'),
                            seeAllText = seeAll.attr('data-comments_count', commentsCount).text();
                        seeAllText = seeAllText.replace(/(\d)/, commentsCount);
                        seeAll.text(seeAllText);
                    }
                }
            })

        })
        .on('click', '.forum-get-replies:not(.link-disallow)', function(e) {
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
                            $('#' + target).empty().append(data).slideToggle('slow');
                            $(this).attr('data-loaded', true);
                        }
                    }
                });
            }

            var form = $('#'+target).find('form');
            if (form.length)
                var commentsCount = form.attr('data-comments_count');
            else
                commentsCount = $(this).attr('data-comments_count');

            var seeAllAttrText = $(this).attr('data-title').replace(/(\d)/, commentsCount),
                seeAllText = $(this).text().replace(/(\d)/, commentsCount);
            $(this).attr('data-title', seeAllText);
            $(this).text(seeAllAttrText);

            if (isLoaded)
                form.slideToggle('slow')

        })

});