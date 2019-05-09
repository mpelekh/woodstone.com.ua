
// Select menu nav
$(document).ready(function () {

    //Hover social opacity
    $(".social").hover(function() {
        $(this).animate({"opacity": "1"});
    }, function() {
        $(this).animate({"opacity": "0.7"});
    });

    //To Up
    $(".toup").click(function(e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    //Change button color
    $("#production-main-btn > #production-main-btn-hover, #btn-hover, #cooperation-main-btn > #cooperation-main-btn-hover").hover(
        function() {
            $(this).removeClass();
            $(this).addClass("btn btn-primary");
        },
        function() {
            $(this).removeClass();
            $(this).addClass("btn btn-warning");
        }

    );

    //Content Min Height
    var contminh = $(window).height()-$(".header").height()-$(".footer-info").height()-$(".footer-copyright").height()+16;
    $(".content").css("min-height",contminh);

    //Windows Width
    //$("body").css("min-width",$(document).width()+"px");

    // Textarea rows
    $("#contacts-textarea").attr("rows", 4);

    $("#convert-textarea").attr("rows", 10);

    //Google map height
    var gh = ($(window).height() > $("#contacts-main-text-col").height()) ?  $("#contacts-main-text-col").height() : ($(window).height()-20);
    $(".googlemap").height(gh);

    //Cooperation bottom position
    var textHeight = $("#cooperation-main-text").height();
    //$("#cooperation-main-btn").height(textHeight);
	if(textHeight > 70)
	{
    		$(".row > #cooperation-main-btn").css("margin-top",(textHeight/2-35)+"px");
	}

    
    //Placeholder
    $("input, textarea").placeholder();


    $('.form-captcha').on('click', function(){
        var rand = Math.floor(Math.random() * 10000),
            source = $(this).attr('data-captcha-source');

        $(this).attr('src', source + '?' + rand);
    });

});

//According Main

$(function() {
    $('#accordion > li').hover(
        function () {
            var $this = $(this);
            $('.accordion-description',$this).stop(true,true).delay(400).fadeIn();
        },
        function () {
            var $this = $(this);
            $('.accordion-description',$this).stop(true,true).fadeOut(500);
        }
    );

    $("#accordion").AccordionImageMenu({
        'openDim': 500,
        'closeDim': 150,
        'height': 255,
        'border' : 1,
        'color':'#ffffff',
        'fadeInTitle': false
    });


});


// Gallery

$(document).ready(function() {

    $(".fancybox").fancybox({

        helpers : {
            title : {
                type : 'over'

            }
        }
    });

});


