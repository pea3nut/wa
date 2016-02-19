<header class="page-header">
    <h1>{$works_inf.works_name}<small class="pull-right">- By：{$works_inf.author_uid}</small></h1>
    <p>更新次数：{$works_inf.section_number} 次&nbsp;&nbsp;&nbsp;最后更新：{$works_inf.update_date}</p>
    <p>{$works_inf.works_intro}</p>
    <p>价格：{$works_inf.price} 果仁</p>
    <p>
     购买：{$works_inf.buy_number} 人&nbsp;&nbsp;
     评分：
     {//获取作品平均分}
     <assign name="avg_score" value="$works_inf['avg_score']/2" />
     {//遍历平均分，每1点加一个星，一开始初始成0.99是为了防止整数少一颗星}
     <for start="0.99" end="$avg_score">
         <span class="glyphicon glyphicon-star"></span>
     </for>
<if condition="$avg_score - (int)$avg_score egt 0.75"><span class="glyphicon glyphicon-star"></span>
<elseif condition="$avg_score - (int)$avg_score egt 0.25" /><span class="glyphicon glyphicon-star-empty"></span>
</if>
        {:number_format($avg_score,1)}
    </p>
    <p><a href="###" class="btn btn-primary btn-lg" role="button">买买买！</a></p>
</header>