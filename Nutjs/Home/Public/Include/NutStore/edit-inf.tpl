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
            <div class="form-group">
                <label class="col-sm-3 control-label" for="banner">作品Banner</label>
                <div class="col-sm-8">
                    <input type="file" name="banner" id="banner" class="form-control">
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