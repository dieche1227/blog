<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>添加商品</title>
          <!-- modal css-->
       
        <!-- 七牛 css-->
    
        <link rel="stylesheet" href="{{asset('qiniu/styles/main.css')}}">
        <link rel="stylesheet" href="{{asset('qiniu/styles/highlight.css')}}">


        <link rel="stylesheet" href="{{asset('s9/css/common.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/home.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/module.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/addbid/uicn.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/upload.css')}}">
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
                <form action="#" method="get" id="afaq">

                    <input type="hidden" name="goodsuid" value="{{ $goodsInfo['guid'] }}">
                    <div class="main_warp">
                        <div class="title cl">
                            <div class="h1 z">商品</div>
                            <div class="h3 z mln"> 
                                －添加商品基本信息
                            </div>
                             
                           
                           

                        </div>
                        <div class="account_warp ptv warp_list">
                            <div class="cont mtv cl">
                                <em class="h2 lin54 z">商品/服务名称：</em>
                                <span class="z">
                                    <input class="nav_in" type="text" name="name" value="" placeholder="">
                                </span>
                                <span class="marl lin54 h6">iphone6</span>
                            </div>
                            <div class="cont mtv cl">
                                <em class="h2 lin54 z">最小计量单位：</em>
                                <span class="z">
                                    <input class="nav_in" type="text" name="unit" value="" placeholder="">
                                </span>
                                <span class="marl lin54 h6">例：/人，/次，/人/次</span>
                            </div>
                            <li class="li cl mtv">
                                <span class="lef z h2" style="width: 170px;margin-right: 35px;display: inline-block;">采购数量及周期：</span>
                                <div class="z rit ptm">
                                    <p class="input">
                                        <input style="width: 250px;padding: 14px;font-size: 16px;color: #5d6d7e;" class="h5" type="text" name="shuliang" value="" placeholder="">
                                    </p>
                                </div>

                                <div class="z rit ptm mln">
                                    <p class="input">
                                        <input style="width: 100px;padding: 14px;font-size: 16px;color: #5d6d7e;" class="h5" type="text" name="danwei" value="" placeholder="" disabled="disabled">
                                    </p>
                                </div>


                                <div class="z rit mlv">
                                    <span class="cl man on">
                                        <em class="z">
                                            <input class="z asv" type="radio" checked="checked" name="zhouqi" value="/月">
                                        </em>
                                        <strong class="z h5">/月</strong>
                                    </span>
                                    <span class="cl woman">
                                        <em class="z">
                                            <input class="z" type="radio" name="zhouqi" value="/年">
                                        </em>
                                        <strong class="z h5">/年</strong>
                                    </span>
                                    <span class="cl woman">
                                        <em class="z">
                                            <input class="z" type="radio" name="zhouqi" value="/次">
                                        </em>
                                        <strong class="z h5">/次</strong>
                                    </span>
                                </div>
                            </li>
                            <li class="li city cl">
                                    <span class="lef z h2">所在城市：</span>
                                    <div class="z rit">
                                        <div class="option_cont cl">
                                            <div class="option sel_w_area cur pos z">
                                                <input class="control_input" type="hidden" name="" value="">
                                                    <span>北京</span>
                                                    <i class="arrow"></i>
                                                    <ol class="sel_option" style="display: none;">
                                                        {!! $provinces !!}
                                                    </ol>
                                            </div>
                                            <div class="option sel_w_area cur pos z ">
                                                    <input class="control_input" type="hidden" name="city" value="">
                                                    <span class="ui_select_val">北京</span>
                                                    <i class="arrow"></i>
                                                    <ol class="sel_option citylis" style="" >
  
                                                    </ol>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <div class="cont mtv cl">
                                <em class="h2 lin54 z">商品参数：</em>
                                <div class="origin_box z">
                                    <div class="cl">
                                        <p class="ele z">参数(产地)</p>
                                        <p class="cont z">参数详情(北京)</p>
                                    </div>
                                    <foreach name="goodinfo['parameters']" item="vo" key="k" >
                                        <div class="origin_item cl"> 
                                            <p class="ele txt_half"> {$vo['name']} </p> 
                                            <p class="cont txt_half"> {$vo['desc']}</p> 
                                            <a href="javascript:;" class="remove" rel="{$vo['id']}">删除</a>  
                                        </div>
                                    </foreach>
                                    <div class="cl" id="addBox">    
                                        <input type="text" name="para_name" class="control_input ele z" value="">
                                        <input type="text" name="para_desc" class="control_input cont z" value="">
                                    </div>                                  
                                    <a href="javascript:;" class="btn btn_orange" id="addEle">添加</a>
                                </div>
                            </div>
                            <div class="cont mtv cl">
                                <em class="h2 z">商品图片：</em>
                                <div class="up-thumb-box z cont" id="picupload">
                                    <ul id="queue" class="cl" data-listidx="0">
                                        <li style="display: none; cursor: pointer;"></li>
                                     
                                            <li class="up-thumb-item">
                                            <img style="width:280px;height:210px" src="{{asset('s9/images/cont.png')}}" alt="">
                                            <div class="thumb-oper" rel="{$vo['id']}" style="bottom: -80px;">
                                               <!--  <a class="set cov" href="javascript:;">
                                                    <i class="icon-pic-round"></i>
                                                    <span class="">封面</span>
                                                </a> -->
                                                <a class="set del" href="javascript:;">
                                                    <i class="icon-error-thin"></i>
                                                    <span id="up_del" class="">删除</span>
                                                </a>
                                            </div>
                                            </li>
                                        
                                     
                                        <div class="up-thumb-add" id="pickfiles">
                                            <div class="upload-icon">
                                                <input type="file" accept=".jpg,.png,.gif,.jpeg" class="upload-icon-file required" title="上传" name="project" multiple="multiple">
                                                <i class="icon-add-round"></i>
                                            </div>
                                            <p class="tit">上传商品图片</p>
                                            <p class="tip">格式:JPG,PNG,GIF</p>
                                            <p class="tip">大小:小于10M</p>
                                            <p class="tip">可拖拽上传</p>
                                        </div>
                                         <input type="hidden" id="domain" value="http://img.maixiangtong.com/">
                                    </ul>
                            
                                    <input name="list1SortOrder" type="hidden">
                                </div>
                            </div> 
                              <!-- 商品介绍 -->
                            <div class="cont mtv cl Personal">
                               <em class="h2 lin54 z">商品介绍：</em>
                                <div class="txta z">
                                    <!-- 加载编辑器的容器 -->
<script id="container" name="content" type="text/plain" style="width: 100%;margin:0 auto;">
这里写产品介绍
</script>

<!-- 实例化编辑器 -->
<script type="text/javascript">
  
     var ue =  UE.getEditor('container', {
                    autoHeight: false,
                    lang:"zh-cn",
                    });
        ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.    
    });
</script>
                                <!-- <div class="txta z">
                                    <textarea class="h5" name="intro" ></textarea>
                                    <p>还可输入<em>500</em>个字符</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                  


                </form>



                <div class="ptv cl pbv prv">
                    <button class="mlv btn post_btn y btn_orange" type="" id="testsub">确定</button>
                    <button class="btn post_btn y" href="javascript:;" title="">取消</button>
                </div>
            </div>
        </div>

        <div class="warp_1180 wpn cl">
            <!-- 右侧内容 -->
            <div class="main more z mtv">
                <form action="#" method="get" id="param">

                    <input type="hidden" name="goodsuid" value="{{ $goodsInfo['guid'] }}">
                    <div class="main_warp">
                        <div class="title cl">
                            <div class="h1 z">商品</div>
                            <div class="h3 z mln"> 
                                －如果其他用户对此商品有需求需要填写表单
                            </div>

                            <button class="mlv btn post_btn y btn_orange" type="" id="edit-param">编辑</button>
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

    <!-- 计量单位modal -->
    <a id="jiliang" href="javascript:;"  class="link" target="_blank" data-target="#modal_jiliang">保密协议</a>
    <div class="modal" id="modal_jiliang">
        <div class="modal_effect" style="">
            <div class="modal_main" style="width: 840px;padding:40px 20px;">
                <i class="icon-close hg_i">取消</i>
                <h3 style="height: 55px; text-align: center; ">当前所有计量单位 <button class="mlv btn post_btn y btn_orange" style="margin-right: 100px;" id="addnewjiliang" type="">添加新计量单位</button></h3>

                <div class="hg_detail">
                    @foreach ($units as $key => $unit)
                        <h5 class="f18">{{ $key }}</h5>
                        <div id="danwei" class="p1">
                            @foreach ($unit as $k => $v)
                                <a class='f16 mlv'  style="cursor:hand">{{ $v['name'] }}</a> 
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>  
        </div>
    </div>


      

    </body>
</html>




    <script src="{{asset('s9/js/totop.js')}}"></script>

    <script src="{{asset('s9/js/msgTip.js')}}"></script>


<script type="text/javascript" src="{{asset('qiniu/scripts/bootstrap.min.js')}}"></script>

<!-- 引入plupload -->
<script type="text/javascript" src="{{asset('qiniu/scripts/moxie.js')}}"></script>
<script type="text/javascript" src="{{asset('qiniu/scripts/plupload.dev.js')}}"></script>

<!-- qiniujs -->
<script type="text/javascript" src="{{asset('qiniu/scripts/zh_CN.js')}}"></script>
<script type="text/javascript" src="{{asset('qiniu/scripts/ui.js')}}"></script>
<script type="text/javascript" src="{{asset('qiniu/scripts/qiniu.js')}}"></script>
<script type="text/javascript" src="{{asset('qiniu/scripts/highlight.js')}}"></script>
<script type="text/javascript" src="{{asset('qiniu/scripts/main.js')}}"></script>
<script type="text/javascript">hljs.initHighlightingOnLoad();</script>

<script>
$(function(){
    jw_qiniu.init({
        uptoken_url:'/qiniu1',
        key:function(up, file){
            return file.name;
        },
        success:function(up, file, info){

             var liId = file.id;
                $('#'+liId).empty().append('<img style="width:280px;height:210px" src="'+"http://img.maixiangtong.com/"+file.target_name+'" alt="">'+
                    '<div class="thumb-oper" rel="" style="bottom: -80px;">'+
                        '<a class="set cov" href="javascript:;">'+
                            '<i class="icon-pic-round"></i>'+
                            '<span class="">封面</span>'+
                        '</a>'+
                        '<a class="set del" href="javascript:;">'+
                            '<i class="icon-error-thin"></i>'+
                            '<span id="up_del" class="">删除</span>'+
                        '</a>'+
                    '</div>').addClass('up-thumb-item');
           
        }
    });
});
</script>


<!-- 商品图片鼠标划入划出效果 -->
<script type="text/javascript">
  $(document).on('mouseenter', '.up-thumb-item', function(){
       $(this).find('.thumb-oper')
           .stop()
           .animate({
               'bottom' :   0
           },200);
    });
    $(document).on('mouseleave', '.up-thumb-item', function(){
       $(this).find('.thumb-oper')
           .stop()
           .animate({
               'bottom' :   -80
           },150);
    });
</script>
    <!--   -->

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

    <script src="{{asset('s9/js/modal.js')}}"></script>

<!-- 城市选择 -->
<script type="text/javascript">
  var qcitys = {};
    $('.procit').click(function(){
        var ob = $(this);
        var cy = ob.attr('rel');
        var url = '/area/'+cy;
        if(qcitys[cy]==undefined){
            $.ajax({
                type:'get',
                async:false,
                url : url,
                data:'id='+$(this).attr('rel'),
                dataType:'json',
                success:function(msg){
                     
                    console.log(msg);
                    $("input[name=city]").val('').parent().find('.ui_select_val').removeClass('Selcolor').html('请选择');
                    $('.citylis').empty().html(msg.data);
                    qcitys[cy] = msg.data;
                },
                error:function(){
                    
                }
            });

        }else{
             $("input[name=city]").val('').parent().find('.ui_select_val').removeClass('Selcolor').html('请选择');
            $('.citylis').empty().html(qcitys[cy]);
        }
    });
</script>

<script type="text/javascript">
    // 添加参数
    $(document).on('click','#addEle',function(){
        //alert(11);
        var  para_name= $("input[name=para_name]").val();
        var para_desc = $("input[name=para_desc]").val();
        var gid = $("input[name=goodsuid]").val();


        if ( $.trim(para_name) && $.trim(para_desc) ) {
            $.ajax({
            url: '/goodsparam',
            type: 'post',
            data: {
                key : para_name,
                value : para_desc,
                goods_guid  : gid,
            },
            dataType: 'json',
            success: function(r) {
                console.log(r);
                globalTip({"msg":r.msg,"setTime":5});
                if(r.status){
                    var addItem = '<div class="origin_item cl"> <p class="ele txt_half"> '+para_name+' </p> <p class="cont txt_half"> '+para_desc+' </p> <a href="javascript:;" class="remove" rel="'+r.id+'">删除</a> </div>'
                        $("#addBox").before(addItem);
                        $("input[name=para_name]").val("");
                        $("input[name=para_desc]").val("");
                   
                }
            }
        });
        

            
        } else {
            globalTip({"msg":"内容不能为空","setTime":5});
            return false;
        }     
    });
    // 删除参数
    $(document).on('click','.origin_item .remove',function(){

        var id = $(this).attr('rel');
        var $this = $(this);
        $.ajax({
            url: '/delpara',
            type: 'post',
            data: {
                id  : id,
            },
            dataType: 'json',
            success: function(r) {
                globalTip({"msg":r.message,"setTime":5});
                console.log(r);
                if(r.status){
                    $this.parent(".origin_item").remove();
                    }
                }
            });
    })
    
</script>

<script type="text/javascript">
    
       //以下为计量单位js
        var tmppd=true;
        $('input[name=unit]').focus(function(){
            if(tmppd){
                $('#jiliang').trigger('click');
                $('.modal_effect').css('top','34px');
            }
        }); 
        $('input[name=unit]').blur(function(){
          var tmp=$('input[name=jiliang]').val();
          $('input[name=danwei]').val(tmp);
        });
       $('#danwei a').click(function(){
            var tmp=$(this).html();
          $('input[name=unit]').val(tmp);
          $('input[name=danwei]').val(tmp);
          $('.icon-close').trigger('click');
       });
       $('#addnewjiliang').click(function(){
           tmppd=false;
          $('input[name=unit]').focus();
          $('.icon-close').trigger('click');
       });

</script>


<script type="text/javascript">
    
     //表单提交
        $('#param-submit').click(function(){
            alert(111);
            $('#param').ajaxSubmit({
                type: 'post',
                url: '/goodsuserparam',
                dataType: 'json',
                success: function(msg) {
                    if (msg.status) {
                        window.location.href="faq?title=faq";
                    } else {
                        alert(msg.msg);
                    }
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
    var num = 1;
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



