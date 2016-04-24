<style type="text/css">
    .buy-now{
        margin:-37px 0 0 0;
    }
    .works-price strong{
        color: #f40;
        font-family: verdana,arial;
        font-weight: 700;
    }
</style>

<header>
    <h1>{$_data.works.inf.works_name}</h1>
    <p>更新次数：{$_data.works.inf.update_number} 次 &nbsp; 最后更新：{$_data.works.inf.update_date}</p>
    <p>{$_data.works.inf.works_intro}</p>
    <p class="works-price">价格：<strong>{$_data.works.inf.price}</strong> 果仁</p>
    <p>购买：{$_data['works']['info']['sum']} 人 &nbsp; 评分：
            {//遍历平均分，每1点加一个星，一开始初始成0.99是为了防止整数少一颗星}
            <php>
                $score =number_format($_data['works']['info']['score']/2 ,2);
            </php>
            <for start="0.99" end="$score">
                <span class="glyphicon glyphicon-star"></span>
            </for>
            <egt name="_data['works']['info']['score']%2" value="1">
                <span class="glyphicon glyphicon-star-empty"></span>
            </egt>
            {$score}
    </p>
    <a href="{:U('NutStore/buy/'.$_data['works']['inf']['id'])}" class="btn btn-primary pull-right buy-now" role="button">购买</a>
</header>