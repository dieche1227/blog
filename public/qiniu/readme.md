#七牛的JavaScript的sdk笔记

> 本demo主要是针对于视频上传，如果需要对图片等资源在客户端进行数据处理，[请参考详细手册](http://developer.qiniu.com/code/v6/sdk/javascript.html)

##1. JavaScript的简单介绍
1. 上传部分

	* html5 模式大于 4 M 时可分块上传，小于 4 M 时直传
	* Flash、html4 模式直接上传
	* 继承了 Plupload 的功能，可筛选文件上传、拖曳上传等
2. 下载（公开资源）
3. 数据处理（图片）
	* imageView2（缩略图）
	* imageMogr2（高级处理，包含缩放、裁剪、旋转等）
	* imageInfo （获取基本信息）
	* exif （获取图片 EXIF 信息）
	* watermark （文字、图片水印）
	* pipeline （管道，可对 imageView2、imageMogr2、watermark 进行链式处理）

##2. 客户端上传，依赖上传凭证
后端服务应提供一个 URL 地址，供 SDK 初始化使用，前端通过 Ajax 请求该地址后获得 upToken。 Ajax 请求成功后，服务端应返回如下格式的 json：

    {
    "uptoken": "0MLvWPnyya1WtPnXFy9KLyGHyFPNdZceomL..."
    }
##3. 前端依赖库文件

1. 本demo依赖于bootstrap，所以额外添加以下文件；
	* bootstrap的css和js和jQuery.js
2. 引入 Plupload插件
	* plupload.full.min.js（产品环境）或引入 plupload.dev.js 和 moxie.js（开发调试）
3. 引入qiniu库文件
	* qiniu.min.js（生产环境）或 qiniu.js（开发调试）
4. 引入其他文件

		1. zh_CN.js
		2. ui.js	上传时进度可视化文件，里面包含FileProgress对象
		3. heighlight.js

5. 七牛上传文件——main.js(也是最重要的文件),笔者对此文件进行封装，直接引用即可。

##4. main.js介绍（主要介绍Qiniu.uploader的配置）
####常见的配置参数

1. browse_button：是对应一个a标签按钮，用此id节点来选择需要上传的文件
2. uptoken：为上传凭证
3. uptoken_url：获取服务器端传来的上传凭证的地址
4. unique_names：是否自动生成唯一的key值
5. 其他请参考手册；

####七个回调方法
1. FileUploaded：每个文件上传成功后，处理相关的事情
2. Key：若想在前端对每个文件的key进行个性化处理，可以配置该函数
3. 其他五个回调函数请参考手册

##5. 封装的参数和运用
笔者对此main.js进行再次封装，把重要数据提出来进行配置参数，如下所示(进行更改过的main.js文件)：

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
        ...

其中笔者把其中必要重要的参数和回调函数全部封装出来，直接调用即可。其具体方法和回调函数有：

1. uptoken_url:服务器地址，用来获取上传凭证
2. key：设置需要上传文件的key；
3. success：上传成功的回调函数；

#####运用

直接在html代码文件中进行初始化即可运用

    <script>
    $(function(){
        console.log(jw_qiniu);
        jw_qiniu.init({
            uptoken_url:'uptoken.php',
            key:function(up, file){
                return file.name + '陈家文';
            },
            success:function(up, file, info){
                alert("上传成功");
            }
        });
    });
    </script>





