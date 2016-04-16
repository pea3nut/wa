<!DOCTYPE html>
<html>
<head>
    <include file="./Public/PeA_nut/inc/tpl/head1.tpl" />
    <title>会员登录</title>
    <style type="text/css">
        .login-window{
            margin: 60px 0;
        }
        .form-group-towbtn button{
            width:48%;
            margin:0 !important;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="panel panel-default col-xs-12 col-md-4 col-lg-3 pull-right login-window">
        <div class="panel-heading">
            <h3 class="panel-title">会员登录</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" class="form-control" id="username" name="username" />
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="text" class="form-control" id="password" name="password" />
            </div>
            <div class="form-group">
                <label for="verifycode">验证码</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="verifycode" name="verifycode">
                    <div class="input-group-addon input-group-verifycode"><img src="{:U('Service/verifycode')}" /></div>
                </div>
            </div>
            <div class="alert alert-danger" role="alert" id="_showMsg" style="display: none;">验证码不符！</div>
            <div class="form-group">
                <button id="_goAjax" type="button" class="btn btn-success btn-block">Sign in</button>
            </div>
            <div class="form-group form-group-towbtn">
                <button type="button" class="btn btn-info btn-block pull-left">注册</button>
                <button type="button" class="btn btn-warning btn-block pull-right">忘记密码</button>
            </div>
        </div>
    </div>
</div>


<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">$(function(){
sign_ajax(
    ["[name='username']" ,"[name='password']" ,"[name='verifycode']"],
    "{:U('Service/sign_in')}"
);
})</script>
</body>
</html>