$(function(){
	var type = 1;
	// 是否通过过滤
	var isFilter = true;
	// 默认推广服务禁用
	// empty_fuwu();

	//达标赛套餐隐藏
	// $("#dabiao").hide();

	// 选择优选赛、达标赛
	$("#selBisai input[type=radio]").click(function(){
		var $this = $(this);

		// 点击选择比赛，清空已选择的套餐，推广服务的已选项
		empty_tao();
		empty_fuwu();

		$("input[name=tctype]").removeAttr("checked");
		// $('input[name=tctype]:checked')

		// 如果点击的是达标赛显示份数
		if( $this.val() == 2 ){
			$('input[name=choice]').val('dabiao');
			// 判断达标赛份数
			$('#num_tao').blur(function() {
				filterCallBack(inputFileter($(this)));
			});
			type = 2;
			$(".fenshu").slideDown();
			$("#dabiao").show();
			$("#youxuan").hide();
		} else {
			$('input[name=choice]').val('youxuan');
			$('#num_tao').unbind();
			type = 1;
			$(".fenshu").slideUp();
			$("#dabiao").hide();
			$("#youxuan").show();
		}

		// 取消价格过滤
		$(".dropdown_fabu .dropdown_tit input[name=custom]").unbind();
	});

	// 选择四个套餐
	$(".fabu_taocan .btn").click(function(){

		var $this = $(this);

		$('input[name=setmeal]').val($(this).parent(".item").attr("rel"));

		var data_price = $(this).attr("data_price");   //选择套餐的价格

		// 点击套餐，清空推广服务的已选项
		var reset_check = $("#fuwuList").find(".icheck");
		hideCheck(reset_check);

		//根据选择套餐设置推广服务可勾选项
		// $('input[name=setmealdj]').val($(this).parent('.itemdd').index()+1);
		taocanSel($(this).parent('.item').index()+1);

		// 点击某个套餐，按钮变橙色
		$(".fabu_taocan .item").removeClass("select");
		$this.parent(".item").addClass("select");
		$(".fabu_taocan .btn").text("选择");
		$this.text("已选");

		// 当点击了四个套餐，自定义隐藏
		var sel_check = $(".dropdown_fabu").find(".icheck");
		var box = $(".dropdown_fabu").find(".dropdown_tit");
		hideCheck(sel_check);
		hideDropdown(box);


	});
	// 选择自定义
	$(".dropdown_fabu .dropdown_tit").click(function(){

		tctype = 2;
		var $this = $(this);
		var box = $(this).next(".dropdown_box").css("display");
		var icheck = $(this).find(".icheck");

		showCheck(icheck);

		if( box == 'none' ){
			showDropdown($this);
		} else{
			hideDropdown($this);
			$(".icheck ").removeClass('checked');
			$(".icheck i").removeClass('icon-ok-sign');
		}

		// 取消选择套餐
		$(".fabu_taocan .item").removeClass("select");
		$(".fabu_taocan .btn").text("选择");

		// 推广服务全部禁用
		empty_fuwu();

		// 过滤价格
		$(this).parent().find('input[name=custom]').blur(function() {
			filterCallBack(inputFileter($(this)));
		});

	});

	// 自定义最少价格
	var  minPrice = $(".fabu_taocan").find(".btn").eq(0).attr("data");
	$("#minPrice").text(minPrice);

	//合计勾选的费用
	$('#fuwuList .icheck').click(function(){
		var index = $(".fabu_taocan").find(".select").index();
		var sum = 0;
		$('#fuwuList input[type=checkbox]:checked').each(function(k, v){
			sum += parseInt($(v).val());
		});
		if( index == 1 || index == 2 ){
			$("#fuwuList_total").text('￥'+sum);
		}
	});

	// 提交
	$("#selType").click(function(){


		var $this = $(this);


		var data = {};

		data.id = $('input[name=id]').val();

		data.type = $('input[name=type]:checked').val();

		if (data.type == 2) {
			data.worsknum = $('input[name=worsknum]').val();
		} else if(data.type == 1) {

		} else {
			return errorTip('请选择竞赛类型');
		}

		data.tctype = $('input[name=tctype]:checked').val();
		if (data.tctype == 2) {
			$inputCustom 	=  $('#'+$('input[name=choice]').val()+' input[name=custom]');
			if (parseInt($inputCustom.attr('min')) > $inputCustom.val())
				return errorTip('自定义奖金必须大于'+$inputCustom.attr('min'));
			data.custom 	= $inputCustom.val();
		} else if (data.tctype == 1) {
			data.setmeal 	= $('input[name=setmeal]').val(); // 套餐id

			if (!data.setmeal)
				return errorTip('请选择竞赛套餐！！！');


		} else {
			return errorTip('请选择竞赛套餐！！！');
		}
		data.istop = data.ishighlight = data.ismedia = data.isletter = data.issecret = data.isensure = -1;
		data.istop 	= $('input[name=istop]').attr("checked")!=undefined ? 1 : -1;
		data.ishighlight = $('input[name=ishighlight]').attr("checked")!=undefined ? 1 : -1;
		data.ismedia 	= $('input[name=ismedia]').attr("checked")!=undefined  ? 1 : -1;
		data.isletter 	= $('input[name=isletter]').attr("checked")!=undefined ? 1 : -1;
		data.issecret 	= $('input[name=issecret]').attr("checked")!=undefined ? 1 : -1;
		data.isensure 	= $('input[name=isensure]').attr("checked")!=undefined ? 1 : -1;
		
		data.servicetype = $('input[name=servicetype]:checked').val();
		//console.log(data);
		// console.log($('input[name=ishighlight]').attr("checked"));
		 //return false;
		$.ajax({
			url: '/savevate',
			type: 'post',
			data: data,
			dataType: 'json',
			success: function(r) {
				$this.find(".loading").empty();
				$this.text("下一步");
				if ( r.stats=='error' )
				{
					globalTip({"msg":r.messages,"setTime":5});
				} else {
					window.location.href=r.messages;
					return false;
				}
			},
			beforeSend:function(){
				var loadinghtml = '<span class="loading spin"></span>';
				$this.text("").append(loadinghtml);
			}
		});













		// data {
		// 	type     	: $("#type").val(),		//类型：优选赛1、达标赛2
		// 	worsknum 	: //达标赛份数
		// 	tctype   	: tctype;	//1、系统套餐 2、自定义套餐
		// 	setmeal		: //系统套餐id
		// 	setmealdj	: rel; //套餐等级1、2、3、4
		// 	ishighlight	: //高亮
		// 	istop		: //置顶
		// 	ismedia		: //推广
		// 	isletter	: //站内推送
		// 	issecret	: //保密服务
		// 	isensure	: //保障服务
		// 	servicetype	: //服务费1、2种
		// 	total		: //总价
		// 	custom		: //自定义奖金
		// 	lowerprice	: //最低价钱
		// }

	});


	/**
	 * lxd 2016/1/11 start
	 */

	// 判断套数



	/**
	 * lxd 2016/1/11 end
	 */


	function filterCallBack(filter) {
		if (false !== filter) {
			isFilter = false;
			for (i=0, l=filter.length; i<l; i++) {
				filter[i].addClass('on');
			}
		} else {
			isFilter = true;
		}
	}






});


/**
 * 表单过滤
 * @param $obj
 * @returns {*}
 */
function inputFileter($obj) {
	$inputArr = [];
	$obj.each(function(index, input) {
		$input = $(input);
		inputValue = $input.val();
		if ((typeof($input.attr('max')) != 'undefined' && inputValue > parseInt($input.attr('max'))) || (typeof($input.attr('min')) != 'undefined' && inputValue < parseInt($input.attr('min'))) || (typeof($input.attr('maxlen')) != 'undefined' && inputValue.length > $input.attr('maxlen')) || (typeof($input.attr('minlen')) != 'undefined' && inputValue.length < $input.attr('min')))
			$inputArr.push($input);
		else
			$input.removeClass('on');

		if (typeof($input.attr('reg')) != 'undefined') {
			reg = new RegExp($input.attr('reg'), 'gis');
			if (null == inputValue.match(reg) && $inputArr.indexOf($input) != -1)
				$inputArr.pupsh($input);
			else
				$input.removeClass('on');
		}
	});
	if ($inputArr[0])
		return $inputArr;
	else
		return false;
}


// 清空
function empty_tao(){
	// 套餐已选按钮橙色去掉
	$(".fabu_taocan .item").removeClass("select");
	// 自定义奖金恢复默认
	var icheck = $(".dropdown_fabu").find(".icheck");
	var dropdown = $(".dropdown_fabu").find("dropdown_tit");
	hideCheck(icheck);
	hideDropdown(dropdown);
}
function empty_fuwu() {
	// 推广服务全部禁用
	var reset_check = $("#fuwuList").find(".icheck");
	var price = $("#fuwuList").find(".price");
	hideCheck(reset_check);

	reset_check.addClass("disabled");
	price.addClass("disabled");
	reset_check.find("input[type=checkbox]").attr("disabled",true);

	// 价格改回0
	$("#fuwuList_total").text("￥0");
}
// 选中check
function showCheck(obj){
	obj.addClass('checked');
	obj.find('input').attr('checked',true);
	obj.find('i').addClass('icon-ok-sign');
}
// 取消选中check
function hideCheck(obj){
	obj.removeClass('checked');
	obj.find('input').removeAttr('checked');
	obj.find('i').removeClass('icon-ok-sign');
}
// 显示
function showDropdown(obj){
	obj.find(".icon-down").addClass("on");
	obj.next(".dropdown_box").slideDown();
}
// 隐藏
function hideDropdown(obj){
	obj.find(".icon-down").removeClass("on");
	obj.next(".dropdown_box").slideUp();
}

// 根据选择套餐设置可勾选项 铜银金钻
function taocanSel(index){
	var allCheckBox = $("#fuwuList").find(".icheck");
	var allCheck = allCheckBox.find("input[type=checkbox]");
	var allprice = $("#fuwuList").find(".price");
	allCheckBox.removeClass("disabled");
	allCheck.removeAttr("disabled");
	allprice.removeClass("disabled");

	if ( index == 1 ) {
		allCheck.attr("disabled",true);
		allCheckBox.addClass("disabled");
		allprice.addClass("disabled");
		allprice.removeClass("line_through");
		$("#fuwuList_total").text("￥0");
	}
	if ( index == 2 ) {
		allCheck.eq(2).attr("disabled",true);
		allCheck.eq(3).attr("disabled",true);
		allCheckBox.eq(2).addClass("disabled");
		allCheckBox.eq(3).addClass("disabled");
		allprice.eq(2).addClass("disabled");
		allprice.eq(3).addClass("disabled");
		allprice.removeClass("line_through");
		$("#fuwuList_total").text("￥0");
	}
	if ( index == 3 ) {
		allprice.removeClass("line_through");
		$("#fuwuList_total").text("￥0");
	}
	if ( index == 4 ) {
		$("#fuwuList_total").text("赠送");
		allprice.addClass("line_through");
	}

}


