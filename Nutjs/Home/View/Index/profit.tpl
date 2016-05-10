<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <title>协会盈利状况</title>
    <load href="__STYLE__/profit.css" />
    <load href="__SCRIPT__/profit.js" />
    <load href="__PUBLIC__/Library/Repository/jquery-animateNumber/jquery.animateNumber.min.js" />
</block>
<block name="body">
    <div class="my-body container">
        <div>
            <p class="nutjs-philosophy">我们一直坚持开源并以非盈利为目的，自2014年12月2日至今盈利为：</p>
            <p class="profit-show"><span id="profit_num">0</span> ￥</p>
        </div>
        <div class="hr-nutjs">推广Web开发技术不仅是<strong>荣誉</strong>，更是<strong>使命</strong>！</div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">收支明细</h3>
                </div>
                <div class="panel-body show-profit-list">
                    <div class="show-profit-list-value profit-cash"><include file="__INCLUDE__/profit-cash.tpl" /></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">资金支持名单</h3>
                </div>
                <div class="panel-body show-profit-list">
                    <div class="show-profit-list-value"><include file="__INCLUDE__/profit-support.tpl" /></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">打赏名单</h3>
                </div>
                <div class="panel-body show-profit-list">
                    <div class="show-profit-list-value"><include file="__INCLUDE__/profit-donate.tpl" /></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">捐赠我们</h3>
                </div>
                <div class="panel-body">
                    <img src="__PUBLIC__/Library/Image/donation-nutjs-qrcode.png" class="img-responsive" />
                    <p class="text-center">如果你喜爱这个技术交流平台，我们愿意接受来自各方面的捐赠</p>
                </div>
            </div>
        </div>
    </div>
</block>