$(function(){

	// 默认支付宝，选择银行显示银行列表
	$(".fabu_pay_bank").hide();

	$(".fabu_pay .iradio").click(function(){
		var attr = $(this).attr("for");
		if ( attr == 'pay2' ) {
			$(".fabu_pay_bank").slideDown();
		} else {
			$(".fabu_pay_bank").slideUp();
		}
	});
});