<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
</block>
<block name="body">
    <div class="container my-body">
        <pre>{:print_r($_data)}</pre>
    </div>
</block>