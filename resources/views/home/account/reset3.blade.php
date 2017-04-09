@extends('public.base')

@section('title')
<title>账户注册</title>
@endsection

@section('css')
  @parent
  <link rel="stylesheet" type="text/css" href="{{asset('static/css/account.css')}}"/> 
@endsection
@section('main')
  <div class="bg-c4877ed h204" ></div>
  <div class="container cf-wrap">
    <div class="row">
      <!-- 重置密码 Start -->
      <h4 class="tlt">忘记密码</h4>
      <div class="cf-confirm-wrap forgot-form">
        <div class="form-wrap">
          <div class="form-hd">
            <dl class="">
              <dt><i><img src="../static/icon/account.svg"  th:src="@{/icon/account.svg}" alt=""/></i><span>第1步</span></dt>
              <dd class="sub-tlt">确认账号</dd>
              <dd class="arrow"></dd>
            </dl>
            <dl>
              <dt><i><img src="../static/icon/phone.svg" th:src="@{/icon/phone.svg}" alt=""/></i><span>第2步</span></dt>
              <dd class="sub-tlt">验证账号</dd>
              <dd class="arrow"></dd>
            </dl>
            <dl class="cur">
              <dt><i><img src="../static/icon/password2.svg" th:src="@{/icon/password2.svg}" alt=""/></i><span>第3步</span></dt>
              <dd class="sub-tlt">重置密码</dd>
              <dd class="arrow"></dd>
            </dl>
            
          </div>
          <div class="form-bd account-form-bd pos">
            <form class="form-horizontal" id="resetForm" action="/resetpassword/1"  method="post" role="form">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group mt53">
                <label for="phone" class="col-sm-2 control-label">设置新密码</label>
                <div class="col-sm-10 ipt">
                  <input name="passwordOne"  type="password" class="form-control input" id="passwordOne" placeholder="长度为6-14个字符，数字与字母的组合">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">确认新密码</label>
                <div class="col-sm-10 ipt">
                  <input name="passwordTwo" type="password" class="form-control input" id="passwordTwo" placeholder="请再次输入密码">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3">
                  <button type="submit" class="btn btn-default btn-primary next-btn">完成</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- 重置密码 End -->
    </div>
  </div>
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
					passwordOne: {
						trigger : 'blur',
		                validators: {
		                    notEmpty: {
		                        message: '密码长度为6-14个字符，数字和字符的组合。'
		                    },
		                    regexp : {
								          regexp : /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,14}$/,
								          message : '密码长度为6-14个字符，数字和字符的组合。'
							},
		                }
		            },
		            passwordTwo: {
		            	trigger : 'blur',
		                validators: {
		                    notEmpty: {
		                        message: '确认密码不能为空！'
		                    },
		                    identical: {
		                        field: 'passwordOne',
		                        message: '密码和确认密码不一致！'
		                    },
		                    regexp : {
								regexp : /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,14}$/,
								message : '密码长度为6-14个字符，数字和字符的组合。'
							},
		                    
		                }
		            },
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



