jQuery.NutjsAjax =function ($option){
    //要的发送字段
    this.field      =$option.field;
    //Ajax请求后的回调函数
    this.callBack   =$option.callBack?$option.callBack:this.defaultCallBack;
    //默认回调解析配置
    this.showMsgFn  =$option.showMsgFn;
    this.alertMsgFn =$option.alertMsgFn;
    //要请求的地址
    this.reqUrl     =$option.reqUrl?$option.reqUrl:document.URL;
    //发送模式
    this.reqMode    =$option.reqMode?$option.reqMode:'post';
    //成功后的重定向
    this.redirect   =$option.redirect;
    //将要发送的JSON对象
    this.fieldData={};
};
jQuery.NutjsAjax.prototype ={
    //版本
    "varsion"           :"1.0.0",
    //计算各个字段，生成要发送是JSON对象
    "countField"        :function(){
        //清空历史信息
        this.fieldData={};
        //遍历字段类型
        //若是数组或字符串，包装成对象
        if(this.field instanceof Array){
            this.field ={
                "text":this.field
            };
        }else if(typeof this.field ==='string'){
            this.field ={
                "text":[this.field]
            };
        };
        for(var key in this.field){
            //如果是裸字符串，包装成数组
            if(typeof this.field[key] ==='string'){
                this.field[key] =[this.field[key]];
            };
            blKey:for (var i=0;i<this.field[key].length;i++){
                var tarElt =$(this.field[key][i]);
                switch(key){
                    case 'select':
                    case 'text':
                        this.fieldData[tarElt.attr("name")]=tarElt.val();
                        break;
                    case 'radio':
                        this.fieldData[tarElt.attr("name")] =tarElt.filter(':checked').val();
                        break;
                    default:
                        break blKey;
                }
            }
        };
    },
    //默认的Ajax回调函数
    "defaultCallBack"   :function($data){
        //获取动作指令
        var actionObj ={};
        if($data["errcode"] &&this.errcode[ $data["errcode"] ]){//从errcode中获取到动作指令
            actionObj =this.errcode[ $data["errcode"] ];
        }else{//手动生成动作指令
            actionObj.showMsg="后台返回："
            if($data["errcode"]) actionObj.showMsg +="错误码"+$data["errcode"];
            if($data["errmsg"]) actionObj.showMsg +="，"+$data["errmsg"];
            actionObj.errElt=true;
        }
        //解析动作指令
        this.analytic(actionObj);
    },
    //发送Ajax请求
    "send"              :function(){
        $.ajax({
            "success"   :this.callBack,
            "context"   :this,
            "dataType"  :'json',
            "data"      :this.fieldData,
            "url"       :this.reqUrl,
            "type"      :this.reqMode,
        });
    },
    //解析服务器返回值
    "analytic"          :function($action){
        //要提示的信息
        if($action["showMsg"]){
            if(this.showMsgFn) this.showMsgFn($action["showMsg"]);
        };
        //要强烈提示的信息
        if($action["alertMsg"]){
            if(this.alertMsgFn) this.alertMsgFn($action["alertMsg"]);
        };
        //true表示提示所有字段
        if($action["errElt"] === true){
            $action["errElt"]=[];
            for(var key in this.field){
                $action["errElt"] =$action["errElt"].concat( this.field[key]);
            };
        }
        //字段提示
        if($action["errElt"]){
            //若为字符串，转换为数组
            if(typeof $action["errElt"] === "string") $action["errElt"] =[$action["errElt"]];
            //遍历所有要提示的字段
            for(var i=0;i<$action["errElt"].length;i++){
                var tpElt =$($action["errElt"][i]);
                //若是radio，则操作要特殊一些
                if(tpElt.attr("type") === "radio"){
                    //这里被变量提升了
                    var isRadio =true;
                    tpElt =tpElt.parent();
                };
                //提示信息
                tpElt.parent()
                    .addClass("has-error")
                    .addClass("has-feedback")
                    .append('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');;
                ;
                //若是radio，则操作要特殊一些
                if(isRadio){//因为有变量提升，因此不会报错
                    tpElt.parent().children(".glyphicon-remove").css("top",0);
                };
                //若是验证码提示，需要向左偏移
                if(tpElt.attr("name") === "verifycode"){
                    tpElt.parent().children(".glyphicon-remove").css("right","70px");
                }
                //若是select，需要向左偏移
                if(tpElt[0] &&tpElt[0].tagName.toLowerCase() === "select"){
                    tpElt.parent().children(".glyphicon-remove").css("right","35px");
                }
                //绑定隐藏提示事件
                tpElt.on("click",function(){
                    $(this).parent()
                        .removeClass("has-error")
                        .children(".glyphicon-remove")
                        .remove()
                    ;
                });
            };
        };
        //执行后续动作
        if($action["action"]){
            $action["action"].call(this);
        };
    }
}
//添加标识符
window.PeA_nut =window.PeA_nut ||[];
window.PeA_nut.push({"NutjsAjax":jQuery.NutjsAjax["varsion"]});
