$(function(){

    // scroll fade
    $(function(){
        $(window).scroll(function (){
            $('.js-fade').each(function(){
                var elemPos = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                if (scroll > elemPos - windowHeight + 160){
                    $(this).addClass('fade');
                }
            });
        });
    });

});