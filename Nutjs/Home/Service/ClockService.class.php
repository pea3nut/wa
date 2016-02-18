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
        $mo->where(array('uid'=>cookie('uid'),'date'=>get_sql_short_date()));
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
        $nutMo->save() or drop(EC_4952.$nutMo->getError());
        //写入ClockModel
        $mo->add() or drop(EC_4951.$mo->getError());
        //返回信息
        drop('1200,'.$this->msg);
    }
    protected function getIncNutNum($uid){
        //基础果仁
        $nuts=10;
        //查看是第几个签到的
        $mo=new ClockModel();
        $users =$mo->where(array('date' => get_sql_short_date()))->count();
        //计算前几名增加额外的倍数
        //第123的倍数
        $multiple1=array(3 ,2 ,1.5);
        if($users < 3){
            $nuts *= $multiple1[$users];
        }
        //记录提示信息
        $this->msg .= "今天是第".($users+1)."个签到的，获得系数{$multiple1[$users]}\n";
        //第0123的倍数
        $multiple2=array(1 ,2 ,1.5 ,3);
        //计算连续签到天数的
        $mo->where(array('uid'=>$uid))->order('date DESC')->limit(3);
        $record =$mo->select();
        //现在的整天时间戳
        $now_time =strtotime(get_sql_short_date());
        for ($i = 0; $i < \count($record); $i++) {
            //上i+1次签到时的整天时间戳
            $clock_time =strtotime($record[$i]['date']);
            //若中间间隔不是一天，直接break
            if ($now_time - $clock_time != 24*60*60*($i+1)){
                break;
            };
        }
        //计算倍数
        $nuts *= $multiple2[$i];
        //记录提示信息
        $this->msg .= "因连续签到{$i}天，获得系数{$multiple2[$i]}\n";
        $this->msg .= "果仁数+{$nuts}";
        //返回终值
        return $nuts;
    }
}