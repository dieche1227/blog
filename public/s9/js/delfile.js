$(function(){
	var cid = $("input[name='id']").val();
	
	$(document).on('click','#upfileDel',function(){
		var $this=$(this);
		var  fid = $(this).attr('rel');
		var data ={
					cid : cid,
					//fid : fid
					};
		$.ajax({
					url		: "/delfile",
					type	: "post",
					data	: data,
					dataType: "json",
					success: function(data){
						//console.log(data);
						if(data.stats=='success')
						$this.closest('.upfile_show').remove();
						$("#fabuUpfile_tit").addClass('disabled').attr('disabled',true);
					},
					error	: function(data){

					}

				});


	});


	

});