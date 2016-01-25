$(document).ready(function() {

    $('.switch a').click(function(){
        if ($(this).hasClass('on')) {
            $(this).siblings('input').val(1);
            $(this).parent().addClass('active');
        } else {
            $(this).siblings('input').val(0);
            $(this).parent().removeClass('active');
        }
    });

});