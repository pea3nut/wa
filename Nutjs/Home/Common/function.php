<?php
use Home\Model\UsersModel;
use Home\Model\TokenModel;

/**
 * 生成给定长度的随机字符串
 * @param string $code 用户输入的验证码字符串
 * @param int $length 要生成字符串的长度
 * @return string 生成的随机字符串
 * */
function get_rand_char($length){
    $str = null;
    $strPol = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max = strlen($strPol)-1;
    for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }
    return $str;
}
/**
 * 检测输入的验证码是否正确
 * @param string $code 用户输入的验证码字符串
 * @param int $id 当前验证码的id，适用于多个验证码
 * @return bool
 * */
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
/**
 * 生成用于登陆的Cookie
 * @param $uid 要生成的Cookie的协会编号
 * */
function log_in($uid){
    //要创建的数据
    $data=array();
    $data['uid']=$uid;
    $data['date']=true;
    $data['token']=true;
    //检查是否token表中是否有此用户，没有则inset，有则updata
    $is_inset=false;
    $mo=new TokenModel();
    $mo->where(array('uid'=>$uid));
    if(empty($mo->find())){
        $is_inset=true;
    }else {
        $is_inset=false;
    };
    //更新token
    $mo->field('uid,date,token');
    $mo->create($data) or drop($mo->getError());
    //更新token，如果不存在则生成一条新记录
    if ($is_inset) {
        $mo->add() or drop(CE_3531.$mo->getError());
    }else{
        $mo->save() or drop(CE_3532.$mo->getError());
    };
    //获取生成的token
    $data['token']=$mo->getToken();
    //生成Cookie
    cookie('uid'    ,$data['uid']);
    cookie('token'    ,$data['token']);
};
/**
 * 退出并返回指定信息，如果$msg为true则不会退出
 * $msg传入不同的参数会有不同的效果
 * <li>Bool 若为true，则返回执行成功的信息(200)且不退出。若为false，则返回未知错误的信息</li>
 * <li>String 以逗号分隔的错误信息，格式：错误码,错误信息</li>
 * @param $msg String/Bool 要返回的信息
 * @param $return=false Bool 若为true，则返回信息不退出
 * @return Json字符串或null
 * */
function drop($msg,$return=false){
    //返回信息的数组
    $reArray=array();
    //解析参数
    if (is_bool($msg)){
        if ($msg){
            $reArray['errcode']=1200;
            $reArray['errmsg']='ok';
        }else {
            $reArray['errcode']=1201;
            $reArray['errmsg']='error';
        };
    }elseif (is_string($msg)){
        $msg=explode(',',$msg);
        if (count($msg) == 2){
            $reArray['errcode']=$msg[0];
            $reArray['errmsg']=$msg[1];
        }else{
            $reArray['errcode']=1201;
            $reArray['errmsg']=$msg[0];
        }
    }else{
        throw new Exception ('$msg参数错误');
    }
    //要返回的字符串
    $json_option =(defined('APP_DEBUG') && APP_DEBUG) ? JSON_UNESCAPED_UNICODE : JSON_FORCE_OBJECT;
    $reMsg=mb_strtolower(json_encode($reArray,$json_option));
    //根据$return来处理返回信息
    header('Content-Type:application/json; charset=utf-8');
    if($return){
        return $reMsg;
    }else {
        //设定Json头信息，返回输出Json
        echo $reMsg;
        //如果$msg为true则不会退出
        if ($msg !== true) exit;
    };
}
/**
 * 检查令牌是否合法
 * @param String(4) $uid 协会编号，默认cookie('uid')
 * @param String(20) $token 令牌值，默认cookie('token')
 * @return bool
 * */
function test_token($uid,$token){
    if(empty($uid)) $uid=cookie('uid');
    if(empty($token)) $token=cookie('token');
    $mo=new TokenModel();
    $mo->where(array('uid'=>$uid));
    $db_token = $mo->getField('token');
    if($db_token == $token && !empty($token)){
        return true;
    }else{
        return false;
    };
}
/**
 * 查询当前协会编号的状态(users表中的state字段)
 * @param $uid String(4) 要查询的协会编号
 * @return String(3) 当前协会编号的状态
 * */
function get_state($uid){
    if(empty($uid)) $uid=cookie('uid');
    $mo=new UsersModel();
    $mo->where(array('uid'=>$uid));
    return $mo->getField('state');
}
/**
 * 查询当前是否正常登陆且账号状态可用
 * @param String(4) $uid 协会编号，默认cookie('uid')
 * @param String(20) $token 令牌值，默认cookie('token')
 * @return bool
 * */
function test_uid($uid,$token){
    $pass_code=array('200','999');
    return test_token($uid,$token) && in_array(get_state($uid) ,$pass_code);
}
/**
 * 以一个友好的格式返回的当前时间
 * @return String Y-m-d H:i:s
 * */
function get_sql_date(){
    return date('Y-m-d H:i:s');
}
/**
 * 渲染输出Markdown文件，渲染前会对源码进行htmlspecialchars编码
 * @param String $path 要渲染的文件路径
 * @return String 渲染成的HTML字符串
 * */
function decode_markdown($path){
    //检测文件是否存在
    if(!file_exists($path)) return;
    //获取文件内容
    $md=file_get_contents($path);
    //过滤HTML字符
    $md=htmlspecialchars($md);
    //渲染Markdown
    include '.\Public\Library\Michelf\Markdown.inc.php';
    $html = \Michelf\Markdown::defaultTransform($md);
    //返回
    return $html;
};
/**
 * 以一个友好的格式返回的当前年月日
 * @return String Y-m-d
 * */
function get_sql_short_date(){
    return date('Y-m-d');
}













