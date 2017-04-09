

	// 获取城市
	$('.getcity').click(function(){
		
		var $this = $(this);
			marking = $this.attr('rel');
		if ( citys[marking]==undefined )
		{
			$.ajax({
				type:'post',
				url:'/cget',
				data:{'id':marking},
				success:function(msg){
					
					if ( msg.stats=='error' )
					{
						return errorTip('非法请求！！！');
					} else
					{
						var data = msg.data;
						citys[marking] = msg.data;
						$('.citywoll').empty();
						$('.cityspan').empty().append(data[0]['name']);
						$('input[name=city]').val(data[0]['id']);

						for(var i in data){
							$('.citywoll').append('<li><a href="javascript:;" rel="'+data[i]['id']+'">'+data[i]['name']+'</a></li>');
							
						}

						$(".sel_option a").click(function(){
					        var rel = $(this).attr("rel");
					        var list = $(this).parents(".sel_option");
					        var titVal = $(this).text();

					        list.find('li').removeClass("on");
					        
					        $(this).parent("li").addClass("on");
					        
					        list.parent(".sel_box").find("span").text(titVal);
					        list.parent(".sel_box").find("input").val(rel);
					        list.slideUp();
					    })

					}

				},
				error:function(){
					
				}
			});
		} else{
			// 如果页面中的变量有就从变量里面获取
			data = citys[marking];
			$('.citywoll').empty();
			$('.cityspan').empty().append(data[0]['name']);
			$('input[name=city]').val(data[0]['id']);
			for(var i in data){
				$('.citywoll').append('<li><a href="javascript:;" rel="'+data[i]['id']+'">'+data[i]['name']+'</a></li>');
			}

			$(".sel_option a").click(function(){
		        var rel = $(this).attr("rel");
		        var list = $(this).parents(".sel_option");
		        var titVal = $(this).text();

		        list.find('li').removeClass("on");
		        
		        $(this).parent("li").addClass("on");
		        
		        list.parent(".sel_box").find("span").text(titVal);
		        list.parent(".sel_box").find("input").val(rel);
		        list.slideUp();
		    })
		}

	})

	// 提交
	$('.determine').click(function(){
		var $this = $(this);
		$.ajax({
			type:'post',
			url :'/confirm',
			data:$('#method').serialize(),
			dataType:'json',
			success:function(msg){
				console.log(msg);
				globalTip({"msg":msg.messages,"setTime":5});
			},
			error:function(){
				errorTip('请求错误请重试！！！');
			}
		});
	})
	
	// 取消
	$('.user_info_cancel').click(function(){

		window.location.reload();
	
	})

	