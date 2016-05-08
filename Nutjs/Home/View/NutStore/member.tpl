<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <title>我的课程 - {$_data.user.uid}</title>
    <load href="__STYLE__/basic.css" />
</block>
<block name="body">
<div class="container my-body">

    <php>
        $works_state_msg =array('已隐藏' ,'连载中' ,'已完结');
        $works_state_col =array('text-danger' ,'text-success' ,'');
    </php>
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
                        <td><a href="{:U('works')}/{$buyInf.works.inf.id}">{$buyInf.works.inf.works_name}</a></td>
                        <empty name="buyInf.score">
                            <td>未评价</td>
                        <else />
                            <td>{$buyInf.score} 分</td>
                        </empty>
                        <td>{$buyInf.works.inf.id}</td>
                        <td>{$buyInf.works.inf.price} 果仁</td>
                        <td class="{$works_state_col[$buyInf['works']['inf']['works_state']]}">{$works_state_msg[$buyInf['works']['inf']['works_state']]}</td>
                    </tr>
                </volist>
            </table>
            <div class="panel-footer text-right">共 {:count($_data['buy'])} 门</div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">投稿的课程</div>
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
                        <td class="{$works_state_col[$submit['inf']['works_state']]}">{$works_state_msg[$submit['inf']['works_state']]}</td>
                        <td>
                            <a href="{:U('works')}/{$submit.inf.id}">查看</a>
                            <eq name="_data.target_user.uid" value="$_data.user.uid">
                            &nbsp;
                            <a href="{:U('edit')}/{$submit.inf.id}">编辑</a>
                            </eq>
                        </td>
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
                <li class="list-group-item">课程作者：
                    {$_data.target_user.name}
                    <empty name="_data.target_user.nickname"><else />
                        @{$_data.target_user.nickname}
                    </empty>
                </li>
                <li class="list-group-item">协会编号： {$_data.target_user.uid}</li>
                <li class="list-group-item">共投稿：{:count($_data['submit'])}</li>
                <li class="list-group-item">共购买：{:count($_data['buy'])}</li>
            </ul>
        </div>
    </aside>
</div>

</div>
</block>