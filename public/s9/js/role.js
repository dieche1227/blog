$(document).ready(function(){
    // 提交
    $('#uprole').click(function(){
        var $this = $(this);
        var val=$('input:radio[name="role"]:checked').val();
        if(val == null){
           globalTip({"msg":'请选择你的角色！',"setTime":5}); 
           return false;
        }
        if($('input[type=checkbox]').attr("checked")){
            $.ajax({
                type:'post',
                url :'/uprole',
                data:$('#role_form').serialize(),
                dataType:'json',
                success:function(msg){
                    if(msg.stats == 'success'){
                        globalTip({"msg":msg.messages,"setTime":5,"URL":'http://js.ui.cn','jump':true});
                    }else{
                        globalTip({"msg":msg.messages,"setTime":5});
                    }
                    
                },
                error:function(){
                    errorTip('请求错误请重试！！！');
                }
            });
        }else{
            globalTip({"msg":'请勾选同意平台使用协议',"setTime":5}); 
            return false;
        }
        
        return false;
    })
})