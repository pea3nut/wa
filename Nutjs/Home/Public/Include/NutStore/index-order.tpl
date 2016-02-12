<ul class="nav nav-tabs">
    <if condition="$order eq 'time_desc' || empty($order)">
        <li role="presentation" class="active"><a href="#">时间<span class="glyphicon glyphicon-download"></span></a></li>
    <elseif condition="$order eq 'time_asc'"/>
        <li role="presentation" class="active"><a href="#">时间<span class="glyphicon glyphicon-upload"></span></a></li>
    <else />
        <li role="presentation"><a href="#">时间</a></li>
    </if>
    <if condition="$order eq 'hot_desc'">
        <li role="presentation" class="active"><a href="#">热度<span class="glyphicon glyphicon-download"></span></a></li>
    <elseif condition="$order eq 'hot_asc'"/>
        <li role="presentation" class="active"><a href="#">热度<span class="glyphicon glyphicon-upload"></span></a></li>
    <else />
        <li role="presentation"><a href="#">热度</a></li>
    </if>
    <if condition="$order eq 'price_desc'">
        <li role="presentation" class="active"><a href="#">价格<span class="glyphicon glyphicon-download"></span></a></li>
    <elseif condition="$order eq 'price_asc'"/>
        <li role="presentation" class="active"><a href="#">价格<span class="glyphicon glyphicon-upload"></span></a></li>
    <else />
        <li role="presentation"><a href="#">价格</a></li>
    </if>
</ul>