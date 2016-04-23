

<div class="panel panel-default">
    <div class="panel-heading">作品章节</div>
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <td>章节号</td>
                <td>名称</td>
                <td>最后修改时间</td>
                <td>操作</td>
            </tr>
        </thead>
        <tbody>
            <volist name="_data.works.section" id="section">
                <tr>
                    <td>{$section.section_id}</td>
                    <td>{$section.section_name}</td>
                    <td>{$section.update_date}</td>
                    <td>
                        <a href="###">编辑</a>
                        <a href="{:U('NutStore/read/'.$section['works_id'].'/'.$section['section_id'])}">查看</a>
                    </td>
                </tr>
            </volist>
        </tbody>
    </table>
</div>