<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
    <style>
        .upload_img{
            cursor:pointer;
            border: 1px solid #ddd;
        }
        .works-banner-progress-shell{
            border-top-left-radius:0;
            border-top-right-radius:0;
        }
        .segr{
            display:none;
        }
    </style>
</block>
<block name="body">
    <div class="container my-body">
        <div class="col-xs-12 col-md-7 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">作品章节</h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>章节号</td>
                            <td>名称</td>
                            <td>内容</td>
                            <td width="100" class="text-right"><button class="btn btn-success btn-xs section_create">+ New Section</button></td>
                        </tr>
                    </thead>
                    <tbody class="section_list">
                        <volist name="_data.works.section" id="section">
                            <tr class="section_row">
                                <include file="__INCLUDE__/edit-section_row.tpl" />
                            </tr>
                        </volist>
                    </tbody>
                </table>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">更新日志</h1>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>日志</td>
                            <td>时间</td>
                            <td width="100" class="text-right"><button class="btn btn-success btn-xs log_create">+ New Log</button></td>
                        </tr>
                    </thead>
                    <tbody class="log_list">
                        <volist name="_data.works.log" id="log">
                            <tr class="log_row">
                                <td>{$log.log}</td>
                                <td>{$log.date}</td>
                                <td class="text-right">
                                    <button class="btn btn-danger btn-xs log_del">删除</button>
                                    <div class="text-danger log_errmsg"></div>
                                    <input type="hidden" name="log_id" value="{$log.id}" />
                                </td>
                            </tr>
                        </volist>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-md-5 col-lg-4">
            <include file="__INCLUDE__/edit-inf.tpl" />
        </div>
    </div>
    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/Library/uploader/src/dmuploader.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__SCRIPT__/sign_log_event.function.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">$(function(){
        //注册Ajax
        sign_ajax(
            [
                "[name='works_name']" ,"[name='works_intro']",
                "[name='price']"      ,"[name='works_id']",
                "[name='works_state']"
            ],
            NUT.URL_ROOT+"/Service/ns_edit_works",
            function(){location.reload();}
        );
        //注册上传
        sign_upload_banner("{:U('Behavior/upload/works_banner')}" ,"{$_data.works.inf.id}");
        //注册章节操作

        //根据raw-data，初始显示效果
        $.each($(".section_row") ,init_section_display);
        function init_section_display(){
            var section_row=$(this);
            var raw =section_row.find(".raw-data");

            $(".segr").hide();
            if(raw.attr("has-edit-md")){
                section_row.find(".segr-btngr-edit").show();
                section_row.find(".segr-secgr-edit").show();
            }else{
                section_row.find(".segr-btngr-default").show();
                if(raw.attr("has-md")){
                    section_row.find(".segr-secgr-default").show();
                }else{
                    section_row.find(".segr-secgr-create").show();
                };
            };

            if(raw.attr("state") === 'edit'){
                $("[name='section_id']")   .val( $(".section_id").hide()   .html() ) .show();
                $("[name='section_name']") .val( $(".section_name").hide() .html() ) .show();
                section_row.find(".segr-btngr").hide();
                section_row.find(".segr-btngr-edit").show();
            }else if(raw.attr("state") === 'show'){
                $(".section_id")   .html( $("[name='section_id']").hide()   .val() ) .show();
                $(".section_name") .html( $("[name='section_name']").hide() .val() ) .show();
                section_row.find(".segr-btngr").hide();
                section_row.find(".segr-btngr-default").show();
                section_row.find(".section-read").prop("href","{:U('NutStore/read/'.$section['works_id'])}/"+ $("[name='section_id']").val());
            };
        };

        //上传章节Markdown
        $(".section_list").delegate(".section_upload_btn" ,"click" ,function(event){
            var sendElt =$(this);
            var eltGroup =sendElt.parents(".section_row");
            var fileInput =eltGroup.find(".section_upload");

            var $url ="{:U('Behavior/upload/works_section/')}";
            var $works_id ="{$_data['works']['inf']['id']}";
            var $section_id =eltGroup.find("[name='section_id']").val();

            eltGroup.dmUploader({
                "url"             : $url,
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
                    "works_id"  :$works_id,
                    "section_id":$section_id
                }
            });

            fileInput.click();
        });
        //清除按钮禁用
        $(".section_list button").removeProp("disabled");
        //创建章节表单
        $(".section_create").on("click",function(){
            $(".section_list").append('\
                <tr class="section_row">\
                    <td>\
                        <span class="section_id" style="display: none;"></span>\
                        <input type="text" name="section_id" />\
                        <input type="hidden" name="id" />\
                    </td>\
                    <td>\
                        <span class="section_name" style="display: none;"></span>\
                        <input type="text" name="section_name" />\
                    </td>\
                    <td><a href="">MarkDown</a></td>\
                    <td>\
                        <div class="segr-btngr-default" style="display: none;">\
                            <button class="btn btn-info btn-xs section_edit">编辑</button>\
                            <button class="btn btn-danger btn-xs section_del">删除</button>\
                        </div>\
                        <div class="segr-btngr-edit" style="display: none;">\
                            <button class="btn btn-success btn-xs section_save">保存</button>\
                            <button class="btn btn-default btn-xs section_cancel">取消</button>\
                        </div>\
                        <div class="segr-btngr-create"">\
                            <button class="btn btn-success btn-xs section_create">保存</button>\
                            <button class="btn btn-danger btn-xs section_del_form">删除</button>\
                        </div>\
                        <div class="section_errmsg text-danger"></div>\
                    </td>\
                </tr>\
            ');
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
            eltGroup.find(".raw-data").removeAttr("has-edit-md").attr("state","show");;
            init_section_display.call(eltGroup);
            // 删除已上传但未保存的章节
            $.ajax({
                "dataType"  :'json',
                "data"      :{
                    "works_id"    :"{$_data.works.inf.id}",
                    "section_id"  :eltGroup.find("[name='section_id']").val(),
                },
                "url"       :"{:U('Behavior/delete/works_section')}",
                "type"      :"post",
            });
            //显示按钮组

        });
        //创建新章节
        $(".section_list").delegate(".section_create" ,"click" ,function(event){
            var sendElt =$(this);
            var eltGroup =sendElt.parents(".section_row");
            //禁用按钮
            sendElt.prop("disabled",true);
            var ajax_req =new $.NutjsAjax({
                "field"     :[eltGroup.find("[name='section_name']"),eltGroup.find("[name='section_id']")],
                "reqUrl"    :"{:U('Service/ns_create_section')}",
                "onSuccsee" :function($data){
                    //将表单转换为文本
                    var id          =$data.id;
                    var section_id  =$data.errmsg;
                    var section_name=eltGroup.find("[name='section_name']").val();
                    eltGroup.find(".section_id").html(section_id);
                    eltGroup.find(".section_name").html(section_name);
                    eltGroup.find(".section_cancel").click();
                    eltGroup.find("[name='id']").val(id);
                    //隐藏按钮组
                    eltGroup.find(".segr-btngr-create").hide();
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
            ajax_req.fieldData["works_id"]="{$_data.works.inf.id}";
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
                "reqUrl"    :"{:U('Service/ns_delete_section')}",
                "onSuccsee" :function(){
                    eltGroup.find(".section_del_form").click();
                },
                "showMsgFn" :function($msg){
                    eltGroup.find(".section_errmsg").html($msg).show();
                },
            });
            //手动设置发送信息
            ajax_req.fieldData.works_id   ="{$_data.works.inf.id}";
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
                "reqUrl"    :"{:U('Service/ns_edit_section')}",
                "onSuccsee" :function($data){
                    raw.removeAttr("has-edit-md").attr("state","show");;
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











        //注册日志操作
        sign_log_event(
            "{:U('Service/ns_create_works_log')}",
            "{:U('Service/ns_delete_works_log')}",
            "{$_data.works.inf.id}"
        );
    })</script>
</block>