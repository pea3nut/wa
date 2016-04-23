<header class="page-header">
    <h1>{$_data.works.inf.works_name}
        <small class="pull-right">
            - By：{$_data.works.author.nickname|default=$_data.works.author.name}
        </small>
    </h1>
    <p>
        -更新次数：{$_data.works.inf.update_number} 次
        -最后更新：{$_data.works.inf.update_date}
    </p>
    <p>{$_data.works.inf.works_intro}</p>
    <p>价格：{$_data.works.inf.price} 果仁</p>
    <p>
        -购买：{$_data['works']['info']['sum']} 人&nbsp;&nbsp;
        -评分：
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
    <p><a href="###" class="btn btn-primary btn-lg" role="button">买买买！</a></p>
</header>