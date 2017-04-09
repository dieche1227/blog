@extends('public.base')

@section('title')
<title>找回密码</title>
@endsection

@section('css')
  @parent
  <link rel="stylesheet" type="text/css" href="{{asset('static/css/account.css')}}"/> 
@endsection
@section('main')
<div class="bg-c4877ed h204"></div>
<!-- 头部结束 -->
  <div class="container cf-wrap">
    <div class="row">
      <!-- 忘记密码 Start -->
      <h4 class="tlt">忘记密码</h4>
      <div class="cf-confirm-wrap forgot-form">
        <div class="form-wrap">
          <div class="form-hd">
            <dl class="cur">
              <dt><i><img src="../static/icon/account2.svg" th:src="@{/icon/account2.svg}" alt=""/></i>
                <span>第1步</span>
              </dt>
              <dd class="sub-tlt">确认账号</dd>
              <dd class="arrow"></dd>
            </dl>
            <dl>
              <dt><i><img src="../static/icon/phone.svg" th:src="@{/icon/phone.svg}" alt=""/></i><span>第2步</span></dt>
              <dd class="sub-tlt">验证账号</dd>
              <dd class="arrow"></dd>
            </dl>
            <dl>
              <dt><i><img src="../static/icon/password.svg" th:src="@{/icon/password.svg}" alt=""/></i><span>第3步</span></dt>
              <dd class="sub-tlt">重置密码</dd>
              <dd class="arrow"></dd>
            </dl>
          
          </div>
          <div class="form-bd pos">
           <!--  <p th:if="${loginNameError!=null}" th:text="${loginNameError}" class="bg-danger tip">该手机号码未注册</p>
            <p th:if="${iCaptchaError!=null}" th:text="${iCaptchaError}" class="bg-danger tip">图形验证码错误</p> -->
            <form class="form-horizontal" id="resetForm" action="/resetpassword" method="post" role="form">

                {{ csrf_field() }}

              <div class="form-group mt53">
                <label for="cellphone" class="col-sm-2 control-label">手机号码</label>
                <div class="col-sm-10 ipt">
                  <input  class="form-control input" id="cellphone"  name="cellphone" value="" type="text" placeholder="11位手机号码">
                </div>
              </div>
              <div class="form-group">
                <label for="graphcode" class="col-sm-2 control-label">验证码</label>
                <div class="col-sm-4 yzm">
                  <input class="form-control"  name="graphcode" type="text" placeholder="图片验证码">
                </div>
                <div class="code-img">
                  <img src="/graphcode"
										width="110px" height="46px" alt="点击刷新验证码"
										onclick="this.src='/graphcode?rnd=' + Math.random();"
										style="cursor: pointer" />
                </div>
              
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3">
                  <button type="submit" class="btn btn-default btn-primary next-btn">下一步</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- 忘记密码 End -->
    </div>
  </div>
@endsection


@section('js')
  @parent
<script>
	$(document).ready(function() {
			 $('#resetForm').bootstrapValidator({
				message : '输入值不合法',
				feedbackIcons : {
					valid : 'glyphicon glyphicon-ok',
					validating : 'glyphicon glyphicon-refresh'
				},
				fields : {
					cellphone : {
						trigger : 'blur',
						validators : {
							notEmpty : {
								message : '不能为空!'
							},
							regexp : {
								regexp : /^1(3|4|5|7|8)\d{9}$/,
								message : '手机格式不对！'
							}
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
            $.ajax({
                  type : "post",
                  url : $form.attr('action'),
                  dataType : 'json',
                  data :  $form.serialize(),
                  success : function(response) {
                    console.log(response);
                      if(response.status){
                            if(response.jumpUrl){
                                window.location.href=response.jumpUrl;
                            }
                        }else{
                           alert(response.msg);
                        }
                  }
                }); 
        });	
	});	
</script>	
@endsection
</body>
</html>



