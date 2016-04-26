<!DOCTYPE html>
<html>
<head>
    <include file="./Public/PeA_nut/inc/tpl/head1.tpl" />
    <meta charset="utf-8" />
    <title>会员登录</title>
    <style type="text/css">
        @media (min-width: 970px){
            body{
                background:url(__IMAGE__/sign_in_bg.jpg) no-repeat;
                background-position:  center 30%;
                background-size: 100%;
            }
            .login-window{
                max-width: 360px;
            }
        }
        .login-window{
            margin: 60px 0;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="col-xs-12 col-md-4 col-lg-3 pull-right login-window">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">会员登录</h1>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" id="username" name="username" />
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="form-group">
                    <label for="verifycode">验证码</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="verifycode" name="verifycode">
                        <div class="input-group-addon input-group-verifycode"><img role="verifycode" src="{:U('Service/verifycode')}" /></div>
                    </div>
                </div>
                <div class="alert alert-danger" role="alert" id="_showMsg" style="display: none;">出现错误</div>
                <div class="form-group">
                    <button id="_goAjax" type="button" class="btn btn-success btn-block">Sign in</button>
                </div>
                <div class="form-group form-group-towbtn">
                    <a role="button" target="_self" class="btn btn-info btn-block pull-left" href="{:U('sign_up_0')}">注册</a>
                    <a role="button" target="_self" class="btn btn-warning btn-block pull-right" href="{:U('forget_password')}">忘记密码</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">$(function(){
    sign_ajax(
        ["[name='username']" ,"[name='password']" ,"[name='verifycode']"],
        NUT.URL_ROOT+"/Service/sign_in"
    );
});</script>
</body> 
</html> 