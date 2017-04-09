// 2016-03-07
// 
// faq展开
$(function(){
	// 问题一级列表默认全部展开
	var faqBtn = $(".faq_menu li .title");
	faqBtn.parent("li").addClass("open");
     
	// 问题一级列表点击展开隐藏
	faqBtn.click(function(event){
		var isOpen = $(this).parent("li").hasClass("open");
		if( isOpen ) {
			$(this).parent("li").removeClass("open");
			$(this).next(".faq_list").slideUp();
		} else {
			$(this).parent("li").addClass("open");
			$(this).next(".faq_list").slideDown();
		}

	})

	// 问题一级列表默认显示四个，点击展开更多
	$(".faq_more").click(function(){
		var isunfold = $(this).prev(".faq_submenu").hasClass("open");
		var liLength = $(this).prev(".faq_submenu") .find("li").length;

		if ( isunfold ) {
			$(this).prev(".faq_submenu").removeClass("open");
			$(this).prev(".faq_submenu").animate({ 
			    height: "212px",
			    background: "red"
			  }, 300 );
			$(this).text("展开更多");
		} else {
			var liHeight = $
			$(this).prev(".faq_submenu").addClass("open");
			$(this).prev(".faq_submenu").animate({ 
			    height: liLength * 53
			  }, 300 );
			$(this).text("收起");
		}
	});

});

	