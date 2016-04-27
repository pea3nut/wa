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
    </style>
</block>
<block name="body">
    <div class="container my-body">
        <div class="col-xs-12 col-md-7 col-lg-8">
            <include file="__INCLUDE__/edit-section.tpl" />
            <include file="__INCLUDE__/edit-log.tpl" />
        </div>
        <div class="col-xs-12 col-md-5 col-lg-4">
            <include file="__INCLUDE__/edit-inf.tpl" />
        </div>
    </div>

    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/Library/uploader/src/dmuploader.min.js" type="text/javascript" charset="utf-8"></script>
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
        sign_upload("{:U('Behavior/upload/works_banner/'.$_data['works']['inf']['id'])}");
    })</script>
</block>