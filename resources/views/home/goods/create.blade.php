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
                <form action="#" method="get" id="afaq" onSubmit="return false;">

                    <input type="hidden" name="goodsuid" value="{{ $goodsInfo['guid'] }}">
                    <div class="main_warp">
                        <div class="title cl">
                            <div class="h1 z">商品/服务</div>
                            <div class="h3 z mln"> 
                                －添加商品/服务基本信息
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
                            <!-- 采购周期 -->
                          <!--   <li class="li cl mtv">
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
                            </li> -->
                            <!-- 所在城市 -->
                           <!--  <li class="li city cl">
                                    <span class="lef z h2">所在城市：</span>
                                    <div class="z rit">
                                        <div class="option_cont cl">
                                            <div class="option sel_w_area cur pos z">
                                                <input class="control_input" type="hidden" name="province" value="">
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
                            </li> -->
                            <div class="cont mtv cl">
                                <em class="h2 lin54 z">商品参数：</em>
                                <div class="origin_box z">
                                    <div class="cl">
                                        <p class="ele z">参数(产地)</p>
                                        <p class="cont z">参数详情(北京)</p>
                                    </div>
                                    
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
                                       <!--  <li style="display: none; cursor: pointer;"></li> -->
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
                                <div class="txta z" style="width:100%;">
                                    <!-- 加载编辑器的容器 -->
<script id="container" name="content" type="text/plain" style="width: 100%;margin:0 auto;">
这里写产品介绍
</script>

<!-- 实例化编辑器 -->
<!-- 点击确定添加商品 -->
<script type="text/javascript">
//     var ue = UE.getEditor('container', {
//     toolbars: [
//             ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
//         ],
//     elementPathEnabled: false,
//     enableContextMenu: false,
//     autoClearEmptyNode:true,
//     wordCount:false,
//     imagePopup:false,
//     autotypeset:{ indent: true,imageBlockLine: 'center' }
// });

$(function(){




     var ue =  UE.getEditor('container', {
                     toolbars: [
            ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'simpleupload', 'fullscreen']
        ],  
                    autoHeight: false,
                    lang:"zh-cn",
                    });
        ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值. 
    });


        $('#formSubmit').click(function(){
                //获取html内容，返回: <p>hello</p>
                var description = ue.getContent(); 

                var goodsuid = $('input[name="goodsuid"]').val();
                    // 计量单位
                var unit = $('input[name="unit"]').val();
                var name = $('input[name="name"]').val();
                //采购数量及周期
                // var  shuliang = $('input[name="shuliang"]').val();
                // var  danwei = $('input[name="danwei"]').val();
                // var zhouqi =  $('input[name="zhouqi"]').val();
                // var province = $('input[name="province"]').val();
                // var city = $('input[name="city"]').val();
                
              $.ajax({
                     type:'post',
                     //async:false,
                     url : '/goods',
                     data:{
                        goods_guid: goodsuid,
                        name  : name,
                        // shuliang: shuliang,
                        // danwei: danwei,
                        // zhouqi: zhouqi,
                        // province:province,
                        // city:city,
                        description:description,
                        unit:unit
                     },
                     dataType:'json',
                     success:function(r){
                        globalTip({"msg":r.msg,
                                   "setTime":5,
                                   'URL':'/goodsuserparam/create?goodsuid={{ $goodsInfo['guid'] }}',
                                    'jump':true,
                                });
                     },
                     error:function(){
                        
                     }
                 });
            }); 
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
                    <button class="mlv btn post_btn y btn_orange" type="" id="formSubmit" >确定</button>
                    <button class="btn post_btn y" href="javascript:;" title="">取消</button>
                </div>
            </div>
        </div>

      
    </div>

    <!-- 计量单位modal -->
    <a id="jiliang" href="javascript:;"  class="link" target="_blank" data-target="#modal_jiliang"></a>
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

<!-- 图片上传 -->
<script>
$(function(){
    jw_qiniu.init({
        uptoken_url:'/qiniu1',
        key:function(up, file){
            return file.name;
        },
        success:function(up, file, info){
            var goodsuid = $('input[name="goodsuid"]').val();
            // alert(file.name);
            // alert(file.type);
            // alert(file.size);
             var liId = file.id;
                $('#'+liId).empty().append('<img style="width:280px;height:210px" src="'+"http://img.maixiangtong.com/"+file.target_name+'" alt="">'+
                    '<div class="thumb-oper" rel="" style="bottom: -80px;">'+
                       
                       
                        '<a class="set del js-img-del"' +'path="'+file.target_name+'" ' +' href="javascript:;">' +
                            '<i class="icon-error-thin"></i>'+
                            '<span  '+' class="">删除</span>'+
                        '</a>'+
                    '</div>').addClass('up-thumb-item');
            //发送请求，通知后台PHP 告诉后台这个图片是哪个商品的
             $.ajax({
                 type:'post',
                 async:false,
                 url : '/goodsimg',
                 data:{
                    goods_guid: goodsuid,
                    name  : file.name,
                    path: file.target_name,
                    size: file.size,
                    type: file.type
                 },
                 dataType:'json',
                 success:function(msg){
                    console.log(msg);  
                   
                 },
                 error:function(){
                    
                 }
             });
           
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

<!-- 商品图片删除 -->

<script type="text/javascript">
     $(document).on('click', '.js-img-del', function(){
        //alert(0);
       var path = $(this).attr('path');
        //发送请求，通知后台PHP 告诉后台这个图片是哪个商品的
             $.ajax({
                 type:'post',
                 async:false,
                 url : '/goodsimg/' + path,
                 data:{
                    _method: "DELETE",
                 },
                 dataType:'json',
                 success:function(msg){
                    console.log(msg);  
                   
                 },
                 error:function(){
                    
                 }
             });
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
<!-- <script type="text/javascript">
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
</script> -->
<!-- 为商品 添加删除参数-->
<script type="text/javascript">
   
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
                    var addItem = '<div class="origin_item cl"> <p class="ele txt_half"> '+para_name+' </p> <p class="cont txt_half"> '+para_desc+' </p> <a href="javascript:;" class="remove" rel="'+r.guid+'">删除</a> </div>'
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

        var guid = $(this).attr('rel');
        var $this = $(this);
        $.ajax({
            url: '/goodsparam/'+guid,
            type: 'post',
            data: {
                _method: 'DELETE',
            },
            dataType: 'json',
            success: function(r) {
                globalTip({"msg":r.msg,"setTime":5});
                //console.log(r);
                if(r.status){
                    $this.parent(".origin_item").remove();
                    }
                }
            });
    })
    
</script>
<!-- 商品计量单位js-->
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
<script src="{{asset('s9/js/jquery-ui/jquery-ui.js')}}"></script>
<!-- 商品图片排序-->
<script>
    $("#queue").sortable({update: function(event,ui){
                                            console.log(event);
                                            console.log(ui);
                                         //拼JSON 数据，键表示广告ID,值表示顺序值；
                                         //{id:sortnum,};
                     var text="";
                      $('#queue li').each(function(index,element){
                        text = text + $(this).find('.thumb-oper').find('.js-img-del').attr("path")+':'+index+',';
                      });
                     

                                      
                        text=text.substring(0,text.length-1);
                                          //text=text+'}'; 
                                          //alert(text); 
                                        
                      $.ajax({
                            type:'post',
                            url:'/goodsimg/1',
                            data:'_method=PUT&orderBy='+text,
                            dataType:'json',
                            success:function(msg){
                              if(msg.state){
                                    alert(msg.msg);
                              }else{
                                alert(msg.msg);
                              }
                            },
                            error:function(){alert("操作失败！");}
                            });
                     } 
        });
</script>







