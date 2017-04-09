
 /*
 * 竞赛首页轮播图
 * 2016-02-03
 */

$(window).load(function(){
    topSlide();
});

/*********************************************************************************************/
function topSlide(){
    var speed = 600;      //切换过程用时0.6秒
    var easing = 'easeOutExpo';
    var _btnPrev = $('#btnPrev');
    var _btnNext = $('#btnNext');
    var _parent = $('#mainSlider');
    var _slider = $('#slideInner');
    var _child = _slider.find('li').filter(':not(.clone)');
    var childWidth = _child.width();
    var childLength = _child.length;
    var currentNum = 0;
    var autoFlag = false;
    var autoTimer;
    
    var func = {

        init : function(){
            
            // 小圆点
            _parent.append('<ul id="pageCounter" class=""></ul>');
            var _pageCounter = $('#pageCounter'); 
            for (var i = 0; i < _child.length; i++) {
                _pageCounter.append('<li class="page"><span></span></li>');
            }
            var _btn = $('#pageCounter').find('.page');
            // 小圆点居中
            var  sliderOffset = $("#pageCounter").width()*(-0.5)-16;
            $("#pageCounter").css("marginLeft",sliderOffset);
            
            //前后添加图片
            var _firstChild = _slider.find('li').eq(0);
            var _lastChild = _slider.find('li').eq(childLength-1);
            _firstChild.clone().appendTo(_slider).addClass('clone');
            _slider.find('li').eq(1).clone().appendTo(_slider).addClass('clone');
            _lastChild.clone().prependTo(_slider).addClass('clone');
            _slider.find('li').eq(childLength-2).clone().prependTo(_slider).addClass('clone');
            
            _slider.css({'width':childWidth*(childLength+4)});
            _btn.eq(0).addClass('current');
            _firstChild.addClass('current');
            
            func.autoPlay();
        },
        
        action : function(index, type){
            var _btn = $('#pageCounter').find('.page');
            // reset
            _slider.stop(true,true);
            _child.removeClass('current');
            _btn.removeClass('current');
            
            var _firstChild = _slider.find('li').filter(':first').filter(':not(.clone)');
            var _lastChild = _slider.find('li').filter(':last').filter(':not(.clone)');
            
            if(type == 'next'){
                currentNum++;
                var moveRange = parseInt(_slider.css('left')) - childWidth;
                
                _slider.animate({'left':moveRange}, speed, function(){
                    if(currentNum == childLength){
                        _slider.css({'left':0});
                        currentNum = 0;
                        _btn.eq(currentNum).addClass('current');
                    }
                    _slider.find('li').filter(':not(.clone)').eq(currentNum).addClass('current');
                });
                    _btn.eq(currentNum).addClass('current');
            }
            else if(type == 'prev') {
                currentNum--;
                var moveRange = parseInt(_slider.css('left')) + childWidth;
                
                _slider.animate({'left':moveRange}, speed, function(){
                    if(currentNum < 0){
                        currentNum = childLength-1;
                        _slider.css({'left':-childWidth*currentNum+1});
                    }
                    _slider.find('li').filter(':not(.clone)').eq(currentNum).addClass('current');
                });
                    _btn.eq(currentNum).addClass('current');
            }
            else {
                currentNum = index;
                var moveRange = childWidth * currentNum;
                
                _slider.animate({'left':-(moveRange)}, speed, function(){
                    _slider.find('li').filter(':not(.clone)').eq(currentNum).addClass('current');
                });
                    _btn.eq(currentNum).addClass('current');
            }
            
            clearInterval(autoTimer);
            func.autoPlay();
        },
        
        autoPlay : function(){
            autoTimer = setInterval(function(){
                func.action(null, 'next');
            }, 8000);       //自动切换间隔8秒
        }
    };
    
    func.init();
    var _btn = $('#pageCounter').find('.page');
    
    _btnNext.on('click', function(){
        func.action(null, 'next');
    });
    
    _btnPrev.on('click', function(){
        func.action(null, 'prev');
    });
    
    _btn.on('click', function(){
        var id = _btn.index(this);
        func.action(id, 'page');
    });
}
/********************************************************************************************/