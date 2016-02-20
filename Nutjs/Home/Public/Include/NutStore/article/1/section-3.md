# 远程合作流程 #

本节讲解的Git工作流（flow）是目前Nutjs团队采用的工作流，其主要部分是使用传统的Git工作流（Git flow）的思想，综合Github网站的一些特点制定而成。

因为此工作流比较简单，所以起来会比较轻松。

## 分支使用 ##

在远程分支中，因为项目较小，我们约定仅使用2个远程分支，分别是master分支和dev分支，其他分支不建议推送到远程仓库中。

### dev分支 ###

所有的提交与合并均提交的到dev分支中，在开发者将其他分支合并进dev分支后，要清理新增的commit，确保它是有意义的，可以帮助其他开发人员阅读项目历史。

当开发人员开始新一天的工作前，只需从远程仓库拉取dev分支即可，提交改动合并分支也仅仅是对dev分支操作。除非特殊需要，否则一般情况下开发人员几乎不会直接操作master分支。

### master分支 ###

master分支与线上项目进行同步，也就是说一旦改动合并进master分支，也就意味着它上线了。

理论上master分支上没有直接的commit，均是从dev分支上合并而来，因此无需在master分支上的commit打任何的标签即可快速的实现线上版本控制。

除Nutjs团队成员外，不建议其他开发者改动master分支。

### 分支举例 ###

理想的commit结构如下

      * 66ba358 - (HEAD -> dev)坚果商店构架建成，增加markdown渲染引擎
      |
      * 7e2a1a2 - 坚果商店模板建成
    * | c7d31a2 - (master)增加API接口文档
    |\|
    | * c7d31a2 - 整理API开发文档
    * | b517502 - 增加API接口
    |\|
    | * cba5826 - 增加修改密码&资料API
    | |
    | * c7d31a2 - 增加登录与注册API
    * | 882e00a - 新增开发文档
    |\|
    | * eff7c11 - 重写开发文档样式
    | |
    | * 66ba358 - 整理完毕开发文档
    | |
    | * 2fd639f - 构架开发文档部分
    |/
    * 4e40742 - 构架目录
    |
    * 34309d9 - 创建项目

而实际上的commit结构如下

    * b517502 - (dev) 写好了签到API 
    * 870b6a8 - 更新create_index类 
    * bd1a340 - 更新的开发文档底部的版权信息 
    * cba5826 - 增加了Widget层 
    * 66ba358 - 对Model模型做了简单的修改 
    | *   7c2bb87 - (HEAD -> master) V1.2 更新结构和细节 
    | |\
    | |/
    |/|
    * | eff7c11 - 更新了结构，简单修复了细节 
    * | 820d77c - 更新了模板文档，修复了引用css文件的bug 
    | *   1f2de57 - V1.1增加样式版 
    | |\
    | |/
    |/|
    * | e5e896b - 更新了文档内容，增加了样式 
    * | 1c70c4b - 增加的部署安装部分的说明 
    |/
    * 7e2a1a2 - Create! 

其实也是能看明白的对不对？之前一直是为了增强可读性，花生一直优化Git的分支结构，使之看起来没有那么乱，而实际上git分支要乱的多，不过仔细观察，总是能理清的。

## Git工作流 ##

其实当你通读上面的课程后，一个简单的Git工作流就已经诞生了。

下面给出一个参考的流程，开发者千万不要生搬硬套，应尝试理解每一步的动机与原因。

> 用方括号[]包裹的为参数，开发者应根据自己的情况进行替换

    从远程仓库克隆项目
        git clone git@[url]:[port]/[path]/[project].git
    若没有dev分支，需要拉下dev分支
        git pull origin dev:dev
    切换到dev分支
        git checkout dev
    A:根据需求在dev分支上最新的commit上建立一个分支
        git branch [branch_name]
        git checkout [branch_name]
    在新分支上不断的开发，提交改动
        git add [file]
        git commit -m "[commit_message]"
        ...
    完成功能后，将改动合并进dev分支
        git checkout dev
        git merge [branch_name]
    B:整理新添加进的commit
        git rebase -i origin/dev
        ...
    C:推送到远程仓库
        git push origin dev:dev
    (可能发生)与远程库发生冲突，先拉下远程库的改动
        git pull origin dev:dev
    (可能发生)然后查看解决冲突，解决冲突
        git status
        ...
        git add [file]
        git commit -m "[commit_message]"
    (可能发生)重复步骤C
        goto C
    一个功能开发工作结束
        ...
    下一次开发前，根据间隔时间长短，先从远程服务器拉下改动
        git pull origin dev:dev
    重复步骤A
        goto A
    
关于步骤C要做一下特殊的说明

## 变基（rebase）分支 ##

在上文中，我们使用的变基分支名的操作，是什么意思呢？这时候我们要引入远程分支的概念。

比如如下结构

    * 4e40742 - (HEAD -> master)构架目录
    |
    * 34309d9 - 创建项目

如果推送到远程仓库，别人再克隆（clone）下来，会是这样的

    * 4e40742 - (HEAD -> master, origin/master)构架目录
    |
    * 34309d9 - 创建项目

其中origin/master表示远程分支。

一开始master分支和origin/master分支是同步的，但是当你不断在master分支上提交，你的master分支就会比origin分支“先进”很多。

    * c7d31a2 - (HEAD -> master)重写开发文档样式
    |
    * cba5826 - 整理完毕开发文档
    |
    * 2fd639f - 构架开发文档部分
    |
    * 4e40742 - (origin/master, origin/HEAD)构架目录
    |
    * 34309d9 - 创建项目

这时候你对origin/master分支进行变基操作，实际上是对**master分支和origin/master分支不同步的的部分进行变基**（也就是2fd639f cba5826 c7d31a2），并且最终效果会同时作用于master分支和origin/master分支。

    git rebase -i origin/master

当你确定好要保留commit后，完成变基操作，结构会是这样的（比如我们将cba5826合并进前一个提交）

    * c7d31a2 - (HEAD -> master, origin/master)重写开发文档样式
    |
    * 2fd639f - 构架开发文档部分
    |
    * 4e40742 - (origin/HEAD)构架目录
    |
    * 34309d9 - 创建项目

这时候我们将master分支push要远程版本库就可以了，本地不会有任何的改动。

所以，除非你要整理某些分支的历史，否则开发过程中我们大部分用的都是变基一个分支名，而不是一个commit_id