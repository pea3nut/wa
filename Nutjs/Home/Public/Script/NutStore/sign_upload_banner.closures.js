(function(){
    $(".upload_call_file").prop("disabled",false);
    $(".upload_group").dmUploader({
        "url"             : RAW.U["Behavior/upload/works_banner"],
        "dataType"        : "json",
        "maxFileSize"     : 2097152,
        "extFilter"       : "jpg;jpeg;png;gif",
        "onUploadSuccess" : function($id ,$data){
            if($data.errcode == '1200'){
                $(".upload_img")
                    .prop("src",$data.errmsg+"?"+Math.random())
                    .show()
                ;
                $(".has-edit-banner-msg").show();
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
        },
        "extraData"       : {
            "works_id"  :RAW.D["works.inf.id"]
        }
    });
    $(".upload_call_file").on("click",function(){
        $(".upload_file").click();
    });
})();