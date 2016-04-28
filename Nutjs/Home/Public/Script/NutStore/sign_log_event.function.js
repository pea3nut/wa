/**
 * 注册更新日志增删操作
 * @param {String} create_url 创建日志的请求链接地址
 * @param {String} delete_url 删除日志的请求链接地址
 * @param {Number} works_id 请求的works_id
 * */
function sign_log_event(create_url ,delete_url,works_id){
//创建日志表单
$(".log_create").on("click",function(){
    $(".log_list").append('\
        <tr class="log_row">\
            <td><input type="text" name="log" value="Fix bug." /></td>\
            <td><input type="date" name="date" value="'+get_short_date()+'" /></td>\
            <td class="text-right">\
                <button class="btn btn-default btn-xs log_submit">保存</button>\
                <button class="btn btn-danger btn-xs log_del_form">删除</button>\
                <div class="text-danger log_errmsg"></div>\
                <input type="hidden" name="log_id" class="log_id" value="0" />\
            </td>\
        </tr>\
    ');
});
//删除未提交的日志表单
$(".log_list").delegate(".log_del_form" ,"click" ,function(event){
    $(this).parents(".log_row").remove();
});
//删除日志
$(".log_list").delegate(".log_del" ,"click" ,function(event){
    var sendElt =$(this);
    var eltGroup =sendElt.parents(".log_row");
    // 禁用按钮
    sendElt.prop("disabled",true);
    //实例化Ajax请求
    var ajax_req =new $.NutjsAjax({
        "field"     :[eltGroup.find("[name='log_id']")],
        "reqMode"   :"post",
        "reqUrl"    :delete_url,
        "onSuccsee" :function(){
            eltGroup.find(".log_del")
                .removeClass("log_del")
                .addClass("log_del_form")
                .click()
            ;
        },
        "showMsgFn" :function($msg){
            eltGroup.find(".log_errmsg").html($msg).show();
        },
        "callBack"  :function($data){
            // 恢复按钮样式
            sendElt.removeProp("disabled");
            // 执行默认的回调函数
            this.defaultCallBack($data);
        }
    });
    // 计算字段，发送
    ajax_req.countField();
    ajax_req.send();
});
//保存日志
$(".log_list").delegate(".log_submit" ,"click" ,function(event){
    var sendElt =$(this);
    var eltGroup =sendElt.parents(".log_row");
    //禁用按钮
    sendElt.prop("disabled",true);
    var ajax_req =new $.NutjsAjax({
        "field"     :[eltGroup.find("[name='log']"),eltGroup.find("[name='date']")],
        "reqUrl"    :create_url,
        "onSuccsee" :function($data){
            //将表单转换为文本
            for(var i=0;i<this.field.length;i++){
                var tpElt =$(this.field[i]);
                tpElt.before(tpElt.val());
                tpElt.remove();
            };
            //删除发送按钮
            sendElt.remove();
            //改变删除按钮功能
            eltGroup.find(".log_del_form")
                .removeClass("log_del_form")
                .addClass("log_del")
            ;
            //添加隐藏域内容
            eltGroup.find(".log_id").val($data.errmsg);
        },
        "showMsgFn" :function($msg){
            eltGroup.find(".log_errmsg").html($msg).show();
        },
        "callBack"  :function($data){
            // 恢复按钮样式
            sendElt.removeProp("disabled");
            // 执行默认的回调函数
            this.defaultCallBack($data);
        }
    });
    // 计算字段，发送
    ajax_req.countField();
    ajax_req.fieldData["works_id"]=works_id;
    ajax_req.send();
});
};