/**
 * 快捷发送Ajax请求
 * @param {Array} $field - 要发送的字段
 * @param {String} $url - 请求的URL
 * @param {Function} $onSuccsee - 成功后的回调函数
 * */
function sign_ajax($field ,$url ,$onSuccsee){
    var sendElt =$("#_goAjax");
    sendElt.attr("disabled",false);
    var ajax_req =new $.NutjsAjax({
        "field"     :$field,
        "reqMode"   :"post",
        "reqUrl"    :$url,
        "onSuccsee" :$onSuccsee ?$onSuccsee :function(){
            if(history.length >1){
                history.back()
            }else{
                location.href=NUT.URL_ROOT;
            };
        },
        "showMsgFn" :function($msg){
            $("#_showMsg").html($msg).show();
        },
        "alertMsgFn":function($msg){
            alert($msg);
        },
        "callBack"  :function($data){
            // 恢复按钮样式
            sendElt.html(sendElt.attr("msg"));
            sendElt.attr("disabled",false);
            // 刷新验证码
            $("*[role='verifycode']").click();
            // 执行默认的回调函数
            this.defaultCallBack($data);
        }
    });
    if($field){
        $($field[$field.length-1]).on("keyup",function(event){
            if(event.keyCode ==13){
                sendElt.click();
            };
        });
    };
    sendElt.on('click',function(){
        // 防止多次触发该事件
        if(sendElt.attr("disabled") ==='disabled') return;
        // 设定按钮样式
        sendElt.attr("msg",sendElt.html());
        sendElt.html("提交中...");
        sendElt.attr("disabled",true);
        // 计算字段，发送
        ajax_req.countField();
        ajax_req.send();
    });
};




function get_short_date(){
    var D =new Date();
    return  D.getFullYear()+"-"
            +((D.getMonth()>=10)?(+D.getMonth()+1):("0"+(+D.getMonth()+1)))
            +"-"
            +D.getDate()
    ;
};
function get_long_date(){
    var D =new Date();
    return  D.getFullYear()+"-"
            +((D.getMonth()>=10)?(+D.getMonth()+1):("0"+(+D.getMonth()+1)))
            +"-"
            +D.getDate()
            +" "
            +((D.getHours()>=10)?(+D.getHours()+1):("0"+(+D.getHours()+1)))
            +":"
            +((D.getMinutes()>=10)?(+D.getMinutes()+1):("0"+D.getMinutes()))
            +":"
            +((D.getSeconds()>=10)?(+D.getSeconds()+1):("0"+D.getSeconds()))
    ;
};
