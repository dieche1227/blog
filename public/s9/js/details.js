$(function(){
	// 改稿
	// 
	// 选项卡
	var tabNav = $(".stab_bar li");
	var showIndex = $(".stab_bar li.on").index();
	
	$(".stab_menu .item").eq(showIndex).show();


	tabNav.click(function(){
		var isclick = $(this).hasClass("disabled");
		if ( !isclick ) {
			var index = $(this).index();
			tabNav.removeClass("on");
			$(this).addClass("on");
			$(".stab_menu .item").hide();
			$(".stab_menu .item").eq(index).show();
		} else {
			return false;
		}
		
	});
	// 获得焦点显示提示信息（按ENTER提交）
/*	$(".modify_area").focus(function(){
		$(this).next(".tip").show();
	});
	$(".modify_area").blur(function(){
		$(this).next(".tip").hide();
	});
*/
	var com_id;
	// 点击enter提交输入内容
	$(document).on('keydown','.modify_area',function(event){
		var $this = $(this);
		if($.trim($this.val()).length <=0){
			return false;
			errorTip('请输入内容');
		}

		if(event.keyCode == 13) {
			add_submit();
			var cont = $this.val();
			$this.parents(".item").find('.idea_list').show().append('<li>'+cont+'<i class="icon-error-thin" rel='+com_id+'></i></li>');
			$this.val("");
			return false;
		}
	});
	// 删除
	$(document).on("click",".icon-error-thin",function(){
		var b=$(this).parent().parent(".idea_list");
		var n=$(this).parent("li").parent(".idea_list").children("li").length;
		demand_del($(this).parent("li"),$(this).attr('rel'));
		if(n==1){
			b.hide();
		}
	});

	add_submit = function(){
		$.ajaxSetup({ async: false});
		$.post('revising',$('#contentform').serialize(),function(msg){
				if(msg.stats){
					com_id = msg.id;
				}else{
					errorTip('提交失败');
					return false;
				}
		},'json')
	}

	demand_del = function(ob,id){
		__data.id = id;
		$.post('demand_del',__data,function(msg){
				if(!msg.stats){
					globalTip(msg);
					return false;
				}else{
					ob.remove();
				}

		},'json')
	}
});