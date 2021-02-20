/*global $, window*/

$(function(){
    
    // اصحح الباكجروند
    
    // Put the height of the overlay div to be the same height of the window
    
    if( $(".overlay, .login").height() < $(window).height() )
    {
        $(".overlay, .login").height($(window).height());
    }
    
    
    $(window).resize(function(){
        
        if( $(".overlay, .login").height() < $(window).height() )
        {
            $(".overlay, .login").height($(window).height());
        }
        
    });
    
    
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
    
    // signup.php   (cascade select box)
    
 
     $(".govern").on("change", function(){
        
        if($(this).val() == 0)
        {
            $(".center").val(0);
            $(".center").attr("disabled","disabled");
            
            $(".district").val(0);
            $(".district").attr("disabled","disabled");
        }
        else
        {
            $(".center").removeAttr("disabled");
            $(".center").val(0);
            $(".district").val(0);
            $(".center optgroup").css("display","none");
            $(".center optgroup[label = " + $(this).val() + "]").css("display","block");
        }
    });
    
    $(".center").on("change", function(){
        
        if($(this).val() == 0)
        {
            $(".district").val(0);
            $(".district").attr("disabled","disabled");
        }
        else /*if($(this).val() == $(".govern").val())*/
        {
            $(".district").removeAttr("disabled");
            $(".district").val(0);
            $(".district optgroup").css("display","none");
            $(".district optgroup[label = " + $(this).val() + "]").css("display","block");
        }
        /*else
        {
            $(".district").val(-1);
            $(".district").attr("disabled","disabled");
        }*/
    });
 
    
});