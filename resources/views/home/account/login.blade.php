@extends('home.public.base')

@section('title')
<title>账户注册</title>
@endsection

@section('css')
  @parent
  <link rel="stylesheet" type="text/css" href="{{asset('static/css/account.css')}}"/> 
@endsection
@section('main') 

	<div class="bg-c4877ed h204"></div>
	<div class="container cf-wrap">
		<div class="row">
			<!-- 用户登录 Start -->
			<h4 class="tlt">用户登录</h4>
			<div class="cf-confirm-wrap login-form">
				<div class="form-wrap reg-form">
					<div class="form-bd account-form-bd pos">
						<!-- <span th:if="${loginError!=null}" th:text="${loginError}"
							class="bg-danger reg-tip"> 该手机号已注册 </span> -->
						<form class="form-horizontal pull-left mlm mtn w328"
							id="loginForm" action="/login"  method="post" role="form">

							{{ csrf_field() }}

							<input name="path" type="hidden" value="{{$path}}">

							<div class="form-group ml-11">
								<div class="col-xs-10 ipt pos">
									<input class="form-control input account-padding"
										id="loginName" name="cellphone" type="text"
									 placeholder="账号">
								</div>
							</div>
							<div class="form-group ml-11">
								<div class="col-xs-10 ipt pos">
									<input class="form-control input account-padding" id="password"
										name="password" type="password" placeholder="密码">
								</div>
							</div>


							<div class="form-group mb0 ml-11">
								<div class="col-xs-4 yzm">
									<input class="form-control" name="graphcode"
										type="text" placeholder="图片验证码">
								</div>
								<div class="code-img">
									<img src="{{url('graphcode')}}"
										width="110px" height="46px" alt="点击刷新验证码"
										onclick="this.src='/graphcode?rnd=' + Math.random();"
										style="cursor: pointer" />
								</div>
							</div>


							<div class="form-group mbn ml-11">
								<div class="checkbox col-xs-10 ipt ">
									<label class="pull-right"> 
									<a href="reset1.html">忘记密码</a>
									</label>
								</div>
							</div>
							<div class="form-group ml-11">
								<div class="col-xs-10 ipt">
									<button type="submit"
										class="btn btn-default btn-primary account-btn">登录</button>
								</div>
							</div>
						</form>
						<div class="reg-middle pull-left mtn">
							<div class="reg-divider"></div>
							<div>
								<span class=" f14 or txt-cccc">or</span>
							</div>
							<div class="reg-divider"></div>
						</div>
						<div class="reg-aside pull-left mtn ">
							<p class="f12 txt-c666 text-left mlw mb0">还没有账号?</p>
							<p class="text-left mlw mb0">
								<a class="btn txt-c4877ed" href="/register"
									th:href="@{/register}">立即注册 <i class="forward"></i></a>
							</p>

							<div class="left-up mtw"></div>
							<img src="../static/img/body_100_100.png"
								th:src="@{/img/body_100_100.png}">
							<div class="right-down"></div>
							<p class="f14 txt-c666 text-left mt15 mlw mb0">扫描关注创业网</p>
							<p class="f14 txt-c666 text-center mb0">微信公众号注册报名</p>
						</div>
					</div>

				</div>
			</div>
			<!-- 用户登录 End -->
		</div>
	</div>

@endsection
	
@section('js')
  @parent  
	<script>
		$(document).ready(
				function() {
					$('#loginForm').bootstrapValidator({
						feedbackIcons : {
							valid : 'glyphicon glyphicon-ok',
							validating : 'glyphicon glyphicon-refresh'
						},
						fields : {
							cellphone : {
								trigger : 'blur',
								validators : {
									notEmpty : {
										message : '手机号码不能为空!'
									}
								}
							},
							password : {
								trigger : 'blur',
								validators : {
									notEmpty : {
										message : '密码不能为空！'
									},
								}
							},

							graphcode : {
								trigger : 'blur',
								validators : {
									notEmpty : {
										message : '验证码不能为空！'
									},
									regexp : {
										regexp : /^[a-zA-Z0-9_\.]{5}$/,
										message : '请输入正确的验证码'
									},
								}
							}
						}
					}).on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post(
            	$form.attr('action'), 
            	$form.serialize(), 
            	function(result) {
                console.log(result);
            	}, 
            	'json');
        });	
				});
	</script>
@endsection




