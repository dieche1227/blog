<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="{{asset('static/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('static/css/common.css')}}">
		
        <link rel="stylesheet" href="{{asset('static/css/createArticle.css')}}">
	</head>
	<body class="bg-blue">
		<!-- 页头开始 -->
		<div class="header">
			<div class="container">
					<div class="row">
						<div class="col-xs-4">
							<a href="#">
									<img alt="Brand" src="../../static/icon/logo_top.png">
								</a>
						</div>
						
						<div class="col-xs-4 col-xs-offset-4 text-right header-right">
						
						<a href="" class="username">张晓明</a>
						<span class="header-space">|</span>
						<a href="" class="logout">退出</a>
						</div>
					</div>
			</div>
		</div>

		<div class="container article-content">
            <div class="content-manager pull-left"></div>
            <div class="content-input pull-right">
				<form class="form-horizontal" role="form" method="POST" action="#" accept-charset="UTF-8" enctype="multipart/form-data">

					<div class="article-input">
						<label for="input-title" class=""><span>*</span>文章标题：</label>
						<input type="text" class="" id="input-title" placeholder="标题需要简洁清晰，传递主题思想明确">
					</div>
					<div class="article-input modify-summary">
						<label for="input-summary" class=""><span>*</span>摘&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&thinsp;要：</label>
						<textarea class="" id="input-summary" placeholder="摘要是动态内容的总结性描述，需简洁明了，概括性强，不超过60字"></textarea>
						<p class="pull-right">还可以录入<span>60</span>字</p>
					</div>
					<div class="article-input modify-type">
						<label for="input-type" class=""><span>*</span>文章类型：</label>
						<select id="input-type">
							<option value="">请选择</option>
							<option value="0">大赛动态</option>
							<option value="1">省市动态</option>
						</select>
					</div>
					<div class="article-input modify-stick">
						<label for="set-stick" class=""><span>*</span>是否置顶：</label>
						<div id="set-stick">
							<label><input type="radio" name="stick" value="male"><span>是</span></label>
							<label><input type="radio" name="stick" value="female"><span>否</span></label>
						</div>
					</div>
					<div class="article-input modify-content">
						<label for="input-content" class=""><span>*</span>文章内容：</label>
						<div class="" id="input-content">	
						 <!-- 加载编辑器的容器 -->
						    <script id="container" name="content" type="text/plain">
						        这里写你的初始化内容
						    </script>
						</div>
					</div>
					<div class="article-input modify-upload-attachment">
						<label for="input-upload-attachment" class=""><span>*</span>上传附件：</label>
						<div class="" id="input-upload-attachment">
							<input type="button" value="点击上传" onclick="inputattachment.click()" id="upload_attachment">
							<input type="file" id="inputattachment" class="hidden" >
						</div>
						<p>附件地址：<span></span></p>
					</div>
					<div class="article-input modify-upload-cover">
						<label class="" for="input-upload-cover"><span>*</span>上传封面图：</label>
						<div class="" id="input-upload-cover">
							<input type="button" value="点击上传" onclick="inputcover.click()" id="upload_cover">
							<input type="file" id="inputcover" class="hidden" >
						</div>
					</div>
					<div class="article-input modify-action">
						<a href="javascript:void(0)" class="pressed" role="button" id="article_preview">预览</a>
						<button href="javascript:void(0)" class="pressed" role="button" id="article_draft">保存草稿</button>
						<a href="javascript:void(0)" class="pressed" role="button" id="article_online">上线</a>
					</div>


				</form>
            </div>
		</div>

	    <div class="back-to-top"></div>

		<div class="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class="logo pull-left">
								<img src="{{asset('static/icon/logo_bottom.png')}}" alt="">
							</div>
							<div class="content pull-left">
								<p>
									<a href="">新职业</a>
									<span class="footer-space">|</span>
									<a href="">关于创业网</a>
									<span class="footer-space">|</span>
									<a href="">联系我们</a>
								</p>
								<p>主管部门：中华人民共和国教育部 版权所有：全国高等学校学生信息咨询与就业指导中心</p>
								<p>京ICP备15029560号</p>
							</div>
						</div>

						<div class="col-md-4 text-right">
							<div class="footer-logo text-center">
								<img src="../../static/icon/footer_96_96.png" alt="">
								<p>大赛官方微信平台</p>
							</div>
						</div>
					</div>
				</div>
			</div>


		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title text-center" id="mySmallModalLabel">删除项目</h4>
					</div>
					<div class="modal-body project-modal-text">
						<span class="project-modal-question"></span>
						<div class="project-modal-info">
							<p class="project-modal-del">确认删除项目</p>
							<p class="project-modal-del">智能家务机器人的研发与推广?</p>
							<div class="form-group clearfix modal-confirm">
								<button class="btn btn-default modal-btn-info-save">确认删除</button>
								<button class="btn btn-default modal-btn-info-cancel">取消</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../../static/lib/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
		<!-- <script src="../../static/lib/bootstrap.min.js" type="text/javascript" charset="utf-8"></script> -->
		
	</body>



    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('uieditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('uieditor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
</html>
