
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});




$().ready(function() {
    $('form').each(function(){
        $(this).validate({     
            submitHandler: function(form) 
                       {      
                          var $form = $(form);
                          var data =  $form.serialize();
                          var url =  $form.attr('action');
                          
                          $.ajax({     
                                type : "POST",
                                url : url ,
                                dataType : 'json',
                                data : data,
                                success : function(response){
                                    if(response.status){
                                        alert(response.msg);
                                        if(response.jumpUrl){
                                            window.location.href=response.jumpUrl;
                                        }
                                    }else{
                                       alert(response.msg);
                                    }
                                }
                            });  
                       }                          
        });
    });
})
