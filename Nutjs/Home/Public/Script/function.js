/**
 * 快捷发送Ajax请求
 * @param {Json} $field - 要发送的字段
 * @param {String} $url - 请求的URL
 * @param {Function} $onSuccsee - 成功后的回调函数
 * */
function sign_ajax($field ,$url ,$onSuccsee){
    var ajax_req =new $.NutjsAjax({
        "field"     :$field,
        "reqMode"   :"post",
        "reqUrl"    :$url,
        "onSuccsee" :$onSuccsee,
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
