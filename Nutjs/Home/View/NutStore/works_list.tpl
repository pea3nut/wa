<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
</block>
<block name="body">

<article class="container my-body">
   <!-- 引入排序选项-->
   <include file="__INCLUDE__/index-order.tpl" />
   <!-- 作品列表-->
   <include file="__INCLUDE__/index-list.tpl" />
</article>

</block>