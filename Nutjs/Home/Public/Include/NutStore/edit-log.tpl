<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">更新日志</h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>日志</td>
                <td>时间</td>
                <td width="100" class="text-right"><button class="btn btn-success btn-xs log_create">+ New Log</button></td>
            </tr>
        </thead>
        <tbody class="log_list">
            <volist name="_data.works.log" id="log">
                <tr class="log_row">
                    <td>{$log.log}</td>
                    <td>{$log.date}</td>
                    <td class="text-right">
                        <button class="btn btn-danger btn-xs log_del">删除</button>
                        <div class="text-danger log_errmsg"></div>
                        <input type="hidden" name="log_id" value="{$log.id}" />
                    </td>
                </tr>
            </volist>
        </tbody>
    </table>
</div>