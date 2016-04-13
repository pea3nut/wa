# Web开发协会网站服务接口（API）文档

协会网站拥有诸多接口，会员可以根据接口开发协会网站各个页面的模板，然后通过github提交pull request

## 接口说明

除特殊说明外，数据统一采用名值对的方式进行请求(key1=value1&key1=value2&...)。调用接口后服务器响应会返回一个json字符串，如

    {"errcode":"4541","errmsg":"验证码不正确！"}

推荐开发者采用Ajax方式调用接口，利用JSON.parse()或eval()解析JSON字符串。

接口返回值篇幅较长，因此我们在其他章节进行介绍。如需了解请[点击这里](errcode)

## 验证码接口

此接口用于调取服务器验证码

调用此接口会返回一张带有验证码的图片，同时协会服务器会记录此次验证码。

#### 接口信息

- 请求方式：GET
- 接口链接：站点URL/Service/verifycode
- 返回值：image/png

协会很多数据库接口为了防止暴力破解添加了验证码机制，很多接口在调用时需要首先验证verifycode字段，这要求开发者在调用其他接口前首先调用本接口获得验证码图片，然后将图片上的文字作为调用其他接口的verifycode字段值，再去在请求其他接口。

因此，如果需要开发特定页面的模板(如登陆页面)，需要在表单中加入用于输入验证码的input并调用验证码接口。

    //HTML
    <img alt="verifycode" src="站点URL/Service/verifycode" />
    <input name="verifycode" type="text" />

为使方便调试，网站提供了一个配置可以允许调用任何接口免去验证验证码。

开发者首先需要开启ThinkPHP的调试模式

    //文件路径 ./index.php
    //开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
    define('APP_DEBUG',True);

然后修改项目配置文件

    //文件路径 ./Nutjs/Home/Conf/config.php
    //表单提交时无需验证verifycode，此配置还要求开启调试模式的情况下才可生效
    'Not_VerifyCode' => true,
    
Note：并不是所有的接口都支持此功能，此功能仅作为开发使用，请仅做开发调试使用，不要依赖此功能作为项目的业务逻辑。

## 基础接口

### 用户登陆

协会网站使用此接口来实现用户登陆，调用此接口可以获取用户登陆令牌cookie

#### 接口信息

- 请求方式：POST
- 接口链接：站点URL/Service/sign_in
- 返回值：JSON

请求需要提交的数据字段：

- username 用户的协会编号或QQ号
- password 用户的登陆密码
- verifycode 验证码

服务器返回一个JSON字符串，如果登陆成功，还会生成2个cookie作为用户登陆令牌

- uid 用户的协会编号
- token 用户的登陆令牌

### 用户注册-第一步

协会网站使用此接口来实现用户注册，用户注册需要2步才能完成

#### 接口信息

- 请求方式：POST
- 接口链接：站点URL/Service/sign_up_0
- 返回值：JSON

请求需要提交的数据字段：

- qq 用户的QQ号，这个字段十分重要，可作为登陆用，一经注册不可修改
- password 用户的登陆密码
- re_password 确认密码
- invite_code 协会发放的邀请码
- verifycode 验证码

服务器返回一个JSON字符串。如果登陆成功，JSON字符串中errmsg字段中返回服务器为当前用户随机生成的协会编号，并且生成用户登陆令牌cookie

### 用户注册-第二步

用户注册的第二步，只有用户仅完成第一步注册且尚未完成第二步才会请求成功。

#### 接口信息

- 请求方式：POST
- 接口链接：站点URL/Service/sign_up_1
- 返回值：JSON

接口需要用户拥有用户登陆令牌cookie，如果没有可调用用户登陆接口获取，调用用户注册第一步接口也会自动生成。

请求需要提交的数据字段：

- name 用户的姓名
- gender 用户的性别。1表示男，2表示女
- age 用户的年龄
- phone 用户的手机号
- school 用户所在的学校。ql表示青岛理工大学，sk表示山东科技大学，sy表示中国石油大学
- wechat 用户的微信号。可以留空
- nickname 用户的昵称。可以留空
- verifycode 验证码

### 退出登录接口

协会网站使用此接口来实现用户退出登录功能。

#### 接口信息

- 请求方式：GET
- 接口链接：站点URL/Service/sign_out
- 返回值：JSON

此操作将更新登陆令牌(原令牌则失效)，并销毁所有cookie。


### 修改密码接口

协会网站使用此接口来实现用户修改密码功能。

#### 接口信息

- 请求方式：POST
- 接口链接：站点URL/Service/change_password
- 返回值：JSON

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

请求需要提交的数据字段：

- password 用户的登陆新密码
- re_password 确认密码
- verifycode 验证码。调用验证码接口返回的图片中的验证码。

服务器返回一个JSON字符串，如果修改密码成功，还将会更新登陆令牌(原令牌则失效)


## 调试接口

协会内网提供了很多调试接口便于开发者调试。

### 检测令牌是否有效

通过此接口可以检测当前令牌是否有效。确切的说是检测现在是否是成功登陆的状态。

#### 接口信息

- 请求方式：POST
- 接口链接：站点URL/Tools/test_token
- 返回值：检测通过返回1，失败返回0

请求需要提交的数据字段：

- uid 协会编号，如果留空则自动获取cookie的uid
- token 令牌，如果留空则自动获取cookie的token

### 获取某个用户的账号状态值

通过此接口可以直接获取某个用户账号的状态值

#### 接口信息

- 请求方式：POST
- 接口链接：站点URL/Tools/get_state
- 返回值：用户的账号状态值。具体参考请点击这里

请求需要提交的数据字段：

- uid 协会编号，如果留空则自动获取cookie的uid

### 以一个更友好的方式检测令牌

通过此接口可以更直观的显示状态信息。

#### 接口信息

- 请求方式：POST
- 接口链接：站点URL/Tools/test_login
- 返回值：html

请求需要提交的数据字段：

- uid 协会编号，如果留空则自动获取cookie的uid
- token 令牌，如果留空则自动获取cookie的token

调试模式开启的情况下，能显示更多的信息。

### 签到接口

此接口可供用户每日签到，获取响应数量的果仁

#### 接口信息

- 请求方式：GET
- 接口链接：站点URL/Service/clock
- 返回值：JSON

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

服务器返回一个JSON字符串。若签到成功返回成功状态码(1200)并返回一段说明文本来告知用户获得的果仁数量。

#### 返回值例子

    {"errcode":"1200","errmsg":"今天是第1个签到的，获得系数3\n因连续签到0天，获得系数1\n果仁数+30"}

## 果仁商店接口

### 创建新作品接口

通过此接口可实现在果仁商店创建新作品的功能。

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：POST
- 接口链接：站点URL/Service/ns_create_works
- 返回值：JSON

请求需要提交的数据字段，所有的参数都是可选的：

- works_name 作品名称
- works_intro 可选，作品简介
- banner 可选，作品的banner，一张640x320的jpg/png图片
- price 出售价格

服务器返回一个JSON字符串，若调用成功，会通过errmsg返回创建的work_id

#### 实例参考

    //新建模式下调用成功
    {"errcode":"1200","errmsg":"7"}

### 修改作品信息接口

通过此接口可实现在果仁商店修改作品信息的功能。

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：POST
- 接口链接：站点URL/Service/ns_edit_works
- 返回值：JSON

请求需要提交的数据字段，所有的参数都是可选的：

- works_id 要修改信息的作品ID
- works_name 作品名称
- works_intro 作品简介
- works_state 作品状态，1-更新中，2-已完结
- banner 作品的banner，一张640x320的jpg/png图片
- price 出售价格

#### 实例参考

    //新建模式下调用成功
    {"errcode":"1200","errmsg":"7"}
    
    //编辑模式下调用成功
    {"errcode":"1200","errmsg":"OK！"}

### 删除作品接口

此接口可删除在果仁商店中投稿的整个作品

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：GET
- 接口链接：站点URL/Service/ns_delete_works
- 返回值：JSON

请求需要提交的数据字段

- works_id 作品ID

### 提交作品章节接口

通过此接口可实现在果仁商店中给作品提交章节。

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：POST
- 接口链接：站点URL/Service/ns_create_section
- 返回值：JSON

请求需要提交的数据字段

- works_id 作品ID
- section_id 可选，默认自动增长。0表示序言，1表示第一章，2表示第二章，以此类推
- section_name 章节名称
- md_file 可选，章节内容，一个markdown文件

在未手动指定section_id时，若调用成功，服务器会自动分配一个section_id并通过errmsg自动返回，生成的section_id是已存在的所有章节的最大值+1

### 修改作品章节接口

通过此接口可实现在果仁商店中给作品提修改章节。

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：POST
- 接口链接：站点URL/Service/ns_edit_section
- 返回值：JSON

请求需要提交的数据字段

- works_id 作品ID
- section_id 章节ID。0表示序言，1表示第一章，2表示第二章，以此类推
- section_name 可选，新的章节名称
- md_file 可选，新的章节内容，一个markdown文件

### 删除章节接口

此接口可删除在果仁商店中投稿的作品章节。

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：GET
- 接口链接：站点URL/Service/ns_delete_section
- 返回值：JSON

请求需要提交的数据字段

- works_id 作品ID
- section_id 章节ID。0表示序言，1表示第一章，2表示第二章，以此类推

### 购买作品接口

此接口允许用户在果仁商店中购买作品。

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：GET
- 接口链接：站点URL/Service/ns_bug_works
- 返回值：JSON

请求需要提交的数据字段

- works_id 作品ID

### 作品评分接口

此接口面向已购买作品的用户对作品进行打分

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：POST
- 接口链接：站点URL/Service/ns_grade_works
- 返回值：JSON

请求需要提交的数据字段

- buy_id 购买记录的ID值
- score 评分，-1表示取消评分，评分为0-10直接的整数

### 提交作品更新日志接口

此可以给作品提交更新日志。

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：POST
- 接口链接：站点URL/Service/ns_create_works_log
- 返回值：JSON

请求需要提交的数据字段

- works_id 要提交到的作品ID
- log 日志内容
- date 提交时间，格式Y-m-d，如2016-03-09

### 删除作品更新日志接口

此可以删除曾经给作品提交更新日志

#### 接口信息

接口需要用户拥有登陆令牌cookie，如果没有可调用用户登陆接口获取。

- 请求方式：GET
- 接口链接：站点URL/Service/ns_delete_works_log
- 返回值：JSON

请求需要提交的数据字段

- log_id 要删除的日志ID