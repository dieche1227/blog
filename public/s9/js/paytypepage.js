$(document).ready(function(){
    $("#aliPay").click(function(){
        if(checkAlipayForm()){
            $.post("/spaytype",$("#aliForm").serialize(),function(data){
                if(data.stats="success"){
                    var cash = data.cash || 0;
                    $("#paytype").val(data.ptype);
                    var modalBoxPos = $("#modal_cash").find(".modal_effect");
                    $("#modal_cash").find(".price").text("").text("￥"+cash);
                    modal("#modal_cash",modalBoxPos);
                }
            })
        }
        return false;
    });

    $("#bankPay").click(function(){
        if(checkBankForm()){
            $.post("/spaytype",$("#bankForm").serialize(),function(data){
                if(data.stats="success"){
                    var cash = data.cash || 0;
                    $("#paytype").val(data.ptype);
                    var modalBoxPos = $("#modal_cash").find(".modal_effect");
                    $("#modal_cash").find(".price").text("").text("￥"+cash);
                    modal("#modal_cash",modalBoxPos);
                }
            })
        }
        return false;
    });

    $(".payedit").click(function(){
        $("#payname,#payphone,#payaccount").removeAttr('readonly').removeClass('disabled');
    });

    $(".bankedit").click(function(){
        $("#bankForm").find("input").removeAttr('readonly').removeClass('disabled');
    });

    $("#confirmCash").click(function(){
        $.post("/subapply",$("#pwdForm").serialize(),function(data){
            if(data.stats=='success'){
                $("#cpwd").val("");
                window.location.href = "/my/cash";
            }else{
                globalTip({"msg":data.msg,"setTime":5});
                return false;
            }
        });
    });
});

function formatBankNo (BankNo){
    if (BankNo.value == "") return;
    var account = new String (BankNo.value);
    account = account.substring(0,23); /*帐号的总数, 包括空格在内 */
    if (account.match (".[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{7}") == null){
        /* 对照格式 */
        if (account.match (".[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{7}|" + ".[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{7}|" +
                ".[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{7}|" + ".[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{7}") == null){
            var accountNumeric = accountChar = "", i;
            for (i=0;i<account.length;i++){
                accountChar = account.substr (i,1);
                if (!isNaN (accountChar) && (accountChar != " ")) accountNumeric = accountNumeric + accountChar;
            }
            account = "";
            for (i=0;i<accountNumeric.length;i++){    /* 可将以下空格改为-,效果也不错 */
                if (i == 4) account = account + "-"; /* 帐号第四位数后加空格 */
                if (i == 8) account = account + "-"; /* 帐号第八位数后加空格 */
                if (i == 12) account = account + "-";/* 帐号第十二位后数后加空格 */
                if (i == 16) account = account + "-";/* 帐号第十二位后数后加空格 */
                account = account + accountNumeric.substr (i,1)
            }
        }
    }
    else
    {
        account = " " + account.substring (1,5) + " " + account.substring (6,10) + " " + account.substring (14,19) + "-" + account.substring(19,25);
    }
    if (account != BankNo.value) BankNo.value = account;
}

function checkAlipayForm(){
    var payphone = $("#payphone").val();
    var payname = $("#payname").val();
    var payaccount = $("#payaccount").val();
    var tel = /^0{0,1}1[3|4|5|7|8][0-9]{9}$/;

    if(payname==""){
        globalTip({"msg":"请填写真实姓名!","setTime":5});
        return false;
    }else if(payphone=="" || !tel.test(payphone)){
        globalTip({"msg":"请填写正确的手机号码!","setTime":5});
        return false;
    }else if(payaccount==""){
        globalTip({"msg":"请填写收款账号!","setTime":5});
        return false;
    }else{
        return true;
    }
}

function checkBankForm(){
    var brealname = $("#brealname").val();
    var bphone = $("#bphone").val();
    var bbank = $("#bbank").val();
    var tel = /^0{0,1}1[3|4|5|7|8][0-9]{9}$/;

    if(brealname==""){
        globalTip({"msg":"请填写真实姓名!","setTime":5});
        return false;
    }else if(bphone=="" || !tel.test(bphone)){
        globalTip({"msg":"请填写正确的手机号码!","setTime":5});
        return false;
    }else if(bbank==""){
        globalTip({"msg":"请填写收款账号!","setTime":5});
        return false;
    }else{
        return true;
    }
}