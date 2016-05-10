$(function () {
    $('#upload').submit(function () {

        var error= true;
        var link = $(this).find(':text[name="video[link]"]').val();
        var isValid = /^(https?\:\/\/)?((www\.)?youtube\.com|youtu\.?be)\/.+$/.test(link);

        if (link && isValid ) {
            error = false;
        }
        if (error === false) {

            var data = $(this).serialize();
            $.ajax({
                url: '/upload',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    $('.noVideo').hide();

                    $('.postVideo').append('<div class="test">' +

                        '<a href="/video/show/'+ data.url +'"><img src="'+ data.preview +'"></a><br><br>'+
                        '<span>Posted By <a href="/profile/show/'+data.authorName.toLowerCase() +'">'+data.authorName +'</a></span>'+
                        + '</div>' +  '<form id="delete" method="post">' +
                        '<input type="hidden" name="id" value="{{ item.id }}">' +
                        '<input type="submit" name="delete" value="Supprimer">' +
                        '</form>'
                   );
                },
                error : function (error) {
                    console.log('error');
                }
            });

        } else {
            if (!link || !isValid) {
                console.log("Put a valid link");

            }
        }
        return false;
    });


    $('#delete').submit(function () {

        var id = $(this).find('input[type=hidden]').val();
        var data = $(this).serialize();
        $.ajax({
            url: '/delete/'+id,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                window.location.reload("/");

            },
            error : function(error){
                console.log('error');
            }
        });
        return false;

    });

});