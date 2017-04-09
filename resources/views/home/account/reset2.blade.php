@extends('public.base')

@section('title')
<title>找回密码</title>
@endsection

@section('css')
  @parent
  <link rel="stylesheet" type="text/css" href="{{asset('static/css/account.css')}}"/> 
@endsection
@section('main')
<div class="bg-c4877ed h204" ></div>
  <div class="container cf-wrap">
    <div class="row">
      <!-- 忘记密码 Start -->
      <h4 class="tlt">忘记密码</h4>
      <div class="cf-confirm-wrap forgot-form">
        <div class="form-wrap">
          <div class="form-hd">
            <dl class="">
              <dt><i><img src="../static/icon/account.svg" th:src="@{/icon/account.svg}" alt=""/></i><span>第1步</span></dt>
              <dd class="sub-tlt">确认账号</dd>
              <dd class="arrow"></dd>
            </dl>
            <dl class="cur">
              <dt><i><img src="../static/icon/phone2.svg" th:src="@{/icon/phone2.svg}"  alt=""/></i><span>第2步</span></dt>
              <dd class="sub-tlt">验证账号</dd>
              <dd class="arrow"></dd>
            </dl>
            <dl>
              <dt><i><img src="../static/icon/password.svg" th:src="@{/icon/password.svg}" alt=""/></i><span>第3步</span></dt>
              <dd class="sub-tlt">重置密码</dd>
              <dd class="arrow"></dd>
            </dl>
          </div>
          <div class="form-bd account-form-bd pos">
          	<!-- <p th:if="${sCaptchaError!=null}" th:text="${sCaptchaError}" class="bg-danger tip">图形验证码错误</p> -->
            <form class="form-horizontal" id="resetForm" action="/resetpassword/1" method="get" role="form">
              
              <div class="form-group mt53">
                <label class="col-sm-2 control-label">您的账号为</label>
                <div class="col-sm-10 ipt account">
                  <p class="form-control-static ptn" id="cellphone">
                  		{{$cellphone}}
                  </p>
                </div>
              </div>
              <div class="form-group">
                <label for="sms-code" class="col-sm-2 control-label">短信验证码</label>
                <div class="col-sm-4 yzm">
                  
                  <input name="msgcode" type="text" class="form-control" placeholder="短信验证码">
                </div>
                <div class="sms-btn">
                  <button type="button" id="sendcode" class="btn btn-default"  onclick="sendMessage(this);">获取短信验证码</button>
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
    var InterValObj; //timer变量，控制时间  
      var count = 60; //间隔函数，60秒执行  
      var curCount = 60;//当前剩余秒数  
    //timer处理函数
    function sendMessage(obj) {  
            $this=$(obj);
            curCount = count;
            var cellphone = $('#cellphone').html();
            alert(cellphone);
            console.log(cellphone);

        var myreg = /^1(3|4|5|7|8)\d{9}$/; 

        // if(!myreg.test(cellphone)) {
        //    $this.nextAll('.help-block').hide();
        //    $this.after('<small class="help-block sendcodestatus" data-bv-validator="" data-bv-for="sCaptcha" data-bv-result="NOT_VALIDATED" style="display: block;color:#e15554;">'+'请输入11位手机号！'+'</small>');
        //    return false;
        // }
           
        $.ajax({
          type : "GET",
          url : '/msgcode',
          dataType : 'json',
          data : {
            //verify : $('#verify').val(),
            cellphone :  $('#cellphone').val(),
          },
          success : function(response) {
            //console.log(response);
             if(response.code == 'success'){ 
               $this.nextAll('.sendcodestatus').hide();
               $("#sendcode").attr("disabled", "true");
                   InterValObj = window.setInterval(SetRemainTime, 1000);
             }else{
               $this.nextAll('.help-block').hide();
               $this.after('<small class="help-block sendcodestatus" data-bv-validator="" data-bv-for="sCaptcha" data-bv-result="NOT_VALIDATED" style="display: block;color:#e15554;">'+response.msgcode+'！</small>');
             }
          }
        });
    }  

      function SetRemainTime() {  
          if (curCount == 0) {                  
              window.clearInterval(InterValObj);//停止计时器  
              $("#sendcode").removeAttr("disabled");//启用按钮  
              $("#sendcode").text("再次获取验证码");  
          }  
          else {  
              curCount--;  
              $("#sendcode").text( curCount + "s");  
          }  
      }  
  </script>
  
  <script>
	$(document).ready(function() {
			 $('#resetForm').bootstrapValidator({
				
				message : '输入值不合法',
				feedbackIcons : {
					valid : 'glyphicon glyphicon-ok',
					invalid : 'glyphicon glyphicon-remove',
					validating : 'glyphicon glyphicon-refresh'
				},
				fields : {
					sCaptcha : {
						trigger : 'blur',
						validators : {
							notEmpty : {
								message : '验证码不能为空！'
							},
							regexp : {
								regexp : /^[a-zA-Z0-9_\.]{6}$/,
								message : '请输入正确的验证码'
							},
						}
					}

				}
			});
			 
			
	});	
</script>	
@endsection



