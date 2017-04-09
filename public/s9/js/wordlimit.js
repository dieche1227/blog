(function($){
$.extend({
wordCount: function (options) {
	var defaults = {
		'textarea':'.det_comment_area',
		'msg':'.comment_warn',
		'max':500,
	};

	var opts = $.extend ( {}, defaults, options );

	$textarea = $(opts.textarea);
	$msg      = $(opts.msg);    

	// 详情页评论输入字数限制
	



	$(document).on('focus',$textarea,function(){
		var insertArea = $(this);
		
	 	var insertRemind = $(this).next('.comment_warn');
	 	//var insertRemind = insertArea.nextAll('.comment_warn');
	 	         //输入框   限制字数   提醒框
	 	wordLimit(insertArea,opts.max,insertRemind);
	});

	// $textarea.on('focus',function() {
	//  	var insertArea = $(this);

	//  	//var insertRemind = $msg;

	//  	var insertRemind = insertArea.nextAll('.comment_warn');
	//  	         //输入框   限制字数   提醒框
	//  	wordLimit(insertArea,opts.max,insertRemind);
	// });



 	wordLimit = function(obj,num,chg){
 		
 		$(document).on('keyup',obj,function(){
 			console.log(obj);
 			var content = obj.val();
 			// console.log(chg.text());
 			// console.log(obj.val().length);
 			// console.log(num);

				if(obj.val().length > num){
					obj.val(obj.val().substr(0, num));
				}else{
					chg.find("strong").text(num - obj.val().length);
				}


 		});



 		// obj.on('keyup',function(){
 		// 	var content = obj.val();
			// 	if(obj.val().length > num){
			// 		obj.val(obj.val().substr(0, num));
			// 	}else{
			// 		chg.find("strong").text(num - obj.val().length);
			// 	}
 		// });


 		// obj.keyup(function(){
 		// 	var content = obj.val();
			// 	if(obj.val().length > num){
			// 		obj.val(obj.val().substr(0, num));
			// 	}else{
			// 		chg.find("strong").text(num - obj.val().length);
			// 	}
 		// });
 		if(obj.val().length >= 1 && obj.val().length <=num){
 			chg.find("strong").text(num - obj.val().length);
 		}
 	};

 	wordLimit($(opts.textarea),opts.max,$msg);
}
})
})(jQuery);