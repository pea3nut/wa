<div class="panel panel-default">
    <div class="panel-heading">课程列表</div>
    <div class="list-group">
        <empty name="_data['works']['section']">
            <div class="list-group-item">暂无课程</div>
        </empty>
        <volist name="_data.works.section" id="section">
            <a href="{:U(CONTROLLER_NAME.'/read/'.$_data['works']['inf']['id'].'/'.$section['section_id'])}" class="list-group-item">
                {$section.section_name}
                <span class="pull-right">更新时间：{$section.update_date}</span>
            </a>
        </volist>
    </div>
</div>