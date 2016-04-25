<?php /*
注意，此文件是对外开放的，在里面写的一切东西都会被其他人所看见。
错误码[ABCD]由4位组成，每位表示的含义也不同。注意，错误码不一定是数字！
A 错误发生的层次
    1 -> 某些特殊情况
    3 -> 公共层，如function
    4 -> 服务层 Service
    5 -> 数据模型层 Model
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
        A -> NsSetUpdateLogService.class.php
    A = 5 情况下
        3 -> InviteCodeModel.class.php
        4 -> TokenModel.class.php
        5 -> UserInfModel.class.php
        6 -> UsersModel.class.php
        7 -> ClockModel.class.php
        8 -> NutsModel.class.php
        9 -> NsWorksListModel.class.php
        A -> NsBuyModel.class.php
        B -> NsSectionModel.class.php
        C -> NsUpdateLogModel.class.php
C 错误类型
    3 ->
        格式级错误。通常发生在验证字段格式过程中发生，比如phone字段填写了数字
        本级别的错误不会调用复杂的系统行为，一般来说都是简单的格式错误
    4 ->
        操作级错误。通常是进行了错误的请求，如用户未登陆、无权限操作、验证码不符、确认密码字段不相同
        本级别的错误行为可能会很复杂，一般来说是业务逻辑的错误
    5 ->
        逻辑级错误。通常是后台源码写的不够健壮，一般来说前台正常调用不会出现本级别的错误
        本级别的错误是为了加强程序健壮性而加进去的，一旦抛出，通常是后台源码写错了
    6 ->
        系统级错误。严重的致命错误，若抛出则说明后台源码有严重Bug，请迅速联系网站开发团队。

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
    '3361' => '生成Token记录时发生错误',//log_in
    '3362' => '更新Token时发生错误',//log_in
    '3331' => 'uid格式不正确',//test_token
    '3332' => 'uid格式不正确',//get_state
    //修改密码 ChangePasswordService
    '4341' => '验证码verifycode不正确',
    '4342' => '用户没有登陆',
    '4343' => 'password字段与re_password字段不等',
    '4351' => '更新记录失败',
    '4361' => '执行登出操作失败',
    //找回密码
    '4441' => '验证码verifycode不正确',
    '4442' => '用户没有登陆',
    //用户登陆 SignInService
    '4531' => 'username字段格式不正确',
    '4541' => '验证码verifycode不正确',
    '4551' => '不存在此用户',
    '4552' => '密码不正确',
    //用户退出登录 SignOutService
    //用户注册1 SignUp0Service
    '4741' => '验证码verifycode不正确',
    '4742' => 'password字段与re_password字段不等',
    '4743' => '不存在此邀请码',
    '4744' => '该邀请码已被使用',
    '4751' => '激活码注销失败',
    '4752' => '激活码注销成功，但账号写入失败，请联系网站管理员，要不然你就吃亏了',
    //用户注册2 SignUp1Service
    '4841' => '验证码verifycode不正确',
    '4842' => '用户没有登陆',
    '4843' => '用户不需要提交信息',
    '4851' => '个人信息写入失败',
    '4852' => '账号状态更新失败',
    //用户签到 ClockService
    '4941' => '用户没有登陆',
    '4942' => '用户今天已经签到了',
    '4951' => '增加果仁时发生错误',
    '4952' => '记录签到时发生错误',
    //果仁商店，创建新作品 NsCreateWorksService
    '4A41' => '用户没有登陆',
    '4A51' => '新建作品失败',
    //果仁商店，修改作品信息 NsEditWorksService
    '4B41' => '用户没有登陆',
    '4B42' => '没有权限',
    '4B51' => '更新资料失败',
    //果仁商店，删除作品 NsDeleteWorksService
    '4C41' => '用户没有登陆',
    '4C42' => '没有权限',
    '4C51' => '作品删除失败',
    //果仁商店，提交新章节 NsCreateSectionService
    '4D41' => '用户没有登陆',
    '4D42' => '没有权限',
    '4D52' => '新建章节失败',
    //果仁商店，修改章节信息 NsEditSectionService
    '4E41' => '用户没有登陆',
    '4E42' => '没有权限',
    '4E51' => '更新章节失败',
    //果仁商店，删除章节 NsDeleteSectionService
    '4F31' => 'works_id格式不正确',
    '4F32' => 'section_id格式不正确',
    '4F41' => '用户没有登陆',
    '4F42' => '没有权限',
    '4F51' => '章节删除失败',
    //果仁商店，购买作品 NsBuyWorksService
    '4G41' => '用户没有登陆',
    '4G42' => '果仁不足',
    '4G43' => '没找到该works_id的作品',
    '4G44' => '你已经购买了此作品了',
    '4G45' => '不能购买自己投稿的作品',
    '4G51' => '果仁扣除失败',
    '4G52' => '成功扣除果仁，但是购买失败，请联系网站管理员，要不然你就吃亏了',
    //果仁商店，提交作品日志 NsCreateWorksLogService
    '4H41' => '用户没有登陆',
    '4H42' => '没有权限',
    '4H51' => '新建日志失败',
    //果仁商店，删除作品日志 NsDeleteWorksLogService
    '4J31' => 'log_id格式不正确',
    '4J41' => '用户没有登陆',
    '4J42' => '没有权限',
    '4J43' => 'log_id没有对应的日志',
    '4J51' => '日志删除失败',
    //果仁商店，已购买作品打分 NsGradeWorksService
    '4K41' => '用户没有登陆',
    '4K42' => '只有购买了此作品才能打分',
    '4K51' => '更新评分失败',
    //激活码使用记录表 InviteCodeModel
    '5331' => 'uid格式不正确',
    '5332' => 'invite_code格式不正确',
    //用户登陆令牌cookie表 TokenModel
    '5431' => 'uid格式不正确',
    //用户扩展信息表 UserInfModel
    '5531' => 'uid格式不正确',
    '5532' => 'name格式不正确',
    '5533' => 'gender格式不正确',
    '5534' => 'age格式不正确',
    '5535' => 'phone格式不正确',
    '5536' => 'school格式不正确',
    '5537' => 'wechat格式不正确，若没有可留空',
    '5538' => 'nickname格式不正确，若没有可留空',
    //用户基础信息表 UsersModel
    '5631' => 'uid格式不正确',
    '5632' => 'state格式不正确',
    '5633' => 'password格式不正确',
    '5634' => 'qq格式不正确',
    '5641' => '该qq已被注册',
    '5661' => 'WEB_BATCH参数未定义',
    //用户签到记录表 ClockModel
    '5731' => 'uid格式不正确',
    '5732' => 'id格式不正确',
    //用户果仁数量记录表 NutsModel
    '5831' => 'uid格式不正确',
    '5832' => 'nuts格式不正确',
    '5833' => 'cumulative格式不正确',
    '5834' => 'uid格式不正确（统计模式）',
    '5835' => 'nuts格式不正确（统计模式）',
    //果仁商店商品(作品)信息表 NsWorksListModel
    '5931' => 'author_uid格式不正确',
    '5932' => 'works_state格式不正确',
    '5933' => 'works_name必填',
    '5934' => 'price格式不正确',
    '5935' => 'works_id|id格式不正确',
    //果仁商店用户购买记录&评分表 NsBuyModel
    '5A31' => 'uid格式不正确',
    '5A32' => 'works_id格式不正确',
    '5A33' => 'score字段必须是数字',
    '5A34' => 'score字段必须在0-10以内',
    '5A35' => 'buy_id|id格式不正确',
    //果仁商店作品章节信息表 NsSectionModel
    '5B31' => 'works_id字段必须是数字',
    '5B32' => 'section_name字段格式不正确',
    '5B33' => 'section_id字段必须是数字',
    '5B34' => 'id字段必须是数字',
    '5B41' => 'section_id重复，此章节已存在',
    //果仁商店作品更新日志记录表 NsUpdateLogModel
    '5C31' => 'works_id字段必须是数字',
    '5C32' => 'section_id字段必须是数字',
    '5C33' => 'id字段必须是数字',
);