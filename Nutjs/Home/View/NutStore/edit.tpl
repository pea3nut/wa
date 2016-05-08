<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <title>编辑 - {$_data.works.inf.works_name}</title>
    <load href="__STYLE__/basic.css" />
    <load href="__STYLE__/edit.css" />
</block>
<block name="body">

    <div class="container my-body">
        <div class="col-xs-12 col-md-7 col-lg-8">
            <!-- 章节列表 --><include file="__INCLUDE__/edit-section.tpl" />
            <!-- 日志列表 --><include file="__INCLUDE__/edit-log.tpl" />
        </div>
        <div class="col-xs-12 col-md-5 col-lg-4">
            <!-- 作品信息 --><include file="__INCLUDE__/edit-inf.tpl" />
        </div>
    </div>

    <!-- 删除作品的警告框 --><include file="__INCLUDE__/edit-alert.tpl" />

    <!-- #载入环境 -->
    <!-- 封装的Ajax --><script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
    <!-- 错误码 --><script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
    <!-- 文件上传库 --><script src="__PUBLIC__/Library/uploader/src/dmuploader.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- PHP数据转换为JS全局变量 --><include file="__INCLUDE__/RAW.js.tpl" />
    <!-- 作品操作 --><script src="__SCRIPT__/sign_works_event.closures.js" type="text/javascript" charset="utf-8"></script>
    <!-- 章节操作 --><script src="__SCRIPT__/sign_section_event.closures.js" type="text/javascript" charset="utf-8"></script>
    <!-- Banner操作 --><script src="__SCRIPT__/sign_upload_banner.closures.js" type="text/javascript" charset="utf-8"></script>
    <!-- 日志操作 --><script src="__SCRIPT__/sign_log_event.closures.js" type="text/javascript" charset="utf-8"></script>

</block>