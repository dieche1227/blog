//20160304 取现选项卡，编辑
$(function(){
	var tabNav = $(".ctab_bar li");
	tabNav.eq(0).find('input').attr('checked',true);
	$(".ctab_menu .item").eq(0).show();


	tabNav.click(function(){
		var index = $(this).index();
		tabNav.eq(index).find('input').attr('checked',true);
		$(".ctab_menu .item").hide();
		$(".ctab_menu .item").eq(index).show();
	});
});



