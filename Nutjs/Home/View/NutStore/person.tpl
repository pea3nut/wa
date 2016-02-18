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
<div class="container text-body">
   <!-- 渲染输出指定markdown-->
    <article class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">已购买的课程</div>
            <ul class="list-group">
                <li class="list-group-item"><a href="###">Cras justo odio<span class="pull-right">2016-2-13</span></a></li>
                <li class="list-group-item"><a href="###">Dapibus ac facilisis in<span class="pull-right">2016-2-13</span></a></li>
                <li class="list-group-item"><a href="###">Morbi leo risus<span class="pull-right">2016-2-13</span></a></li>
            </ul>
            <div class="panel-footer text-right">共 3 门</div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">我投稿的课程</div>
            <ul class="list-group">
                <li class="list-group-item"><a href="###">Porta ac consectetur ac<span class="pull-right">2016-2-13</span></a></li>
                <li class="list-group-item"><a href="###">Vestibulum at eros<span class="pull-right">2016-2-13</span></a></li>
            </ul>
            <div class="panel-footer text-right">共 2 门</div>
        </div>
    </article>
    <aside class="container col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">个人资料<a class="pull-right" href="###">编辑</a></div>
            <div class="panel-body">
                <img src="__PUBLIC__/PeA_nut/img/PeA_nut.jpg" alt="" style="width:100%;" />
            </div>
            <ul class="list-group">
                <li class="list-group-item">昵称：花生PeA</li>
                <li class="list-group-item">个性签名：写代码、控V家，相信就会存在，请叫我花生。</li>
            </ul>
        </div>
    </aside>
</div>
</body>
<!-- 引入JS文件 -->
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/jquery-1.9.1.min.js" />
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/bootstrap.min.js" />
</html>