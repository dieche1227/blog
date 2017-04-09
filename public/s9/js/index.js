
$(function() {
	/*导航效果*/

	/*var a1=$(window).width();
	$(".js_banner_main").width(a1);*/
	var window_height=$(window).height();
	/*$(window).scroll(function(event) {
		if($(window).scrollTop()> 70){
			$(".js_nav_d").hide()
	        $(".js_nav_fix").show();  

	    }else{
			$(".js_nav_d").show()
	        $(".js_nav_fix").hide();
	    }
	});
	$(window).scroll(function(event) {
		if($(window).scrollTop()>70){
			$(".js_nav_p").addClass('js_nav_px')

	    }else{
			$(".js_nav_d").show()
			$(".js_nav_p").removeClass('js_nav_px')
	    }		
	});*/

	/*导航头像部分*/
	$(".js_user_info ").hover(function() {
		$(this).children('.js_user_x').show();
	}, function() {
		$(this).children('.js_user_x').hide();
	});

	$(".js_n").siblings("a").css({
		cursor: 'default'
	});
	$(".js_n").siblings("a").attr({
		href: 'javascript:;'
	});
	/*首页轮播图*/
	//轮播小圆点居中显示
	var  sliderOffset = $(".js_banner ol").width()*(-0.5)-16;
    $(".js_banner ol").css("marginLeft",sliderOffset);           
	var $key=0;
    /* 右侧按钮开始*/
    $(".js_arrow_r").click(function(event) {
   
         autoplay(); 
    });
    /*左侧按钮开始*/
    $(".js_arrow_l").click(function(event) {
        $(".js_banner ul li").eq($key).fadeOut(500);  
        $key--;  

        $key=$key%$(".js_banner ul li").length;
        $(".js_banner ul li").eq($key).fadeIn(500);
        $(".js_banner ol li").eq($key).addClass('current').siblings().removeClass('current');
    });

   /*点击小方块开始*/
     $(".js_banner ol li").click(function(event) {
     	$(this).addClass('current').siblings().removeClass('current');

     	$(".js_banner ul li").eq($key).fadeOut(500); 

        $key=$(this).index();  /*  一定是先淡出 上一个图片  ，再淡入 当前的图片*/

        $(".js_banner ul li").eq($key).fadeIn(500);

     });
    var timer=setInterval(autoplay, 3000);
    function autoplay(){
    	$(".js_banner ul li").eq($key).fadeOut(500);  
        $key++;  
        $key=$key%$(".js_banner ul li").length;
        $(".js_banner ul li").eq($key).fadeIn(500);
        $(".js_banner ol li").eq($key).addClass('current').siblings().removeClass('current');
    }
	$(".js_banner").hover(function() {
		$(".js_banner ol").fadeIn();
		clearInterval(timer); 
		timer=null; 
	}, function() {
		$(".js_banner ol").fadeOut();
		clearInterval(timer); 
		timer=setInterval(autoplay, 3000);  
	});

	/*首页设计师与主办方切换*/
	$(".js_main .js_ed li").click(function(event) {
		$(this).addClass('on').siblings('').removeClass('on');
		var n=$(this).index();
		$(".js_main .js_edc").children().eq(n).show().siblings().hide();
	});
		 var scrollFunc = function (e) {
        var direct = 0;
        e = e || window.event;
        if (e.wheelDelta) {  //判断浏览器IE，谷歌滑轮事件             
            if (e.wheelDelta > 0) { //当滑轮向上滚动时
               if($(window).scrollTop()>70){
				$(".js_nav_d").hide();
		        $(".js_nav_fix").fadeIn();
				$(".js_nav_p").addClass('js_nav_px').fadeIn();
				}
		        if($(window).scrollTop()<70){
					$(".js_nav_d").show();
		            $(".js_nav_fix").hide();
		            $(".js_nav_p").show().removeClass('js_nav_px');
		    	}	 
            }
            if (e.wheelDelta < 0) { //当滑轮向下滚动时
            	$(".js_nav_fix").hide();
	    		$(".js_nav_px").hide();
            }
        } else if (e.detail) {  //Firefox滑轮事件
            if (e.detail> 0) { //当滑轮向上滚动时
                $(".js_nav_fix").hide();
	    	    $(".js_nav_px").hide();
            }
            if (e.detail< 0) { //当滑轮向下滚动时
				if($(window).scrollTop()>70){
					$(".js_nav_d").hide();
			        $(".js_nav_fix").fadeIn("fast");
					$(".js_nav_p").addClass('js_nav_px').fadeIn("fast");
				}
		        if($(window).scrollTop()<70){
					$(".js_nav_d").show();
		            $(".js_nav_fix").hide();
		            $(".js_nav_p").show().removeClass('js_nav_px');
		    	}	         	
            }
        }
    }
    //给页面绑定滑轮滚动事件
    if (document.addEventListener) {
        document.addEventListener('DOMMouseScroll', scrollFunc, false);
    }
    //滚动滑轮触发scrollFunc方法
    window.onmousewheel = document.onmousewheel = scrollFunc;
	/*scroll(function(down) { 
		if(down==="up"){
			if($(window).scrollTop()>70){
				$(".js_nav_d").hide();
		        $(".js_nav_fix").fadeIn("fast");
				$(".js_nav_p").addClass('js_nav_px').fadeIn("fast");
			}
	        if($(window).scrollTop()<70){
				$(".js_nav_d").show();
	            $(".js_nav_fix").hide();
	            $(".js_nav_p").show().removeClass('js_nav_px');
	    	}	    	
		}
		else{
			if($(window).scrollTop()>70){
			
	          
	    	}
	    	$(".js_nav_fix").hide();
	    	$(".js_nav_px").hide();
		}
		
	}); */  
});

/*function scroll( fn ) {
    var beforeScrollTop = document.body.scrollTop,
        fn = fn || function() {};
    window.addEventListener("scroll", function() {
        var afterScrollTop = document.body.scrollTop,
            delta = afterScrollTop - beforeScrollTop;
        if( delta === 0 ) return false;
        fn( delta > 0 ? "down" : "up" );
        beforeScrollTop = afterScrollTop;
    }, false);
}*/