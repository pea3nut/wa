function sign_ajax($field ,$url){
    var ajax_req =new $.NutjsAjax({
        "field"     :$field,
        "reqMode"   :"post",
        "reqUrl"    :$url,
        "showMsgFn" :function($msg){
            $("#_showMsg").html($msg).show();
        },
        "alertMsgFn":function($msg){
            alert($msg);
        },
    });
    $("#_goAjax").on('click',function(){
        ajax_req.countField();
        ajax_req.send();
    });
};
