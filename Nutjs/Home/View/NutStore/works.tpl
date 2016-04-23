<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
</block>
<block name="body">
    <div class="container my-body">
    <article class="col-lg-9 col-md-9 col-xs-12">
        <!-- 引入课程信息简介 -->
        <include file="__INCLUDE__/works-inf.tpl" />
        <!-- 导航条 -->
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#preface" data-toggle="tab">序言</a></li>
            <li role="presentation"><a href="#courses_list" data-toggle="tab">课程</a></li>
            <li role="presentation"><a href="#log" data-toggle="tab">更新日志 (7)</a></li>
        </ul>
        <!-- 主内容 -->
        <div class="tab-content">
            <!-- 课程序言 -->
            <div id="preface" class="tab-pane">
                {$_data.works.preface|default="<h1>没有序言</h1>"}
            </div>
            <!-- 课程列表 -->
            <div id="courses_list" class="tab-pane">
                <include file="__INCLUDE__/works-list.tpl" />
            </div>
            <!-- 课程更新日志 -->
            <div id="log" class="tab-pane active">
                <include file="__INCLUDE__/works-log.tpl" />
            </div>
        </div>
    </article>
    <!-- 侧边栏 -->
    <aside class="container col-lg-3 col-md-3 hidden-xs hidden-sm">
        <!-- 引入作者信息 -->
        <include file="__INCLUDE__/courses-author.tpl" />
    </aside>
    </div>
</block>