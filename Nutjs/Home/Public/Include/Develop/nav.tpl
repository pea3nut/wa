<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{:U('/')}" class="navbar-brand navbar-brand-nutjs_ico">
                <img class="" src="__PUBLIC__/Library/Image/nutjs.ico" alt="Nutjs" />
            </a>
            <a href="{:U('/')}" class="navbar-brand navbar-brand-nutjs_text">Nutjs.com</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#nav-list">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="nav-list">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{:U('Exploit/index')}" target="_self"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
                <in name="Think.ACTION_NAME" value="public,deploy,template,api">
                 <li class="dropdown active">
                <else />
                 <li class="dropdown">
                </in>
                    <a role="button" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-book"></span> 文档
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{:U('Exploit/public')}" target="_self">公共资源</a></li>
                        <li><a href="{:U('Exploit/deploy')}" target="_self">部署安装</a></li>
                        <li><a href="{:U('Exploit/template')}" target="_self">模板开发</a></li>
                        <li><a href="{:U('Exploit/api')}" target="_self">服务接口（API）</a></li>
                    </ul>
                </li>
                <in name="Think.ACTION_NAME" value="errcode,user_state,structure">
                 <li class="dropdown active">
                <else />
                 <li class="dropdown">
                </in>
                        <a role="button" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-list-alt"></span> 参考
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{:U('Exploit/errcode')}" target="_self">服务接口（API）返回值</a></li>
                            <li><a href="{:U('Exploit/user_state')}" target="_self">用户状态码（state）</a></li>
                            <li><a href="{:U('Exploit/structure')}" target="_self">网站构架信息</a></li>
                        </ul>
                </li>
                <in name="Think.ACTION_NAME" value="rules,tools">
                 <li class="dropdown active">
                <else />
                 <li class="dropdown">
                </in>
                        <a role="button" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon glyphicon-th"></span> 其他
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{:U('Exploit/rules')}" target="_self">开发规范建议</a></li>
                            <li><a href="{:U('Exploit/tools')}" target="_self">开发工具</a></li>
                        </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>