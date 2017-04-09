(function($){
$.extend({
ms_DatePicker: function (options) {    
    var defaults = {
        YearSelector: "#year",
        MonthSelector: "#month",
        DaySelector: "#days",
        FirstText: "--",
        FirstValue: 0
    };
    var opts = $.extend({}, defaults, options);
    var $YearSelector = $(opts.YearSelector);
    var $MonthSelector = $(opts.MonthSelector);
    var $DaySelector = $(opts.DaySelector);

    // 年份列表
    var yearNow = new Date().getFullYear();
	var yearSel = $YearSelector.find('span').text();
    for (var i = 1960 ; i <= yearNow; i++) {
		var sed = yearSel==i?"class='on'":"";
        var yearStr = '<li '+sed+'><a href="javascript:;" rel="'+i+'">'+i+'</a></li>';
        $YearSelector.find('ol').append(yearStr);
    }

    // 月份列表
	var monthSel = $MonthSelector.find('span').text();
    for (var i = 1; i <= 12; i++) {
		var sed = monthSel==i?"class='on'":"";
        var monthStr = '<li '+sed+'><a href="javascript:;" rel="'+i+'">'+i+'</a></li>';
        $MonthSelector.find('ol').append(monthStr);
    }

    var month = parseInt(monthSel);
    var year = parseInt(yearSel);

    // 日列表(仅当选择了年月)
    function BuildDay() {
            if($DaySelector.find('ol li').length > 0){
                $DaySelector.find('ol li').remove();
            }
            var dayCount = 0;
            switch (month) {
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    dayCount = 31;
                    break;
                case 4:
                case 6:
                case 9:
                case 11:
                    dayCount = 30;
                    break;
                case 2:
                    dayCount = 28;
                    if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)) {
                        dayCount = 29;
                    }
                    break;
                default:
                    break;
            }
			
            var daySel = $DaySelector.find('span').text();
            for (var i = 1; i <= dayCount; i++) {
				 var sed = daySel==i?"class='on'":"";
				 var dayStr = '<li '+sed+'><a href="javascript:;" rel="'+i+'">'+i+'</a></li>';
                 $DaySelector.find('ol').append(dayStr);
            }
            $(".sel_option a").click(function(){
    // $(document).on('click','.sel_option a',function(){
        var rel = $(this).attr("rel");
        var list = $(this).parents(".sel_option");
        var titVal = $(this).text();

        $(".sel_option a").parent("li").removeClass("on");
        $(this).parent("li").addClass("on");
        
        list.parent(".sel_box").find(".sel_val_tit").text(titVal);
        list.parent(".sel_box").find("input").val(rel);
        list.slideUp();

    });

    }

    $MonthSelector.find('a').click(function () {
        month = parseInt($(this).attr('rel'));
        BuildDay();
    });

    $YearSelector.find('a').click(function () {
        year = parseInt($(this).attr('rel'));
        BuildDay();
    });

	BuildDay();
}
})
})(jQuery);