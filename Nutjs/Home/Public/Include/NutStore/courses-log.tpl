<ul class="list-group">
    <volist name="data.log" id="log">
        <li class="list-group-item">
            <div class="panel panel-default">
                <div class="panel-heading">{$log.date}</div>
                <div class="panel-body">{$log.log}</div>
            </div>
        </li>
    </volist>
</ul>