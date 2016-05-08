<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">作品章节</h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>章节号</td>
                <td>名称</td>
                <td>内容</td>
                <td width="100" class="text-right"><button class="btn btn-success btn-xs section_create_form">+ New Section</button></td>
            </tr>
        </thead>
        <tbody class="section_list">
            <volist name="_data.works.section" id="section">
                <tr class="section_row">
                    <include file="__INCLUDE__/edit-section_row.tpl" />
                </tr>
            </volist>
            <assign name="section" value="" />
            <tr class="hide section_row_tpl section_row">
                <include file="__INCLUDE__/edit-section_row.tpl" />
            </tr>
        </tbody>
    </table>
</div>