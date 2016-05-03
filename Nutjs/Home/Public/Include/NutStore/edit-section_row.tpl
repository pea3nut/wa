<td>
    <span class="section_id">{$section.section_id}</span>
    <input type="text" name="section_id" style="display: none;" value="{$section.section_id}" />
    <input type="hidden" name="id" value="{$section.id}" />
</td>
<td>
    <span class="section_name">{$section.section_name}</span>
    <input type="text" name="section_name" style="display: none;" value="{$section.section_name}" />
</td>
<td class="hide raw-data"
    has-md="{$section['has_md']}" 
    has-edit-md="{$section['has_edit_md']}"
    section-id="{$section.id}"
></td>
<td>
    <input type="file" name="file" class="hidden section_upload" />
    <div class="segr segr-secgr-create">
        <button class="btn btn-default btn-xs section_upload_btn">上传章节</button>
    </div>
    <div class="segr segr-secgr-default">
        <a href="{:U('NutStore/read/'.$section['works_id'].'/'.$section['section_id'])}">查看</a>
        <button class="btn btn-default btn-xs section_upload_btn">重新上传</button>
    </div>
    <div class="segr segr-secgr-edit">
        <a href="{$section['has_edit_md']}">未保存的章节</a>
        <button class="btn btn-default btn-xs section_upload_btn">重新上传</button>
    </div>
</td>
<td>
    <div class="segr segr-btngr-create">
        <button class="btn btn-success btn-xs section_create">保存</button>
        <button class="btn btn-danger btn-xs section_del_form">删除</button>
    </div>
    <div class="segr segr-btngr-default">
        <button class="btn btn-info btn-xs section_edit">编辑</button>
        <button class="btn btn-danger btn-xs section_del">删除</button>
    </div>
    <div class="segr segr-btngr-edit">
        <button class="btn btn-success btn-xs section_save">保存</button>
        <button class="btn btn-default btn-xs section_cancel">取消</button>
    </div>
    <div class="section_errmsg text-danger"></div>
</td>