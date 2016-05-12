<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <title>会员注册</title>
    <style>
        .form-window{
            margin-top:60px;
        }
        @media (min-width: 970px){
            body{
                background:url(__IMAGE__/sign_up_bg.jpg) no-repeat;
                background-position:  center 0;
                background-size: 100% ;
                background-color: #020224;
            }
            .form-window{
                position: absolute;
                margin: -230px auto 0 auto;
                top:50%;
                left:0;
                right:0;
                max-width: 420px;
                opacity: 0.8;
            }
            .form-window:hover{
                opacity: 1;
            }
        }
    </style>
</block>
<block name="body">

<div class="container" id="my-body">
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
                            <img role="verifycode" src="{:U('Service/verifycode')}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger col-sm-10 center-block no-float" role="alert" id="_showMsg" style="display: none;">出现错误</div>
            <div class="form-group">
                <div class="col-sm-10 center-block no-float form-group-towbtn-1-3">
                    <button type="button" class="btn btn-warning btn-block">返回登陆</button>
                    <button type="button" class="btn btn-success btn-block" id="_goAjax">Sign up</button>
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
        NUT.URL_ROOT+"/Member/sign_up_1"
    );
    //设定主部分高度
    $('#my-body').css("min-height",innerHeight);
    $(window).on("resize",function(){
        $('#my-body').css("min-height",innerHeight);
    })
    //导航条反色
    $("#_nav").addClass("navbar-inverse").css("height");
    //版权声明反色
    $("#_foot").css("backgroundColor","#020224").css("color","#85dcf8");
});</script>
</block>