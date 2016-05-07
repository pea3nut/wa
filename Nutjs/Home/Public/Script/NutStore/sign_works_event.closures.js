(function () {
//修改作品资料
sign_ajax(
    [
        "[name='works_name']" ,"[name='works_intro']",
        "[name='price']"      ,"[name='works_id']",
        "[name='works_state']"
    ],
    NUT.URL_ROOT+"/Service/ns_edit_works",
    function(){
        var dt =new Date();
        $(".edit-works-inf-msg").html(
            "保存成功 "+
            dt.getHours()+
            ":"+
            dt.getMinutes()+
            ":"+
            dt.getSeconds()
        );
    }
);
//删除作品
$(".del-works-all").on("click",function () {
    var sendElt =$(this);
    var ajax_req =new $.NutjsAjax({
        "reqMode"   :"post",
        "reqUrl"    :RAW.U["Service/ns_delete_works"],
        "onSuccsee" :function(){
            location.href="{:U('member')}";
        },
        "showMsgFn" :function($msg){
            eltGroup.find(".log_errmsg").html($msg).show();
        },
        "callBack"  :function($data){
            // 恢复按钮样式
            sendElt.removeProp("disabled");
            // 执行默认的回调函数
            this.defaultCallBack($data);
        }
    });
    ajax_req.fieldData["works_id"]="{$_data.works.inf.id}";
    ajax_req.send();
});
//删除未保存的Banner
$(".banner-del").on("click",function () {
    $(".has-edit-banner-msg").hide();
    $(".upload_img").prop("src" ,$(".works-inf-raw").attr("has-banner"));
    $.ajax({
        "dataType"  :'json',
        "data"      :{
            "works_id"    :RAW.D["works.inf.id"]
        },
        "url"       :RAW.U["Behavior/delete/works_banner"],
        "type"      :"post",
    });
});
})()