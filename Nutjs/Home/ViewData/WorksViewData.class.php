<?php
namespace Home\ViewData;
use Think\Model\RelationModel;
/**
 * 创建用于View模板的数据
 * 格式化works数据
 * */
class WorksViewData extends RelationModel{
    /**
     * 自身的表名
     * @access protected
     * @var String
     * */
    protected $tableName ='ns_works_list';
    /**
     * 本表要显示的字段，若要修改本表的字段名字需要在这里修改
     * @access protected
     * @var Array
     * */
    protected $fields=array(
        'id','author_uid','works_name','works_intro','works_state',
        'price','update_number','update_date','create_date'
    );
    /**
     * 关联信息，默认所有的关联都会被执行
     * 若要修改关联字段的名称，需要修改as_fields值，以:分割 [name]:[new_name]
     * @access protected
     * @var Array
     * */
    protected $_link = array(

    );
    /**
     * 针对本层特殊的构造函数
     * @access public
     * @param $id 获取记录的id值
     * */
    public function __construct($id){
        $id =(int)$id;
        $this->options['field'] =$this->fields;
        $this->options['link']  =true;
        $this->options['where'] =array('id'=>$id);
        $this->options['limit'] ='1';
        parent::__construct();
    }
}