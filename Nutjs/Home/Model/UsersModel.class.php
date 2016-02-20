<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 用户基础信息表
 *
 * <dt>uid</dt>
 * <dd>主键 char(5) 用户的协会编号</dd>
 *
 * <dt>qq</dt>
 * <dd>varchar(16) 用户的QQ号</dd>
 *
 * <dt>password</dt>
 * <dd>varchar(64) 用户的密码，自动使用crypt散列</dd>
 * */
class UsersModel extends RelationModel{
    /**
     * 新用户注册时随机生成的协会编号
     * @var String
     * @access protected
     * */
    protected $uid=null;
    /**
     * 数据表中的字段信息
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array(
        'state','uid','qq','password',
        '_type' => array(
            'state'    => 'char',
            'uid'      => 'char',
            'qq'       => 'varchar',
            'password' => 'varchar',
        ),
    );
    /**
     * 只读字段，一旦写入就不允许再修改了
      * @var Array
     * @access protected
     * */
    protected $readonlyField=array('uid','qq');
    /**
     * 数据表的主键
      * @var String
     * @access protected
     * */
    protected $pk='uid';
    /**
     * 关联信息
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     */
    protected $_link = array(
        'inf'   =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'UserInf',
            'foreign_key'   => 'uid',
        ),
        'clock' =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'Clock',
            'foreign_key'   => 'uid',
        ),
        'token' =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Token',
            'foreign_key'   => 'uid',
        ),
        'nut' =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Nuts',
            'foreign_key'   => 'uid',
        ),
        'code' =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'InviteCode',
            'foreign_key'   => 'uid',
        ),
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        array('password'    ,'crypt'        ,self::MODEL_BOTH    ,'function'),//对密码进行散列计算
        array('password'    ,null            ,self::MODEL_BOTH    ,'ignore'),//如果密码为空则释放
        array('state'        ,'100'            ,self::MODEL_INSERT    ,'string'),//在新用户注册时随机生成协会编号
        array('uid'            ,'createUid'    ,self::MODEL_INSERT    ,'callback'),//在新用户注册时随机生成协会编号
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        array('uid'            ,RegExp_uid        ,EC_5631    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//在inset的时候是自动生成的，因此无需检查
        array('state'        ,RegExp_state    ,EC_5632    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//同上
        array('password'    ,RegExp_password,EC_5633    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('qq'            ,RegExp_qq        ,EC_5634    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('qq'            ,'checkQq'        ,EC_5651    ,self::MUST_VALIDATE    ,'callback'    ,self::MODEL_INSERT),//QQ不允许更改，因此仅仅需要注册的时候查同即可
    );
    /**
     * 获取随机生成的协会编号
     * @access public
     * @return String 协会编号
     * */
    public function getUid(){
        return $this->uid;
    }
    /**
     * 检查该QQ是否已被注册
     * @param string qq 用户提交的qq字段
     * @access protected
     * */
    protected function checkQq($qq){
        $mo=new \Think\Model();
        $mo->table('__USERS__');
        if(empty($mo->where(array('qq'=>$qq))->find())){
            return true;
        }else{
            return false;
        };
    }
    protected function createUid(){
        if(empty(C('WEB_BATCH'))) drop(EC_5661);
        $this->uid=C('WEB_BATCH').mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9);
        return $this->uid;
    }
}