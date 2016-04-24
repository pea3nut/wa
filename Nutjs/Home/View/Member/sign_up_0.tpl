<!DOCTYPE html>
<html>
<head>
    <include file="./Public/PeA_nut/inc/tpl/head1.tpl" />
    <meta charset="utf-8" />
    <title>会员注册</title>
    <style>
        .form-window{
            margin-top:60px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="panel panel-default col-xs-12 col-sm-9 col-md-6 col-lg-5 center-block no-float no-padding form-window">
        <div class="panel-heading">
            <h1 class="panel-title">会员注册</h1>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <label for="qq" class="col-sm-3 control-label">QQ号码</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="qq" name="qq" />
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">登陆密码</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
            </div>
            <div class="form-group">
                <label for="re_password" class="col-sm-3 control-label">确认密码</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="re_password" name="re_password" />
                </div>
            </div>
            <div class="form-group">
                <label for="invite_code" class="col-sm-3 control-label">邀请码</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="invite_code" name="invite_code" />
                </div>
            </div>
            <div class="form-group">
                <label for="verifycode" class="col-sm-3 control-label">验证码</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="text" class="form-control" id="verifycode" name="verifycode" />
                        <div class="input-group-addon input-group-verifycode">
                            <img src="{:U('Service/verifycode')}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger col-sm-10 center-block no-float" role="alert" id="_showMsg" style="display: none;">出现错误</div>
            <div class="form-group">
                <div class="col-sm-10 center-block no-float form-group-towbtn-3-1">
                    <button type="button" class="btn btn-success btn-block pull-left" id="_goAjax">Sign up</button>
                    <button type="button" class="btn btn-warning btn-block pull-right">返回登陆</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
            
</div>

<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">$(function(){
sign_ajax(
    ["[name='qq']" ,"[name='password']" ,"[name='re_password']" ,"[name='invite_code']" ,"[name='verifycode']"],
    NUT.URL_ROOT+"/Service/sign_up_0",
    NUT.URL_ROOT+"Member/sign_up_1"
);
})</script>
</body>
</html>