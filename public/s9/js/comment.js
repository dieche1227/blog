$(document).ready(function(){
	 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


	 var state = true;
	 var touid,pid='';

	 var replyform  ='<div class="det_comment_form pos cl" style="display:none;">';
      	 replyform  += '<form action="">';
      	 replyform +=   '<textarea name="" class="control_input det_comment_area" replyform></textarea>';
       	 replyform +=   '<p class="comment_warn" >还可以输入<strong class="txt_orange">500</strong>个字</p>';
       	replyform +=   '<div class="mtw mbv cl">';
       	replyform +=   		'<a href="#" class="btn btn_orange y jspublish">发表留言</a>';
        replyform +=   		'<p class="tip y">Ctrl+Enter</p>';
       	replyform +=   '</div>';
       	replyform  += '</form>';
       	replyform +='</div>';

	// 点击展开隐藏评论下的回复框
	$(document).on('click','.det_reply_btn',function(){
		var $this = $(this);
		var box= $this.next(".det_comment_form");
		var tmp = box.length;
		if(tmp==0){
			$this.after(replyform);
		}
	    box= $this.next(".det_comment_form");
		var boxState = box.css("display");
		if ( boxState == "none" ){
			$this.addClass("on");
			box.slideDown();
			box.find(".det_comment_area").focus();
			$("html,body").animate({scrollTop:$this.offset().top+30},1000);
			//赋值传输
			touid = $(this).attr('touid');
	        pid = $(this).attr('pid');
	        box.find('.jspublish').attr('touid',touid);
	        box.find('.jspublish').attr('pid',pid);

	        $.wordCount({'textarea':'[replyform]','msg':'.comment_warn',
		'max':500});

		} else {
			box.slideUp();
			$this.removeClass("on");
		}	
	});

	    //评论按钮点击
	    $(document).on('keydown','textarea',function(event){
	        if (event.ctrlKey && event.keyCode == 13)  {      
	            comment($(this));  
	            return false;
	        }
	    });

	    //评论按钮点击
	    $(document).on('click','.jspublish',function(){
	        var duixiang=$(this).closest('form').find('textarea');
	         	comment(duixiang);
	         	return false;
	    });
	    
	    function yanzheng(obj){
	     $('.verifycode').attr('src','/code?'+Math.random());   
	    }
	    function comment(obj){
	       if(!state){return false;}
	       	state = false;
	        newContent = obj.val();
	        
	        if($.trim(newContent) == '' || $.trim(newContent).length <=0){
	             globalTip({'msg':'内容不为空','Time':3});
	             return false;
	         }

	        touid = obj.closest('.det_comment_form').find('.jspublish').attr('touid');
	        
	        pid = obj.closest('.det_comment_form').find('.jspublish').attr('pid');
	        
	        data = {
	           loginuid : loginuid,//登陆用户ID
	          	content : newContent,//去掉空格后的评论内容
	          	  obid  : obid,//竞赛ID
	    		  touid : touid,//回复的是谁，如果直接留言则为空
	    			pid : pid,//回复的是哪条评论，如果直接留言则为空
	        };
	        //LOADING效果
	        var loadinghtml = '<span class="loading spin"></span>';
	        obj.closest('form').find('.jspublish').text('').append(loadinghtml);
	       
	        $.ajax({
	            type:'post',
	            url:'/addComment',
	            data:data,
	            dataType:'json',
	            success:function(msg){
	                globalTip(msg);
	                if(msg.stats=='success'){
	                    obj.val('');
	                    $('.det_comment_main').prepend(msg.html);
	                    state =true;
	                }
	                // if(msg.verify){
	                //     $('.verify').removeClass('hide');
	                //     verify = true;
	                // }
	                obj.closest('form').find('.loading').remove();
	                obj.closest('form').find('.jspublish').text('发表留言');
	                state =true;

	                if(pid){
	                	obj.closest('.det_comment_form').remove();
	                }
	                obj.closest('form').find('.txt_orange').text('500');
	               
	            },error:function(){
	                alert('错误');
	                obj.closest('form').find('.loading').remove();
	                obj.closest('form').find('.jspublish').text('发表留言');
	                state =true;
	            }
	    	});
	        
	    }
	 
	    //reply//meiyong
	    // $(document).on('click','button[class*=reply]',function(){
	    //     ob = $(this);
	    //     data = {
	    //       uid :  uid,
	    //       commentid : commentid,
	    //       coment : ob.parents('form').find('textarea').val(),
	    //       obid  :obid,
	    //       commenttype: commenttype,
	    //     }

	    //     if(verify){
	    //         replycode = $.trim(ob.prev().val());
	    //         if(replycode.length != 4){
	    //             alert('请输入验证码');
	    //             ob.prev().focus();
	    //             return false;
	    //         }
	    //         data.code=replycode
	    //     }

	    //     $.ajax({
	    //         type:'post',
	    //         url:'/reply',
	    //         data:data,
	    //         dataType:'json',
	    //         success:function(msg){
	    //             msg.time=5;
	    //                 globalTip(msg);
	    //                 if(msg.state){
	    //                     $('.comment-inner').prepend(msg.html);
	    //                     ob.parents('form').hide();
	    //                 }else{
	    //                     $('.comment-form textarea').focus();
	    //                 }
	    //                 if(msg.verify){
	    //                     ob.parents('.comment-cont').find('.comment-code').removeClass('hide');
	    //                     ob.parents('.comment-cont').find('.comment-code-input').removeClass('hide');
	    //                     verify = msg.verify;
	    //                 }
	    //                 $('.verifycode').trigger('click');
	    //         },
	    //         error:function(){
	    //         	alert('请求失败');
	    //         }
	    //     });
	    //     return false;
	    // });

	  
 });
	   
	   
	    
	    
	  


	    
