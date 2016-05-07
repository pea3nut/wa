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
            margin-bottom: 0;
        }
        .segr{
            display:none;
        }
        .has-edit-banner-msg{
            margin:3px 0px 15px 0px;
            text-align: center;
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
                    <p>你确定你要删除作品吗？</p>
                    <p>此操作将不会真正删除你的作品，只是将作品<strong>隐藏</strong>起来，除作者和已购买的用户外，它将是不可见的。</p>
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
    <!-- PHP数据转换为JS全局变量 -->
    <include file="__INCLUDE__/RAW.js.tpl" />
    <!-- 日志操作 -->
    <script src="__SCRIPT__/sign_log_event.closures.js" type="text/javascript" charset="utf-8"></script>
    <!-- 章节操作 -->
    <script src="__SCRIPT__/sign_section_event.closures.js" type="text/javascript" charset="utf-8"></script>
    <script src="__SCRIPT__/sign_upload_banner.closures.js" type="text/javascript" charset="utf-8"></script>
    <!-- 作品操作 -->
    <script src="__SCRIPT__/sign_works_event.closures.js" type="text/javascript" charset="utf-8"></script>
</block>