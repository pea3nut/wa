# URL信息

此文档罗列出了协会网站中的所有页面

## 会员信息操作页面

### [abc]会员登录页面

- 页面链接：站点URL/Member/sign_in
- 功能：实现会员登录功能，获取登陆令牌cookie
- _data数据：无

### 会员注册第一步

- 页面链接：站点URL/Member/sign_up_0
- 功能：新会员注册第一步
- _data数据：无

### 会员注册第二步

- 页面链接：站点URL/Member/sign_up_1
- 功能：新会员注册第二步
- _data数据：有
- 数据权限：需要登陆令牌cookie

#### _data数据

- uid 用户的编号

### 修改密码页面

- 页面链接：站点URL/Member/change_password
- 功能：实现修改密码功能
- _data数据：有
- 数据权限：需要登陆令牌cookie

#### _data数据

- uid 用户的编号
- nickname 用户的昵称
- name 用户的真实姓名
- qq 用户的QQ号
- gender 默认为0。用户的性别，1表示男，2表示女
- age 用户的年龄
- phone 用户的手机号
- school 用户所在的学校，默认为ql。ql青理 sk山科 sy石油
- wechat 用户微信号，可以留空
- nickname 用户的昵称

## 果仁商店页面

### 投稿新课程页面

- 页面链接：站点URL/NutStore/submit_works
- 功能：实现果仁商店创建新课程功能
- _data数据：有
- 数据权限：需要登陆令牌cookie

#### _data数据

- uid 用户的编号
- nickname 用户的昵称
- name 用户的真实姓名
- qq 用户的QQ号
- gender 默认为0。用户的性别，1表示男，2表示女
- age 用户的年龄
- phone 用户的手机号
- school 用户所在的学校，默认为ql。ql青理 sk山科 sy石油
- wechat 用户微信号，可以留空
- nickname 用户的昵称

### 查看课程信息页面

- 页面链接：站点URL/NutStore/works/[works_id]
- 功能：查看课程详细信息页面
- _data数据：有
- 数据权限：无

#### _data数据

作品信息

- works.id 投稿的作品ID
- works.author_uid 作品的UP主（投稿者）的协会编号
- works.works_name 作品的名称
- works.works_intro 作品简介
- works.works_state 作品状态 0-隐藏 1-更新中，2-已完结
- works.price 作品售价
- works.update_number 作品的历史更新次数
- works.update_date 作品最后更新时间
- works.create_date 作品创建时间

作者信息

- author.uid 用户的编号
- author.nickname 用户的昵称
- author.name 用户的真实姓名
- author.qq 用户的QQ号
- author.gender 默认为0。用户的性别，1表示男，2表示女
- author.age 用户的年龄
- author.phone 用户的手机号
- author.school 用户所在的学校，默认为ql。ql青理 sk山科 sy石油
- author.wechat 用户微信号，可以留空
- author.nickname 用户的昵称

若已登录则会有更多的数据，包括

- user.uid 用户的编号
- user.nickname 用户的昵称
- user.name 用户的真实姓名
- user.qq 用户的QQ号
- user.gender 默认为0。用户的性别，1表示男，2表示女
- user.age 用户的年龄
- user.phone 用户的手机号
- user.school 用户所在的学校，默认为ql。ql青理 sk山科 sy石油
- user.wechat 用户微信号，可以留空
- user.nickname 用户的昵称


### 编辑课程信息页面

- 页面链接：站点URL/NutStore/edit_works/[works_id]
- 功能：实现编辑课程信息、增删改查课程章节功能

### 果仁商店个人信息页面

- 页面链接：站点URL/NutStore/member/[uid]
- 功能：查看自己或他人的个人信息

### 查看课程列表

- 页面链接：站点URL/NutStore/list/[order_by]/[asc|desc]
- 功能：查看课程，并按[order_by]排序

[order_by]值为排序依据，默认为update

- update 按最后更新时间排序，最新的在最后面
- create 按投稿时间排序，最新的在最后
- score 按课程评分排序，分最低的在最前面
- hot 按课程购买数排序，越热门越在后面
- price 按课程价格排序，越便宜越在前面

[asc|desc]值为排序升序or降序，默认为asc

- asc 升序排序，最小的在最前面
- desc 降序排序，最小的在最后面

### 阅读课程界面

- 页面链接：站点URL/NutStore/read/[works_id]/[section]
- 功能：实现会员登录功能，获取登陆令牌cookie

## 协会网站开发文档页面

### 开发文档首页

- 页面链接：站点URL/Develop/index
- 功能：实现会员登录功能，获取登陆令牌cookie

## 协会公告页

### 公告查看

- 页面链接：站点URL/News/read/[news_id]
- 功能：实现会员登录功能，获取登陆令牌cookie

## 特殊页面

### 协会大事记

- 页面链接：站点URL/Nutjs/history
- 功能：实现会员登录功能，获取登陆令牌cookie

### Markdown渲染

- 页面链接：站点URL/Nutjs/markdown/xxx.md
- 功能：临时共享一下Markdown
