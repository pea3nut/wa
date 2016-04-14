# URL信息

[TOC]

此文档罗列出了协会网站中的所有页面

## 会员信息操作页面

### 会员登录页面

- 页面链接：站点URL/Member/sign_in
- 功能：实现会员登录功能，获取登陆令牌cookie
- 访问控制：无

### 会员注册第一步

- 页面链接：站点URL/Member/sign_up_0
- 功能：新会员注册第一步
- 访问控制：无

### 会员注册第二步

- 页面链接：站点URL/Member/sign_up_1
- 功能：新会员注册第二步
- 访问控制：需要登陆令牌cookie

### 修改密码页面

- 页面链接：站点URL/Member/change_password
- 功能：实现修改密码功能
- 访问控制：需要登陆令牌cookie

## 果仁商店页面

### 投稿新课程页面

- 页面链接：站点URL/NutStore/submit_works
- 功能：实现果仁商店创建新课程功能
- 访问控制：无

### 查看课程信息页面

- 页面链接：站点URL/NutStore/works/[works_id]
- 功能：查看课程详细信息页面
- 访问控制：无

### 编辑课程信息页面

- 页面链接：站点URL/NutStore/edit_works/[works_id]
- 功能：实现编辑课程信息、增删改查课程章节功能
- 访问控制：需要登陆令牌cookie && 必须为课程作者

### 果仁商店个人信息页面

- 页面链接：站点URL/NutStore/member/[uid]
- 功能：查看自己或他人的个人信息
- 访问控制：需要登陆令牌cookie

### 查看课程列表

- 页面链接：站点URL/NutStore/list/[order_by]/[asc|desc]
- 功能：查看课程，并按[order_by]排序
- 访问控制：无

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
- 访问控制：需要登陆令牌cookie && (已购买此作品 || [section]==0)

## 协会网站开发文档页面

### 开发文档首页

- 页面链接：站点URL/Develop/index
- 功能：实现会员登录功能，获取登陆令牌cookie
- 访问控制：无

## 协会公告页

### 公告查看

- 页面链接：站点URL/News/read/[news_id]
- 功能：实现会员登录功能，获取登陆令牌cookie
- 访问控制：无

## 特殊页面

### 协会大事记

- 页面链接：站点URL/Nutjs/history
- 功能：实现会员登录功能，获取登陆令牌cookie
- 访问控制：无

### Markdown渲染

- 页面链接：站点URL/Nutjs/markdown/xxx.md
- 功能：临时共享一下Markdown
- 访问控制：无
