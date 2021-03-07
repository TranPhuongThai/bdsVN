$(document).ready(function(){
    $('.button-main-menu-mobile').click(function(){
        $(this).parent().find('.nav-main-menu').toggle();
    });
    $('.main-menu .container > ul > li').click(function(){
        $(this).find('> ul').toggle();
    });
})