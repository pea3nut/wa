<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <title>购买 - {$_data.works.inf.works_name}</title>
    <load href="__STYLE__/basic.css" />
    <style>
        .tb-show-inf{
            padding-left: 20px !important;
        }
        .buy-inf .list-group-item-heading{
            margin-top: 10px;
        }
        .buy-inf p{
            text-indent: 2em;
            margin-top: 10px;
        }
    </style>
</block>
<block name="body">
    <div class="container my-body">
        <article class="col-xs-12">
            <div class="panel panel-default buy-inf">
                <div class="panel-heading"><h1 class="panel-title">核对购买信息</h1></div>
                <div class="panel-body list-group">
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">购买人信息</h4>
                        <p class="list-group-item-text">{$_data.user.uid} {$_data.user.name}</p>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">课程信息</h4>
                        <p class="list-group-item-text">{$_data.works.inf.works_name}</p>
                        <p class="list-group-item-text">By：{$_data.works.author.nickname|default=$_data.works.author.name}</p>
                    </div>
                    <div class="list-group-item">
                        <div class="list-group-item-text panel panel-default text-right">
                            <div class="panel-heading text-left"><h2 class="panel-title">统计</h2></div>
                            <table class="table">
                                <tr>
                                    <td>可用果仁：</td>
                                    <td width="1" class="tb-show-inf">{$_data.user.nuts}</td>
                                </tr>
                                <tr>
                                    <td>购买所需果仁：</td>
                                    <td>-{$_data.works.inf.price}</td>
                                </tr>
                                <tr>
                                    <td>剩余果仁：</td>
                                    <td>{$_data['user']['nuts']-$_data['works']['inf']['price']}</td>
                                </tr>
                            </table>
                            <div class="panel-body">
                                <div class="text-danger" id="_showMsg" style="display: none;">出现错误</div>
                                <button id="_goAjax" class="btn btn-success">确定购买</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>

<!-- PHP数据转换为JS全局变量 --><include file="__INCLUDE__/RAW.js.tpl" />
<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/NutjsAjax.class.js" type="text/javascript" charset="utf-8"></script>
<script src="__PUBLIC__/PeA_nut/js/nutjs_ajax/errcode.json.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">$(function(){
sign_ajax(
    null,
    NUT.URL_ROOT+"/Service/ns_buy_works/"+"?works_id={$_data.works.inf.id}",
    function(){
        location.href =RAW.U['NutStore/works']+RAW.D["works.inf.id"];
    }
);
})</script>
</block>