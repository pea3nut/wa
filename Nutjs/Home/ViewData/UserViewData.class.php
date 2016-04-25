<?php
namespace Home\ViewData;
use Think\Model\RelationModel;
/**
 * 创建用于View模板的数据
 * 创建全局 _data.user数据
 * */
class UserViewData extends RelationModel{
    /**
     * 自身的表名
     * @access protected
     * @var String
     * */
    protected $tableName ='users';
    /**
     * 本表要显示的字段，若要修改本表的字段名字需要在这里修改
     * @access protected
     * @var Array
     * */
    protected $fields=array(
        'state','uid','qq'
    );
    /**
     * 关联信息，默认所有的关联都会被执行
     * 若要修改关联字段的名称，需要修改as_fields值，以:分割 [name]:[new_name]
     * @access protected
     * @var Array
     * */
    protected $_link = array(
        'inf'   =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'UserInf',
            'foreign_key'   => 'uid',
            'mapping_key'   => 'uid',
            'as_fields'     => '*',
        ),
        'nut' =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Nuts',
            'foreign_key'   => 'uid',
            'mapping_key'   => 'uid',
            'as_fields'     => 'nuts',
            'mapping_fields'=> 'nuts',
        ),
    );
    /**
     * 针对本层特殊的构造函数
     * @access public
     * @param $uid 获取记录的uid值
     * */
    public function __construct($uid){
        if(!preg_match(RegExp_uid, $uid)) drop('1201,UserViewData构造时发生异常');
        $this->options['field'] =$this->fields;
        $this->options['link']  =true;
        $this->options['where'] =array('uid'=>$uid);
        $this->options['limit'] ='1';
        parent::__construct();
    }
}