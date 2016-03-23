<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
/**
 * 果仁商店作品章节信息表
 *
 * <dt>id</dt>
 * <dd>主键 UNSIGNED int 章节记录ID</dd>
 *
 * <dt>works_id</dt>
 * <dd>UNSIGNED int 章节所属的作品的ID</dd>
 *
 * <dt>section_id</dt>
 * <dd>UNSIGNED int 章节在作品中的排序ID，第x涨</dd>
 *
 * <dt>section_name</dt>
 * <dd>varchar 章节名称</dd>
 *
 * <dt>update_date</dt>
 * <dd>date 本章最后更新时间</dd>
 * */
class NsSectionModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array('id','works_id','section_id','section_name','update_date');
    /**
     * 数据表的主键
     * @var String
     * @access protected
     * */
    protected $pk='id';
    /**
     * 最终插入数据表的section_id
     * @var int
     * @access public
     * */
    public $section_id=-1;
    /**
     * 关联信息
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     */
    protected $_link = array(
        'works'  =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'NsWorksList',
            //对方的键
            'foreign_key'   => 'id',
            //自己的键，默认为自己的主键
            'mapping_key'   => 'works_id',
        ),
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        //新增时，必须校验的字段
        array('works_id'    ,'number'         ,EC_5B31    ,self::MUST_VALIDATE      ,'regex'    ,self::MODEL_INSERT),//works_id 12
        array('section_name','require'        ,EC_5B32    ,self::MUST_VALIDATE      ,'regex'    ,self::MODEL_INSERT),//works_name 1
        //若section_id存在则需要校验
        array('section_id'  ,'number'         ,EC_5B33    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_BOTH),//section_id 24
        //新增数据时，若section_id有值，则检查works_id下的section_id是否可用
        array('section_id'  ,'checkSectionId' ,EC_5B41    ,self::EXISTS_VALIDATE    ,'function' ,self::MODEL_INSERT),//section_id 24
        //更新时，若存在则校验
        array('works_id'    ,'number'         ,EC_5B31    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//works_id 4
        array('id'          ,'number'         ,EC_5B34    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//id 4
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //update_date字段总是填充当前时间
        array('update_date'  ,Short_Date             ,self::MODEL_BOTH    ,'function'),//update_date 1234
        //使用htmlspecialchars过滤输入字段
        array('section_name' ,'htmlspecialchars'     ,self::MODEL_BOTH    ,'function'),//works_name 24
        //新增数据时，清楚所有对于ID的操作
        array('id'           ,''                     ,self::MODEL_INSERT  ,'string'),  //id 12
        array('id'           ,''                     ,self::MODEL_INSERT  ,'ignore'),  //id 12
        //若section_id无值则自动增长
        array('section_id'   ,'setSectionId'         ,self::MODEL_INSERT  ,'callback'),////section 1
    );
    /**
     * 检查works_id下的section_id是否可用
     * @return bool
     * @access protected
     * @param section_id 提交来的section_id
     * */
    protected function checkSectionId($section_id){
        $mo =new Model();
        $mo ->table('__NS_SECTION__')
        ->where(array(
            'works_id'   =>$this->submit['works_id'],
            'section_id' =>$section_id
        ));
        $data =$mo->find();
        return empty($data);
    }
    /**
     * 自动获取section_id，并填充$this->section_id
     * 若section_id为空，则自动增长
     * 若section_id有值，则会直接返回section_id并填充$this->section_id
     * @return Int section_id
     * @access protected
     * @param section_id 提交来的section_id
     * */
    protected function setSectionId($section_id){
        if (empty($section_id)){
            $mo =new Model();
            $mo ->table('__NS_SECTION__')
                ->where(array('works_id'=>$this->submit['works_id']))
                ->order('section_id DESC')
                ->field('section_id')
                ->limit(1)
            ;
            $data =$mo->find();
            if (empty($data)){
                $this->section_id =0;
            }else {
                $this->section_id =$data['section_id']+1;
            }
        }else {
            $this->section_id =$section_id;
        }
        return $this->section_id;
    }
}