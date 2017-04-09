<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="{{asset('static/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('static/css/common.css')}}">
		<link rel="stylesheet" href="{{asset('static/css/admin.css')}}" />
	</head>
	<body class="bg-blue">
		<div class="container pad-top pad-bottom">
            <div class="col-xs-6 text-center pad-top112">
                <h2 class="login-title2">全国大学生创业服务网</h2>
                <h3 class="login-title3">后台管理系统</h3>
            </div>
            <div class="col-xs-6">
                <div class="login">
                    <h2><img src="{{asset('static/img/logo.png')}}"></h2>
                    <div class="bg-w pad-18-60 border-r-4">
						<form class="clearfix">
							<div class="form-group login-div">
								<div class="col-sm-12 login-input">
							         <label class="login-error">用户名或密码错误</label>
								</div>
							</div>
							<div class="form-group login-div">
								<div class="col-sm-12 login-input">
									<i class="login-people"></i>
								     <input type="text" class="form-control login-account" placeholder="账号">
								</div>
							</div>
							<div class="form-group login-div">
								<div class="col-sm-12 login-input">
									<i class="login-lock"></i>
								      <input type="password" class="form-control login-password"  placeholder="密码">
								</div>
							</div>
							<div class="form-group login-div">
								<div class="col-sm-8 login-input">
								       <input type="text" class="form-control" placeholder="图片验证码">
								</div>
								<div class="col-sm-4 login-input">
									   <img src="">
								</div>
							</div>
							<div class="form-group login-div">
								<div class="col-sm-12 login-input">
									<button class="admin-login form-control">登&nbsp;&nbsp;陆</button>
								</div>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
        
			<div class="back-to-top"></div>

		
		<script src="{{asset('static/lib/jquery-1.11.1.min.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{asset('static/lib/bootstrap.min.js')}}" type="text/javascript" charset="utf-8"></script>
		
	</body class="bg-blue">
</html>
