
$(function(){
	//首先将#scrollUpf隐藏
    $("#toTop").hide();
    //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
    $(function() {
        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                $("#toTop").fadeIn();
            } else {
                $("#toTop").fadeOut();
            }
        });
        //当点击跳转链接后，回到页面顶部位置
        $("#toTop .arrows").click(function() {
            $('body,html').animate({
                scrollTop: 0
            },
            500);
            return false;
        });
    });
});