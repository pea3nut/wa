<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">修改作品信息</h1>
    </div>
    <div class="panel-body form-horizontal">
        <input type="hidden" name="works_id" id="works_id" value="{$_data.works.inf.id}">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="works_name">作品名称</label>
            <div class="col-sm-8">
                <input type="text" name="works_name" id="works_name" class="form-control" value="{$_data.works.inf.works_name}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="works_intro">简介</label>
            <div class="col-sm-8">
                <textarea placeholder="可选，支持Markdown语法" name="works_intro" id="works_intro" class="form-control">{$_data.works.inf.works_intro}</textarea>
            </div>
        </div>
        <div class="form-group upload_group">
            <label class="col-sm-3 control-label" for="banner">Banner</label>
            <div class="col-sm-8">
                <empty name="_data.works.inf.edit_banner">
                    <img alt="Upload img" class="img-responsive upload_img upload_call_file" src="{$_data.works.inf.banner|default='__PUBLIC__/Library/Image/no-image.png'}" />
                <else />
                    <img alt="Upload img" class="img-responsive upload_img upload_call_file" src="{$_data.works.inf.edit_banner}" />
                </empty>
                <div class="progress works-banner-progress-shell" style="display: none;">
                    <div class="works-banner-progress progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">
                        0%
                    </div>
                </div>
                <input type="file" name="banner" title="640px * 360px" id="banner" class="hidden upload_file">
                <div class="upload_msg upload-msg alert alert-danger" style="display: none;">上传失败</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="price">售价</label>
            <div class="col-sm-8">
                <input type="text" name="price" id="price" class="form-control" value="{$_data.works.inf.price}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="price">作品状态</label>
            <div class="col-sm-8">
                <select name="works_state" id="works_state" class="form-control">
                    <option value="1">更新中</option>
                    <option value="2">已完结</option>
                </select>
            </div>
            <script type="text/javascript">
                var works_state_value ={$_data.works.inf.works_state};
                $("[name='works_state']").val(works_state_value);
            </script>
        </div>
        <div style="display: none;" id="_showMsg" role="alert" class="alert alert-danger col-sm-10 center-block no-float">出现错误</div>
        <div class="form-group">
            <div class="col-sm-10 center-block no-float form-group-towbtn-1-3">
                <button class="btn btn-danger btn-block" type="button">删除</button>
                <button id="_goAjax" class="btn btn-success btn-block" type="button">Ctrl + S</button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>