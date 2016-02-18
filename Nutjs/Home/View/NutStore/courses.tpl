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
<!-- 正文 -->
<div class="container text-body">
    <br /><br /><br /><br />
    <article class="col-lg-9 col-md-9 col-xs-12">
        <!-- 引入课程信息简介 -->
        <include file="__INCLUDE__/courses-inf.tpl" />
        <!-- 导航条 -->
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#preface" data-toggle="tab">序言</a></li>
            <li role="presentation"><a href="#courses_list" data-toggle="tab">课程</a></li>
            <li role="presentation"><a href="#discuss" data-toggle="tab">评论 (15)</a></li>
            <li role="presentation"><a href="#log" data-toggle="tab">更新日志 (7)</a></li>
        </ul>
        <!-- 主内容 -->
        <div class="tab-content">
            <!-- 课程序言 -->
            <div id="preface" class="active tab-pane">
                <include file="__INCLUDE__/courses-preface.tpl" />
            </div>
            <!-- 课程列表 -->
            <div id="courses_list" class="tab-pane">
                <include file="__INCLUDE__/courses-list.tpl" />
            </div>
            <!-- 课程评论 -->
            <div id="discuss" class="tab-pane">
                <!-- 发表评论组件 -->
                <include file="__INCLUDE__/courses-send_discuss.tpl" />
                <!-- 评论列表 -->
                <include file="__INCLUDE__/courses-discuss.tpl" />
            </div>
            <!-- 课程更新日志 -->
            <div id="log" class="tab-pane">
                <include file="__INCLUDE__/courses-log.tpl" />
            </div>
        </div>
    </article>
    <!-- 侧边栏 -->
    <aside class="container col-lg-3 col-md-3 hidden-xs hidden-sm">
        <!-- 引入作者信息 -->
        <include file="__INCLUDE__/courses-author.tpl" />
    </aside>
</div>
</body>
<!-- 引入JS文件 -->
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/jquery-1.9.1.min.js" />
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/bootstrap.min.js" />
</html>