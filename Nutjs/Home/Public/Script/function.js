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
    $($field[$field.length-1]).on("keyup",function(event){
        if(event.keyCode ==13){
            sendElt.click();
        };
    });
    
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

function sign_upload($url){
    $(".upload_call_file").prop("disabled",false);
    $(".upload_group").dmUploader({
        "url"             : $url,
        "dataType"        : "json",
        "maxFileSize"     : 2097152,
        "extFilter"       : "jpg;jpeg;png;gif",
        "onUploadSuccess" : function($id ,$data){
            if($data.errcode == '1200'){
                $(".upload_img")
                    .prop("src",$data.errmsg+"?"+Math.random())
                    .show()
                ;
            }else {
                $(".upload_msg").html($data.errmsg).show();
            }
            $(".upload_msg").hide();
        },
        "onUploadError"   : function(id, message){
            $(".upload_msg").html(message).show();
        },
        "onFileSizeError" : function(file){
            $(".upload_msg").html("文件过大，请上传2M以下的图片").show();
        },
        "onFileExtError"  : function(file){
            $(".upload_msg").html("仅支持jpg、png、gif的图片").show();
        },
        "onUploadProgress": function(id, percent){
            var perStr =percent+"%";
            $(".works-banner-progress").css("width",perStr).html(perStr);
            if(percent == 100)$(".works-banner-progress").html("Success !");
        },
        "onNewFile"       : function(){
            $(".works-banner-progress-shell").show();
            $(".works-banner-progress").css("width",0).html("0%");
        },
        "onBeforeUpload"  : function(id){
            $(".upload_call_file").prop("disabled",true);
        },
        "onComplete"      : function(){
            $(".upload_call_file").prop("disabled",false);
        }
    });
    $(".upload_call_file").on("click",function(){
        $(".upload_file").click();
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
