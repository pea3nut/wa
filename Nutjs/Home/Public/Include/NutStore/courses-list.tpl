<div class="panel panel-default">
    <div class="panel-heading">课程列表</div>
    <div class="list-group">
        <if condition="empty($section_list)"><div class="list-group-item">暂无课程</div></if>
        <volist name="section_list" id="section">
            <a href="{:U(CONTROLLER_NAME.'/body/'.$works_inf['id'].'/'.$section['id'])}" class="list-group-item">
                {$section.section_name}
                <span class="pull-right">更新时间：{$section.update_date}</span>
            </a>
        </volist>
    </div>
</div>