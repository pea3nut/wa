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
                <input type="email" class="form-control" value="Git协作基本流程" />
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">课程简介：</label>
                <textarea class="form-control" rows="3">本课程面向已有Git基础的同学，讲解Git协作流以及如何使用Git参与协会网站建设。在购买观看此课程前，请确保你已经有基本的Git基础，本课程仅会讲解协会开发Git工作流以及遇到某些特殊的情况如何处理，不会太多的涉及基础的Git操作。</textarea>
            </div>
            <div class="form-inline">
                <label><a href="###">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                <label>售价：</label><input type="number" class="form-control input-sm" value="2469" />果仁
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">课程列表</div>
            <ul class="list-group form-inline">
                <li class="list-group-item ">
                    <label>标题：</label><input type="text" class="form-control input-sm" value="Git分支使用情景" />
                    <label>序号：</label><input type="number" class="form-control input-sm" value="1" />
                    <label><a href="###">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                </li>
                <li class="list-group-item ">
                    <label>标题：</label><input type="text" class="form-control input-sm" value="git rebase -i 命令详解" />
                    <label>序号：</label><input type="number" class="form-control input-sm" value="2" />
                    <label><a href="###">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                </li>
                <li class="list-group-item ">
                    <label>标题：</label><input type="text" class="form-control input-sm" value="Github网站pull repuset功能" />
                    <label>序号：</label><input type="number" class="form-control input-sm" value="3" />
                    <label><a href="###">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                </li>
                <li class="list-group-item ">
                    <label>标题：</label><input type="text" class="form-control input-sm" value="rebase远程分支" />
                    <label>序号：</label><input type="number" class="form-control input-sm" value="4" />
                    <label><a href="###">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                </li>
                <li class="list-group-item ">
                    <label>标题：</label><input type="text" class="form-control input-sm" value="Git工作流" />
                    <label>序号：</label><input type="number" class="form-control input-sm" value="5" />
                    <label><a href="###">Markdown文件</a>：</label><input type="button" class="form-control btn btn-info" value="重新上传" />
                </li>
            </ul>
    </div>
    </article>
    <aside class="container col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">更新课程：</div>
        <div class="panel-body">
            <img src="__IMAGE__/git.jpg" alt="" width="100%" />
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="exampleInputEmail1">本次更新说明：</label>
                <textarea class="form-control" rows="2">更新实例代码部分的小bug</textarea>
            </div>
            <button class="btn btn-info pull-right">保存</button>
        </div>
    </div>
    </aside>
</div>
</body>
<!-- 引入JS文件 -->
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/jquery-1.9.1.min.js" />
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/bootstrap.min.js" />
</html>