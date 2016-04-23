<section class="row">
<volist name="_data.works" id="works">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <a href="{:U(CONTROLLER_NAME.'/works/'.$works['inf']['id'])}">
                <img src="__IMAGE__/article/{$works.inf.id}.jpg" alt="Banner" width="640px" height="320px" />
            </a>
            <div class="caption">
                <h3>{$works.inf.works_name}</h3>
                <p>By：{$works.inf.author_uid}</p>
                <p>更新次数：{$works.inf.section_number} 次</p>
                <p>最后更新：{$works.inf.update_date}</p>
                <p>{$works.inf.works_intro}</p>
                <p>价格：{$works.inf.price} 果仁</p>
                <p>
                    购买：{$works_statistic[$works['id']]['buy_number']} 人&nbsp;&nbsp;
                    评分：
                        {//遍历平均分，每1点加一个星，一开始初始成0.99是为了防止整数少一颗星}
                        <php>
                            if(is_null($works['info']['score'])) $works['info']['score']=5;
                            $score =number_format($works['info']['score']/2 ,2);
                        </php>
                        <for start="0.99" end="$score">
                            <span class="glyphicon glyphicon-star"></span>
                        </for>
                        <egt name="works['info']['score']%2" value="1">
                            <span class="glyphicon glyphicon-star-empty"></span>
                        </egt>
                        {$score}
                </p>
                <p>
                    <a href="###" class="btn btn-primary btn-lg" role="button">查看</a>
                    <a href="###" class="btn btn-primary btn-lg" role="button">买买买！</a>
                </p>
            </div>
        </div>
    </div>
</volist>
</section>