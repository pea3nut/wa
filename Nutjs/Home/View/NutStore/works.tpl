<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
    <style type="text/css">
        #preface .panel-body{
            padding-top: 0;
        }
    </style>
</block>
<block name="body">
<div class="container my-body">
    <article class="col-lg-9 col-md-9 col-xs-12">
        <!-- 引入课程信息简介 -->
        <include file="__INCLUDE__/works-inf.tpl" />
        <!-- 导航条 -->
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#preface" data-toggle="tab">序言</a></li>
            <li role="presentation"><a href="#courses_list" data-toggle="tab">课程 ({:count($_data['works']['section'])})</a></li>
            <li role="presentation"><a href="#log" data-toggle="tab">更新日志 ({:count($_data['works']['log'])})</a></li>
        </ul>
        <!-- 主内容 -->
        <div class="tab-content">
            <!-- 课程序言 -->
            <div id="preface" class="tab-pane active">
                <div class="panel panel-default">
                    <div class="panel-body">{$_data.works.preface|default="<h1>没有序言</h1>"}</div>
                </div>
            </div>
            <!-- 课程列表 -->
            <div id="courses_list" class="tab-pane">
                <include file="__INCLUDE__/works-list.tpl" />
            </div>
            <!-- 课程更新日志 -->
            <div id="log" class="tab-pane">
                <include file="__INCLUDE__/works-log.tpl" />
            </div>
        </div>
    </article>
    <!-- 侧边栏 -->
    <aside class="container col-lg-3 col-md-3 hidden-xs hidden-sm">
        <div class="panel panel-default">
            <div class="panel-heading">作者信息</div>
            <div class="panel-body">
                <img src="__IMAGE__/article/{$_data.works.inf.id}.jpg" class="img-responsive" />
            </div>
            <ul class="list-group">
                <li class="list-group-item">课程作者：
                    {$_data.works.author.name}
                    <empty name="_data.works.author.nickname"><else />
                        @{$_data.works.author.nickname}
                    </empty>
                </li>
                <li class="list-group-item">协会编号： {$_data.works.author.uid}</li>
                <li class="list-group-item text-right"><a href="{:U('NutStore/member/')}/{$_data.works.author.uid}">查看更多</a></li>
            </ul>
        </div>
    </aside>
</div>
</block>