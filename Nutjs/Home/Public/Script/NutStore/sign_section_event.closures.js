(function (){


//根据raw-data，初始显示效果
$.each($(".section_row") ,init_section_display);
function init_section_display(){
    var section_row=$(this);
    var $$=function(){
        return section_row.find.apply(section_row ,arguments);
    };
    var raw =$$(".raw-data");

    // #将raw中数据同步至表单
    $$("section_id").html(raw.attr("sectionid"));
    $$("[name='section_id']").val(raw.attr("sectionid"));

    // #更新查看Markdown链接
    $$(".segr").hide();
    if(raw.attr("has-edit-md")){
        $$(".segr-btngr-edit").show();
        $$(".segr-secgr-edit").show();

        $$(".section-edit-md").prop("href" ,raw.attr("has-edit-md"));
    }else{
        $$(".segr-btngr-default").show();
        if(raw.attr("has-md")){
            $$(".segr-secgr-default").show();

            var md_url =RAW.U["NutStore/read/self"] +raw.attr("sectionid");
            $$(".section-md").prop("href" ,md_url);
        }else{
            $$(".segr-secgr-create").show();
        };
    };

    // #根据state更新表单状态
    if(raw.attr("state") === 'edit'){
        var textSectionId =$$(".section_id");
        var textSectionName =$$(".section_name");

        textSectionId.hide();
        textSectionName.hide();

        if(textSectionId.html() ){
            $$("[name='section_id']")   .val( textSectionId.html() )   .show();
        };
        if(textSectionName.html() ){
            $$("[name='section_name']") .val( textSectionName.html() ) .show();
        };

        $$(".segr-btngr").hide();
        $$(".segr-btngr-edit").show();
    }else if(raw.attr("state") === 'show'){
        var inputSectionId =$$("[name='section_id']")
        var inputSectionName =$$("[name='section_name']");

        inputSectionId.hide();
        inputSectionName.hide();

        if(inputSectionId.val() ){
            $$(".section_id")   .html( inputSectionId.val() ) .show();
        };
        if(inputSectionName.val()){
            $$(".section_name") .html( inputSectionName.val() ) .show();
        };

        $$(".segr-btngr").hide();
        $$(".segr-btngr-default").show();
    }else if(raw.attr("state") === 'create'){
        $$("[name='section_name']").show();
        $$("[name='section_id']").show();

        $$(".section_id").hide();
        $$(".section_name").hide();

        $$(".segr-btngr").hide();
        $$(".segr-btngr-create").show();
    };
};

//上传章节Markdown
$(".section_list").delegate(".section_upload_btn" ,"click" ,function(event){
    var sendElt =$(this);
    var eltGroup =sendElt.parents(".section_row");
    var fileInput =eltGroup.find(".section_upload");
    var raw =eltGroup.find(".raw-data");

    if(raw.attr("state") === 'create'){
        var $section_id ='auto';
    }else{
        var $section_id =eltGroup.find("[name='section_id']").val();
    }

    eltGroup.dmUploader({
        "url"             : RAW.U["Behavior/upload/works_section"],
        "dataType"        : "json",
        "maxFileSize"     : 102400,
        "extFilter"       : "md",
        "onUploadSuccess" : function($id ,$data){
            if($data.errcode == '1200'){
                eltGroup.find(".raw-data").attr("has-edit-md" ,$data.errmsg);
                init_section_display.call(eltGroup);
            }else {
                $(".section_errmsg").html($data.errmsg).show();
            };
            $(".upload_msg").hide();
        },
        "onUploadError"   : function(id, message){
            eltGroup.find(".section_errmsg").html(message).show();
        },
        "onFileSizeError" : function(file){
            eltGroup.find(".section_errmsg").html("文件过大，请上传100k以下的md文件").show();
        },
        "onFileExtError"  : function(file){
            eltGroup.find(".upload_msg").html("仅支持md文件").show();
        },
        "onBeforeUpload"  : function(id){
            console.log(sendElt);
            sendElt.prop("disabled",true);
        },
        "onComplete"      : function(){
            sendElt.prop("disabled",false);
        },
        "extraData"       : {
            "works_id"  :RAW.D["works.inf.id"],
            "section_id":$section_id
        }
    });

    fileInput.click();
});
//清除按钮禁用
$(".section_list button").removeProp("disabled");
//创建章节表单
$(".section_create_form").on("click",function(){
    var tpl=$(".section_row_tpl").clone(false ,true);
    tpl.removeClass("hide");
    tpl.removeClass("section_row_tpl");
    $(".section_list").append(tpl);
    tpl.find(".raw-data").attr("state","create");
    init_section_display.call(tpl);
});
//删除未提交的章节表单
$(".section_list").delegate(".section_del_form" ,"click" ,function(event){
    $(this).parents(".section_row").remove();
});
//进入编辑章节状态
$(".section_list").delegate(".section_edit" ,"click" ,function(event){
    var eltGroup=$(this).parents(".section_row");
    // 在raw_data中标明编辑状态
    eltGroup.find(".raw-data").attr("state","edit");
    init_section_display.call(eltGroup);
});
//退出编辑章节状态
$(".section_list").delegate(".section_cancel" ,"click" ,function(event){
    var eltGroup=$(this).parents(".section_row");
    // 在raw_data中删除
    eltGroup.find(".raw-data").removeAttr("has-edit-md").attr("state","show");
    init_section_display.call(eltGroup);
    // 删除已上传但未保存的章节
    $.ajax({
        "dataType"  :'json',
        "data"      :{
            "works_id"    :RAW.D["works.inf.id"],
            "section_id"  :eltGroup.find("[name='section_id']").val(),
        },
        "url"       :RAW.U["Behavior/delete/works_section"],
        "type"      :"post",
    });
});
//创建新章节
$(".section_list").delegate(".section_create" ,"click" ,function(event){
    var sendElt =$(this);
    var eltGroup =sendElt.parents(".section_row");
    var raw =eltGroup.find(".raw-data");
    //禁用按钮
    sendElt.prop("disabled",true);
    var ajax_req =new $.NutjsAjax({
        "field"     :[eltGroup.find("[name='section_name']"),eltGroup.find("[name='section_id']")],
        "reqUrl"    :RAW.U["Service/ns_create_section"],
        "onSuccsee" :function($data){
            raw.attr("section-id" ,$data.id);
            raw.attr("sectionid"  ,$data.section_id);
            raw.attr("has-md"     ,$data["has-md"]);
            raw.attr("has-edit-md","");
            raw.attr("state"      ,"show");
            init_section_display.call(eltGroup);
        },
        "showMsgFn" :function($msg){
            eltGroup.find(".section_errmsg").html($msg).show();
        },
        "callBack"  :function($data){
            // 恢复按钮样式
            sendElt.removeProp("disabled");
            // 执行默认的回调函数
            this.defaultCallBack($data);
        }
    });
    // 计算字段，发送
    ajax_req.countField();
    ajax_req.fieldData["works_id"]=RAW.D["works.inf.id"];
    ajax_req.send();
});
//删除章节
$(".section_list").delegate(".section_del" ,"click" ,function(event){
    var sendElt =$(this);
    var eltGroup =sendElt.parents(".section_row");
    // 禁用按钮
    sendElt.prop("disabled",true);
    //实例化Ajax请求
    var ajax_req =new $.NutjsAjax({
        "reqMode"   :"post",
        "reqUrl"    :RAW.U["Service/ns_delete_section"],
        "onSuccsee" :function(){
            eltGroup.find(".section_del_form").click();
        },
        "showMsgFn" :function($msg){
            eltGroup.find(".section_errmsg").html($msg).show();
        },
    });
    //手动设置发送信息
    ajax_req.fieldData.works_id   =RAW.D["works.inf.id"];
    console.log(eltGroup.find(".section_id"));
    ajax_req.fieldData.section_id =eltGroup.find(".section_id").html();
    // 发送
    ajax_req.send();
});
//保存编辑章节
$(".section_list").delegate(".section_save" ,"click" ,function(event){
    var sendElt =$(this);
    var eltGroup =sendElt.parents(".section_row");
    var raw =eltGroup.find(".raw-data");
    //禁用按钮
    sendElt.prop("disabled",true);
    var ajax_req =new $.NutjsAjax({
        "field"     :[eltGroup.find("[name='section_name']"),eltGroup.find("[name='section_id']")],
        "reqUrl"    :RAW.U["Service/ns_edit_section"],
        "onSuccsee" :function($data){
            if(raw.attr("has-edit-md")){
                raw.attr("has-md" ,raw.attr("has-edit-md"));
                raw.removeAttr("has-edit-md").attr("state","show");
            };
            raw.attr("state" ,"show");
            init_section_display.call(eltGroup);
        },
        "showMsgFn" :function($msg){
            eltGroup.find(".section_errmsg").html($msg).show();
        },
        "callBack"  :function($data){
            // 恢复按钮样式
            sendElt.removeProp("disabled");
            // 执行默认的回调函数
            this.defaultCallBack($data);
        }
    });
    // 计算字段，发送
    ajax_req.countField();
    ajax_req.fieldData["id"]=raw.attr("section-id");
    ajax_req.send();
});



})();//函数结束