 //用户框失去、得到焦点事件处理
            var email_10    = '<span id="password_errtext" class="user-input-er-span iconfont"><b>未检测到邮箱</b><i></i></span>';
            var password_10 = '<span id="password_errtext" class="user-input-er-span iconfont"><b></b><i></i></span>';
            var username_10 = '<span id="password_errtext" class="user-input-er-span iconfont"><b></b><i></i></span>';
            var code_10     = '<span id="password_code" class="user-input-er-span iconfont"><b></b><i></i></span>';

            var emaildef    = $('#forgot-email').val();
            var userdef     = $('#forgot-user').val();
            var codedelf    = $('#forgot-code').val();
            var userErro    = null;
            var ckuser      = false;
            $('#forgot-email').blur(function(){
                if($.trim($(this).val()).length<=0 || $(this).val()==emaildef){          
                    $(this).parent().removeClass('login-on');  //给#username的父元素添加class     
                    $(this).val(emaildef);
                    $(this).after(password_10);
                }else{
                    $.ajax({
                        type: 'post',
                        url: '/verifyemail',
                        dataType:"json",
                        data: 'email='+$(this).val(),
                        success:function(msg){
                            if(msg.code == 200){
                                if(msg.multiple){
                                    ckuser = true;
                                    alert(msg.msg);
                                    $('#username').show().focus();
                                }else{
                                     ckuser = false;
                                      $('#username').hide();
                                }
                                userErro = 0;
                                $(this).next("span").remove();
                            }else{
                                $("#forgot-email").after('<span id="password_errtext" class="user-input-er-span iconfont"><b>'+msg.msg+'</b><i></i></span>');
                                userErro = 20;
                                 return false;
                            }
                                return false;
                        }
                       
                        
                       
                    });

                }
                return false;
            }).focus(function(){
                $(this).parent().addClass('login-on');
                if($(this).val()==emaildef)
                $(this).val('');
                $(this).next("span").remove();
            });

            $('#forgot-user').blur(function(){
                 if(userErro == 20){
                    $('#forgot-email').focus();
                    return;
                }
                if($.trim($(this).val()).length<=0 || $(this).val()==userdef){
                    $(this).parent().removeClass('login-on');  //给#username的父元素添加class
                    $(this).val(userdef)
                    //$(this).focus();
                    $(this).after(username_10);                 
                }   
            }).focus(function(){
                if(userErro == 20){
                    $('#forgot-email').focus();
                    return;
                }
                $(this).parent().addClass('login-on');
                if($(this).val()==userdef)
                $(this).val('');
                $(this).next("span").remove();
            });
            
            $('#forgot-code').blur(function(){
                if($.trim($(this).val()).length <= 0 || $('#forgot-code').val()==codedelf){
                    //$(this).val(codedelf)
                    $(this).parent().removeClass('login-on');  //给#username的父元素添加class
                    //$(this).focus();
                    //globalTip({'msg':'请输入验证码！'});
                    $("#password_code").remove();
                    $("#forgot-code").after(code_10);
                    $(this).val('请输入验证码');
                    return false;          

                }
                
            }).focus(function(){
                $(this).parent().addClass('login-on');
                if($(this).val()==codedelf)
                $(this).val('');
                $("#password_code").remove();
            });
            

            $('#forgot-button').click(function(){ 
                if($.trim($('#forgot-email').val()).length<=0 || $('#forgot-email').val()==emaildef){
                   errorTip('请填写注册邮箱',3) //当密码不为空并且不是“请输入密码”时，弹出提示信息“密码不能为空”
                   $('#forgot-email').focus();
                   return false;  //如果判断为真，停止执行下面的代码，
                }
                

                if(ckuser){
                    if($.trim($('#forgot-user').val()).length<=0 || $('#forgot-user').val()==userdef){
                       errorTip('请填写用户名',3) //当密码不为空并且不是“请输入密码”时，弹出提示信息“密码不能为空”
                       $('#forgot-user').focus();
                       return false;  //如果判断为真，停止执行下面的代码，
                    }
                }
                


                if($.trim($('#forgot-code').val()).length<=0 || $('#forgot-code').val()==codedelf){
                   errorTip('请填写验证吗',3) //当密码不为空并且不是“请输入密码”时，弹出提示信息“密码不能为空”
                   $('#forgot-code').focus();
                   return false;  //如果判断为真，停止执行下面的代码，
                }

                $.ajax({
                    type: 'post',  //类型
                    url:  '/checkinfo',  //请求地址
                    dataType:"json",   //类型
                    data:$('#LoginForm').serialize(),  //获取ID为“LoginForm”的表单下所有name元素
                    success:function(msg){
                        globalTip(msg)
                        if(msg.code>1){
                            $('.fg-code-pic img').trigger('click');
                        }
                    }

                });

                return false;
            });
          
            





