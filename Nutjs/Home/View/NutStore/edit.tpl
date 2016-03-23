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
    <article class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">编辑课程</div>
        <div class="panel-body ">
            <div class="form-group">
                <label>课程名称：</label>
                <input type="email" class="form-control" value="{$data.works_name}" />
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课程简介：</label>
                <textarea class="form-control" rows="3">{$data.works_intro}</textarea>
            </div>
            <div class="form-inline">
                <label><a href="{:U(CONTROLLER_NAME.'/body/'.$data['id'].'/0')}">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                <label>售价：</label><input type="number" class="form-control input-sm" value="{$data.price}" />果仁
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">课程列表</div>
            <ul class="list-group form-inline">
            <volist name="data.section" id="section">
                <li class="list-group-item ">
                    <label>标题：</label><input type="text" class="form-control input-sm" value="{$section.section_name}" />
                    <label>序号：</label><input type="number" class="form-control input-sm" value="{$section.section_id}" />
                    <label><a href="{:U(CONTROLLER_NAME.'/body/'.$section['works_id'].'/'.$section['section_id'])}">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                </li>
            </volist>
                <li class="list-group-item text-right">
                    <input type="button" class="form-control btn btn-success" value="新建" />
                </li>
            </ul>
    </div>
    </article>
    <aside class="container col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">更新课程：</div>
        <div class="panel-body">
            <img src="__IMAGE__/article/{$data.id}.jpg" alt="" style="width:100%;" />
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="exampleInputEmail1">本次更新说明：</label>
                <textarea class="form-control" rows="2">Fix bug.</textarea>
            </div>
            <button class="btn btn-info pull-right">保存</button>
        </div>
    </div>
    </aside>
</div>
<!-- 引入版权信息 -->
<include file="./Public/PeA_nut/inc/nutjs.footer.tpl" />
</body>
<!-- 引入JS文件 -->
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/jquery-1.9.1.min.js" />
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/bootstrap.min.js" />
</html>