$("#queue").dragsort({dragSelector: "li", dragBetween: true,dragEnd:saveOrder,placeHolderTemplate:'<li class="up-thumb-item up-thumb-add" style="width:258px;height:192px;"></li>'});
function saveOrder() {
		var data = $("#queue li div").map(function() {return $(this).attr('rel') }).get();
		$("input[name=list1SortOrder]").val(data.join("|"));
		$.ajax({
			type:'post',
			url:'/sortorder',
			// data:{'orderlist':data.join("|"),'acl':acl},
			data:{'orderlist':data.join("|"),'prcdi':$('input[name=id]').val()},
			success:function(msg){
				
			},
			error:function(){

			}
		});
	};