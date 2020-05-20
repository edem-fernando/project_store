$(function () {
   
    var time_efect = 400;

    $('header > img').on('mouseenter', function(){
        $(this).css({
           opacity : '1',
           cursor  : 'pointer'
        }); 
    });

    $('header > img').on('mouseout', function(){
        $(this).css('opacity', '0.9');
    });

    $('.main_content_products > header > h4').on('mouseenter', function(){
        $(this).css({
           'text-decoration'    : 'underline',
           'cursor'             : 'pointer'
        }); 
    });

    $('.main_content_products > header > h4').on('mouseout', function () {
        $(this).css('text-decoration', 'none');
    });

    $('.btn').on('mouseenter', function(){
        $(this).css({
            cursor : 'pointer',
            background : '#FFF',
            color : '#563D7C'
        });
    });

    $('.btn').on('mouseout', function(){
        $(this).css({
            background : '#28a745',
            color : '#FFF'
        });
    });

    $('.tutor_social_network > h6 > a').on('mouseenter', function(event) {
        $(this).css('text-decoration', 'underline');
    }).on('mouseout', function(event) {
        $(this).css('text-decoration', 'none');
    });

    $('.footer_cta_header > h3 > a').on('mouseenter', function(event) {
        $(this).css({
            background:'#FFF',
            color: '#563D7C'
        });
    }).on('mouseout', function(e) {
        $(this).css({
            background:'#563D7C',
            color: '#FFF'
        });
    });

    $(".main_content_school_description > header > h4 > a").add('.footer_content_menu > ul > li > a').add('.footer_content_links > ul > li > a').on('mouseenter', function(event) { 
        $(this).css('text-decoration', 'underline');
    }).on('mouseout', function(event) {
        $(this).css('text-decoration', 'none');
    });

    /*modal 
    $(".main_content_products > header > h4").on("click", function (e) {
        var modal = $(".modal");
        var btn_close = $(".btn_close");
        
        
        modal.fadeIn(time_efect, function () {
            btn_close.on("click", function () {
                modal.fadeOut(time_efect, function () {});
            });
        }).css("display", "flex");
    });*/
});