<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
</block>
<block name="body">
<div class="container my-body">

    <article class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">已购买的课程</div>
            <table class="table">
                <tr>
                    <td>购买记录ID</td>
                    <td>课程名称</td>
                    <td>你的评价</td>
                    <td>课程ID</td>
                    <td>售价</td>
                    <td>课程状态</td>
                </tr>
                <volist name="_data.buy" id="buyInf">
                    <tr>
                        <td>{$buyInf.id}</td>
                        <td>{$buyInf.works.inf.works_name}</td>
                        <td>{$buyInf.score} 分</td>
                        <td>{$buyInf.works.inf.id}</td>
                        <td>{$buyInf.works.inf.price} 果仁</td>
                        <td>{$buyInf.works.inf.works_state}</td>
                    </tr>
                </volist>
            </table>
            <div class="panel-footer text-right">共 {:count($_data['buy'])} 门</div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">我投稿的课程</div>
            <table class="table">
                <tr>
                    <td>课程ID</td>
                    <td>课程名称</td>
                    <td>售价</td>
                    <td>课程状态</td>
                    <td>操作</td>
                </tr>
                <volist name="_data.submit" id="submit">
                    <tr>
                        <td>{$submit.inf.id}</td>
                        <td>{$submit.inf.works_name}</td>
                        <td>{$submit.inf.price} 果仁</td>
                        <td>{$submit.inf.works_state}</td>
                        <td><a href="{:U('edit')}/{$submit.inf.id}">编辑</a></td>
                    </tr>
                </volist>
            </table>
            <div class="panel-footer text-right">共 {:count($_data['submit'])} 门</div>
        </div>
    </article>
    <aside class="container col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">个人资料<a class="pull-right" href="###">编辑</a></div>
            <ul class="list-group">
                <li class="list-group-item">投稿昵称：{$_data.user.nickname|default=$_data.user.name}</li>
                <li class="list-group-item">共投稿：{:count($_data['submit'])}</li>
                <li class="list-group-item">共购买：{:count($_data['buy'])}</li>
            </ul>
        </div>
    </aside>
</div>

</div>
</block>