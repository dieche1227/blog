<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <meta name="description" content=""/>
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache"/> 
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache"/> 
    <meta HTTP-EQUIV="Expires" CONTENT="0"/>
    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/reset.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/header_nav.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/footer.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/account.css')}}"/>
</head>
<body class="bg-cf2f2f2">
	<!-- 头部开始 -->
	<div class="container wpn pl0">
		<div class="navbar navbar-default bg_gray mb0" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"></a>
			</div>
		</div>
	</div>
	<div class="bg-png">
		<div class="login-success center-block">
			<h2 class="f24 txt-cfff text-center mbw">
				<i class="check"></i> <span class="plw"><b>您已注册成功!</b></span>
			</h2>
			<p class="f16 txt-cfff center-block text-center">轻松获得融资服务,</p>
			<p class="f16 txt-cfff center-block text-center ">
				或参加中国“互联网+”大学生创新创业大赛，</p>
			<p class="f16 txt-cfff center-block text-center">请申请成为创业者。</p>

			<div class="center-block text-center mtw">
				<a th:href="@{/talent/add}" href="./talent/add"
					class=" txt-c5682ee btn btn-default">申请成为创业者&nbsp&nbsp></a>
			</div>

			<div class="center-block text-center mtw">
				<a class=" f12 txt-cfff btn btn-link non-dec">暂不申请，继续浏览网站</a>
			</div>
		</div>

	</div>



	<!-- 头部结束 -->


	<!-- 尾部开始 -->
	<div th:include="fragment :: footer"></div>

	<script>
		$(document).ready(function() {
			$("#stick").css("height", '0px');
		});
	</script>
</body>
</html>



