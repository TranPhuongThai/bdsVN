$(document).ready(function() {
    var $navLi = $('#nav li'); 
    $('<span></span>').insertBefore('#nav li a');
    
    $navLi.each(function() {
       var linkText = $(this).find('a').text();
       $(this).find('span').show().text(linkText);
       //alert(linkText);
    });
    $navLi.hover(function() {
        $(this)
        .find('span')
        .stop()
        .animate({marginTop: '-40px'}, 300);
    }, function() {
        $(this)
        .find('span')
        .stop()
        .animate({marginTop: '0px'}, 300);
    });
});