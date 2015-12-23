$(document).ready(function(){

    $('.delete').click(function(event) {
        event.preventDefault();

        var del = $(this).attr("data-delete");
        var route = '/deleteArticle/' + del;

        $.ajax({
            type: "POST",
            url: route,
            data: ({}),
            success: function(data)
            {
                if (data == 'ArticleDelete') {
                    var str = '#idPost' + del;
                    $(str).fadeOut(500);
                } else {
                    alert('Произошла ошибка при удалении статьи!');
                }
            }
        });
    });
});