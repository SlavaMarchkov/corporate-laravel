jQuery(document).ready(function ($) {
    
    $('.commentlist li').each(function (i) {
        $(this).find('div.commentNumber').text('#' + (i + 1));
    });
    
    $('#commentform').on('click', '#submit', function (evt) {
        evt.preventDefault();
        const commentParent = $(this); // выбираем кнопку в той форме, по которой был клик
        $('.wrap_result')
            .css('color', 'green')
            .text('Сохранение комментария')
            .fadeIn(500, function () {
                const data = $('#commentform').serializeArray();
                $.ajax({
                    url: $('#commentform').attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    type: 'POST',
                    datatype: 'JSON',
                    success: function (response) {
                        if (response.error) {
                            $('.wrap_result').css('color', 'red').append('<br><strong>Ошибка: </strong>' + response.error.join('<br>'));
                            $('.wrap_result').delay(3000).fadeOut(500);
                        } else if (response.success) {
                            $('.wrap_result')
                                .append('<br><strong>Комментарий успешно сохранён</strong>')
                                .delay(1000)
                                .fadeOut(500, function () {
                                    // если добавленный комментарий не родительский, а ответный на др. комментарии
                                    if (response.data.parent_id > 0) {
                                        commentParent
                                            .parents('div#respond')
                                            .prev()
                                            .after('<ul class="chidren">' + response.comment + '</ul>');
                                    } else {
                                        // если комментарий не первый, т.е. уже есть комментарии
                                        // и получается, что пользователь добавляет родительский комментарий
                                        if (response.data.count > 1) {
                                            $('ol.commentlist').append(response.comment);
                                        // если комментарий первый, то выводим его перед формой добавления комментария    
                                        } else {
                                            $('#comments-title').after('<ol class="commentlist group">' + response.comment + '</ol>');
                                        }
                                    }
                                    $('#cancel-comment-reply-link').click();
                                    $('#commentform')[0].reset();
                                });
                        }
                    },
                    error: function () {
                        $('.wrap_result').css('color', 'red').append('<br><strong>Ошибка!</strong>');
                        $('.wrap_result').delay(2000).fadeOut(500, function () {
                            $('#cancel-comment-reply-link').click();
                        });
                    },
                });
            });
    });
});