<ul class="list-group">
    <empty name="_data.works.log">
        <li class="list-group-item">暂无更新日志</li>
    </empty>
    <volist name="_data.works.log" id="log">
        <li class="list-group-item">
            <div class="panel panel-default">
                <div class="panel-heading">{$log.date}</div>
                <div class="panel-body">{$log.log}</div>
            </div>
        </li>
    </volist>
</ul>