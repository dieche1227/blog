<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title>商品列表</title>
        <link rel="stylesheet" href="./Public/fonts/iconfont.css">
        <link rel="stylesheet" href="{{asset('/s9/css/common.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/home.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/module.css')}}">
        <link rel="stylesheet" href="{{asset('static/css/bootstrap.min.css')}}" />
    </head>

 
 
    <!-- {/* 选择分类 */} -->
    
   
<body>
    <!-- 头部开始 -->
    <div class="bg_white">
        <div class="wpn cl">
            <a class="hlogo" href="/" title=""></a>
            <ul class="hnav cl">
                <li ><a href="/goodlist">商品库</a></li>
                <li class="on"><a href="/quanzilist">圈子</a></li>
                <li ><a href="/bidlist">活动</a></li>
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


</style>
    <div class="bg_white pt58">
    <!-- 正在进行的比赛 -->
        
      
                <div class="wpn cl">
                    <h2 class="htit">
                        <a href="/singlelist/{$zone['id']}">{$zone['name']}</a>
                        <foreach name="zone['zi']" item="son" key="ddd" >
                            <small><a href="/singlelist/{$son['id']}">{$son['name']}</a></small>
                        </foreach>
                    </h2>
                    <ul class="works_on">
                        @foreach ($goods['data'] as $good)
                            <li>
                                <a href="/goodinfo/{$vo['id']}" class="cover">
                                    <img src="{{$good['faceImg']}}" alt="" width="280" height="210">
                                </a>
                                <div class="info">
                                    <h4><a href="/goodinfo/{$vo['id']}"> {{ $good['name'] }}</a></h4>
                                    <p class="txt_half">329会员</p>
                                    
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
         

        
    </div>

    <div class="container mtv mbv">

     
        <div class="wrap_1180 bg_white wpn  plm prm">
             {!! $pageHtml  !!} 
        </div>
    </div>
</body>
       

    
       
    


