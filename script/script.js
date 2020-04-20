$('header > img').on('mouseenter', function(){
    $(this).css({
       opacity : '1',
       cursor  : 'pointer'
    }); 
});

$('header > img').on('mouseout', function(){
    $(this).css({
       opacity : '0.9',
    });
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
    })
});

$('.btn').on('mouseout', function(){
    $(this).css({
        background : '#28a745',
        color : '#FFF'
    })
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
