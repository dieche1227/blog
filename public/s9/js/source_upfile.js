$(function(){
	$("#sourceUpfile").click(function(){
		var agree = $('#agree').hasClass("checked");
		// console.log(agree);
		// 判断是否选择了同意协议
		if ( !agree ) {
			errorTip("请勾选同意协议");
			return false;
		};
	});

	$(document).on('click','[data-target]',function(){
		var modalBox1 = $(this).attr('data-target');
		var modalBoxPos1 = $(modalBox1).find(".modal_effect");
		if ( modalBox1 = '#modal_upwin' ) {
			conid = $(this).parents(".wlist").find(".thisid").text();
			proid = $(this).attr("rel");
			
			$("#modal_upwin").find("input[name='conid']").val(conid);
			$("#modal_upwin").find("input[name='proid']").val(proid);
		};
		modal(modalBox1,modalBoxPos1);
	});

	// 上传文件
	$('#sourceUpfile').dmUploader({
	    url: '/source',
	    dataType: 'json',
	    extFilter : 'rar;zip;7z',  
	    extraData:{'cid':conid,'pid':proid},
	    onNewFile: function(id, file){
	    	var size = (file.size/1024/1024);
	    	if(size < 1){
	    		size = (file.size/1024).toFixed(1)+'KB';
	    	}else{size = size.toFixed(1)+'M'}
	    	$('#size').empty().text('大小:'+size);

	    	$('#filename').empty().text(file.name);
	    }, 
	    onFileSizeError : function(file){
	        // alert('文件:"'+file.name+'" 超过10M规定大小');
	    },
	    onFileExtError:function(file){
	    	globalTip({"msg":'文件:"'+file.name+'" 类型错误,请重新上传',"setTime":5});
	    },
	    onUploadProgress: function(id, percent){
	        var percentStr = percent + '%';
	        $("#progress").width(percentStr);
	        $("#percentStr").text(percentStr);
	        if(percent == 100){
	        	$('#add_but').text('数据处理中');
	        }
	    },
	    onBeforeUpload:function(e){
	    	$('.hg_gdt').show();
	    },
	    // 上传成功
	    onUploadSuccess: function(id, data){
	    	console.log(data);
	    	if ( data.stats == 'success' )
	    	{
	    		$('#add_source').addClass('hg_gre');
	    		$('#add_but').hide();
	    		$('#add_confirm').show();
	    		$('#add_but').text('提交');
	    		
	    		successTip('文件上传成功!');
	    	} else
	    	{
	    		errorTip(data.messages+' 请重试!');
	    		//window.location.href='/sourcerror';
	    	}
	    },
	    // 上传失败
	    onUploadError:function(id, message){
	    	if(message == 'abort'){
	    		errorTip('请重新选择上传文件');
	    	}else{
	    		errorTip('上传失败');
	    	}
	    	
	    },
	    onComplete:function(){
	    	
	    },onCancel:function(id,file){
	    	console.log(id);
	    	console.log(file);
	    }
	});

	$('#add_source').click(function(){
		$.post('/sourec_add',{'cid':conid,'pid':proid},function(msg){
			console.log(msg);
			if(msg.stats){
				globalTip({'msg':msg.messages,'URL':'/sourceyer','jump':true,"setTime":5})
			}else{
				errorTip(msg.messages);
			}
		},'json');
		return false;
	});
});