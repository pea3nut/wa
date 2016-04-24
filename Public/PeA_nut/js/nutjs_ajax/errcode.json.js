/**
 * 后台返回值对应JS响应
 * @param
 *  showMsg 要提示的文本
 *  alertMsg 要强烈提示的文本
 *  errElt 一个jQ选择器，出错的元素
 *  action 后续要执行的方法
 * @author 花生PeA
 * */
(function (){
var
errorObj ={
    "action"    :goBack,
    "alertMsg"  :"致命错误，请报告网络管理员",
    "showMsg"   :"致命错误，请报告网络管理员",
},
vcObj ={
    "showMsg"   :"验证码不正确",
    "errElt"    :"[name='verifycode']",
},
uidObj ={
    "showMsg"   :"用户名格式不正确",
    "errElt"    :["[name='username']","[name='uid']"],
},
siObj ={
    "action"    :goSignIn,
    "alertMsg"  :"请先登录",
},
rpsObj ={
    "showMsg"   :"两次输入的密码不一致",
    "errElt"    :["[name='password']","[name='re_password']"],
},
accObj ={
    "errElt"    :true,
    "alertMsg"  :"没有权限",
},
widObj ={
    "showMsg"   :"作品ID格式不正确",
    "errElt"    :"[name='works_id']"
},
end;

function goSignIn(){
    location.href=NUT.URL_ROOT+"/Member/sign_in";
};

function goIndex(){
    location.href=NUT.URL_ROOT;
}

function goBack(){
    history.back();
};



$.NutjsAjax.prototype.errcode ={
    //预定义对象
    "action":{},
    //动作
    "1201":errorObj,
    "1202":{
        "showMsg"   :"请求不正确，请重试",
        "errElt"    :true,
    },
    "3361":{
        "showMsg"   :"登陆失败，请重试",
    },
    "3362":{
        "showMsg"   :"登陆失败，请重试",
    },
    "3331":uidObj,
    "3332":uidObj,
    "4341":vcObj,
    "4342":siObj,
    "4343":rpsObj,
    "4351":{
        "showMsg"   :"密码修改失败，请报告网络管理员",
    },
    "4361":{
        "action"    :goIndex,
        "alertMsg"  :"密码修改成功，但是出了些小错误，请报告网络管理员",
        "showMsg"   :"密码修改成功，但是出了些小错误，请报告网络管理员",
    },
    "4441":vcObj,
    "4442":siObj,
    "4531":uidObj,
    "4541":vcObj,
    "4551":{
        "showMsg"   :"不存在此用户",
        "errElt"    :["[name='username']"],
    },
    "4552":{
        "showMsg"   :"密码不正确",
        "errElt"    :["[name='password']"],
    },
    "4741":vcObj,
    "4742":rpsObj,
    "4743":{
        "showMsg"   :"不存在此邀请码",
        "errElt"    :["[name='invite_code']"],
    },
    "4744":{
        "showMsg"   :"此邀请码已被使用",
        "errElt"    :["[name='invite_code']"],
    },
    "4751":{
        "showMsg"   :"激活码注销失败，请报告网络管理员",
        "errElt"    :true,
    },
    "4752":{
        "showMsg"   :"激活码注销成功，但账号写入失败，请联系网站管理员，要不然你就吃亏了",
        "errElt"    :true,
    },
    "4841":vcObj,
    "4842":siObj,
    "4843":{
        "showMsg"   :"你不需要进行此操作",
        "errElt"    :true,
    },
    "4851":{
        "showMsg"   :"操作失败，个人信息写入失败，请联系网站管理员",
        "errElt"    :true,
    },
    "4852":{
        "showMsg"   :"操作失败，账号状态更新失败，请联系网站管理员",
        "errElt"    :true,
    },
    "4941":siObj,
    "4942":{
        "showMsg"   :"今天已经签过到了",
        "errElt"    :true,
    },
    "4951":{
        "showMsg"   :"增加果仁时发生错误，请联系网站管理员",
        "errElt"    :true,
    },
    "4952":{
        "showMsg"   :"记录签到时发生错误，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4A41":siObj,
    "4A51":{
        "showMsg"   :"新建作品失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4B41":siObj,
    "4B42":accObj,
    "4B51":{
        "showMsg"   :"资料更新失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4C41":siObj,
    "4C42":accObj,
    "4C51":{
        "showMsg"   :"作品删除失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4D41":siObj,
    "4D42":accObj,
    "4D51":{
        "showMsg"   :"提交章节失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4E41":siObj,
    "4E42":accObj,
    "4E51":{
        "showMsg"   :"章节修改失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4F31":widObj,
    "4F32":{
        "showMsg"   :"章节ID格式不正确",
        "errElt"    :"[name='section_id']",
    },
    "4F41":siObj,
    "4F42":accObj,
    "4F51":{
        "showMsg"   :"提交章节失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4G41":siObj,
    "4G42":{
        "errElt"    :true,
        "showMsg"   :"额，你的果仁好像不太够",
    },
    "4G43":{
        "showMsg"   :"没有该ID的作品",
        "errElt"    :true,
    },
    "4G44":{
        "showMsg"   :"你已经购买了此作品啦~~",
        "errElt"    :true,
    },
    "4G51":{
        "showMsg"   :"果仁扣除失败，请联系网站管理员",
        "errElt"    :true,
    },
    "4G52":{
        "showMsg"   :"成功扣除果仁，但是购买失败，请联系网站管理员，要不然你就吃亏喽~~",
        "errElt"    :true,
    },
    
    "4H41":siObj,
    "4H42":accObj,
    "4H51":{
        "showMsg"   :"日志创建失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4E31":{
        "showMsg"   :"日志ID格式不正确",
        "errElt"    :"[name='log_id']",
    },
    "4E41":siObj,
    "4E42":accObj,
    "4E43":{
        "showMsg"   :"找不到对应ID的日志",
        "errElt"    :"[name='log_id']",
    },
    "4E51":{
        "showMsg"   :"日志删除失败，请联系网站管理员",
        "errElt"    :true,
    },
    
    "4K41":siObj,
    "4K42":accObj,
    "4K51":{
        "showMsg"   :"作品评分失败，请联系网站管理员",
        "errElt"    :true,
    },


    "5331":uidObj,
    "5332":{
        "showMsg"   :"邀请码格式不正确",
        "errElt"    :"[name='invite_code']",
    },
    "5431":uidObj,
    "5531":uidObj,
    "5532":{
        "showMsg"   :"请输入正确的姓名",
        "errElt"    :"[name='name']",
    },
    "5533":{
        "showMsg"   :"请选择性别",
        "errElt"    :"[name='gender']",
    },
    "5534":{
        "showMsg"   :"请输入正确的年龄",
        "errElt"    :"[name='age']",
    },
    "5535":{
        "showMsg"   :"请输入正确的手机号",
        "errElt"    :"[name='phone']",
    },
    "5536":{
        "showMsg"   :"请选择你的学校",
        "errElt"    :"[name='school']",
    },
    "5537":{
        "showMsg"   :"请输入正确的微信号，如果没有可以留空",
        "errElt"    :"[name='school']",
    },
    "5538":{
        "showMsg"   :"请输入正确的昵称，如果没有可以留空",
        "errElt"    :"[name='nickname']",
    },
    "5631":uidObj,
    "5632":{
        "showMsg"   :"脚本出错！",
        "errElt"    :true,
    },
    "5633":{
        "showMsg"   :"密码格式不正确",
        "errElt"    :"[name='password']",
    },
    "5634":{
        "showMsg"   :"QQ格式不正确",
        "errElt"    :"[name='qq']",
    },
    "5641":{
        "showMsg"   :"该QQ已被注册",
        "errElt"    :"[name='qq']",
    },
    "5661":{
        "showMsg"   :"系统出错，请联系网站管理员",
        "alertMsg"  :"系统出错，请联系网站管理员",
        "errElt"    :true,
    },
    "5731":uidObj,
    "5732":{
        "showMsg"   :"系统出错，请联系网站管理员",
        "alertMsg"  :"系统出错，请联系网站管理员",
        "errElt"    :true,
    },
    "5831":uidObj,
    "5832":{
        "showMsg"   :"果仁数量格式不正确",
        "errElt"    :"[name='nuts']"
    },
    "5833":{
        "showMsg"   :"累计果仁数量格式不正确",
        "errElt"    :"[name='cumulative']"
    },
    "5834":uidObj,
    "5832":{
        "showMsg"   :"果仁数量格式不正确",
        "errElt"    :"[name='nuts']"
    },
    "5931":{
        "showMsg"   :"作者ID格式不正确",
        "errElt"    :"[name='author_uid']"
    },
    "5932":{
        "showMsg"   :"作品状态格式不正确",
        "errElt"    :"[name='works_state']"
    },
    "5933":{
        "showMsg"   :"作品名称格式不正确",
        "errElt"    :"[name='works_name']"
    },
    "5934":{
        "showMsg"   :"价格格式不正确",
        "errElt"    :"[name='price']"
    },
    "5935":{
        "showMsg"   :"作品ID格式不正确",
        "errElt"    :["[name='works_id']","[name='id']"]
    },
    
    "5A31":uidObj,
    "5A32":{
        "showMsg"   :"作品ID格式不正确",
        "errElt"    :"[name='works_id']"
    },
    "5A33":{
        "showMsg"   :"评分必须是数字",
        "errElt"    :"[name='score']"
    },
    "5A34":{
        "showMsg"   :"评分必须为0~10之间",
        "errElt"    :"[name='score']"
    },
    "5A35":{
        "showMsg"   :"购买记录ID格式不正确",
        "errElt"    :["[name='buy_id']","[name='id']"]
    },
    
    "5B31":widObj,
    "5B32":{
        "showMsg"   :"章节名称格式不正确",
        "errElt"    :"[name='section_name']"
    },
    "5B33":{
        "showMsg"   :"章节ID格式不正确",
        "errElt"    :"[name='section_id']"
    },
    "5B34":{
        "showMsg"   :"主键ID格式不正确",
        "errElt"    :"[name='id']"
    },
    "5B41":{
        "showMsg"   :"该章节已存在，请重新指定或启用自动增长",
        "errElt"    :"[name='section_id']"
    },
    
    "5C31":widObj,
    "5C32":{
        "showMsg"   :"果仁数量格式不正确",
        "errElt"    :"[name='section_id']"
    },
    "5C33":{
        "showMsg"   :"果仁数量格式不正确",
        "errElt"    :"[name='id']"
    },
};



})()