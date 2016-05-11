

$(function(){

    /* UPLOAD MODAL*/
    $('#uploadAVideo').click(function(){
        $('.popUp').show('fast').css("display","table");
        $('.modalPopUp').show('slow').css("display","table-cell");
        $('.videoUploadForm').css('display','block');
        $('.close').css('display','block');
    });

    $('.close').click(function(){
        $('.popUp').hide('fast').css("display","table");
    });

    /* Login Modal */
    $('#login').click(function(){
        $('.loginPopUp').show('fast').css("display","table");
        $('.modalPopUp').show('slow').css("display","table-cell");
        $('.loginForm').css('display','block');
        $('.close').css('display','block');
    });

    $('.close').click(function(){
        $('.loginPopUp').hide('fast').css("display","table");
    });

    /* register Modal */
    var registerPopUp = $(".registerPopUp");

    $('#register').click(function(){
        $(registerPopUp).show('fast').css("display","table");
        $('.modalPopUp').show('slow').css("display","table-cell");
        $('.registerForm').css('display','block');
        $('.closeRegister').css('display','block');
    });

    $('.closeRegister').click(function(){
        $(registerPopUp).hide('fast').css("display","table");
    });

});