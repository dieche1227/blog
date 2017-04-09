function isExitsVariable(variableName) {
    try {
        if (typeof(variableName) == "undefined" || variableName=='') {
            return false;
        } else {
            return true;
        }
    } catch(e) {}
    return false;
}

var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();

$(document).ready(function(){
    $("input[name='state']").click(function(){
        var _url = window.location.href;
        var isdone = $(this).val();
        if(!isExitsVariable($_GET['isdone'])){
            var has = _url.indexOf('?');

            var _newUrl = has<0?_url + "?isdone="+isdone:_url + "&isdone="+isdone;
            window.location.href = _newUrl;
        }else{
            _url = _url.replace(/isdone=\d/,"isdone="+isdone);
            window.location.href = _url;
        }
    });
});