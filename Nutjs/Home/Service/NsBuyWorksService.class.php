<?php
namespace Home\Service;
use Think\Model;
use Home\Model\NsBuyModel;
use Home\Model\NutsModel;
/**
 * 果仁商店购买作品
 * */
class NsBuyWorksService{
    /**
     * 购买作品需要花费的果仁数
     * @access protected
     * @var Int
     * */
    protected $price=1;
    /**
     * 入口函数。此函数会被自动调用
     * */
    public function run(){
        //校验登陆信息
        test_token() or drop(EC_4G41);
        //尝试创建购买记录数据对象
        $buyMo =new NsBuyModel();
        $buyMo ->create(
            array(
                'works_id'  =>I('get.works_id'),
                'uid'       =>cookie('uid')
            ),
            Model::MODEL_INSERT
        ) or drop($buyMo->getError());
        //检查用户果仁够不够
        $this->checkNuts() or drop(EC_4G42);
        //检查用户是否已购买此作品
        $this->checkRepeat() or drop(EC_4G44);
        //检查用户是否正在购买自己的作品
        $this->checkRepeat() or drop(EC_4G45);
        //尝试创建扣除果仁数据对象
        $nutsMo =new NutsModel();
        $nutsMo ->create(
            array(
                'uid' => cookie('uid'),
                'nuts'=> - $this->price
            ),
            Model::MODEL_SET_NUTS
        ) or drop($nutsMo->getError());
        //若开启Not_Submit_To_Database则不提交数据库
        if (C('Not_Submit_To_Database')) {
            var_dump($buyMo->data());
            var_dump($nutsMo->data());
            $buyMo->fetchSql(true);
            $nutsMo->fetchSql(true);
        };
        //注册数据库
        $nutsMo ->save() or drop(EC_4G51.$nutsMo->getError());
        $buyMo  ->add() or drop(EC_4G52.$buyMo->getError());
        //返回成功信息
        drop(true);
    }
    /**
     * 检查用户是否已购买过此作品
     * @return bool
     * @access protected
     * */
    protected function checkRepeat(){
        $mo =new Model();
        $mo->table('__NS_BUY__');
        $mo ->where(array(
            'works_id'  =>I('get.works_id'),
            'uid'       =>cookie('uid')
        ));
        return empty($mo->find());
    }
    /**
     * 检查用户所持有的果仁是否足够购买作品
     * 还会用作品价格来填充
     * @return bool
     * @access protected
     * */
    protected function checkNuts(){
        //获取需要的果仁数
        $targetNuts =1;
        $worksMo =new \Home\Model\NsWorksListModel();
        $worksMo ->where(array(
            'id' => I('get.works_id')
        ));
        $worksMo->field('price');
        $data =$worksMo->find();
        if (empty($data)) drop(EC_4G43);
        $targetNuts =$this->price =$data['price'];
        //获取用户剩余可用的果仁数
        $userNuts =1;
        $nutMo =new \Home\Model\NutsModel();
        $nutMo ->where(array(
            'uid' => cookie('uid')
        ));
        $userNuts =$nutMo->getField('nuts');
        //返回
        return $userNuts >= $targetNuts;
    }
    /**
     * 检查用户是否正在购买自己投稿的作品
     * @return bool
     * @access protected
     * */
    protected function checkSelf(){
        //获取作者uid
        $targetNuts =1;
        $worksMo =new \Home\Model\NsWorksListModel();
        $worksMo ->where(array(
            'id' => I('get.works_id')
        ));
        return $worksMo->getField('author_uid') !== cookie('uid');
    }
}