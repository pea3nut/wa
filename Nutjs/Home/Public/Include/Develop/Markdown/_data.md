# 模板开发_data变量说明

[TOC]

凡是在Web开发协会官方开发的网页中，在Controller层均有_data变量可供模板开发使用。

## 全局变量

任何页面都可以使用的变量

### 状态变量

- _data.isLogged [0|1] 用户是否已登录
- _data.version 当前网站的版本

### 用户信息变量

若用户已合法登陆，还会有用户信息变量，包括

- _data.user.uid 用户的编号
- _data.user.nickname 用户的昵称
- _data.user.name 用户的真实姓名
- _data.user.qq 用户的QQ号
- _data.user.gender 默认为0。用户的性别，1表示男，2表示女
- _data.user.age 用户的年龄
- _data.user.phone 用户的手机号
- _data.user.school 用户所在的学校，默认为ql。ql青理 sk山科 sy石油
- _data.user.wechat 用户微信号
- _data.user.nickname 用户的昵称

其他页面根据不同的功能可能添加更多的数据变量

## 果仁商店页面变量

果仁商店中页面的_data变量参考

### 查看课程信息页面

- 页面链接：站点URL/NutStore/works/[works_id]

作品信息

- _data.works.id 投稿的作品ID
- _data.works.author_uid 作品的UP主（投稿者）的协会编号
- _data.works.works_name 作品的名称
- _data.works.works_intro 作品简介
- _data.works.works_state 作品状态 0-隐藏 1-更新中，2-已完结
- _data.works.price 作品售价
- _data.works.update_number 作品的历史更新次数
- _data.works.update_date 作品最后更新时间
- _data.works.create_date 作品创建时间

作者信息

- _data.author.uid 用户的编号
- _data.author.nickname 用户的昵称
- _data.author.name 用户的真实姓名
- _data.author.qq 用户的QQ号
- _data.author.gender 默认为0。用户的性别，1表示男，2表示女
- _data.author.age 用户的年龄
- _data.author.phone 用户的手机号
- _data.author.school 用户所在的学校，默认为ql。ql青理 sk山科 sy石油
- _data.author.wechat 用户微信号
- _data.author.nickname 用户的昵称

### 编辑课程信息页面

- 页面链接：站点URL/NutStore/edit_works/[works_id]

_date数据同上

### 果仁商店个人信息页面

- 页面链接：站点URL/NutStore/member/[uid]

## 已购买的信息

已购买的记录信息

- _data.buy.length 用户一共购买的课程数
- _data.buy[x] 用户购买的第x个课程，一个数组
- _data.buy[x].id 购买记录ID
- _data.buy[x].score 用户购买的第x个课程给出的评分

已购买的课程信息

- _data.buy[x].works.id 购买的第x个课程ID
- _data.buy[x] 用户购买的第x个课程给出的评分
- _data.buy[x].works.author_uid 购买的第x个课程的UP主（投稿者）的协会编号
- _data.buy[x].works.works_name 购买的第x个课程的名称
- _data.buy[x].works.works_intro 购买的第x个课程简介
- _data.buy[x].works.works_state 购买的第x个课程状态 0-隐藏 1-更新中，2-已完结
- _data.buy[x].works.price 购买的第x个课程售价
- _data.buy[x].works.update_number 购买的第x个课程的历史更新次数
- _data.buy[x].works.update_date 购买的第x个课程最后更新时间
- _data.buy[x].works.create_date 购买的第x个课程创建时间

已购买的课程的作者信息

- _data.buy[x].author.uid 购买的第x个课程的作者的编号
- _data.buy[x].author.nickname 购买的第x个课程的作者的昵称
- _data.buy[x].author.name 购买的第x个课程的作者的真实姓名
- _data.buy[x].author.qq 购买的第x个课程的作者的QQ号
- _data.buy[x].author.gender 购买的第x个课程的作者的性别，1表示男，2表示女
- _data.buy[x].author.age 购买的第x个课程的作者的年龄
- _data.buy[x].author.phone 购买的第x个课程的作者的手机号
- _data.buy[x].author.school 购买的第x个课程的作者所在的学校，默认为ql。ql青理 sk山科 sy石油
- _data.buy[x].author.wechat 购买的第x个课程的作者微信号
- _data.buy[x].author.nickname 购买的第x个课程的作者的昵称

## 投稿信息

- _data.submit.length 用户一共投稿的课程数
- _data.submit[x] 用户投稿的第x个课程
- _data.submit[x].works.id 投稿的第x个课程的ID
- _data.submit[x].works.author_uid 投稿的第x个课程的UP主（投稿者）的协会编号
- _data.submit[x].works.works_name 投稿的第x个课程的名称
- _data.submit[x].works.works_intro 投稿的第x个课程简介
- _data.submit[x].works.works_state 投稿的第x个课程状态 0-隐藏 1-更新中，2-已完结
- _data.submit[x].works.price 投稿的第x个课程售价
- _data.submit[x].works.update_number 投稿的第x个课程的历史更新次数
- _data.submit[x].works.update_date 投稿的第x个课程最后更新时间
- _data.submit[x].works.create_date 投稿的第x个课程创建时间

### 查看课程列表

- 页面链接：站点URL/NutStore/list/[order_by]/[asc|desc]

页面信息

- _data.list.length 总作品数
- _data.order 排序依据[order_by]的值
- _data.aod 排序升序还是降序[asc|desc]的值

作品列表，作品信息

- _data.list.length 总作品数
- _data.list[x] 第x个课程
- _data.list[x].works.id 第x个课程的ID
- _data.list[x].works.author_uid 第x个课程的UP主（投稿者）的协会编号
- _data.list[x].works.works_name 第x个课程的名称
- _data.list[x].works.works_intro 第x个课程简介
- _data.list[x].works.works_state 第x个课程状态 0-隐藏 1-更新中，2-已完结
- _data.list[x].works.price 第x个课程售价
- _data.list[x].works.update_number 第x个课程的历史更新次数
- _data.list[x].works.update_date 第x个课程最后更新时间
- _data.list[x].works.create_date 第x个课程创建时间

作品列表，作品作者信息

- _data.list[x].author.uid 第x个课程的作者的编号
- _data.list[x].author.nickname 第x个课程的作者的昵称
- _data.list[x].author.name 第x个课程的作者的真实姓名
- _data.list[x].author.qq 第x个课程的作者的QQ号
- _data.list[x].author.gender 第x个课程的作者的性别，1表示男，2表示女
- _data.list[x].author.age 第x个课程的作者的年龄
- _data.list[x].author.phone 第x个课程的作者的手机号
- _data.list[x].author.school 第x个课程的作者所在的学校，默认为ql。ql青理 sk山科 sy石油
- _data.list[x].author.wechat 第x个课程的作者微信号
- _data.list[x].author.nickname 第x个课程的作者的昵称

### 阅读课程界面

- 页面链接：站点URL/NutStore/read/[works_id]/[section]

作品信息

- _data.works.id 投稿的作品ID
- _data.works.author_uid 作品的UP主（投稿者）的协会编号
- _data.works.works_name 作品的名称
- _data.works.works_intro 作品简介
- _data.works.works_state 作品状态 0-隐藏 1-更新中，2-已完结
- _data.works.price 作品售价
- _data.works.update_number 作品的历史更新次数
- _data.works.update_date 作品最后更新时间
- _data.works.create_date 作品创建时间

作者信息

- _data.author.uid 用户的编号
- _data.author.nickname 用户的昵称
- _data.author.name 用户的真实姓名
- _data.author.qq 用户的QQ号
- _data.author.gender 默认为0。用户的性别，1表示男，2表示女
- _data.author.age 用户的年龄
- _data.author.phone 用户的手机号
- _data.author.school 用户所在的学校，默认为ql。ql青理 sk山科 sy石油
- _data.author.wechat 用户微信号
- _data.author.nickname 用户的昵称

若请求的[section]为0或购买过此作品，还会增加额外的章节字段

- _data.works.section


## 特殊页面变量