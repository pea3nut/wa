<?php
/*
注意，此文件是对外开放的，在里面写的一切东西都会被其他人所看见。
错误码[ABCD]由4位组成，每位表示的含义也不同。注意，错误码不一定是数字！
A 错误发生的层次
    1 -> 某些特殊情况
    3 -> 公共层，如function
    4 -> Service层
    5 -> Model层
B 错误发生的文件
    A = 3 情况下
        3 -> .\Nutjs\Home\Common\function.php
    A = 4 情况下
        3 -> ChangePasswordService.class.php
        4 -> GetPasswordService.class.php
        5 -> SignInService.class.php
        6 -> SignOutService.class.php
        7 -> SignUp0Service.class.php
        8 -> SignUp1Service.class.php
        9 -> ClockService.class.php
    A = 5 情况下
        3 -> InviteCodeModel.class.php
        4 -> TokenModel.class.php
        5 -> UserInfModel.class.php
        6 -> UsersModel.class.php
        7 -> ClockModel.class.php
        8 -> NutsModel.class.php
C 错误类型
    3 -> 字段格式错误
    4 -> 用户操作不合法，如无权限操作、验证码不符、确认密码字段不相同
    5 -> 链接数据库检查时发生的字段错误
    6 -> 系统错误
D 错误具体编码
    这个编码由各个文件中自由调用，如需查看源码，可以根据前3位错误码定位到具体的文件来进行排查
*/
return array(
    //错误码  => 错误信息
    //注意，请以错误码为准，错误信息有可能会根据不同的情况而发生改变
    //特殊错误码
    '1200' => 'ok',//操作成功
    '1201' => 'error',//发生错误
    '1202' => '非法的数据对象',//提交数据时，数据格式不正确
    //公共核心部分
    '3361' => '生成新Token记录时发生错误',
    '3362' => '更新Token时发生错误',
    //修改密码
    '4341' => '验证码verifycode不正确',
    '4342' => '用户没有登陆',
    '4343' => 'password字段与re_password字段不等',
    '4351' => '更新记录失败',
    '4361' => '执行登出操作失败',
    //找回密码
    '4441' => '验证码verifycode不正确',
    '4442' => '用户没有登陆',
    //用户登陆
    '4541' => '验证码verifycode不正确',
    '4531' => 'username字段格式不正确',
    '4551' => '不存在此用户',
    '4552' => '密码不正确',
    //用户注册1
    '4741' => '验证码verifycode不正确',
    '4742' => 'password字段与re_password字段不等',
    '4751' => '不存在此邀请码',
    '4752' => '该邀请码已被使用',
    '4761' => 'users表写入失败',
    '4762' => 'invite_code表写入失败',
    //用户注册2
    '4841' => '验证码verifycode不正确',
    '4842' => '用户没有登陆',
    '4843' => '用户不需要提交信息',
    '4861' => 'user_inf表写入失败',
    '4862' => 'users表更新失败',
    //用户签到
    '4941' => '用户没有登陆',
    '4942' => '用户今天已经签到了',
    '4951' => 'ClockModel写入错误',
    '4952' => 'NutsModel写入错误',
    //InviteCodeModel
    '5331' => 'uid格式不正确',
    '5332' => 'invite_code格式不正确',
    //TokenModel
    '5431' => 'uid格式不正确',
    //UserInfModel
    '5531' => 'uid格式不正确',
    '5532' => 'name格式不正确',
    '5533' => 'gender格式不正确',
    '5534' => 'age格式不正确',
    '5535' => 'phone格式不正确',
    '5536' => 'school格式不正确',
    '5537' => 'wechat格式不正确',
    //UsersModel
    '5631' => 'uid格式不正确',
    '5632' => 'state格式不正确',
    '5633' => 'password格式不正确',
    '5634' => 'qq格式不正确',
    '5651' => '该qq已被注册',
    '5661' => 'WEB_BATCH参数未定义',
    //ClockModel
    '5731' => 'uid格式不正确',
    //NutsModel
    '5831' => 'uid格式不正确',
    '5832' => 'nuts格式不正确',
    '5833' => 'cumulative格式不正确',
    '5834' => 'uid格式不正确（统计模式）',
    '5835' => 'nuts格式不正确（统计模式）',
);