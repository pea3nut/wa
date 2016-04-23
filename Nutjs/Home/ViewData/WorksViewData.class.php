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
     * 关联信息，默认所有的关联都会被执行
     * 若要修改关联字段的名称，需要修改as_fields值，以:分割 [name]:[new_name]
     * @access protected
     * @var Array
     * */
    protected $_link = array(
        'section'   =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsSection',
            'foreign_key'   => 'works_id',
            'mapping_key'   => 'id',
            'mapping_order' => 'section_id',
        ),
        'log'   =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsUpdateLog',
            'foreign_key'   => 'works_id',
            'mapping_key'   => 'id',
        ),
    );
    /**
     * 重写的select方法，取得所有作品数据
     * */
    public function select(){
        $data=parent::select();
        for($i=0;$i<count($data);$i++){
            $this->tidy($data[$i]);
        };
        return $data;
    }
    /**
     * 重写的find方法，取得单个作品数据
     * @param int $id 要取得的作品ID
     * */
    public function find($id){
        $id =(int)$id;
        $this->options['where'] =array('id'=>$id);
        $data=parent::find();
        return $this->tidy($data);
    }
    /**
     * 对原始的ns_works_list数据进行格式化
     * @param Array &$data 原始的ns_works_list数据
     * @return Array 格式后的数据
     * */
    protected function tidy(&$data){
        # 整理原数据
        $data['inf']= array();
        foreach ($data as $key => $value) {
            if(is_string($value) || is_numeric($value)){
                $data['inf'][$key]=$value;
                unset($data[$key]);
            };
        };
        # 获取章节信息
        ## 不需要整理
        # 获取统计信息
        $buy_mo =new \Home\Model\NsBuyModel();
        $buy_mo ->where(array('works_id' =>$data['inf']['id']));
        $buy_mo ->field(array(
            'count(works_id)'=>'sum',
            'avg(score)'=>'score',
        ));
        $data['info']=$buy_mo ->find();
        # 获取作者信息
        $user_va =new \Home\ViewData\UserViewData($data['inf']['author_uid']);
        $data['author']=$user_va ->find();
        return $data;
    }
    /**
     * 针对本层特殊的构造函数
     * @access public
     * @param $id 获取记录的id值
     * */
    public function __construct(){
        $this->options['link']  =true;
        parent::__construct();
    }
}