/**
 *  todo: Сделать добавление статьи через ajax. получаем данные обрабатываем их, если что то не так возвращаем ошибки,
 *  если все ок, то выпиливаем все и ставим, что статья добавлена
 */

$(document).ready(function(){

    $(document).on('submit', '.js-form', function(e){
        e.preventDefault();

        var vars = $(this).serialize();
        var furl = $(this).attr('action');

        console.log(vars);
        console.log(furl);

        $.ajax({
            type: "POST",
            url: furl,
            data: vars,
            success: function(response)
            {
                response = JSON.parse(response);

                if (response.NoPostArgumentException != undefined) {
                    alert('Something went wrong...');
                    return;
                }

                if (response.Exception != undefined) {
                    alert('Something went wrong...');
                    return;
                }

                if (response.EmptyParameterException != undefined) {

                    if () {

                    }





                    console.log('!!');
                    return;
                }



                return;

                /*
                if (response.status.code != 1001) {
                    if (response.data.succes === 'Ok') {
                        $("#formCall").empty();
                        $("#formCall").append("<span class='succes'>Спасибо за обращение. Мы свяжемся с вами в ближайшее время.</span>");
                    }
                } else {

                    if (response.data.honeyPot != undefined) {
                        return;
                    }

                    // снять везде класс ошибки
                    $("#formCall input[name='name']").removeClass('inputError');
                    $("#formCall input[name='phone']").removeClass('inputError');
                    $("#formCall textarea[name='comment']").removeClass('inputError');
                    $("#formCall span[class='error']").remove();

                    if (response.data.error.name != undefined) {
                        if (response.data.error.name === 'name!') {
                            $("#formCall input[name='name']").addClass( "inputError" );
                            $("#formCall input[name='name']").after("<span class='error'>Поле не заполнено</span>");
                        }
                    }

                    if (response.data.error.phone != undefined) {
                        if (response.data.error.phone === 'phone!') {
                            $("#formCall input[name='phone']").addClass( "inputError" );
                            $("#formCall input[name='phone']").after("<span class='error'>Поле не заполнено</span>");
                        }
                        if (response.data.error.phone === 'phone!!') {
                            $("#formCall input[name='phone']").addClass( "inputError" );
                            $("#formCall input[name='phone']").after("<span class='error'>Поле должно содержать только цифры</span>");
                        }
                    }

                    if (response.data.error.comment != undefined) {
                        if (response.data.error.comment === 'comment!') {
                            $("#formCall textarea[name='comment']").addClass( "inputError" );
                            $("#formCall textarea[name='comment']").after("<span class='error'>Поле не заполнено</span>");
                        }
                    }

                }
                */
            }
        }); // $.ajax

    }); // $('#formCall').submit


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
    }); // $('.delete').click
});