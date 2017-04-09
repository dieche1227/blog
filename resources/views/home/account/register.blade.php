<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title>register</title>
       <!--  <link rel="stylesheet" href="./Public/fonts/iconfont.css"> -->
        <link rel="stylesheet" href="{{asset('s9/css/common.css')}}">
        <!-- <link rel="stylesheet" href="./s9/css/home.css"> -->
        <link rel="stylesheet" href="{{asset('s9/css/module.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/account.css')}}">
    </head>
    <body>
       
            <!-- 头部开始 -->
<div class="bg_white">
    <div class="wpn cl">
        <a class="hlogo" href="/" title=""></a>
        <ul class="hnav cl">
            <li ><a href="/goodlist">商品</a></li>
            <li class="on"><a href="/quanzilist">圈子</a></li>
            <li ><a href="/bidlist">招标</a></li>
            <li ><a href="/rule">规则</a></li>
        </ul>
       
        <div class="huser y">
            <a href="/useinfo" class="avatar">
                <img src="./s9/images/avatar.jpg" alt="">
            </a>
            <a href="/notice" class="news">
                <i class="icon-horn"></i>
            </a>
        </div>
    </div>
</div>
<!-- 头部结束 -->
       
    
            <!-- 用户注册 Start -->
            
      <div class="cf-confirm-wrap reg-form-wrap">
        <div class="form-wrap reg-form">
          <div class="form-bd account-form-bd pos">
            
             @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif



            @if (session('msg'))

            <span  class="bg-danger reg-tip">
                        {{session('msg')}}
            </span>
             
            @endif


            
           
            <form id="regForm" class="form-horizontal pull-left mlm mtn w328" role="form"
              role="form" id="regForm" method="post" action="{{url('create')}}" >
                {{ csrf_field() }}
            <input name="path" type="hidden" value="{{$path}}">
              <div class="form-group ml-11">
                <div class="col-xs-10 ipt">
                 <input type="text" class="form-control input" id="cellphone" placeholder="请输入11位手机号码" name="cellphone" value="{{ old('cellphone') }}">
                </div>
              </div>
              <div class="form-group ml-11">
                <div class="col-xs-10 ipt">
                   <input type="text" class="form-control input" id="phone" name="password" placeholder="密码长度为6-14个字符,数字和字母的组合" value="{{ old('password') }}">
                </div>
              </div>
              <div class="form-group ml-11">
                <div class="col-xs-4 yzm">
                   <input type="text" class="form-control" id="code" name="verify" value="{{ old('verify') }}" placeholder="图片验证码">
                </div>
                <div class="code-img">
                  <img src="{{url('graphcode')}}" 
                     width="110px" height="46px" alt="点击刷新验证码"
                    onclick="this.src='/graphcode?rnd=' + Math.random();"
                    style="cursor: pointer" />
                </div>
              </div>
              <div class="form-group mbw ml-11">
                <div class="col-xs-4 yzm">
                 <input type="text" name="msgcode" class="form-control" id="msgcode" placeholder="短信验证码" value="{{ old('msgcode') }}">
                </div>
                <div class="sms-btn">
                  <button type="button" id="sendcode" class="btn btn-default"  onclick="sendMessage(this)">获取短信验证码</button>
                </div>
              </div>

              <div class="form-group mbn ml-11  mt-10 accept-formgroup">
                <div class="checkbox col-xs-10 ipt pt-2">
                  <label> <input name="accept" class="" type="checkbox" value="accept"
                    checked="checked"> <span>接受</span> <a href="/registerprotocol"  target="_blank">《网用户协议》</a>
                  </label>
                </div>
              </div>
              <div class="form-group ml-11">
                <div class="col-xs-10 ipt">
                  <button id="reg" name='reg' type="submit" disabled="disabled"
                    class="btn btn-default btn-primary account-btn">注册</button>
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
              <p class="f12 txt-c666 text-left mlw mb0">已有账号?</p>
              <p class="text-left mlw mb0">
                <a class=" txt-c4877ed" href="/login">立即登录 <i
                  class="forward"></i></a>
              </p>
              <div class="left-up mtw"></div>
              <img src="../static/img/body_100_100.png"
                th:src="@{/img/body_100_100.png}">
              <div class="right-down"></div>
              <p class="f14 txt-c666 text-left mt15 mlw mb0">扫描关注创业网</p>
              <p class="f14 txt-c666 text-center mb0">
                微信公众号注册报名</p>
            </div>
          </div>

        </div>
      </div>
            <!-- 用户注册 End -->
    

     
     






        <!-- 问题帮助 -->
        <div class="bg_orange" >
            <div class="wpn cl help">
                <div class="info">
                    <h2 class="tit"><a href="/faqlists">问题反馈</a></h2>
                    <p class="text">
                        如有任何疑问，请点击问题反馈，如需获得进一步帮助，请联系：xxx@17zhaobiao.com；<br>
                        或者拨打热线：123456789；也可以在线联系客服咨询。
                    </p>
                </div>
                <div class="contact">
                    <p class="item"><i class="icon-email-line"></i>xxx@17zhaobiao.com</p>
                    <p class="item"><i class="icon-tel"></i>010-8888888</p>
                </div>
            </div>
        </div>
        <!-- 页脚 -->
        <div class="bg_white">
            <div class="wpn">
                <i class="ft icon-uimini"></i>
            </div>
        </div>
        <!--{/* 返回顶部*/}-->
        <div id="toTop" class="totop">
            <a class="arrows" title="返回顶部" href="javascript:;"></a>
            <a class="service" title="QQ客服" href="javascript:;"><i class="icon-qq"></i></a>
        </div>
    </body>
</html>

    <script type="text/javascript" src="{{asset('s9/js/plugin/jquery-1.10.2.js')}}"></script>

    <!--[if lt IE 9]> 
        <script src="../js/plugin/html5.min.js"></script>
    <![endif]-->
    <!--[if (gte IE 6)&(lte IE 8)]>
        <script src="../js/plugin/selectivizr.min.js"></script>
    <![endif]-->
    <script src="{{asset('s9/js/totop.js')}}"></script>

    <script src="{{asset('s9/js/msgTip.js')}}"></script>
    <script src="{{asset('static/lib/bootstrapvalidator/dist/js/bootstrapValidator.js')}}" type="text/javascript" charset="utf-8"></script>


<script>
   
    var InterValObj; //timer变量，控制时间  
      var count = 60; //间隔函数，60秒执行  
      var curCount = 60;//当前剩余秒数  
    //timer处理函数
    function sendMessage(obj) {  
            $this=$(obj);
            curCount = count;
            var cellphone = $('#cellphone').val();
        var myreg = /^1(3|4|5|7|8)\d{9}$/; 
        if(!myreg.test(cellphone)) {
           $this.nextAll('.help-block').hide();
           $this.after('<small class="help-block sendcodestatus" data-bv-validator="" data-bv-for="sCaptcha" data-bv-result="NOT_VALIDATED" style="display: block;color:#e15554;">'+'请输入11位手机号！'+'</small>');
           return false;
        }
           
        $.ajax({
          type : "GET",
          url : '/msgcode',
          dataType : 'json',
          data : {
            verify : $('#verify').val(),
            tel :  $('#cellphone').val(),
          },
          success : function(response) {
            //console.log(response);
             if(response.StatusCode == '400'){ 
               $this.nextAll('.sendcodestatus').hide();
               $("#sendcode").attr("disabled", "true");
                   InterValObj = window.setInterval(SetRemainTime, 1000);
             }else{
               $this.nextAll('.help-block').hide();
               $this.after('<small class="help-block sendcodestatus" data-bv-validator="" data-bv-for="sCaptcha" data-bv-result="NOT_VALIDATED" style="display: block;color:#e15554;">'+response.ResultData+'！</small>');
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
       $('#regForm').bootstrapValidator({
          fields : {
            cellphone : {
              trigger : 'blur',
              validators : {
                notEmpty : {
                  message : '请输入11位手机号!'
                },
                regexp : {
                  regexp : /^1(3|4|5|7|8)\d{9}$/,
                  message : '请输入11位手机号！'
                }
              }
            },
            password : {
              trigger : 'blur',
              validators : {
                notEmpty : {
                  message : '密码长度为6-14个字符，数字和字符的组合。'
                },
                
                
                regexp : {
                  regexp : /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,14}$/,
                  message : '密码长度为6-14个字符，数字和字符的组合。'
                },
                
                
                
                different : {
                  field : 'cellphone',
                  message : '密码不能和手机号一样!'
                }
              }
            },

            verify : {
              trigger : 'blur',
              validators : {
                notEmpty : {
                  message : '验证码不能为空！'
                },
                regexp : {
                  regexp : /^[a-zA-Z0-9_\.]{5}$/,
                  message: '请输入正确的验证码'
                },
              }
            },

            msgcode : {
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
            },  
          

        }
      });
});
</script>


