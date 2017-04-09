
	function update_file_progress(id) {
	    var progressHtml;
	        progressHtml = '<li id="uploadFile'+id+'" class="up-thumb-item up-thumb-add up-thumb-bar"><div class="bar-border"><p class="bar-cont"></p></div></li>';
	        $('#picfile').before(progressHtml);
	}
		    
    function upload_full_show(id, data){
        // 文件上传进度
        if ( data.stats=='success') {
        	ob = $('#uploadFile'+id);
           	ob.find('.bar-cont').width('100%');
			ob.html('');
            ob.html = $('<img style="width:280px;height:210px" src="'+data.links+'" alt=""><div class="thumb-oper" rel="'+data.picid+'"><a class="set cov" href="javascript:;"><i class="icon-pic-round"></i><span class="">封面</span></a><a class="set del" href="javascript:;"><i class="icon-error-thin"></i><span id="up_del" class="">删除</span></a></div>').appendTo(ob).show();
           	ob.removeClass('up-thumb-add up-thumb-bar');
        }
    }
	
	$(function(){
		// 上传作品
		    $('#picupload').dmUploader({
		        url:'/jectfile',
		        dataType	: 'json',
		        fileName	: 'project',
		        extFilter 	: 'jpg;png;gif;jpeg',
		        maxFileSize : 10485760,  //10M
		        extraData	: {'prcdi':$('input[name=id]').val()},
		        onNewFile: function(id, file){
		         	update_file_progress(id);
		        }, 
		        onFileSizeError : function(file){
		            alert('文件:"'+file.name+'" 超过10M规定大小');
		        },
		        onFileExtError:function(file){
		        	alert('文件:"'+file.name+'" 类型错误,请重新上传');
		        },
		        onUploadProgress: function(id, percent){
		            var percentStr = percent + '%';
		            $('#uploadFile'+id).find('.bar-cont').width(percentStr);
		        },
		        onUploadSuccess: function(id, data){
		        	console.log(data);

		        	if(data.stats=='error'){
		        		globalTip({"msg":data.messages,"setTime":5});
		        		$('#uploadFile'+id).remove();
		        		return false;
		        	}else{
		        		upload_full_show(id, data);
		        	}
		        },
		        onUploadError:function(id, message){
		        	alert('上传请求失败');
		        	$('#uploadFile'+id).remove();
		        }
		    });

		// 上传封面
		    $('#fontcover').dmUploader({
		    	url:'/coverfile',
		    	fileName:'coverfile',
		    	dataType: 'json',
		        extFilter : 'jpg;png;gif;jpeg',
		        maxFileSize : 10485760,
		        extraData:{'prcdi':$('input[name=id]').val()},
		    	onBeforeUpload:function(file){
		    		this.find('.up-cover-btn').text('正在上传封面');
		    	},
		    	onFileSizeError : function(file){
		            alert('封面文件:"'+file.name+'" 超过规定大小10M');
		        },
		         onFileExtError:function(file){
		        	alert('文件:"'+file.name+'" 类型错误,请重新上传');
		        },
		    	onUploadProgress: function(id, percent){
		    		var percentStr = percent + '%';
		            this.find('.up-cover-bar').width(percentStr);
		        },
		        onComplete: function(){
		      		this.find('.up-cover-bar').width(0);
		      	},
		        onUploadSuccess: function(id, data){
		        	
		        	if ( data.stats=='error' )
		        	{	
		        		globalTip({"msg":data.messages,"setTime":5});
		        		// coverfile = false;
		        		this.find('.up-cover-btn').text('编辑封面(560*420)');
		        		return false;
		        	} else
		        	{
		        		globalTip({"msg":data.messages,"setTime":5});
		        		coverfile = true;
		        		$('.up-cover-pic img').attr('src',data.data).width('280px').height('210px');
		        		this.find('.up-cover-btn').text('编辑封面(560*420)');
		        	}
		        	
		        	console.log(data);
		        },
		        onUploadError:function(id, message){
		        	alert('操作失败');
		        	$('#uploadFile'+id).remove();
		        	this.find('.up-cover-btn').text('编辑封面(560*420)');
		        }
		    });
  
});

