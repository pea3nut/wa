<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
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
    <script type="text/javascript">$(function(){
    sign_ajax(
        {
            "text"  :["[name='works_name']" ,"[name='works_intro']" ,"[name='price']","[name='works_id']"],
            "select":"[name='works_state']",
            "file"  :"[name='banner']"
        },
        NUT.URL_ROOT+"Service/ns_edit_works"
    );
    })</script>
</block>