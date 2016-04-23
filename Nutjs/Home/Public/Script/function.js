function sign_ajax($field ,$url ,$redirect){
    var ajax_req =new $.NutjsAjax({
        "field"     :$field,
        "reqMode"   :"post",
        "reqUrl"    :$url,
        "redirect"  :$redirect,
        "showMsgFn" :function($msg){
            $("#_showMsg").html($msg).show();
        },
        "alertMsgFn":function($msg){
            alert($msg);
        },
    });
    $(document.body).on("keyup",function(event){
        if(event.keyCode ==13){
            ajax_req.countField();
            ajax_req.send();
        };
    });
    
    $("#_goAjax").on('click',function(){
        ajax_req.countField();
        ajax_req.send();
    });
};