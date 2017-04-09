var gcashPage =  {
    APPLY_ID:'applycash',
    init:function(){
        gcashPage.ApplyEl = $("#"+gcashPage.APPLY_ID);
    },
    apply:function(Utoken){
        gcashPage.ApplyEl.click(function(){
            if(!Utoken) globalTip({"msg":"非法操作,请先登录!","setTime":5});
            $.ajax({
                type:'post',
                 url:'alycash',
                data:{},
                dataType:'json',
            });
        })
    },
};