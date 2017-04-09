$(function(){

	$('#fabuUpfile').dmUploader({
	    url: '/filecontest',
	    dataType: 'json',
	    extFilter : 'rar;zip;7z',
	    maxFileSize : 10485760,   
	    extraData:{'id':$('#file_ups').attr('rel')},
	    onNewFile: function(id, file){
	    	$(this).find(".upfile_show").empty();

	    	$(".fabu_ft .btn").removeAttr("id");
	    	$(".fabu_ft .btn").addClass("onfile");
	   
    		$(".fabu_ft .btn").click(function(){
    			if($(this).hasClass("onfile")){
    				globalTip({"msg":"正在上传文件，请稍等。。。","setTime":5});

    			} else {

    			}
    		});
	    	
	    }, 
	    onFileSizeError : function(file){
	        errorTip('文件:"'+file.name+'" 超过10M规定大小',5);
	    },
	    onFileExtError:function(file){
	    	errorTip('文件:"'+file.name+'" 类型错误,请重新上传',5);
	    },
	    onUploadProgress: function(id, percent){
	        var percentStr = percent + '%';
	        $(this).find('.upfile_bar').width(percentStr);
	    },
	    onUploadSuccess: function(id, data){

	    	globalTip({"msg":data.messages,"setTime":5});

	    	if ( data.stats=='success' )
	    	{	
	    		$('#fabuUpfile').append(data.html);
	    		$("#fabuUpfile_tit").removeClass("disabled");
				$("#fabuUpfile_tit").removeAttr("disabled");
	    	}

	    	$(".fabu_ft .btn").attr("id","nextStep1");
	    	$(".fabu_ft .btn").removeClass("onfile");
			
	    },
	    onUploadError:function(id, message){
	    	$(this).find('.upfile_bar').width(0);
	    },
	    onComplete:function(){
	    	
	    	$(this).find('.upfile_bar').width(0);
	    }
	});
});

