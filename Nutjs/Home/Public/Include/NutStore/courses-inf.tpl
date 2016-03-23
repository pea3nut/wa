<header class="page-header">
    <h1>{$data.works_name}<small class="pull-right">- By：{$data.inf.nickname}</small></h1>
    <p>更新次数：{$data.section_number} 次&nbsp;&nbsp;&nbsp;最后更新：{$data.update_date}</p>
    <p>{$data.works_intro}</p>
    <p>价格：{$data.price} 果仁</p>
    <p>
     购买：{:count($data['buy'])} 人&nbsp;&nbsp;
     评分：{//遍历平均分，每1点加一个星，一开始初始成0.99是为了防止整数少一颗星}
     <for start="0.99" end="$avg_score">
         <span class="glyphicon glyphicon-star"></span>
     </for>
<if condition="$avg_score - (int)$avg_score egt 0.75"><span class="glyphicon glyphicon-star"></span>
<elseif condition="$avg_score - (int)$avg_score egt 0.25" /><span class="glyphicon glyphicon-star-empty"></span>
</if>
        {$avg_score}
    </p>
    <p><a href="###" class="btn btn-primary btn-lg" role="button">买买买！</a></p>
</header>