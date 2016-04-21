# 网站构架信息

[TOC]

## 基本信息

协会网站基本信息如下：

- 操作系统：Linux CentOS 6.5
- 服务器：Apache 2.4.16
- 数据库：MySQL 5.6.27
- 后台语言：PHP 5.5.30
- 公网IP：120.27.108.49

协会网站采用ThinkPHP3.2.3搭建而成，采用SMVC(Service Model View Controller)架构，对原生的ThinkPHP框架做过小幅度修改，可能会造成不兼容现象，请开发者在调试过程中测试指正，我们会第一时间修复不兼容现象。

    联系人：花生PeA
    邮箱：626954412@qq.com

## 文件地图

    站点目录
    ├─Nutjs 应用目录
    │  ├─Home 站点模块
    │  │  ├─Common 预加载文件mul
    │  │  │  ├─define.php 预定义常量文件
    │  │  │  ├─error_code.php 调用接口返回的错误码
    │  │  │  ├─web_association.sql 用于项目部署的数据库文件
    │  │  │  └─function.php 函数库文件
    │  │  ├─Conf 配置文件存放文件夹
    │  │  │  └─config.php 模块配置文件
    │  │  ├─Controller 控制器层目录
    │  │  │  ├─DevelopController.class.php  开发文档控制器
    │  │  │  ├─IndexController.class.php    首页控制器
    │  │  │  ├─MemberController.class.php   会员请求控制器
    │  │  │  ├─MntController.class.php      测试控制器
    │  │  │  ├─NutStoreController.class.php 果仁商店控制器
    │  │  │  ├─NutjsController.class.php    Nutjs团队专用控制器
    │  │  │  ├─ServiceController.class.php  Service层转接控制器
    │  │  │  └─ToolsController.class.php    工具控制器
    │  │  ├─Model 模型层目录
    │  │  │  ├─InviteCodeModel.class.php    邀请码表模型
    │  │  │  ├─NsBuyModel.class.php         果仁商店-用户购买记录表模型
    │  │  │  ├─NsSectionModel.class.php     果仁商店-课程章节信息记录表模型
    │  │  │  ├─NsUpdateLogModel.class.php   果仁商店-课程更新日志表模型
    │  │  │  ├─NsWorksListModel.class.php   果仁商店-课程信息表模型
    │  │  │  ├─NutsModel.class.php          用户果仁数记录表模型
    │  │  │  ├─TokenModel.class.php         登陆令牌表模型
    │  │  │  ├─UserInfModel.class.php       用户信息表模型
    │  │  │  └─UsersModel.class.php         用户基础表模型
    │  │  ├─Public 模板资源文件目录
    │  │  │  ├─Image    图片资源目录
    │  │  │  ├─Include  引用文件资源目录
    │  │  │  │  ├─Develop   Develop控制器引用资源目录
    │  │  │  │  │  ├─Markdown   Develop控制器markdown文件存放目录
    │  │  │  │  │  └─...
    │  │  │  │  └─...
    │  │  │  ├─Script   JS脚本资源目录
    │  │  │  └─Style    层叠样式表资源目录
    │  │  ├─Service 服务层目录
    │  │  │  ├─ChangePasswordService.class.php 修改密码服务
    │  │  │  ├─GetPasswordService.class.php 找回密码服务
    │  │  │  ├─SignInService.class.php 用户登陆服务
    │  │  │  ├─SignOutService.class.php 用户登出服务
    │  │  │  ├─SignUp0Service.class.php 用户注册服务1
    │  │  │  ├─SignUp1Service.class.php 用户注册服务2
    │  │  │  └─...
    │  │  ├─View 视图层目录(模板文件)
    │  │  │  ├─Exploit 开发文档页面模板
    │  │  │  ├─Index 首页模板
    │  │  │  ├─Member 会员请求页面模板
    │  │  │  ├─Exploit 开发文档页面模板
    │  │  │  ├─Mnt 测试控制器页面模板
    │  │  │  ├─Tools 工具控制器页面模板
    │  │  │  └─... 各种控制器模板文件夹
    │  │  └─... 其他目录
    │  └─Runtime 运行时目录（缓存，可以随意删除）
    ├─Public 公共资源文件目录
    │  ├─Library Nutjs团队公共资源文件夹
    │  └─... 其他公共资源文件夹
    ├─ThinkPHP 框架目录
    └─index.php 入口文件

地图仅供参考，详细使用规范参阅站点源码，如需获得完整的文档参考可以在Develop控制器下寻找。

## 网站分层详解

我们按照从前端到数据库可以简单按功能将协会网站分为6层，其中不分主次，功能流程图如下图

![](URL_ROOT/Nutjs/Home/Public/Image/Develop/mvc-visio.png)

实际运行中对比上图可能有无数例外，请开发者根据情况自由调整。

### View层

View负责页面的显示部分与用户交互部分。

View层决定了网站是以什么样子展现在用户眼中，因此尤为重要。View还负责处理用户请求（如用户提交登陆数据）这些数据是如何提交到后台的（Ajax），后台返回不同的值后，页面应该作何反应（如提示用户密码不正确）。

开发View不需要对后台运作有所了解，所有的数据（$_data）都由下层提供，[点击这里](URL_ROOT/Develop/_data)了解Controller层都为View提供了那些数据。

View是最高层，任意的改动View层均不会影响其他层。

### Controller层

Controller层是整个网站的控制中心。

Controller层定义了用户能够访问的什么页面，连接后台数据将它输送到View层。如用户想要查看个人信息时，Controller需要先检查用户是否是一个合法用户（权限控制），然后调用后台ViewData层获取数据库的数据，将它输送给View，View对他进行美化后显示给用户。

Controller层十分强大，几乎可以干任何事。但是我们不建议Controller跨层访问，这样破坏了分层原则。操纵Controller需要对协会网站的运作有所了解。

Controller层改动几乎不会影响其他层，除了View

### ViewData层

ViewData负责整理后台数据，输送给Controller。

ViewData存在的目的是为了让Controller层调取后台数据更加容易。所以ViewData层是对底层数据库数据进行格式整理，直接提供给Controller，这样可以大大的减少Controller层的代码量。

ViewData层的数据整理是根据前台需要来的，其中整理是数据便是View中的`$_data`，详细请[点击这里](URL_ROOT/Develop/_data)

### Service层

Service层负责接收View层请求的数据并响应他们。

Service层就是协会的API，用户的每一个数据库请求都是View通过Ajax/GET调用的。如用户想要注册账号，View层将用户想要申请的用户名和密码提交到Service层，根据Service的响应（如后台返回莫某个错误码表示用户名格式不正确），再做出相应的动作（提示用户检查用户名格式）。

因为需要操作数据库，所以Service十分敏感，开发Service时请务必要小心。

### Model层

Model层是底层数据库的映射。

直接操作数据库无疑是极其危险的而且十分不便，那么Model层就负责将数据库包装起来，这一方面提高了安全性，另一方面也让操作数据库变的十分便利。因此，理论上来说，数据库中多少张表，Model中就有多个文件。

Model是分层的最低成，几乎任何的接口改动都会影响所有其他层！所以，改动Model层时请保持兼容旧版本。

### 数据库（MySQL）

协会网站采用MySQL数据库，改动数据库时请同步改动Model层。












































ViewData

Service
Model
SQL