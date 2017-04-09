
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="{{asset('static/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('static/css/common.css')}}">
		
		<link rel="stylesheet" href="{{asset('static/css/modal.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('static/css/jquery.datetimepicker.css')}}"/>
	</head>
	<style>
		tr:nth-child(odd)
		{
			background:#DEE7EF;
			text-align:center;
			font-size: 14px;
		}
		tr:nth-child(even)
		{
			background:#FFFFFF;
			text-align:center;
			font-size: 14px;
		}
		.trs th{
			text-align:center;
			color: #ffffff;
		}
		.block-left{
			margin:0px;
			margin-top:10px;
			font-size: 16px;
			text-align: center;
		}
		.block-left-1{
			margin:0px;
			background: #000000;
			color:#ffffff;
			padding:10px 0px;
		}
		.block-left-2{
			margin:0px;
			background: #ffffff;
			color:#000000;
			padding:10px 0px;
		}
		.top-clear-pd{
			padding:0px;
		}
		.block-top{
			padding:10px 0px;
			font-size: 16px;
		}
		.block-top-left{
			margin:0px;
			padding:0px;
			float: left;
			display:inline-block;
		}
		.block-top-right{
			margin:0px;
			padding:0px;
			float: right;
			display: inline-block;
		}
		.not-margin{
			margin:0px;
		}
	</style>
	<body>
		<!-- 页头开始 -->
		<div class="header">
			<div class="container top-clear-pd">
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
		

	    <div class="back-to-top"></div>

		<div class="container" style="padding-top: 20px;overflow: hidden">
			<div class="row">
				<div class="col-xs-2 block-left">
					<a href="/admin/goods"><p class="block-left-1">商品列表</p></a>
					<a href="/admin/plan"><p class="block-left-2">"采购计划列表</p></a>
				</div>
				<div class="col-xs-10">
					<div class="clearfix block-top">
						<span class="block-top-left"><strong>"互联网+"&nbsp;大赛</strong></span>
						<span class="block-top-right"><strong>创建文章</strong></span>
					</div>
					<div style="padding-top:15px;background-color:#ffffff;">
							<div style="">
							<form class="form-horizontal" role="form">
								<div class="form-group" style="margin-left: 20px;">
									<label class="control-label pull-left " style="width: 50px;margin-right: 15px;">文章标题</label>
									<input type="text" class="form-control pull-left" name="roll_name" placeholder="关键字" style="width: 200px;">
									<label class="control-label pull-left" style="width: 50px;margin-right: 15px;">时间</label>
									<input type="text" class="form-control pull-left" id="date_timepicker_start" name="roll_name" placeholder="关键字" style="width: 150px;">
									<label class=" control-label pull-left" style="width: 20px;margin-right: 10px;">至</label>
									<input type="text" class="form-control pull-left" id="date_timepicker_end" name="roll_name" placeholder="关键字" style="width: 150px;">
									<label class=" control-label pull-left" style="width: 50px;margin-right: 10px;">状态</label>
									<select class="form-control" style="width: 80px;display: inline-block">
										<option value="">1</option>
										<option value="">2</option>
									</select>
									<span style="display:inline-block;">
										<button type="button" class="btn btn-primary" style="width:70px;margin-bottom: 5px; margin-left:20px;">搜索</button>
									</span>
								</div>
							</form>
							</div>

						<div class="table-responsive">
							<table class="table table-bordered not-margin">
								<tr class="trs" style="background:#296DAD;" >
									<th>编号</th>
									<th>采购计划名称</th>
									<th>采购计划描述</th>
									<th>采购计划总价格</th>
									<th>状态</th>
									<th>操作</th>
								</tr>
								@foreach ($plans['data'] as $plan)
									<tr>
										<td>{{ $plan['guid'] }}</td>
										<td><a href="/admin/plan/{{ $plan['guid'] }}">{{ $plan['name'] }}</td>
										<td>{{ $plan['total']}}</td>
										<td>{{ $plan['total'] }}</td>
										<td>待发布</td>
										<td>预览&nbsp;&nbsp;修改&nbsp;&nbsp;撤回&nbsp;&nbsp;置顶&nbsp;&nbsp;删除</td>
									</tr>
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class="logo pull-left">
								<img src="../../static/icon/logo_bottom.png" alt="">
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
		<script src="../../static/lib/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="../../static/js/back_to_top.js"></script>
		<script src="../../static/lib/jquery.datetimepicker.js"></script>
		<script>
			$(function(){
				// 为下拉菜单按钮绑定移入移出事件
				$(".drop-hover").mouseover(function(){
					// $(this).addClass("text-primary");
					$(this).addClass("dropup");
					$(".drop-menu").removeClass("hidden");
				});
				$(".drop-hover").mouseout(function(){
					$(".drop-menu").addClass("hidden");
					$(this).removeClass("dropup");
				});

				// 为下拉菜单选项绑定移入移出事件
				$(".drop-menu").mouseover(function(){
					// $(".drop-hover").removeClass("text-primary");
					// alert(111);
					$(".drop-hover").addClass("dropup");
					$(".drop-menu").removeClass("hidden");
				});
				$(".drop-menu").mouseout(function(){
					$(".drop-menu a").mouseover(function(){
						$(this).addClass("text-primary");
					});
					$(".drop-menu").addClass("hidden");
					$(".drop-hover").removeClass("dropup");
				});
			});
		</script>

		<script>
			$('#datetimepicker_dark').datetimepicker({theme:'dark'});
			$(function(){
				jQuery('#date_timepicker_start').datetimepicker({
					theme:'dark',
					format:'Y-m-d',
					//minDate:'0',
					timepicker:false,
					onShow:function( ct ){
						this.setOptions({
							maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
						})
					}
				});
				jQuery('#date_timepicker_end').datetimepicker({
					theme:'dark',
					format:'Y-m-d',
					//minDate:'1970/01/02',
					timepicker:false,
					onShow:function( ct ){
						this.setOptions({
							minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
						})
					}
				});
			});


		</script>

	</body>
</html>
