$(function(){
		
		var validate = function(name, is_void, is_type, is_length, is_num, length_gw, num_size, error_void, error_len, error_num)
		{
			// name为必填项。
			// is_void  	是否必填 （可选值1、2）。
			// is_length 	是否判断长短 （可选值1、2），为1时必须验证长度，name存在值时必须更具length_gw判断长度
			// is_num		是否判断数字
			// length_gw	字符长短
			// num_size		数字最小值
			if ( is_type=='val' )
			{
				var Iname = $("input[name="+name+"]").val();
			} else {
				var Iname = $("textarea[name="+name+"]").val();

			}
			
			
			if ( Iname=='' && is_void==1 )
			{
				globalTip({"msg":error_void,"setTime":5});
				$("input[name="+name+"]").focus();
				return false;
			} else
			{
				if ( Iname!='' && is_void==1 )
				{
					if ( is_length==1 )
					{
						var newstro    = length_gw.split('-'),
						    oritreleno = Iname.length;

						if ( oritreleno < newstro[0] || oritreleno > newstro[1] )
						{
							globalTip({"msg":error_len,"setTime":5});
							$("input[name="+name+"]").focus();
							return false;
						}
					}
					
					if ( is_num==1 )
					{
						var numbero = /^[1-9][0-9]*$/;
						if ( !numbero.test(Iname) ) 
						{
							globalTip({"msg":error_num,"setTime":5});
							$("input[name="+name+"]").focus();
							return false;
						}
						if ( Iname < 1 )
						{
							globalTip({"msg":error_num,"setTime":5});
							$("input[name="+name+"]").focus();
							return false;
						}
					}
					return true;

				}

				if ( Iname=='' && is_void==2 )
				{
					return true;
				}
				if ( Iname!='' && is_void==2 )
				{
					if ( is_length==1 )
					{
						var newstrt    = length_gw.split('-'),
						    oritrelent = Iname.length;
						if ( oritrelent < newstrt[0] || oritrelent > newstrt[1] )
						{
							globalTip({"msg":error_len,"setTime":5});
							$("input[name="+name+"]").focus();
							return false;
						}
					}
					if ( is_num==1 )
					{
						var numbert = /^[1-9]*$/;
						if ( !numbert.test(Iname) ) 
						{
							globalTip({"msg":error_num,"setTime":5});
							$("input[name="+name+"]").focus();
							return false;
						}
						if ( Iname < 1 )
						{
							globalTip({"msg":error_num,"setTime":5});
							$("input[name="+name+"]").focus();
							return false;
						}
					}
					return true;
				}
			}

			
			
		}

		$(document).on('click','#nextStep1',function(){

			var $this = $(this);
			var loadinghtml = '<span class="loading spin"></span>';
			$this.text("").append(loadinghtml);

			// 判断竞赛标题
			tit = validate('title', 1, 'val', 1, 2, '5-20', 2, '请输入5-20个字符的标题', '请输入5-20个字符的标题');
			if ( !tit )
			{	
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			// 判断应用行业
			// profe = validate('professionid',1,2,2,2,2,'请选择应用行业','请选择应用行业');
			// if ( !profe )
			// {
				
			// }
			professionval = $("input[name=professionid]").val();
			if ( professionval<1 )
			{
				globalTip({"msg":'请选择应用行业',"setTime":5});
				$("input[name=professionid]").focus();
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			// 需求简介和设计目标
			intr = validate('intro',1,'text',1,2,'10-200',2,'需求简介和设计目标请输入10-200个字符','需求简介和设计目标请输入10-200个字符');
			if ( !intr )
			{
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			// 目标人群及使用场景
			scen = validate('scene',2,'val',1,2,'0-50',2,'请在目标人群及使用场景输入最多50个字符','请在目标人群及使用场景输入最多50个字符');
			if ( !scen )
			{
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			// 背景资料 
			backf = validate('background',2,'text',1,2,'0-300',2,'请在背景资料输入最多300个字符','请在背景资料输入最多300个字符,当前为:'+$('textarea[name=background]').val().length+'个字');
			if ( !backf )
			{
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			// 设计数量要求
			desne = validate('desneeds',1,'val',2,1,2,2,'请输入不为0的数字','请输入不为0的数字','请输入不为0的数字');
			if ( !desne )
			{
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			// 设计内容要求
			conte = validate('contentneeds',1,'text',1,2,'10-500',2,'请输入10-500个字符的设计内容要求','请输入10-500个字符的设计内容要求');
			if ( !conte )
			{
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}

			// 最终交付设计作品格式要求 
			format = validate('formatneeds',1,'val',1,2,'2-20',2,'请输入2-20个字符的设计作品格式要求','请输入2-20个字符的设计作品格式要求');
			if ( !format )
			{
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			// 您有可供设计师参考的网站链接吗？
			//链接地址
			var link = /^http:\/\//; 
			if( $.trim($("input[name=referlink]").val()).length != 0 ) {
				if( !link.test($("input[name=referlink]").val()) ) {
					globalTip({"msg":"请输入http://格式","setTime":5});
					$("input[name=referlink]").focus();
					$this.find(".icon-loading").empty();
					$this.text("下一步");
					return false;
				}
			}
			// 上传文件标题框
			// .upfileShow
			// var upfileShow = $("#fabuUpfile").find(".upfile_show").length;
			// if ( upfileShow ) {
			// 	attac = validate('attachfile',1,'val',1,2,'2-10',2,'请在附件名称输入2-10个字符','请在附件名称输入2-10个字符');
				
			// 	if ( !attac )
			// 	{
			// 		$this.find(".icon-loading").empty();
			// 		$this.text("下一步");
			// 		return false;
			// 	}
			// } 
			
			// 您还有什么其他想法传达给设计师
			othew = validate('other',2,'text',1,2,'0-300',2,'请在请在其他想法中输入0-300个字符','请在请在其他想法中输入0-300个字符');
			if ( !othew )
			{
				$this.find(".icon-loading").empty();
				$this.text("下一步");
				return false;
			}
			var data = {

					id 			 : $("input[name=id]").val(),				// id
					title    	 : $("input[name=title]").val(),			//※1、竞赛标题
					professionid : $("input[name=professionid]").val(),		//※2、应用行业
					intro		 : $("textarea[name=intro]").val(),	 		//3、需求简介和设计目标
					scene		 : $("input[name=scene]").val(),			//4、目标人群及使用场景
					background	 : $("textarea[name=background]").val(),	//5、背景资料
					desneeds	 : $("input[name=desneeds]").val(),			//※6、设计数量要求
					contentneeds : $("textarea[name=contentneeds]").val(),	//※7、设计内容要求
					formatneeds	 : $("input[name=formatneeds]").val(),		//※8、最终交付设计作品格式要求
					referlink	 : $("input[name=referlink]").val(),		//9、您有可供设计师参考的网站链接吗？
					// attachfile	 : $("input[name=attachfile]").val(),		//10、上传附件标题
					other		 : $("textarea[name=other]").val()			//11、您还有什么其他想法传达给设计师？

				}

				$.ajax({

					url		: "/oscontest",
					type	: "post",
					data	: data,
					dataType: "json",

					success: function(data){
						if ( data.stats=='error' )
						{
							globalTip({"msg":data.messages,"setTime":5});
							$this.find(".icon-loading").empty();
							$this.text("下一步");
							return false;
						}else
						{
							$this.find(".icon-loading").empty();
							$this.text("下一步");
							window.location.href=data.messages;
							return false;
						}
						console.log(data);
					},
					error	: function(){

					}

				});

		});
			

});