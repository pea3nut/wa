<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title"></h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>名称</td>
                <td>时间</td>
                <td>操作</td>
            </tr>
        </thead>
        <tbody>
            <volist name="_data.works.log" id="log">
                <tr>
                    <td>{$log.log}</td>
                    <td>{$log.date}</td>
                    <td>
                        <a href="###">删除</a>
                    </td>
                </tr>
            </volist>
        </tbody>
    </table>
</div>