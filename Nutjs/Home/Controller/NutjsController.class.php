<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
/**
 * Nutjs团队测试控制器
 * */
class NutjsController extends Controller {
    public function index(){
        echo 'Home / NutjsController -> index()';
    }
    private function sql(){//迁移数据
        //初始化Model
        $connection_new = array(
            'DB_TYPE'=>'mysql', //数据库类型
            'DB_HOST'=>'localhost', //服务器地址
            'DB_NAME'=>'web_association', //数据库名
            'DB_USER'=>'root', //用户名
            'DB_PWD'=>'', //密码
            'DB_PORT'=>3306, //端口
            'DB_PREFIX'=>'wa_', //数据库表前缀
            'db_charset' => 'utf8',//数据库字符集
        );
        $connection_old = array(
            'DB_TYPE'=>'mysql', //数据库类型
            'DB_HOST'=>'localhost', //服务器地址
            'DB_NAME'=>'association', //数据库名
            'DB_USER'=>'root', //用户名
            'DB_PWD'=>'', //密码
            'DB_PORT'=>3306, //端口
            'DB_PREFIX'=>'', //数据库表前缀
            'db_charset' => 'utf8',//数据库字符集
        );
        $new_mo=new Model();
        $new_mo->db(null,$connection_new);
        $old_mo=new Model();
        $old_mo->db(null,$connection_old);
        /*/数据迁移userinf_login
        $old_mo->table('userinf_login');
        $all_user=$old_mo->select();
        $abc_time=array(
            'A'=>'2014-12-10 23:33:33',
            'B'=>'2015-03-30 23:33:33',
            'C'=>'2015-09-01 23:33:33',
        );
        $data=array();
        for ($i = 0; $i < count($all_user); $i++) {
            //赋值users表
            preg_match('/^\w/', $all_user[$i]['id_formal'],$reStr);
            $data['uid']        =$all_user[$i]['id_formal'];
            $data['qq']         =$all_user[$i]['id_person'];
            $data['password']   =$all_user[$i]['password'];
            $data['date']       =$abc_time[$reStr[0]];
            $new_mo->table('__USERS__');
            $new_mo->add($data,null,true);
            //赋值token表
            $new_mo->table('__TOKEN__');
            $new_mo->add(array('uid'=>$all_user[$i]['id_formal'],'token'=>get_rand_char(20)),null,true);
        }
        //数据迁移userinf_basic
        $old_mo->table('userinf_basic');
        $all_basic=$old_mo->select();
        for ($i = 0; $i < count($all_basic); $i++) {
            //填充__USER_INF__
            $data1=array();
            $data1['uid']       = $all_basic[$i]['id_formal'];
            $data1['name']      = $all_basic[$i]['name'];
            $data1['gender']    = $all_basic[$i]['sex'];
            $data1['age']       = $all_basic[$i]['old'];
            $data1['phone']     = $all_basic[$i]['phone'];
            $data1['school']    = $all_basic[$i]['school'];
            $data1['wechat']    = $all_basic[$i]['wechat'];
            $new_mo->table('__USER_INF__')->add($data1,null,true);
            //填充__NUTS__
            $data2=array();
            $data2['uid']           = $all_basic[$i]['id_formal'];
            $data2['cumulative']    = $all_basic[$i]['integral_cumulative'];
            $data2['nuts']          = $all_basic[$i]['integral_surplus'];
            $new_mo->table('__NUTS__')->add($data2,null,true);
        };
        //数据迁移userinf_active
        $old_mo->table('userinf_active');
        $all_active=$old_mo->select();
        for ($i = 0; $i < count($all_active); $i++) {
            //填充__INVITE_CODE__
            $new_mo->table('__INVITE_CODE__');
            $data['invite_code']    =$all_active[$i]['active'];
            $data['date']           =$all_active[$i]['date'];
            $data['uid']            =$all_active[$i]['user'];
            $new_mo->add($data);
        }
        //更新时间
        $userMo=new UsersModel();
        $codeMo=new InviteCodeModel();
        $allUser=$userMo->field('date,uid')->select();
        var_dump($allUser);
        for ($i=0;$i<\count($allUser);$i++){
            $codeMo->where(array('uid'=>$allUser[$i]['uid']));
            $codeMo->data(array('date'=>$allUser[$i]['date']));
            $userMo->save();
        }
        //*/
    }

}