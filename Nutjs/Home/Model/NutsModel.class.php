<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 果仁表
 * 果仁表内置提供了“统计模式”来供开发者快捷的操作果仁数
 * 在使用Create方法创建数据时，向第二个参数传入在传入Model::MODEL_SET_NUTS即表示启用统计模式
 * 启用统计模式的情况下，在uid的同时，仅需将nuts字段设置成要增加的数字即可
 * 比如，Model::create(array('uid'=>'A233','nuts'=>'50','cumulative'=>'150'))
 *  - 表示将A233用户的果仁数设置成50，累计获得设置成150
 * 而，Model::create(array('uid'=>'A233','nuts'=>'50'),Model::MODEL_SET_NUTS)
 *  - 表示将A233的果仁数增加50，系统会自动计算递增cumulative和nuts字段
 *
 * <dt>uid</dt>
 * <dd>主键 char(5) 用户的协会编号</dd>
 *
 * <dt>nuts</dt>
 * <dd>init(8) 可用的果仁数</dd>
 *
 * <dt>cumulative</dt>
 * <dd>init(8) 用户累计获得的果仁，自动完成，若nuts字段值大于0，每次递增nuts字段的数值</dd>
 * */
class NutsModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
     * @var Array
     * @access protected
     * */
    protected $fields=array('uid','nuts','cumulative');
    /**
     * 只读字段，一旦写入就不允许再修改了
     * @var Array
     * @access protected
     * */
    protected $readonlyField=array('uid');
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
        'user'  =>array(
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'Users',
            'foreign_key'   => 'uid',
        ),
        'inf'  =>array(
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'UserInf',
            'foreign_key'   => 'uid',
        )
    );
    /**
     * 自动完成字段，提供了一个特殊的快捷操作 -- 统计模式
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //根据nuts字段生成cumulative字段
        array('cumulative'  ,'getCumulative'        ,self::MODEL_SET_NUTS    ,'callback'),
        //根据nuts字段生成真正的nuts字段
        array('nuts'        ,'getNuts'              ,self::MODEL_SET_NUTS    ,'callback'),
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        //普通模式验证
        array('uid'         ,RegExp_uid  ,EC_5831  ,self::MUST_VALIDATE  ,'regex'  ,self::MODEL_BOTH),
        array('nuts'        ,'number'    ,EC_5832  ,self::MUST_VALIDATE  ,'regex'  ,self::MODEL_BOTH),
        array('cumulative'  ,'number'    ,EC_5833  ,self::MUST_VALIDATE  ,'regex'  ,self::MODEL_BOTH),
        //统计模式验证
        array('uid'         ,RegExp_uid  ,EC_5834  ,self::MUST_VALIDATE  ,'regex'  ,self::MODEL_SET_NUTS),
        array('nuts'        ,'number'    ,EC_5835  ,self::MUST_VALIDATE  ,'regex'  ,self::MODEL_SET_NUTS),
    );
    /**
     * 统计模式下，根据nuts字段生产cumulative字段
     * 注意！此操作没有任何的过滤和转换，直接使用nuts字段值
     * 若nuts字段不为数字可能会发生意想不到的效果。
     * @param mixed $cumulative 并没有什么卵用的参数
     * @return Array 一个直接操作SQL语句的数组
     * */
    protected function getCumulative($cumulative){
        if($this->submit['nuts'] > 0){
           return array('exp','`cumulative` +'.$this->submit['nuts']);
        }else{
            unset($this->fields[array_search('cumulative',$this->fields)]);
        };
    }
    /**
     * 统计模式下，获取真正的nuts字段
     * @param mixed $nuts 并没有什么卵用的参数
     * @return Array 一个直接操作SQL语句的数组
     * */
    protected function getNuts($nuts){
        if($this->submit['nuts'] > 0){
           return array('exp','`nuts` +'.$this->submit['nuts']);
        }else{
            return array('exp','`nuts` '.$this->submit['nuts']);
        };
    }
}