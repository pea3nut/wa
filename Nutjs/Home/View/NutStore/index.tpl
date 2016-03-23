<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8" />
    <!-- 设定虚拟视窗 -->
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no" />
    <!-- 让IE浏览器以edge引擎渲染 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- 让双核浏览器用webkit引擎渲染 -->
    <meta name="renderer" content="webkit" />
    <!-- 定义超链接默认为行为 -->
    <base target="_self" />
    <!-- 载入网站ICON -->
    <link rel="shortcut icon" href="__PUBLIC__/Library/Image/nutjs.ico" type="image/x-icon" />
    <!-- 引入CSS文件 -->
    <load href="__PUBLIC__/Library/bootstrap-3.3.5/css/bootstrap.css" />
    <load href="__PUBLIC__/PeA_nut/css/rewrite_bootstrap.css" />
    <load href="__PUBLIC__/PeA_nut/css/class.css" />
    <load href="__STYLE__/nav.css" />
    <!-- 标题 -->
    <title>网站标题</title>
</head>
<body>
<!-- 引入导航栏 -->
<include file="__INCLUDE__/nav.tpl" />
<br /><br /><br /><br />
<!-- 正文 -->
<article class="container text-body">
   <!-- 引入排序选项-->
   <include file="__INCLUDE__/index-order.tpl" />
   <!-- 作品列表-->
   <include file="__INCLUDE__/index-list.tpl" />
</article>
<!-- 引入版权信息 -->
<include file="./Public/PeA_nut/inc/nutjs.footer.tpl" />
</body>
<!-- 引入JS文件 -->
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/jquery-1.9.1.min.js" />
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/bootstrap.min.js" />
</html>