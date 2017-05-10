<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>如果其他用户对此商品有需求需要填写表单</title>
          <!-- modal css-->
       
       
    
       
        <link rel="stylesheet" href="{{asset('s9/css/common.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/home.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/module.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/addbid/uicn.css')}}">
      
        <link rel="stylesheet" href="{{asset('s9/css/addbid/new_enter.css')}}">

        <link rel="stylesheet" href="{{asset('s9/css/modal.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/addgoods.css')}}">
        <script type="text/javascript" src="{{asset('qiniu/scripts/jquery.min.js')}}"></script>
       @include('UEditor::head');
        <script type="text/javascript">
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        </script>
     
    </head>
    <body>
 <div id="ajax-hook"></div>

    <div class="container">

        <div class="warp_1180 wpn cl">
            <!-- 右侧内容 -->
            <div class="main more z mtv">
                <form action="#" method="get" id="param">

                    <input type="hidden" name="goodsuid" value="{{ $goodsuid }}"> 
                    <div class="main_warp">
                        <div class="title cl">
                            <div class="h1 z">商品</div>
                            <div class="h3 z mln"> 
                                －如果其他用户对此商品有需求需要填写表单
                            </div>

                           
                        </div>
                        <div class="account_warp ptv warp_list cl">
                            <div class="z w70" >
                                <h3>
                              联系方式(其他用户对此商品有需求,必填)  
                                </h3>
                                <div class="cl apply-list-form mtv">
                                        <label class="w10 z f16 txt-center"> 
                                            <input  type="checkbox" disabled="disabled" checked>
                                             <input name="ismust-0" value="1"  id="" type="hidden">
                                            必选
                                        </label>
                                        <label class="control-label w20 z f16 txt-center">称呼</label>
                                        <input name="param-name-0" type="hidden" value="称呼"> 
                                        <input type="hidden" name="input-type-0" value="single-line">
                                         <input type="hidden" name="param-name-0-param" value="null">
                                        <div class="w68 z">
                                            <input  type="text" class="w100 p14" placeholder="如：张先生,李小姐"  disabled="" value="如：张先生,李小姐"> 
                                             <input name="tip-0" type="hidden" value="如：张先生,李小姐"> 
                                            <span class="help-block m-b-none">
                                            </span>
                                        </div>
                                        
                                </div>
                                <div class="cl apply-list-form mtv">
                                        <label class="w10 z f16 txt-center"> 
                                            <input  type="checkbox" checked>
                                             <input name="ismust-1" value="1"  id="" type="hidden">
                                            必选
                                        </label>
                                        <label class="control-label w20 z f16 txt-center">所在城市</label>
                                        <input name="param-name-1" type="hidden" value="称呼"> 
                                        <input type="hidden" name="input-type-0" value="single-line">
                                         <input type="hidden" name="param-name-1-param" value="null">
                                        <div class="w68 z">
                                            <input  type="text" class="w100 p14" placeholder="如：张先生,李小姐"  disabled="" value="如：北京，海淀;河北，唐山"> 
                                             <input name="tip-1" type="hidden" value="如：北京，海淀;河北，唐山"> 
                                            <span class="help-block m-b-none">
                                            </span>
                                        </div>     
                                </div>

                                 <div class="cl apply-list-form mtv">
                                        <label class="w10 z f16 txt-center"> 
                                            <input  type="checkbox" checked>
                                             <input name="ismust-2" value="1"  id="" type="hidden">
                                            必选
                                        </label>
                                        <label class="control-label w20 z f16 txt-center">采购周期和数量</label>
                                        <input name="param-name-2" type="hidden" value="称呼"> 
                                        <input type="hidden" name="input-type-0" value="single-line">
                                         <input type="hidden" name="param-name-2-param" value="null">
                                        <div class="w68 z">
                                            <input  type="text" class="w100 p14" placeholder="如:300箱/年"  disabled="" value="如:300箱/年"> 
                                             <input name="tip-2" type="hidden" value="如:300箱/年"> 
                                            <span class="help-block m-b-none">
                                            </span>
                                        </div>     
                                </div>

                              

                                <h3 class="mtv">
                                   其他
                                </h3>
                                <h4 class="mlm mtm">未添加其他栏位（即其他用户对此商品有需求不需要提供额外信息）</h4>

                                <div class="user-define">
                                    <div class="cl apply-list-form mtv">
                                            <label class="w10 z f16 txt-center"> 
                                                <input name="ismust-1" value="1" id="" type="checkbox"  checked>
                                                必选
                                            </label>
                                            <label class=" w20 z f16 txt-center">
                                                <input name="param-name-1" value="" id="" type="text" class="w90 p14" placeholder="单行文本框" >
                                                <input type="hidden" name="input-type-1" value="single-line">

                                                <input type="hidden" name="param-name-1-param" value="null">
                                            </label>
                                            <div class="w68 z">
                                                <input name="tip-1" type="text" required class="w100 p14" placeholder="提示信息写这里"> 
                                            </div>
                                            <div class="w5 z txt-center remove-param">
                                            删除
                                            </div>
                                    </div>
                                   
                                </div>



                            </div>

                            <aside class="y w20 mrv p14">

                                <h3 class="txt-center mtm">常用栏位</h3>
                                <hr class="w80">
                                <div class="cl">
                                    <div class="z w40 ptn pbn plm prm f14 bg-gray mlm">
                                        月采购量
                                    </div>
                                    <div class="y w40 ptn pbn plm prm f14 bg-gray mlw">
                                        所在城市
                                    </div>
                                </div>
                                <div class="cl mtm">
                                    <div class="z w40 ptn pbn plm prm f14 bg-gray mlm">
                                        收货地址
                                    </div>
                                   
                                </div>
                                <h3 class="txt-center mtm">自定义栏位</h3>
                                <hr class="w80">
                                <button type="button" class="center-block btn btn-block btn-outline w90 mtn bg-gray js-single-line-button">单行文本框</button>

                                <button type="button" class="center-block btn btn-block btn-outline w90 mtn bg-gray js-multiple-line-button">多行文本框</button>
                                
                                <button type="button" class="center-block btn btn-block btn-outline w90 mtn bg-gray js-radio-button">单选文本框</button>
                                <button type="button" class="center-block btn btn-block btn-outline w90 mtn bg-gray js-checkbox-button">多选文本框</button>
                                <button type="button" class="center-block btn btn-block btn-outline w90 mtn bg-gray js-single-image-button">单图片框</button>
                                <button type="button" class="center-block btn btn-block btn-outline w90 mtn bg-gray js-multiple-image-button">多图片框</button>
                                <button type="button" class="center-block btn btn-block btn-outline w90 mtn bg-gray js-file-button">上传文件框</button> 
                            </aside>
                        </div>
                    </div>
                    
                </form>
                <div class="ptv cl pbv prv">
                    <button class="mlv btn post_btn y btn_orange" type="" id="param-submit">确定</button>
                    <button class="btn post_btn y" href="javascript:;" title="">取消</button>
                </div>
            </div>
        </div>
    </div>

    


      

    </body>
</html>







    <script src="{{asset('s9/js/msgTip.js')}}"></script>
    <!--[if lt IE 9]> 
        <script src="../js/plugin/html5.min.js"></script>
    <![endif]-->
    <!--[if (gte IE 6)&(lte IE 8)]>
        <script src="../js/plugin/selectivizr.min.js"></script>
    <![endif]-->
    <script src="{{asset('s9/js/totop.js')}}"></script>
    <script  src="{{asset('s9/js/new_enter.js')}}"></script>
    <script src="{{asset('s9/js/form.js')}}" type="text/javascript"></script> 


<script type="text/javascript">
    
     //表单提交
        $('#param-submit').click(function(){
            alert(111);
            $('#param').ajaxSubmit({
                type: 'post',
                url: '/goodsuserparam',
                dataType: 'json',
                success: function(msg) {
                    console.log(msg);
                    // if (msg.status) {
                    //     window.location.href="faq?title=faq";
                    // } else {
                    //     alert(msg.msg);
                    // }
                },
                error: function() {
                    errorTip("请求错误,稍后再试");
                }

            });
            return false;
        })
</script>


<script type="text/javascript">
$(function(){  
    var num = 5;
    //单行文本框点击
    $('.js-single-line-button').click(function(){
        num++;
        $('.user-define').append('<div class="cl apply-list-form mtv">'
            +'<label class="w10 z f16 txt-center"> <input name="ismust-'+num+'" value="" id="" type="checkbox"  checked>必选</label>'
            +'<label class=" w20 z f16 txt-center"><input name="param-name-'+num+'" value="" id="" type="text" class="w90 p14" placeholder="单行文本框">'
             +'<input type="hidden" name="input-type-'+num+'" value="single-line">'
            +'<input type="hidden" name="param-name-'+num+'-param" value="null">'
           
            +'</label>'

            +'<div class="w68 z"><input name="tip-'+num+'" type="text" class="w100 p14" placeholder="提示信息写这里"><span class="help-block m-b-none"></span></div>'
            +'<div class="w5 z txt-center remove-param">删除</div></div>');
    });

    //多行文本框点击
    $('.js-multiple-line-button').click(function(){
        num++;
        $('.user-define').append('<div class="cl apply-list-form mtv">'
            +'<label class="w10 z f16 txt-center"> <input name="ismust-'+num+'" value="" id="" type="checkbox"  checked>必选</label>'
            +'<label class=" w20 z f16 txt-center"><input name="param-name-'+num+'" value="" id="" type="text" class="w90 p14" placeholder="多行文本框"  input-type="multiple-line" >'
             +'<input type="hidden" name="param-name-'+num+'-param" value="null">'
            +'<input type="hidden" name="input-type-'+num+'" value="multiple-line">'
            +'</label>'
            +'<div class="w68 z"><input name="tip-'+num+'" type="text" class="w100 p14" placeholder="提示信息写这里"><span class="help-block m-b-none"></span></div>'
            +'<div class="w5 z txt-center remove-param">删除</div></div>');
    });
    // 单选按钮点击
     $('.js-radio-button').click(function(){
        num++;
        $('.user-define').append('<div class="cl apply-list-form mtv">'
            +'<label class="w10 z f16 txt-center"> <input name="ismust-'+num+'" value="" id="" type="checkbox"  checked>必选</label>'
            +'<label class=" w20 z f16 txt-center"><input name="param-name-'+num+'" value="" id="" type="text" class="w90 p14" placeholder="单选按钮">'

            +'<input type="hidden" name="input-type-'+num+'" value="radio">'

            +'</label>'

            +'<div class="w68 z"><input name="tip-'+num+'" type="text" class="w100 p14" placeholder="提示信息写这里"><span class="help-block m-b-none">'+
                                                '选项列表</span>'+
                                                '<div class="choose-box">'+
                                                    '<div class=" flex-box  w45 mtm ">'+
                                                        '<input name="param-name-'+num+'-param[]" class="p14" type="text">'+
                                                        '<i class="js-remove-param-param">删除</i>'+
                                                    '</div>'+
                                            
                                                    '<div class="mtm w30" style="cursor: pointer;">'+
                                                        '<img data-rel="'+num+'" src="'+'/s9/img/plus.png'+'">'+
                                                    '</div>'+

                                                '</div></div>'
            +'<div class="w5 z txt-center remove-param">删除</div></div>');
    });

     // 多选按钮点击
    $('.js-checkbox-button').click(function(){
        num++;
        $('.user-define').append('<div class="cl apply-list-form mtv">'
            +'<label class="w10 z f16 txt-center"> <input name="ismust-'+num+'" value="" id="" type="checkbox"  checked>必选</label>'
            +'<label class=" w20 z f16 txt-center"><input name="param-name-'+num+'" value="" id="" type="text" class="w90 p14" placeholder="多选按钮"  >'
            +'<input type="hidden" name="input-type-'+num+'" value="checkbox">'

            +'</label>'

            +'<div class="w68 z"><input name="tip-'+num+'" type="text" class="w100 p14" placeholder="提示信息写这里"><span class="help-block m-b-none">'+
                                                '选项列表</span>'+
                                                '<div class="choose-box">'+
                                                    '<div class=" flex-box  w45 mtm ">'+
                                                        '<input name="param-name-'+num+'-param[]" class="p14" type="text">'+
                                                        '<i class="js-remove-param-param">删除</i>'+
                                                    '</div>'+
                                            
                                                    '<div class="mtm w30" style="cursor: pointer;">'+
                                                        '<img data-rel="'+num+'" src="'+'/s9/img/plus.png'+'">'+
                                                    '</div>'+
                                                '</div></div>'
            +'<div class="w5 z txt-center remove-param">删除</div></div>');
    });

    // 单图片文本框点击
    $('.js-single-image-button').click(function(){
        num++;
        $('.user-define').append('<div class="cl apply-list-form mtv">'
            +'<label class="w10 z f16 txt-center"> <input name="ismust-'+num+'" value="" id="" type="checkbox"  checked>必选</label>'
            +'<label class=" w20 z f16 txt-center"><input name="param-name-'+num+'" value="" id="" type="text" class="w90 p14" placeholder="单图片框"  >'
             +'<input type="hidden" name="input-type-'+num+'" value="single-image">'
             +'<input type="hidden" name="param-name-'+num+'-param" value="null">'
           
            +'</label>'
            +'<div class="w68 z"><input name="tip-'+num+'" type="text" class="w100 p14" placeholder="提示信息写这里"></div>'
            +'<div class="w5 z txt-center remove-param">删除</div></div>');
    });
    // 多图片文本框点击
    $('.js-multiple-image-button').click(function(){
        num++;
        $('.user-define').append('<div class="cl apply-list-form mtv">'
            +'<label class="w10 z f16 txt-center"> <input name="ismust-'+num+'" value="" id="" type="checkbox"  checked>必选</label>'
            +'<label class=" w20 z f16 txt-center"><input name="param-name-'+num+'" value="" id="" type="text" class="w90 p14" placeholder="多图片框"  >'
             +'<input type="hidden" name="param-name-'+num+'-param" value="null">'
            +'<input type="hidden" name="input-type-'+num+'" value="multiple-image">'
            +'</label>'
            +'<div class="w68 z"><input name="tip-'+num+'" type="text" class="w100 p14" placeholder="提示信息写这里"></div>'
            +'<div class="w5 z txt-center remove-param">删除</div></div>');
    });


 // 文件文本框点击
    $('.js-file-button').click(function(){
        num++;
        $('.user-define').append('<div class="cl apply-list-form mtv">'
            +'<label class="w10 z f16 txt-center"> <input name="ismust-'+num+'" value="" id="" type="checkbox"  checked>必选</label>'
            +'<label class=" w20 z f16 txt-center"><input name="param-name-'+num+'" value="" id="" type="text" class="w90 p14" placeholder="文件框"  >'
             +'<input type="hidden" name="param-name-'+num+'-param" value="null">'
            +'<input type="hidden" name="input-type-'+num+'" value="file">'
            +'</label>'
            +'<div class="w68 z"><input name="tip-'+num+'" type="text" class="w100 p14" placeholder="提示信息写这里"></div>'
            +'<div class="w5 z txt-center remove-param">删除</div></div>');
    });






    //删除参数
    $(document).on('click','.remove-param',function(){
        $(this).closest('.cl').remove();
    });
    //删除参数的参数

    $(document).on('click','.js-remove-param-param',function(){
        $(this).closest('.flex-box').remove();
    });

    //添加参数的参数

    $(document).on('click','.choose-box div img',function(){
        var rel =  $(this).attr('data-rel');

        $(this).closest('div').before('<div class="flex-box  w45 mtm"><input  name="param-name-'+ rel +'-param[]" class=" p14" type="text"><i class="js-remove-param-param">删除</i></div>');
    });

  

});

</script>



