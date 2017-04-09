// 发布竞赛详情页

$(function(){

	
	// 竞赛简介子导航展开收起
	$(".det_menu li").click(function(){
		var $this = $(this);
		var detLi = $(".det_menu li");
	 
		if( $this.hasClass("open") ){
			$(this).removeClass("open");
			$(this).find(".det_submenu").slideUp();
		} else {
			detLi.removeClass("open");
			detLi.find(".det_submenu").slideUp();

			$this.addClass("open");
			$this.find(".det_submenu").slideDown();
		}
	});

	//赛简介内容展开更多
	$(".det_cont_list .more").click(function(){
		$(this).parent().toggleClass("open");
	});

	// 时间线
	var timeLine = $('.timeline li[class=on]').index();
	$('.timeline li[class=on]').append('<span class="active"></span>');
	if ( timeLine == 0 ) {
		$(".timeline_bar").css("width","0");
	};
	if ( timeLine == 1 ) {
		$(".timeline_bar").css("width","25%");
	};
	if ( timeLine == 2 ) {
		$(".timeline_bar").css("width","50%");
	};
	if ( timeLine == 3 ) {
		// alert(timeLine)
		$(".timeline_bar").css("width","75%");
	};
	if ( timeLine == 4 ) {
		$(".timeline_bar").css("width","100%");
	};
	
});