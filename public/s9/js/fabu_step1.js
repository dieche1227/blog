$(function(){

	var title    	= $("input[name=title]"),			//※1、竞赛标题
		professionid= $("input[name=professionid]"),	//※2、应用行业
		intro		= $("textarea[name=intro]"),	 	//3、需求简介和设计目标
		scene		= $("input[name=scene]"),			//4、目标人群及使用场景
		background	= $("textarea[name=background]"),	//5、背景资料
		desneeds	= $("input[name=desneeds]"),		//※6、设计数量要求
		contentneeds= $("textarea[name=contentneeds]"),	//※7、设计内容要求
		formatneeds	= $("input[name=formatneeds]"),		//※8、最终交付设计作品格式要求
		referlink	= $("input[name=referlink]"),		//9、您有可供设计师参考的网站链接吗？
		// attachfile	= $("input[name=attachfile]"),		//10、上传附件标题
		other		= $("textarea[name=other]");		//11、您还有什么其他想法传达给设计师？

		// 数字
		var number = /^[1-9][0-9]*$/;
		//链接地址
		var link = /(http|ftp|https):\/\/([\w.]+\/?)\S*/;

		//※1、竞赛标题
		/*title.blur(function(){
			if( $.trim(title.val()).length < 5 || $.trim(title.val()).length > 20 ) {
				globalTip({"msg":"请输入5-20个字符","setTime":5});
				title.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}
		});*/
		//3、需求简介和设计目标
		/*intro.blur(function(){
			if( $.trim(intro.val()).length < 10 || $.trim(intro.val()).length > 300) {
				globalTip({"msg":"请输入10-200个字符","setTime":5});
				intro.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}

		});*/
		//4、目标人群及使用场景
		/*scene.blur(function(){
			if( $.trim(scene.val()).length > 50 ) {
				globalTip({"msg":"请输入最多50个字符","setTime":5});
				scene.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}

		});*/
		//5、背景资料
		/*background.blur(function(){
			if( $.trim(background.val()).length > 300 ) {
				
				globalTip({"msg":"请输入最多300个字符","setTime":5});
				background.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}

		});*/

		//※6、设计数量要求
		desneeds.blur(function(){
			if( !number.test(desneeds.val()) ) {
				globalTip({"msg":"请输入不为0的数字","setTime":5});
				desneeds.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}
		});
		//※7、设计内容要求
		/*contentneeds.blur(function(){
			if( $.trim(contentneeds.val()).length < 10 || $.trim(contentneeds.val()).length > 500 ) {
				globalTip({"msg":"请输入10-500个字符","setTime":5});
				contentneeds.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}
		});*/
		//※8、最终交付设计作品格式要求
		/*formatneeds.blur(function(){
			if( $.trim(formatneeds.val()).length < 2 || $.trim(formatneeds.val()).length > 20 ) {
				globalTip({"msg":"请输入2-20个字符","setTime":5});
				formatneeds.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}
		});*/

		//9、您有可供设计师参考的网站链接吗？
		referlink.blur(function(){
			if( $.trim(referlink.val()).length != 0 ) {
				if( !link.test(referlink.val()) ) {
					globalTip({"msg":"请输入http://格式","setTime":5});
					referlink.addClass("error");
					return false;
				} else {
					$(this).removeClass("error");
				}
			}
			
		});
		//10、上传附件标题
		// attachfile.blur(function(){
		// 	if( $.trim(attachfile.val()).length == 0 ) {
		// 		globalTip({"msg":"请输入附件标题","setTime":5});
		// 		attachfile.addClass("error");
		// 		return false;
		// 	} else {
		// 		$(this).removeClass("error");
		// 	}
		// 	if( $.trim(attachfile.val()).length < 2 || $.trim(attachfile.val()).length > 10 ){
		// 		globalTip({"msg":"请输入2-10个字符","setTime":5});
		// 		attachfile.addClass("error");
		// 		return false;
		// 	} else {
		// 		$(this).removeClass("error");
		// 	}
		// 	if( !file.test(attachfile.val()) ) {
		// 		globalTip({"msg":"文件名称不能包括“.”","setTime":5});
		// 		return false;
		// 	} else {
		// 		$(this).removeClass("error");
		// 	}
		// });

		//11、您还有什么其他想法传达给设计师？
		/*other.blur(function(){
			if( $.trim(other.val()).length > 300 ) {
				globalTip({"msg":"请输入最多300个字符","setTime":5});
				other.addClass("error");
				return false;
			} else {
				$(this).removeClass("error");
			}
		});*/


});