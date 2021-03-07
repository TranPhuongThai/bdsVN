$(document).ready(function(){
    /* main-menu mobile */
    $('.button-main-menu-mobile').click(function(){
        $(this).parent().find('.nav-main-menu').toggle();
    });
    $('.main-menu .container > ul > li').click(function(){
        if($(this).has('ul').length > 0){
            $(this).find('> ul').toggle();
            return false;
        }
    });
    /* tab search*/
    $('#main-search ul li').click(function(){
        $('#main-search ul li').removeClass('active');
        $(this).addClass('active');
        var dataType = $(this).attr('data-type');
        if(dataType == 2){
            $(this).parent().parent().find('form select[data-type="2"]').addClass('disabled').prop('disabled', 'disabled');
        }else{
            $(this).parent().parent().find('form select[data-type="2"]').removeClass('disabled').prop('disabled', false);
        }
    });
    /* banner scroll */
    $("#siteLeft").show();
    $("#siteRight").show();
    var positionQuery = '.bnScroll .item';
    if (positionQuery.length > 0) {

        var bodywidth = 1000; // $('.site').width();
        var widthleft = $('#siteLeft .bnScroll').width();
        var widthright = $('#siteRight .bnScroll').width();
        var xright = (($(document).width() - bodywidth) / 2) + bodywidth;
        var xleft = (($(document).width() - bodywidth) / 2) - widthleft;

        $(window).scroll(function () {
            rePosition();
        });

        $(window).resize(function () {
            rePosition();
        });

        function rePosition() {
            if ($(document.body).width() < bodywidth + widthleft + widthright) {
                $('.bnScroll').css('display', 'none');
                return;
            } else {
                $('.bnScroll').css('display', 'block');
            }

            xright = (($(document.body).width() - 0 - bodywidth) / 2) + bodywidth + 10;

            if (widthleft == null) {
                xleft = (($(document.body).width() - 0 - bodywidth) / 2) - widthright - 10;
            } else {
                xleft = (($(document.body).width() - 0 - bodywidth) / 2) - widthleft - 10;
            }
            //console.log($(document.body).width() + " -- " + bodywidth + " -- " + widthleft + " -- " + widthright + " -- " + xleft);
            var $toadoOld = 0;
            var $toadoCurr = $(window).scrollTop();

            var heightFromTop = 0;
            //var fixPos = window.location.pathname != "/" ? 192 : 440;
            var fixPos = 415;
            var newtop = 0;
            var botPos = $("#footer").position().top - $(".bnScroll").height();
            if ($toadoCurr <= fixPos) {
                newtop = fixPos;
            } else if ($toadoCurr >= botPos) {
                newtop = botPos;
            }
            else {
                newtop = $toadoCurr - $toadoOld + heightFromTop;
            }

            if ($('#siteLeft .bnScroll .item').length != 0) {
                $('#siteLeft .bnScroll').stop().animate({ 'top': newtop + 30, 'left': xleft }, 300);

            }
            if ($('#siteRight .bnScroll .item').length != 0)
                $('#siteRight .bnScroll').stop().animate({ 'top': newtop + 30, 'right': xleft }, 300);


            $toadoOld = $toadoCurr;
        }

        rePosition();
    }
})