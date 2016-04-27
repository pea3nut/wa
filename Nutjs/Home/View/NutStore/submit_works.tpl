<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
    <style>
        .banner-sign{
            padding:2px 0 0 3px;
            font-size: 0.8em;
        }
        .upload_img{
            margin-top:5px;
            border: 1px solid #ddd;
            width:100%;
        }
        .upload_msg{
            margin-top:5px;
        }
        .works-banner-progress-shell{
            margin-bottom: 0;
        }
    </style>
</block>
<block name="body">
<div class="my-body panel panel-default col-xs-12 col-sm-9 col-md-6 col-lg-5 center-block no-float no-padding form-window">
        <div class="panel-heading">
            <h1 class="panel-title">投稿新作品</h1>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="works_name">作品名称</label>
                <div class="col-sm-8">
                    <input type="text" name="works_name" id="works_name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="works_intro">简介</label>
                <div class="col-sm-8">
                    <textarea placeholder="可选，支持Markdown语法" name="works_intro" id="works_intro" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="banner">作品Banner</label>
                <div class="col-sm-8 upload_group">
                    <input type="button" class="form-control upload_call_file" value="点击上传图片" />
                    <div class="progress works-banner-progress-shell" style="display: none;">
                        <div class="works-banner-progress progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">
                            0%
                        </div>
                    </div>
                    <div class="banner-sign text-danger">*上传图片最佳尺寸为640*360，或更大的16:9图像(会自动处理)</div>
                    <input type="file" name="banner" title="640px * 360px" id="banner" class="hidden upload_file">
                    <img alt="Upload img" class="upload_img img-responsive" style="display: none;" />
                    <div class="upload_msg upload-msg alert alert-danger" style="display: none;">上传失败</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="price">售价</label>
                <div class="col-sm-8">
                    <input type="text" name="price" id="price" class="form-control">
                </div>
            </div>
            <div style="display: none;" id="_showMsg" role="alert" class="alert alert-danger col-sm-10 center-block no-float">出现错误</div>
            <div class="form-group">
                <div class="col-sm-10 center-block no-float">
                    <button id="_goAjax" class="btn btn-success btn-block pull-left" type="button">创建我的作品！</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/Library/uploader/src/dmuploader.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">$(function(){
        // 注册Ajax事件
        sign_ajax(
            ["[name='works_name']" ,"[name='works_intro']" ,"[name='price']"],
            NUT.URL_ROOT+"/Service/ns_create_works",
            function ($data){
                location.href=NUT.URL_ROOT+"/NutStore/edit/"+$data.errmsg;
            }
        );
        // 注册文件上传
        sign_upload("{:U('Behavior/upload/works_banner')}");
    })</script>
</block>