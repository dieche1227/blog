

$(function(){
	
	$(document).on('click','.choose_btn',function(){

		var $this 	= $(this);
		var selected= $this.parents("li").hasClass("sel");

		var id 	= $this.attr("data-id");
		var seque = $this.parents('.pos').find('.num').text();
		var alink = $this.parents('.pos').find('.cover').attr("href");
		var ilink = $this.parents('.pos').find('.cover').find('img').attr('src');
		var box = $("#wlistBox");
		
		var html= '<li class="pos"> <a href="'+alink+'" class="cover"> <img src="'+ilink+'"> <span class="num">'+seque+'</span> </a> <span class="wlist_choose choose_btn_del" data-id="'+id+'"><i class="icon-minus"></i></span> </li>';

		if( !selected ){
			var TrcgNum = $("#wlistBox").find("li").length;
			if ( TrcgNum>=lbig )
			{	// 不能大于最大选择数量
				return errorTip('最多可以'+lbig+'个备选！！！');
				return false;
			}
			
			$.ajax({
				url: '/checkrw',
				type: 'post',
				data: {'pid':id,'cid':$(".det_hd_info").attr('rel')},
				dataType: 'json',
				success: function(data) {
					if ( data.stats=='error' )
					{
						return errorTip(data.messages);
					} else
					{
						$this.parents("li").addClass("sel");
						$this.find("i").removeClass("icon-add").addClass("icon-ok-sign");
						box.append(html);
						$anum = $('.ischunm').text();
						$('.ischunm').text(parseInt($anum)+1);
					}
				}
			});
			
		} else {
			return false;
		}
		
	});

	$(document).on('click','.choose_btn_del',function(){
		var $this 	= $(this);
		var delId = $(this).attr("data-id");
		$.ajax({
			url: '/checkrwminus',
			type: 'post',
			data: {'pid':delId,'cid':$(".det_hd_info").attr('rel')},
			dataType: 'json',
			success: function(data) {
				if ( data.stats=='error' )
				{
					return errorTip(data.messages);
				} else
				{
					$this.parents("li").remove();
	   				$('.choose_btn[data-id='+delId+']').parents('li').removeClass("sel");
	   				$('.choose_btn[data-id='+delId+']').find("i").removeClass("icon-ok-sign").addClass("icon-add");
	   				$anum = $('.ischunm').text();
					$('.ischunm').text(parseInt($anum)-1);
				}
			}
		});
		
	});


	$(document).on('click','.submit_works',function(){
		var TrcgNum = $("#wlistBox").find("li").length;
		if ( lnow>=2 )
		{// 如果报名作品超过2个
			if ( TrcgNum<2 )
			{// 如果选择备选少于2个
				return errorTip('抱歉请您选择至少两个作品作为备选入围作品！！！');
			}
		} else {
			if ( !TrcgNum )
			{// 如果不为真的话提示选择入围作品！！！
				return errorTip('抱歉请您选择作品作为备选入围作品！！！');
			}
		}

		// 获取弹框id
		var modalBox = '#modal_ruwei';
		var modalBoxPos = $(modalBox).find(".modal_effect");
		// 显示弹框
		modal(modalBox,modalBoxPos);
		
	});

	$(document).on('click','.submit_works_y',function(){

		var thiscont = $(".det_hd_info").attr('rel');

		$.ajax({
			url: '/cutoutcx',
			type: 'post',
			data: {'cid':$(".det_hd_info").attr('rel')},
			dataType: 'json',
			success: function(data) {
				if ( data.stats=='error' )
				{
					return errorTip(data.messages);
				} else 
				{	
					window.location.href = 'http://js.ui.cn/supervise?id='+thiscont+'&pl=part';
				}
				
			}
		});

	})
});