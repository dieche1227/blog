/*global Qiniu */
/*global plupload */
/*global FileProgress */
/*global hljs */

var jw_qiniu = new Object();
$(function() {
//进行闭包设置
jw_qiniu.init = function(paramObj){
	
	//配置获取服务器上传凭证的url，其返回参数必须是json对象:{"uptoken": "0omL..."}
	this.uptoken_url = paramObj.uptoken_url == undefined ? 'uptoken' : paramObj.uptoken_url; 
	
	//设置上传文件的key值，如果不设置，则保持默认原文件名称作为key值 |   注意：形参为up,file
	this.key = typeof paramObj.key == 'function' ? paramObj.key : null;
	
	//设置上传成功的回调函数 	注意参数为up, file, info
	this.success = typeof paramObj.success == 'function' ? paramObj.success : null;
	
	
	//============以下为demo内部代码==========================
	var uploader = Qiniu.uploader({
		runtimes: 'html5,flash,html4',
		browse_button: 'pickfiles',
		container: 'container',
		drop_element: 'container',
		max_file_size: '1000mb',
		flash_swf_url: 'bower_components/plupload/js/Moxie.swf',
		dragdrop: true,
		chunk_size: '4mb',
		multi_selection: !(mOxie.Env.OS.toLowerCase()==="ios"),
		//uptoken_url: $('#uptoken_url').val(),
		uptoken_url: jw_qiniu.uptoken_url,
		// uptoken_func: function(){
		//     var ajax = new XMLHttpRequest();
		//     ajax.open('GET', $('#uptoken_url').val(), false);
		//     ajax.setRequestHeader("If-Modified-Since", "0");
		//     ajax.send();
		//     if (ajax.status === 200) {
		//         var res = JSON.parse(ajax.responseText);
		//         console.log('custom uptoken_func:' + res.uptoken);
		//         return res.uptoken;
		//     } else {
		//         console.log('custom uptoken_func err');
		//         return '';
		//     }
		// },
		domain: $('#domain').val(),
		get_new_uptoken: false,
		// downtoken_url: '/downtoken',
		unique_names: true,
		// save_key: true,
		// x_vars: {
		//     'id': '1234',
		//     'time': function(up, file) {
		//         var time = (new Date()).getTime();
		//         // do something with 'time'
		//         return time;
		//     },
		// },
		auto_start: true,
		log_level: 5,
		init: {
			'FilesAdded': function(up, files) {
                //alert(jw_qiniu.key);
				$('table').show();
				$('#success').hide();
				plupload.each(files, function(file) {
					var progress = new FileProgress(file, 'fsUploadProgress');
					progress.setStatus("等待...");
					progress.bindUploadCancel(up);
				});
				console.log(files);
                
				console.log("第一步，添加文件");
			},
			'BeforeUpload': function(up, file) {
				var progress = new FileProgress(file, 'fsUploadProgress');
				var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
				if (up.runtime === 'html5' && chunk_size) {
					progress.setChunkProgess(chunk_size);
				}
				console.log(file);
				console.log("第二步，触发上传前的函数回调");
                var liId = file.id;
                var progressHtml;
                    progressHtml = '<li id="'+ liId +'" class="up-thumb-item up-thumb-add up-thumb-bar">'+
                                        '<div class="bar-border">'+
                                            '<p class="bar-cont">'+
                                            '</p>'+
                                        '</div>'+
                                    '</li>';
                //alert(progressHtml);
               $('#pickfiles').before(progressHtml);

			},
			'UploadProgress': function(up, file) {
               
                var liId = file.id;

                var percentStr = file.percent + '%';
                $('#'+liId).find('.bar-cont').width(percentStr);
                var progress = new FileProgress(file, 'fsUploadProgress');
				var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
				progress.setProgress(file.percent + "%", file.speed, chunk_size);
				console.log(file);
				console.log("第三步，上传时，返回上传进度");
			},
			'UploadComplete': function() {


				$('#success').show();
				console.log("第五步，全部上传完成");
			},
			'FileUploaded': function(up, file, info) {
				var progress = new FileProgress(file, 'fsUploadProgress');
				progress.setComplete(up, info);
				console.log(file);
                
				
				console.log("第四步，某个文件上传成功时回调函数");
               
               
				//如果设置了，则进行函数回调
				if(jw_qiniu.success != null){
					jw_qiniu.success(up, file, info);
				}
			},
			'Error': function(up, err, errTip) {
				$('table').show();
				var progress = new FileProgress(err.file, 'fsUploadProgress');
				progress.setError();
				progress.setStatus(errTip);
			},
			'Key': function(up, file) {
		
				// do something with key
				var key = file.name;
				//如果设置了，则按照返回值进行设置key;
				if(jw_qiniu.key != null){
					var tmp = jw_qiniu.key(up,file);
					key = tmp == undefined ? key : tmp; 
				}
				console.log("上传文件时，定义的key的名称" + key);
				return key;
			 }
		}
	});


	
    uploader.bind('FileUploaded', function() {
        console.log('hello man,a file is uploaded');
    });
    $('#container').on(
        'dragenter',
        function(e) {
            e.preventDefault();
            $('#container').addClass('draging');
            e.stopPropagation();
        }
    ).on('drop', function(e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragleave', function(e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragover', function(e) {
        e.preventDefault();
        $('#container').addClass('draging');
        e.stopPropagation();
    });



    $('#show_code').on('click', function() {
        $('#myModal-code').modal();
        $('pre code').each(function(i, e) {
            hljs.highlightBlock(e);
        });
    });


    $('body').on('click', 'table button.btn', function() {
        $(this).parents('tr').next().toggle();
    });


    var getRotate = function(url) {
        if (!url) {
            return 0;
        }
        var arr = url.split('/');
        for (var i = 0, len = arr.length; i < len; i++) {
            if (arr[i] === 'rotate') {
                return parseInt(arr[i + 1], 10);
            }
        }
        return 0;
    };

    $('#myModal-img .modal-body-footer').find('a').on('click', function() {
        var img = $('#myModal-img').find('.modal-body img');
        var key = img.data('key');
        var oldUrl = img.attr('src');
        var originHeight = parseInt(img.data('h'), 10);
        var fopArr = [];
        var rotate = getRotate(oldUrl);
        if (!$(this).hasClass('no-disable-click')) {
            $(this).addClass('disabled').siblings().removeClass('disabled');
            if ($(this).data('imagemogr') !== 'no-rotate') {
                fopArr.push({
                    'fop': 'imageMogr2',
                    'auto-orient': true,
                    'strip': true,
                    'rotate': rotate,
                    'format': 'png'
                });
            }
        } else {
            $(this).siblings().removeClass('disabled');
            var imageMogr = $(this).data('imagemogr');
            if (imageMogr === 'left') {
                rotate = rotate - 90 < 0 ? rotate + 270 : rotate - 90;
            } else if (imageMogr === 'right') {
                rotate = rotate + 90 > 360 ? rotate - 270 : rotate + 90;
            }
            fopArr.push({
                'fop': 'imageMogr2',
                'auto-orient': true,
                'strip': true,
                'rotate': rotate,
                'format': 'png'
            });
        }

        $('#myModal-img .modal-body-footer').find('a.disabled').each(function() {

            var watermark = $(this).data('watermark');
            var imageView = $(this).data('imageview');
            var imageMogr = $(this).data('imagemogr');

            if (watermark) {
                fopArr.push({
                    fop: 'watermark',
                    mode: 1,
                    image: 'http://www.b1.qiniudn.com/images/logo-2.png',
                    dissolve: 100,
                    gravity: watermark,
                    dx: 100,
                    dy: 100
                });
            }

            if (imageView) {
                var height;
                switch (imageView) {
                    case 'large':
                        height = originHeight;
                        break;
                    case 'middle':
                        height = originHeight * 0.5;
                        break;
                    case 'small':
                        height = originHeight * 0.1;
                        break;
                    default:
                        height = originHeight;
                        break;
                }
                fopArr.push({
                    fop: 'imageView2',
                    mode: 3,
                    h: parseInt(height, 10),
                    q: 100,
                    format: 'png'
                });
            }

            if (imageMogr === 'no-rotate') {
                fopArr.push({
                    'fop': 'imageMogr2',
                    'auto-orient': true,
                    'strip': true,
                    'rotate': 0,
                    'format': 'png'
                });
            }
        });

        var newUrl = Qiniu.pipeline(fopArr, key);

        var newImg = new Image();
        img.attr('src', 'images/loading.gif');
        newImg.onload = function() {
            img.attr('src', newUrl);
            img.parent('a').attr('href', newUrl);
        };
        newImg.src = newUrl;
        return false;
    });
}
});
