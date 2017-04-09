$('#demand_submit').click(function(){

	var list = $(".idea_list li i").map(function() {return $(this).attr('rel')}).get().join(',');
	__data.id = list;

	if(!__data.id.length){
		globalTip({'msg':'请输您的需求并回车确认'});
		return false;
	}

	if(confirm('是否确认需求')){
		
		$.post('demand_confirm',__data,function(msg){
				if(!msg.stats){
					globalTip(msg);
				}else{
					window.location.reload();
				}
		},'json');
	}
});