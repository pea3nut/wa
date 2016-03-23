<?php
namespace Home\Service;
use Think\Model;
use Home\Model\ClockModel;
use Home\Model\NutsModel;
/**
 * 用户签到
 * 签到实际上是更新TokenModel中的date字段为签到时间，每次请求签到时检查是否
 * */
class ClockService{
    /**
     * 提示信息
     * @var String
     * @access protected
     * */
    protected $msg='';
    /**
     * 签到获得的基础果仁
     * @var Int
     * @access protected
     * */
    protected $basicNuts=10;
    /**
     * 每日签到的前几名额外的倍数奖励
     * @var Array
     * @access protected
     * */
    protected $rankMultiple=array(3 ,2 ,1.5);
    /**
     * 连续签到的额外的倍数奖励
     * @var Array
     * @access protected
     * */
    protected $fullMultiple=array(1 ,2 ,1.5 ,3);
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4941);
        //在签到表创建数据对象
        $mo=new ClockModel();
        $mo->field('uid');
        $mo->create(array('uid'=>cookie('uid'))) or drop($mo->getError());
        //检查是否已签到
        $mo->where(array('uid'=>cookie('uid'),'date'=>Short_Date));
        if($mo->find()) drop(EC_4942);
        //获取用户增加果仁数
        $nuts =$this->getIncNutNum(cookie('uid'));
        //在nuts表创建数据对象
        $nutMo=new NutsModel();
        $nutMo->create(
            array('uid'=>cookie('uid'),'nuts'=>$nuts)
            ,Model::MODEL_SET_NUTS
        ) or drop($nutMo->getError());
        //写入NutsModel
        //检查是否有记录，如果没有则新增
        $tpMo=new NutsModel();
        if(!$tpMo->where( array('uid'=>cookie('uid')))->find()){
            $tpMo->add(array(
                'uid'=>cookie('uid'),
                'nuts'=>0,
                'cumulative'=>0,
            ));
        }
        //增加果仁
        $nutMo->save()  or drop(EC_4951.$nutMo->getError());
        //记录签到
        $mo->add()      or drop(EC_4952.$mo->getError());
        //返回信息
        drop('1200,'.$this->msg);
    }
    /**
     * 查看某天有几个人签到
     * @access protected
     * @return Number
     * @param [date=Short_Date] 要计算的日期，默认取Short_Date
     * */
    protected function countClockPersonNumber($date =Short_Date){
        $mo=new ClockModel();
        $mo->where(array('date' => $date));
        return $mo->count();
    }
    /**
     * 计算某人连续签到了几天
     * @access protected
     * @return Number
     * @param max=3 最大的连续天数
     * @param uid=cookie('uid') 要统计人的uid
     * @param date=Short_Date 从哪里开始计算连续天数
     * */
    protected function countFullDay($max=3,$uid=null,$date =Short_Date){
        if (is_null($uid)) $uid=cookie('uid');
        //计算连续签到天数的
        $mo=new ClockModel();
        $mo->where(array('uid'=>$uid));
        $mo->order('date DESC');
        $mo->limit($max);
        $record =$mo->select();
        //现在的整天时间戳
        $startTime =strtotime($date);
        for ($i = 0; $i < count($record); $i++) {
            //上i+1次签到时的整天时间戳
            $lastClockTime =strtotime($record[$i]['date']);
            //若中间间隔不是i天，直接break
            if ($startTime - $lastClockTime != 24*60*60*($i+1)){
                break;
            };
        };
        return $i;
    }
    /**
     * 计算应该获得的果仁数
     * @return Int
     * @access protected
     * */
    protected function getIncNutNum(){
        //最终获得的果仁
        $nuts =$this->basicNuts;
        //计算前几名签到的倍数
        $rank=$this->countClockPersonNumber();
        if($rank < count($this->rankMultiple)){
            $nuts *=$this->rankMultiple[$rank];
        }
        //计算连续签到倍数
        $full=$this->countFullDay();
        $nuts *= $this->fullMultiple[$full];
        //生成提示msg
        $this->msg =$this ->getMsg($rank,$full,$nuts);
        //返回果仁数
        return $nuts;
    }
    /**
     * 生成提示信息
     * @return String
     * @access protected
     * @param rank 第几个签到的
     * @param full 连续签到了几天
     * @param 获得了几个果仁
     * */
    protected function getMsg($rank ,$full ,$nuts){
        $msg='你是今天第 '.($rank+1).' 个签到的';
        if($rank < count($this->rankMultiple)){
            $msg .= "，额外获得 {$this->rankMultiple[$rank]} 倍加成！";
        };
        if ($full >0){
            $msg .="\n连续签到 {$full} 天获得 {$this->fullMultiple[$full]} 倍加成！";
        };
        $msg .="\n获得果仁 x {$nuts} ！";
        return $msg;
    }
}