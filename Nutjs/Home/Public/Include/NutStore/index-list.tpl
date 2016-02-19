<section class="row">
<volist name="works_inf" id="works">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <a href="{:U(CONTROLLER_NAME.'/courses/'.$works['id'])}"><img src="__IMAGE__/article/{$works.id}.jpg" alt="" /></a>
            <div class="caption">
                <h3>{$works.works_name}</h3>
                <p>By：{$works.author_uid}</p>
                <p>更新次数：{$works.section_number} 次</p>
                <p>最后更新：{$works.update_date}</p>
                <p>{$works.works_intro}</p>
                <p>价格：{$works.price} 果仁</p>
                <p>
                    购买：{$works_statistic[$works['id']]['buy_number']} 人&nbsp;&nbsp;
                    评分：
                    {//获取作品平均分}
                    <assign name="avg_score" value="$works_statistic[$works['id']]['avg_score'] /2" />
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
            </div>
        </div>
    </div>
</volist>
</section>