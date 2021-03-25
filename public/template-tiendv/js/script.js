$(document).ready(function(){
    // ------------------------------- Partner Slider
    var pSlider = $ (".partner-slider");
    if(pSlider.length) {
        pSlider.owlCarousel({
          loop:true,
          nav:false,
          dots:false,
          autoplay:true,
          autoplayTimeout:4000,
          smartSpeed:1200,
          autoplayHoverPause:true,
          lazyLoad:true,
          responsive:{
                0:{
                    items:1
                },
                400:{
                    items:2
                },
                768:{
                    items:3
                },
                992:{
                    items:4
                },
                1200:{
                    items:5
                }
            },
      })
    }


    // ------------------------------- Partner Slider
    var pSlider = $ (".partner-slider-two");
    if(pSlider.length) {
        pSlider.owlCarousel({
          loop:true,
          nav:false,
          dots:false,
          autoplay:true,
          autoplayTimeout:4000,
          smartSpeed:1200,
          autoplayHoverPause:true,
          lazyLoad:true,
          responsive:{
                0:{
                    items:1
                },
                400:{
                    items:2
                },
                576:{
                    items:3
                },
                992:{
                    items:4
                },
                1200:{
                    items:8
                }
            },
      })
    }
    
    $('.validate').validate();
    /* main-menu mobile */
    $('.button-main-menu-mobile').click(function(){
        $(this).parent().find('.nav-main-menu').toggle();
    });
    
    $('.main-menu .container > ul > li').click(function(){
        if($(this).has('ul').length > 0){
            $(this).find('> ul').toggle();
            //return false;
        }
    });
    
    /* real order */
    $('select[name="fSortReal"]').change(function(){
        var option = $(this).find('option:selected');
        $.cookie('fSort', option.attr('data-fSort'));
        $.cookie('fOrder', option.attr('data-fOrder'));
        location.reload();
        location.href = location.href;
    });
    
    /*form user*/
    var cct = $.cookie('csrf_cookie_name');
    $('#btn-regis').click(function(){
        var parent = $(this).parent().parent();
        
        var username = parent.find('input[name="username"]').val();
        var email = parent.find('input[name="email"]').val();
        var password = parent.find('input[name="password"]').val();
        var repassword = parent.find('input[name="repassword"]').val();
        var phone = parent.find('input[name="phone"]').val();
        if(!username || !email || !password || !repassword || !phone){
            parent.find('.message').html('<p class="bg-danger">Vui lòng nhập đầy đủ thông tin</p>');
        }else{
            $.post("dang-ky", {
                    'csrf_token_name': cct,
                    'username' : username,
                    'email' : email,
                    'password' : password,
                    'repassword' : repassword,
                    'phone' : phone
                },function(result){
                    var data = JSON.parse(result);
                    if(data.status == 1){
                        parent.find('.message').html('<p class="bg-success">'+data.message+'</p>');
                        parent.find('form').remove();
                    }else{
                        parent.find('.message').html('<p class="bg-danger">'+data.message+'</p>');
                    }
                }); 
        }
        
    });
    $('#btn-login').click(function(){
        var parent = $(this).parent().parent();
        
        var email = parent.find('input[name="email"]').val();
        var password = parent.find('input[name="password"]').val();
        if(!email || !password){
            parent.find('.message').html('<p class="bg-danger">Vui lòng nhập đầy đủ thông tin</p>');
        }else{
            $.post("dang-nhap", {
                    'csrf_token_name': cct,
                    'email' : email,
                    'password' : password
                },function(result){
                    var data = JSON.parse(result);
                    if(data.status == 1){
                        parent.find('.message').html('<p class="bg-success">'+data.message+'</p>');
                        location.reload();
                    }else{
                        parent.find('.message').html('<p class="bg-danger">'+data.message+'</p>');
                    }
                }); 
        }
            
    });
    $('#btn-reset').click(function(){
        var parent = $(this).parent().parent();
        
        var email = parent.find('input[name="email"]').val();
        if(!email){
            parent.find('.message').html('<p class="bg-danger">Vui lòng nhập đầy đủ thông tin</p>');
        }else{
            $.post("quen-mat-khau", {
                    'csrf_token_name': cct,
                    'email' : email
                },function(result){
                    var data = JSON.parse(result);
                    if(data.status == 1){
                        parent.find('.message').html('<p class="bg-success">'+data.message+'</p>');
                    }else{
                        parent.find('.message').html('<p class="bg-danger">'+data.message+'</p>');
                    }
                }); 
        }
    });
    
    /* tab search*/
    $('#main-search ul li').click(function(){
        $('#main-search ul li').removeClass('active');
        $(this).addClass('active');
        var dataType = $(this).attr('data-type');
        if(dataType == 2){
            $(this).parent().parent().find('input[name="type"]').val('2');
            $(this).parent().parent().find('form select[data-type="2"]').addClass('disabled').prop('disabled', 'disabled');
        }else{
            $(this).parent().parent().find('input[name="type"]').val('1');
            $(this).parent().parent().find('form select[data-type="2"]').removeClass('disabled').prop('disabled', false);
        }
    });
    $("#province_list").change(function (){
        var str = "";
        $(this).find("option:selected").each(function () {
            str += $(this).attr("value");
        });
        //var cct = $("input[name=csrf_token_name]").val();
        //var cct = $.cookie("csrf_cookie_name");
        $.post("/ajax/getOptionDistrict/"+str, {
                'id' : str,
                'csrf_token_name': cct
            },function(data){
                data = '<option value="0">Quận/Huyện</option>' + data;
                $("#district_list").html(data);
            }); 
        return false;
    });
    $("#district_list").change(function (){
        var str = "";
        $(this).find("option:selected").each(function () {
            str += $(this).attr("value");
        });
        //var cct = $("input[name=csrf_token_name]").val();
        //var cct = $.cookie("csrf_cookie_name");
        $.post("/ajax/getOptionWard/"+str, {
                'id' : str,
                'csrf_token_name': cct
            },function(data){
                data = '<option value="0">Phường/Xã</option>' + data;
                $("#ward_list").html(data);
            }); 
        return false;
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
    $(".login").click(function(){
        $("#modalLogin").modal("show");
    });
    $(".forget").click(function(){
        $("#modalForget").modal("show");
    });
    $(".regis").click(function(){
        $("#modalRegis").modal("show");
    });
    
})