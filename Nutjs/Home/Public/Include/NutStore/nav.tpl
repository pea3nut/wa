<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{:U('/')}" class="navbar-brand navbar-brand-nutjs_ico">
                <img class="" src="__PUBLIC__/Library/Image/nutjs.ico" alt="Nutjs" />
            </a>
            <a href="{:U('/')}" class="navbar-brand navbar-brand-nutjs_text">NutStore</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#nav-list">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="nav-list">
            <ul class="nav navbar-nav">
                <li><a href="{:U('index')}" target="_self"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
                <eq name="Think.ACTION_NAME" value="course">
                  <li class="dropdown active">
                <else />
                  <li class="dropdown">
                </eq>
                    <a href="###"><span class="glyphicon glyphicon-education"></span> 课程</a>
                </li>
                <eq name="Think.ACTION_NAME" value="tags">
                  <li class="dropdown active">
                <else />
                  <li class="dropdown">
                </eq>
                    <a href="###"><span class="glyphicon glyphicon-tags"></span> 标签</a>
                </li>
            </ul>
            <eq name="is_signin" value="1">
              <button type="button" class="btn btn-success navbar-btn btn-sm">我要投稿！&nbsp;<span class="glyphicon glyphicon-pencil"></span></button>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="{:U('Exploit/index')}" target="_self">个人中心</a></li>
              </ul>
            <else />
              <p class="navbar-text navbar-right"><a href="###" class="navbar-link">登陆</a> / <a href="#" class="navbar-link">注册</a></p>
            </eq>
        </div>
    </div>
</nav>