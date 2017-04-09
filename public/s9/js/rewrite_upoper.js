$(document).on('click', '.del', function() {
    ob = $(this).parent();
    if (confirm('确定要删除该作品图吗?')) {
        $.ajax({
            url: '/filedel',
            type: 'post',
            data: {
                'id': ob.attr('rel'),
                // 'acl': acl
            },
            dataType: 'json',
            success: function(msg) {
                if (msg.stats=='success') {
                    ob.parent().remove();
                    globalTip({"msg":msg.messages,"setTime":5});
                } else {
                    
                    globalTip({"msg":msg.messages,"setTime":5});
                }
            },
            error: function() {
                alert('请求出错,请重试');
            }
        })
    }
});

$(document).on('click', '.cov', function() {
    ob = $(this).parent();
    if (confirm('确定将该图作为封面图吗?')) {
        $('#fontcover').css('background-color','#eb984e');
        $('#fontcover span').text('设置封面中请稍等');
        $.ajax({
            url: '/setcover',
            type: 'post',
            data: {
                'id':  ob.attr('rel'),
                'pid': $('input[name=id]').val()
            },
            dataType: 'json',
            success: function(msg) {
                console.log(msg);
                if (msg.stats=='success') {
                    $('a[class=up-cover-pic] img').attr('src', msg.links);
                    coverfile = true;
                    globalTip({"msg":'设置封面成功！！！',"setTime":5});
                } else {
                    globalTip({"msg":msg.messages,"setTime":5});
                }

                $('#fontcover').css('background-color','');
                $('#fontcover span').text('编辑封面(560*420)');

            },
            error: function() {
                alert('请求出错,请重试');
                $('#fontcover').css('background-color','');
                $('#fontcover span').text('编辑封面(560*420)');
            }
        })
    }

});
