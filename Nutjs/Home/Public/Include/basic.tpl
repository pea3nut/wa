<!DOCTYPE html>
<html>
<head>
    <include file="./Public/PeA_nut/inc/tpl/head1.tpl" />
    <meta charset="utf-8" />
    <block name="head"></block>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" id="_nav">
    <div class="container">
        <div class="navbar-header">
            <a href="{:U('/')}" class="navbar-brand navbar-brand-nutjs_ico">
                <img width="25" src="__PUBLIC__/Library/Image/nutjs.ico" alt="Nutjs" />
            </a>
            <a href="{:U('/')}" class="navbar-brand navbar-brand-nutjs_text">Nutjs.com</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#nav-list">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="nav-list">
            <if condition="!$_data['isLogged']">
                <p class="navbar-text navbar-right">
                    <a href="{:U('Member/sign_in')}" class="navbar-link">登陆</a>
                    /
                    <a href="{:U('Member/sign_up_0')}" class="navbar-link">注册</a>
                </p>
            </if>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{:U('index')}" target="_self"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
                <li class="dropdown">
                    <a role="button" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-book"></span> 文档 / 手册
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">开发文档</li>
                        <li><a href="{:U('Develop/rules')}" target="_self">开发建议</a></li>
                        <li><a href="{:U('Develop/deploy')}" target="_self">部署安装</a></li>
                        <li><a href="{:U('Develop/join')}" target="_self">如何参与</a></li>
                        <li><a href="{:U('Develop/template')}" target="_self">模板开发指南</a></li>
                        <li class="dropdown-header">参考手册</li>
                        <li><a href="{:U('Develop/_data')}" target="_self">模板数据</a></li>
                        <li><a href="{:U('Develop/url')}" target="_self">URL速查</a></li>
                        <li><a href="{:U('Develop/api')}" target="_self">API请求</a></li>
                        <li><a href="{:U('Develop/errcode')}" target="_self">API返回</a></li>
                        <li><a href="{:U('Develop/user_state')}" target="_self">state码</a></li>
                        <li class="dropdown-header">其他</li>
                        <li><a href="{:U('Develop/public')}" target="_self">公共资源</a></li>
                        <li><a href="{:U('Develop/structure')}" target="_self">网站构架信息</a></li>
                        <li><a href="{:U('Develop/tools')}" target="_self">开发工具</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a role="button" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-briefcase"></span> 果仁商店
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{:U('NutStore/rules')}" target="_self">投稿新课程</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{:U('NutStore/rules')}" target="_self">商店首页</a></li>
                        <li><a href="{:U('NutStore/rules')}" target="_self">我的课程</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a role="button" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-briefcase"></span> 其他
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{:U('NutStore/rules')}" target="_self">协会历史</a></li>
                        <li><a href="{:U('NutStore/rules')}" target="_self">公告查看</a></li>
                        <li><a href="{:U('NutStore/rules')}" target="_self">手机资料片</a></li>
                        <li><a href="{:U('NutStore/rules')}" target="_self">Markdown渲染</a></li>
                    </ul>
                </li>
                <if condition="$_data['isLogged']">
                    <li class="dropdown">
                        <a role="button" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span> {$_data.user.uid}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{:U('Exploit/rules')}" target="_self">更新资料</a></li>
                            <li><a href="{:U('Exploit/rules')}" target="_self">修改密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{:U('Exploit/rules')}" target="_self">Sign out</a></li>
                        </ul>
                    </li>
                </if>
            </ul>
        </div>
    </div>
</nav>
<block name="body"></block>
<include file="./Public/PeA_nut/inc/tpl/nutjs.footer.tpl" />
</body>
</html>