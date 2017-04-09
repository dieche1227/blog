$(function(){
	// 点击列举，显示填写框
	$(".origin_box").hide();  //默认隐藏
	$(".origin_btn").click(function(){
		var $this = $(this);
		var checkedVal = $(this).find("input[name='sel']").val();
		var box = $(".origin_box");

		if( checkedVal == 1 ) {
			box.slideDown();
		} else {
			box.slideUp();
		}
	
	});

	// 添加
	$(document).on('click','#addEle',function(){
		var eleVal = $("input[name=element]").val();
		var contVal = $("input[name=analysis]").val();
		var pid = $("input[name=id]").val();
		var cid = $("input[name=croid]").val();

		if ( $.trim(eleVal) && $.trim(contVal) ) {

			$.ajax({
			url: '/addelement',
			type: 'post',
			data: {
				ele  : eleVal,
				anal : contVal,
				pid  : pid,
				cid  : cid,
			},
			dataType: 'json',
			success: function(r) {
				
				globalTip({"msg":r.messages,"setTime":5});
				console.log(r);
				if(r.stats=='success'){
					var addItem = '<div class="origin_item cl"> <p class="ele txt_half"> '+eleVal+' </p> <p class="cont txt_half"> '+contVal+' </p> <a href="javascript:;" class="remove" rel="'+r.id+'">删除</a> </div>'
						$("#addBox").before(addItem);
						$("input[name=element]").val("");
						$("input[name=analysis]").val("");
					}
				}
			});
		

			
		} else {
			globalTip({"msg":"内容不能为空","setTime":5});
			return false;
		}


		
	});
	// 删除
	$(document).on('click','.origin_item .remove',function(){
		
		var id = $(this).attr('rel');
		var cid = $("input[name=croid]").val();
		var pid = $("input[name=id]").val();
		var $this = $(this);
		$.ajax({
			url: '/delelement',
			type: 'post',
			data: {
				id  : id,
				cid : cid,
				pid : pid,
			},
			dataType: 'json',
			success: function(r) {
				
				globalTip({"msg":r.messages,"setTime":5});
				console.log(r);
				if(r.stats=='success'){
					$this.parent(".origin_item").remove();
					}
				}
			});

		


	})

	// 上传列表鼠标经过
	$(document).on('mouseenter', '.up-thumb-item', function(){
	   $(this).find('.thumb-oper')
	       .stop()
	       .animate({
	           'bottom'	:	0
	       },200);
	});
	$(document).on('mouseleave', '.up-thumb-item', function(){
	   $(this).find('.thumb-oper')
	       .stop()
	       .animate({
	           'bottom'	:	-80
	       },150);
	});

	// var cstat = true;

	$("#upWork").click(function(){
		// if ( !cstat )
		// {
		// 	globalTip({"msg":"请勿重复点击，谢谢！！！","setTime":5});
		// 	return false;
		// }

		// cstat = false;
		// 封面
		// coverfile == false 未上传封面
		if ( !coverfile ) {
			globalTip({"msg":"请上传封面","setTime":5});
			return false;
		}
		// 作品
		var upWorks = $("#queue").find(".up-thumb-item").length;
		
		if ( !upWorks ) {
			globalTip({"msg":"请上传至少一个作品","setTime":5});
			return false;
		}
		// 法律信息
		var originList = $("input[name=sel]:checked").val();
		if( originList == 1 ) {
			var originItem = $(".origin_item").length;
			if( !originItem ) {
				globalTip({"msg":"请至少列举一项","setTime":5});
				return false;
			}
		}

		// 勾选我的作品显示人类
		var gxman = $("input[name=isagree]").attr("checked");
		if ( !gxman )
		{
			globalTip({"msg":"请勾选我的作品显示人类（包括小孩），我已获得书面同意（或能够获得）","setTime":5});
			return false;
		}
		
		// 协议
		var xieyi = $("input[name=isoriginal]").attr("checked");
		if ( !xieyi ) {
			globalTip({"msg":"请勾选原创版权保障协议","setTime":5});
			return false;
		}

		var data = {
			theme		: $("input[name=theme]").val(),
			intro		: $("textarea[name=intro]").val(),
			sel			: $("input[name=sel]:checked").val(),
			isagree		: $("input[name=isagree]").is(":checked"),
			isoriginal	: $("input[name=isoriginal]").is(":checked"),
			pid			: $("input[name=id]").val(),
			cid 		: $("input[name=croid]").val(),
			title		: $("input[name=title]").val()
		}
		
		$.ajax({
			url		: "/perfect",
			type	: "post",
			data	: data,
			datatype: "json",
			success	: function(data){
				console.log(data);
				if ( data.stats=='error' )
				{
					globalTip({"msg":"上传失败！！！","setTime":5});
				} else
				{
					globalTip({"msg":"上传成功","setTime":5});
					cstat = true;
					location.href = data.src;
				}
			},
			error	: function(data){
				
			}
		});

		
	});
});