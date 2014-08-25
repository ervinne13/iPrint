$(document).ready(function () {
    $('#Layer1').parallax();
    $('#Layer8').parallax();

    function Bookmark1Scroll() {
        var $obj = $("#wb_Bookmark1");
        if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false)) {
            $obj.addClass("in-viewport");
            ShowObjectWithEffect('wb_Text1', 1, 'slideup', 1600, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Text2', 1, 'slidedown', 1300, 'easeInOutExpo');
            ShowObjectWithEffect('wb_CssMenu1', 1, 'slideleft', 1000, 'easeInOutExpo');
        }
        if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true)) {
            $obj.removeClass("in-viewport");
            ShowObjectWithEffect('wb_CssMenu1', 0, 'slideup', 500, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Text1', 0, 'slideup', 500, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Text2', 0, 'slideup', 500, 'easeInOutExpo');
        }
    }
    Bookmark1Scroll();
    $(window).scroll(function (event) {
        Bookmark1Scroll();
    });
    $('a[href*=#Bookmark1]').click(function (event) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: $('#wb_Bookmark1').offset().top
        }, 600, 'easeInOutBack');
    });

    function Bookmark2Scroll() {
        var $obj = $("#wb_Bookmark2");
        if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false)) {
            $obj.addClass("in-viewport");
            ShowObjectWithEffect('wb_Text3', 1, 'slidedown', 1000, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Text4', 1, 'slideright', 1300, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Line1', 1, 'dropup', 1600, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Image2', 1, 'slideright', 1900, 'easeInOutExpo');
        }
        if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true)) {
            $obj.removeClass("in-viewport");
            ShowObjectWithEffect('wb_Text3', 0, 'slideup', 500, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Text4', 0, 'slideup', 500, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Line1', 0, 'slideup', 500, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Image2', 0, 'slideup', 500, 'easeInOutExpo');
        }
    }
    Bookmark2Scroll();
    $(window).scroll(function (event) {
        Bookmark2Scroll();
    });
    $('a[href*=#Bookmark2]').click(function (event) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: $('#wb_Bookmark2').offset().top
        }, 600, 'linear');
    });

    function Bookmark3Scroll() {
        var $obj = $("#wb_Bookmark3");
        if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false)) {
            $obj.addClass("in-viewport");
            ShowObjectWithEffect('wb_Text5', 1, 'slidedown', 1000, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Text6', 1, 'slideright', 1300, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Line2', 1, 'dropup', 1600, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Image3', 1, 'slideleft', 1900, 'easeInOutExpo');
        }
        if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true)) {
            $obj.removeClass("in-viewport");
            ShowObjectWithEffect('wb_Text5', 0, 'slideup', 500);
            ShowObjectWithEffect('wb_Text6', 0, 'blindhorizontal', 500);
            ShowObjectWithEffect('wb_Line2', 0, 'blindhorizontal', 500);
            ShowObjectWithEffect('wb_Image3', 0, 'blindhorizontal', 500);
        }
    }
    Bookmark3Scroll();
    $(window).scroll(function (event) {
        Bookmark3Scroll();
    });

    function Bookmark4Scroll() {
        var $obj = $("#wb_Bookmark4");
        if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false)) {
            $obj.addClass("in-viewport");
            ShowObjectWithEffect('wb_Text7', 1, 'slideup', 1000, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Text8', 1, 'slideup', 1300, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Line3', 1, 'dropdown', 1600, 'easeInOutExpo');
            ShowObjectWithEffect('wb_Image4', 1, 'slideright', 1900, 'easeInOutExpo');
        }
        if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true)) {
            $obj.removeClass("in-viewport");
            ShowObjectWithEffect('wb_Text7', 0, 'slideup', 500);
            ShowObjectWithEffect('wb_Text8', 0, 'slideup', 500);
            ShowObjectWithEffect('wb_Line3', 0, 'slideup', 500);
            ShowObjectWithEffect('wb_Image4', 0, 'slideup', 500);
        }
    }
    Bookmark4Scroll();
    $(window).scroll(function (event) {
        Bookmark4Scroll();
    });

    function Bookmark5Scroll() {
        var $obj = $("#wb_Bookmark5");
        if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false)) {
            $obj.addClass("in-viewport");
            ShowObjectWithEffect('Layer11', 1, 'scale', 1000, 'easeInOutBack');
        }
        if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true)) {
            $obj.removeClass("in-viewport");
            ShowObjectWithEffect('Layer11', 0, 'fade', 500);
        }
    }
    Bookmark5Scroll();
    $(window).scroll(function (event) {
        Bookmark5Scroll();
    });
    $('img[data-src]').lazyload();
});