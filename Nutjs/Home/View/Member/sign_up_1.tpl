<!DOCTYPE html>
<html>
<head>
    <include file="./Public/PeA_nut/inc/tpl/head1.tpl" />
    <meta charset="utf-8" />
    <title>会员信息填写</title>
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
            <h1 class="panel-title">会员信息填写</h1>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">用户名</label>
                <div class="col-sm-8">
                    <p class="form-control-static">{$_data.user.uid} / {$_data.user.qq}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">真实姓名</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" />
                </div>
            </div>
            <div class="form-group">
                <label for="nickname" class="col-sm-3 control-label">昵称</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nickname" name="nickname" placeholder="没有可留空" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">性别</label>
                <div class="col-sm-8">
                    <label class="radio-inline col-xs-3 col-sm-2"><input type="radio" id="gender-1" value="1" name="gender" />男</label>
                    <label class="radio-inline col-xs-3 col-sm-2"><input type="radio" id="gender-2" value="2" name="gender" />女</label>
                </div>
            </div>
            <div class="form-group">
                <label for="age" class="col-sm-3 control-label">年龄</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="age" name="age" />
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-3 control-label">爪机号</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="phone" name="phone" />
                </div>
            </div>
            <div class="form-group">
                <label for="school" class="col-sm-3 control-label">校区</label>
                <div class="col-sm-8">
                    <select name="school" class="form-control">
                    	<option value="ql">青岛理工大学</option>
                    	<option value="sk">山东科技大学</option>
                    	<option value="sy">中国石油大学</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="wechat" class="col-sm-3 control-label">微信号</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="wechat" name="wechat" placeholder="没有可留空" />
                </div>
            </div>
            <div class="alert alert-danger col-sm-10 center-block no-float" role="alert" id="_showMsg" style="display: none;">出现错误</div>
            <div class="form-group">
                <div class="col-sm-10 center-block no-float">
                    <button type="button" class="btn btn-success btn-block pull-left" id="_goAjax">Ctrl + S</button>
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
    {
        "text"  :["[name='name']" ,"[name='age']" ,"[name='phone']" ,"[name='wechat']" ,"[name='nickname']"],
        "select":"[name='school']",
        "radio" :"[name='gender']",
    },
    NUT.URL_ROOT+"/Service/sign_up_1",
    NUT.URL_ROOT
);
})</script>
</body>
</html>