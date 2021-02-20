/*global $, window*/

$(function(){
    
    // اصحح الباكجروند
    
    // Put the height of the overlay div to be the same height of the window
    
    if( $(".index, .inquire, .overlay, .login, .complain").height() < $(window).height() )
    {
        $(".index, .inquire, .overlay, .login, .complain").height($(window).height());
    }
    
    
    $(window).on("resize", function(){
        
        if( $("html").height() > $(window).height() )
        {
            $(".index, .inquire, .overlay, .login, .complain").height($("html").height());
        }
        
    });
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    // Login.php   (password eye slash)
    
    $(".login i").click(function(){
        
        if($(this).hasClass("fa-eye"))
        {
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            $(".login input.pass").attr("type","text");
        }
        else
        {
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            $(".login input.pass").attr("type","password");
        }
        
    })
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // signup.php   (cascade select box)
    
    $(".signup .govern").on("change", function(){
        
        if($(this).val() == -1)
        {
            $(".signup .center").val(-1);
            $(".signup .center").attr("disabled","disabled");
            
            $(".signup .district").val(-1);
            $(".signup .district").attr("disabled","disabled");
        }
        else
        {
            $(".signup .center").removeAttr("disabled");
            $(".signup .center").val(-1);
            $(".signup .district").val(-1);
            $(".signup .center optgroup").css("display","none");
            $(".signup .center optgroup[label = " + $(this).val() + "]").css("display","block");
        }
    });
    
    $(".signup .center").on("change", function(){
        
        if($(this).val() == -1)
        {
            $(".signup .district").val(-1);
            $(".signup .district").attr("disabled","disabled");
        }
        else if($(this).val() == $(".signup .govern").val())
        {
            $(".signup .district").removeAttr("disabled");
            
            $(".signup .district").val(-1);
            $(".signup .district optgroup").css("display","none");
            $(".signup .district optgroup[label = " + $(this).val() + "]").css("display","block");
        }
        else
        {
            $(".signup .district").val(-1);
            $(".signup .district").attr("disabled","disabled");
        }
    });
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    // index.php (prevent a click event if the user doesnt registered)
    
    // https://www.tutorialrepublic.com/faq/how-to-check-if-an-element-exists-in-jquery.php ,,, https://api.jquery.com/length/
    
    $(".serv .functions ul li a, .serv > a").on("click", function(event){
        
        if($(".reglog .row").has("div a.reg").length) // IMPORTANT NOTE ABOUT .LENGTH PROPERTY
        {
            event.preventDefault();
            
            if(!$(".reglog .row").has("div.alert").length)
            {
                $(".reglog .row").prepend("<div class='alert alert-danger center-block' style='width: 500px' dir='rtl'>يجب الاشتراك او تسجيل الدخول لاستخدام خدمات الموقع</div>");
            
                $(".reglog").css("margin-top", "25px");
            }            
        }
        
    });
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // inquire.php
    
//    if( $(".inquire form input[type='hidden']").val() == "e" )
//    {
//        $(".inquire .socialid h1").append("خدمة الاستعلام عن فاتورة الكهرباء");
//        $(".inquire").css("background-image","url(layout/images/back-1.jpg)");
//        $(".inquire .logo img").attr("src","layout/images/light-bulb-2.png");
//    }
//    
//    else if( $(".inquire form input[type='hidden']").val() == "w" )
//    {
//        $(".inquire .socialid h1").append("خدمة الاستعلام عن فاتورة الماء");
//        $(".inquire").css("background-image","url(layout/images/back-2.jpg)");
//        $(".inquire .logo img").attr("src","layout/images/tap4.png");
//    }
//    
//    else if( $(".inquire form input[type='hidden']").val() == "g" )
//    {
//        $(".inquire .socialid h1").append("خدمة الاستعلام عن فاتورة الغاز");
//        $(".inquire").css("background-image","url(layout/images/back-3.jpg)");
//        $(".inquire .logo img").attr("src","layout/images/gas2.png");
//    }
});