<?php
namespace Home\ViewData;
use Think\Model\RelationModel;
/**
 * 创建用于View模板NutStore/list的数据
{
    order,
    aod,
    list:[
        length,
        {
            score,
            works:{},
            author:{},
        },
    ]
}
 * */
class ListViewData extends RelationModel{
    /**
     * 构造方法传进的uid值
     * @access protected
     * @var String
     * */
    protected $order_by='';
    /**
     * 构造方法传进的uid值
     * @access protected
     * @var String
     * */
    protected $aod='';
    /**
     * 自身的表名
     * @access protected
     * @var String
     * */
    protected $tableName ='ns_works_list';
    /**
     * 查询数据集
     * @access public
     * @param array $options 表达式参数
     * @return mixed
     */
    public function select($options){
        //要返回的数组
        $reArr =array(
            'order' =>$this->order_by,
            'aod'   =>$this->aod,
            'list'  =>array()
        );
        //遍历作品信息
        $list_arr =parent::select($options);
        for ($i=0;$i<count($list_arr);$i++){
            //获取作品作者信息
            $author_da =new UserViewData($list_arr[$i]['author_uid']);
            $author_arr =$author_da->find();
            //计算作品评分
            $avg_score =0;
            $mo_buy=new \Home\Model\NsBuyModel();
            $mo_buy ->where(array('work_id'=>$list_arr[$i]['id']));
            $mo_buy ->field('avg(score) as avg_score');
            $avg_score =$mo_buy ->find()['avg_score'];
            $avg_score =number_format($avg_score,2);
            //格式化数据
            array_push($reArr['list'] ,array(
                'score' =>($avg_score ==-1) ?5 :$avg_score,
                'works' =>$list_arr[$i],
                'author'=>$author_arr
            ));
        }
        return $reArr;
    }
    /**
     * 针对本层特殊的构造函数
     * @access public
     * @param $uid 获取记录的uid值
     * */
    public function __construct($order_by ,$aod){
        if(!preg_match('/^\w+$/', $this->order_by=$order_by)) drop('1201,ListViewData构造时发生异常');
        if(!preg_match('/^(asc|desc)$/i', $this->aod=$aod)) drop('1201,ListViewData构造时发生异常');
        $this->options['field'] =$this->fields;
        $this->options['link']  =true;
        $this->order("{$order_by} {$aod}");
        parent::__construct();
    }
}