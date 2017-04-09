
$(function(){
	//选择下拉框
	$(".sel_box").click(function(){
	    var $this = $(this);
	    $this.blur();
	    var o = $this.find('.sel_option').css('display');
	    if( o == 'none' ){
	        $this.find(".sel_option").slideDown();
	    }else{
	        $this.find(".sel_option").slideUp();
	    }

	    // 选中项对应在下拉列表中间
	    obj = $('#'+$this.attr('id'));
	        ob = obj.find('.sel_option');
	        if ( obj.find('ol li').hasClass('on') ) {
	        	if(obj.find('ol li[class=on]').length > 0){
	        	    ob.scrollTop(ob.scrollTop() + obj.find('ol li[class=on]').position().top);
	        	}
	        }
	        

	    /*点击任何地方关闭层*/
	    $(document).click(function(event){
	        var tar = $(event.target).attr("class");
	        if( tar != $this ){
	            $this.find(".sel_option").slideUp();
	        }
	    });
	    return false;
	});



	$(".sel_option a").click(function(){
		//var rel = $(this).attr("rel");
		var list = $(this).parents(".sel_option");
		var titVal = $(this).text();


		$(".sel_option a").parent("li").removeClass("on");
		$(this).parent("li").addClass("on");
		
		list.parent(".sel_box").find(".sel_val_tit").text(titVal);
		list.parent(".sel_box").find("input").val(titVal);
		list.slideUp();

	});

	// 复选框
	$(".icheck input").click(function(){
		var $this = $(this);
		if ( $this.parent().hasClass("disabled") ){

			// return false;

		} else {

			if( $this.parent().hasClass("checked") ){
				$this.parent().removeClass('checked');
				$this.removeAttr('checked');
				$this.siblings('i').removeClass('icon-ok-sign');
				
			} else{
				$this.parent().addClass('checked');
				$this.attr('checked',true);
				$this.siblings('i').addClass('icon-ok-sign');
			}
			
		}
		

	});

	// 下拉显示
	// $(".dropdown_tit").click(function(){
	// 	var $this = $(this);
	// 	var box = $(this).next(".dropdown_box").css("display");
		
	// 	if( box == 'none' ){
	// 		$this.find(".icon-down").addClass("on");
	// 		$this.next(".dropdown_box").slideDown();
	// 	} else{
	// 		$this.find(".icon-down").removeClass("on");
	// 		$this.next(".dropdown_box").slideUp();
	// 	}
	// });
});
