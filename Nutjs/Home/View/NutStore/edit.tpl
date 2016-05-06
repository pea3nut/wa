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
                            <td width="100" class="text-right"><button class="btn btn-success btn-xs section_create_form">+ New Section</button></td>
                        </tr>
                    </thead>
                    <tbody class="section_list">
                        <volist name="_data.works.section" id="section">
                            <tr class="section_row">
                                <include file="__INCLUDE__/edit-section_row.tpl" />
                            </tr>
                        </volist>
                        <assign name="section" value="" />
                        <tr class="hide section_row_tpl section_row">
                            <include file="__INCLUDE__/edit-section_row.tpl" />
                        </tr>
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
    
    
    <!-- 删除作品的警告框 -->
    <div class="modal fade" id="del_works" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">删除整个作品</h4>
                </div>
                <div class="modal-body">
                    <p>你确定你要删除整个作品吗？</p>
                    <p>这将是不可逆的，你将丢失作品中的所有章节与日志！！</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger del-works-all">确定删除！</button>
                </div>
            </div>
        </div>
    </div>

    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/Library/uploader/src/dmuploader.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__SCRIPT__/sign_log_event.function.js" type="text/javascript" charset="utf-8"></script>
    <script src="__SCRIPT__/sign_section_event.function.js" type="text/javascript" charset="utf-8"></script>
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
        sign_section_event(
            "{$_data['works']['inf']['id']}",
            "{:U('Behavior/upload/works_section/')}",
            "{:U('Service/ns_edit_section')}",
            "{:U('NutStore/read/'.$_data['works']['inf']['id'])}/",
            "{:U('Behavior/delete/works_section')}",
            "{:U('Service/ns_create_section')}",
            "{:U('Service/ns_delete_section')}"
        );

        //注册日志操作
        sign_log_event(
            "{:U('Service/ns_create_works_log')}",
            "{:U('Service/ns_delete_works_log')}",
            "{$_data.works.inf.id}"
        );

        //注册删除章节
        $(".del-works-all").on("click",function () {
            var sendElt =$(this);
            var ajax_req =new $.NutjsAjax({
                "reqMode"   :"post",
                "reqUrl"    :"{:U('Service/ns_delete_works')}",
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
        // 计算字段，发送
    })</script>
</block>