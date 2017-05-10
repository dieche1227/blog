<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <block name="title"><title>标题</title></block>
        
        <link rel="stylesheet" href="{{asset('s9/css/common.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/home.css')}}">
        <link rel="stylesheet" href="{{asset('s9/css/module.css')}}">
        

        <link rel="stylesheet" href="{{asset('s9/css/list.css')}}">
		<link rel="stylesheet" href="{{asset('s9/css/fabu.css')}}">
		<link rel="stylesheet" href="{{asset('s9/css/det.css')}}">
		<link rel="stylesheet" href="{{asset('s9/css/addbid/uicn.css')}}">
		<link rel="stylesheet" href="{{asset('s9/css/addbid/new_enter.css')}}">
		<link rel="stylesheet" href="{{asset('s9/css/modal.css')}}">
		<link rel="stylesheet" href="{{asset('s9/css/form_basic.css')}}">
	<style>
		.media-object{
			width:40%;
		}
		.media-body{
			width:60%;
		}
	</style>
	<style type="text/css">
		/*/* css 重置 */
		.js{width:90%; margin:10px auto 0 auto; }
		.js p{ padding:5px 0; font-weight:bold; overflow:hidden;  }
		.js p span{ float:right; }
		.js p span a{ color:#f00; text-decoration:underline;   }
		.js textarea{ height:100px;  width:98%; padding:5px; border:1px solid #ccc; border-top:2px solid #aaa;  border-left:2px solid #aaa;  }

		/* 本例子css */
		.game163{ position: relative; border: 1px solid #dcdddd; padding: 4px; overflow: hidden; width: 300px; }
		.game163 .bigImg{ height: 258px; position: relative;}
		.game163 .bigImg li img{ vertical-align:middle; width:300px; height:225px;   }
		.game163 .bigImg  h4{ font-size: 14px; font-weight: bold; line-height: 33px; height: 33px; padding-right: 30px; overflow: hidden; text-align: left; }

		.game163 .smallScroll{ height: 47px; margin-bottom: 6px;}
		.game163 .sPrev,.game163 .sNext{ float: left; display: block; width: 14px; height: 47px; text-indent: -9999px; background: url(images/sprites1008.png) no-repeat 0 -3046px; }
		.game163 .sNext{ background-position: 0 -2698px;}
		.game163 .sPrev:hover{ background-position: 0 -3133px;}
		.game163 .sNext:hover{ background-position: 0 -2785px;}

		.game163 .smallImg{ float:left;  margin: 0 6px; display:inline; width: 260px; overflow: hidden;}
		.game163 .smallImg ul{ height:54px;  width: 9999px; overflow: hidden; }
		.game163 .smallImg li{ float: left; padding: 0 4px 0 0; width:62px; cursor:pointer;  display: inline;  }
		.game163 .smallImg img{ border: 1px solid #dcdddd; width:60px; height:45px;  }
		.game163 .smallImg .on img{ border-color: #1e50a2;}

		.game163 .pageState{ position: absolute; top: 235px; right: 5px; font-family: "Times New Roman", serif; letter-spacing: 1px;}
		.game163 .pageState span{ color: #f00; font-size: 16px;}
		.det_hd_info > div {
	     	width: auto; 
	     	height: auto; 
	    
		}
		.det_hd_info .tag {
		    border-left: none; 
		    border-right: none; 
		    padding-left: 0px; 
		}
		.det_hd_info {
	    	padding: 0px 0 0px; 
		}
	</style>
	<style type="text/css" media="screen">
        .a{width: 100px;height:50px;background: red;cursor: pointer;display: inline-block;margin: 30px;}
    </style>





    </head>
    <body>
        <div id="ajax-hook"></div>




	
	<!-- {/* 商品信息 */} -->
	<div class="container mtv">
		<div class="wrap_1180 bg_white wpn ptv">
					<div class="main more">
						<div class="main_warp" style="padding-top: 0px;padding-bottom: 20px;">
							<div class="title cl">
								<div class="h1 z">意向招标商品</div>
							</div>
                        	<div class="title cl">
                            	<div class="f16 z">
                            		<a href="/singlelist/{$goodinfo['zid']}">{$goodinfo['fulei']}</a> 
                            		&nbsp&nbsp&nbsp&nbsp>&nbsp&nbsp&nbsp&nbsp
                            	</div>
                            	
                            	<div class="f16 z">
                            		<a href="/singlelist/{$goodinfo['zsid']}">{$goodinfo['zilei']}</a>
                            	</div>
                            	
                            	
                        	</div>
                        </div>
                    </div>
			<div class="cl">

				<div class="z media-object" id="preview">
					<div class="game163" style="margin:0 auto">
						 <ul class="bigImg" style="position: relative; width: 300px; height: 258px;">

						 	@foreach ($goodsImgs as $img)
							<!-- <foreach name="goodinfo['pics']" item="vo" key="k" > -->
								<li style="position: absolute; width: 300px; left: 0px; top: 0px; display: none;">
									<a href="" target="_blank"><img src="http://img.maixiangtong.com/{{ $img->path }}"></a>
									<h4><a href="#" target="_blank"></a></h4>
								</li>
							@endforeach
							<!-- </foreach> -->
						</ul>
						<div class="smallScroll">
							<a class="sPrev prevStop" href="javascript:void(0)">←</a>
						<div class="smallImg">
							<div class="tempWrap" style="overflow:hidden; position:relative; width:264px">
								<ul style="width: 528px; left: 0px; position: relative; overflow: hidden; padding: 0px; margin: 0px;">
									
									@foreach ($goodsImgs as $img)
										<li class="" style="float: left; width: 62px;"><a><img src="http://img.maixiangtong.com/{{ $img->path }}"></a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<a class="sNext" href="javascript:void(0)">→</a>
						</div>
						<div class="pageState"><span>2</span>/8</div>
					</div>
				</div>
				<div class="media-body det_hd_info z">

					<h2 class="mbv">{$goodinfo['name']}</h2>
					<!-- 参数列表 -->
					<dl class="cl">
						<dt class="z f14 mrv">参数名1:</dt>
						<dd class="z">
							<ul class="cl">
								<li class="f14 z mrv">参数值1</li>
								<li class="f14 z mrv">参数值3</li>
							</ul>
						</dd>
					</dl>
					<foreach name="canshus" item="canshu">
						<dl class="cl">
						<dt class="z f14 mrv">{$key}:</dt>
						<dd class="z">
							<ul class="cl">
								<foreach name="canshu" item="vo">
									<li class="f14 z mrv">{$vo}</li>
								</foreach>
							</ul>
						</dd>
						</dl>
					</foreach>

					<div class="f16 cl mtv mrv">
		    			<span>数量：</span>{$goodinfo['allnum']}/{$goodinfo['jiliang']}/
		    			<empty name="isanyue">
		    					年
		    			<else />
		    					月
		    			</empty>
					</div>
					<div class="f16 cl mrv">
		    			<span>人数</span>
		    			<a target="_blank" href="#"> {$goodinfo['usernum']}（会员）
		    			</a>
					</div>
					<!-- <div class="f16">
						<span></span>写点儿啥呢
					</div> -->
					<div class="tag_wp mlv mbw">
						<ul class="tag cl">
							<foreach name="goodinfo['parameters']" item="vo" key="k" >
								<li>{$vo['name']}:{$vo['desc']}</li>
						    </foreach>
	                    </ul>
					</div>
				
			        <div class="func f16 mlv mbw">
			            <button class="btn btn_orange z" goodid="{$goodinfo['id']}" data-target="#modal-email">对此商品也有需求</button>
						
			            <button class="btn btn_green z mlv" goodid="{$goodinfo['id']}" data-target="">分享</button>

			            <a class="btn btn-like" href="#accuse-layer" data-toggle="modal">举报</a>
			        </div>
				</div>
			</div>
		
			<!-- {/* 选项卡 */} -->
			<div class="wpn">
				<ul class="det_nav cl">
		    		<li class="on"	
		    		><a href="/goodinfo/{$goodinfo['id']}">简介</a></li>
		            <li class="on"
		            
		            >
		            <a 

		            	href="/goodmembers/{$goodinfo['id']}">会员<small>()</small></a></li>
		            <li><a href="#">活动<small>(0)</small></a></li>
		        	<li><a href="#">评论<small>(0)</small></a></li>
		    	</ul>
 			</div>
		</div>
	</div>


	<div class="container">
		<div class="wrap_1180 bg_white wpn ">
			<div class="fbox cl fbox_first mlv">
				<div class="w800 z">
						<p class="text">还记得年少时的梦么，那是永远不凋零的花</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

	<script src="{{asset('s9/js/form_basic.js')}}"></script>
	<script type="text/javascript" src="{{asset('s9/js/superslide/jquery1.42.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('s9/js/superslide/jquery.SuperSlide.2.1.js')}}"></script>

	<script type="text/javascript">
		//大图切换
		jQuery(".game163").slide({ titCell:".smallImg li", mainCell:".bigImg", effect:"fold", autoPlay:true,delayTime:200,
			startFun:function(i,p){
				//控制小图自动翻页
				if(i==0){ jQuery(".game163 .sPrev").click() } else if( i%4==0 ){ jQuery(".game163 .sNext").click()}
			}
		});
		//小图左滚动切换
		jQuery(".game163 .smallScroll").slide({ mainCell:"ul",delayTime:100,vis:4,scroll:4,effect:"left",autoPage:true,prevCell:".sPrev",nextCell:".sNext",pnLoop:false });
	</script>

	<script type="text/javascript" src="{{asset('s9/js/modal.js')}}"></script> 

	<script>
		//我 也常买

		$('#changmai').click(function(){
			var goodid = $(this).attr('goodid');
			var shuliang = $('input[name=shuliang]').val();
			shuliang = $.trim(shuliang);
			if(shuliang == '' || shuliang.length <=0){
	            globalTip({'msg':'数量不能为空','Time':3});
	            $('input[name=shuliang]').focus();
	            return false;
	         }

	        // if(!isNaN(shuliang)){
	        //  	globalTip({'msg':'只能为数字','Time':3});
	        //  	$('input[name=shuliang]').focus();
	        //      return false;
	        // }
			var danwei = $('input[name=danwei]').val();

			var zhouqi = $('input[name=zhouqi]').val();
			 data = {
	         	goodid : goodid,
	         	shuliang:shuliang,
	         	danwei:danwei,
	         	zhouqi:zhouqi,
	        };
			 $.ajax({
	            type:'post',
	            url:'/woyechangmai',
	            data:data,
	            dataType:'json',
	            success:function(msg){
	                globalTip(msg);
	              
	                return false;
	            },
	            error	: function(data){
	            	alert('网络故障');
				}
	        });
			 return false;

		})


	</script>


	


