# 模板开发指南

[TOC]

本文档可以帮助没有任何PHP基础的开发者为协会网站开发页面，仅需要HTML+CSS技术及即可

## 模板构架

协会网站采用ThinkPHP3.2.3框架搭建而成，在页面显示（View层）方面使用使用ThinkPHP原生的ThinkTemplate模板引擎。详细的模板引擎使用请参考ThinkPHP官方手册中[视图](http://www.kancloud.cn/manual/thinkphp/1785)和[模板](http://www.kancloud.cn/manual/thinkphp/1793)章节，这里就不再过多赘述。本章节主要向开发者介绍协会网站的View层构架和模板开发。

## 模板说明

网站页面模板存放规则为

	./Nutjs/Home/View/控制器名/方法名.tpl

如协会的登陆页面`http://www.nutjs.com/Member/sign_in`，其中控制器名是Member，方法名是sign_in。所以调用的模板就为

	./Nutjs/Home/View/Member/sign_in.tpl

>注意，路径是严格区分大小写的

每一个模板文件都有其归属的控制器，如果没有相应控制器直接在`./Nutjs/Home/View/`下建立文件夹并在文件夹创建中模板文件，这样是无法运行的。

通常来说我们不建议开发者创建额外的控制器来调试（除非你明确知道自己在做什么）。我们为开发者提供了一个开发测试用的Mnt控制器，开发者仅需在`./Nutjs/Home/View/Mnt`文件夹下创建模板文件即可运行。

在进行模板开发时，无需知道控制器所在的位置，仅仅在`./Nutjs/View/`中新建一个以控制器命名的文件夹，如Mnt文件夹，然后自由的命名模板文件即可渲染执行。

比如，我们在`./Nutjs/Home/View/Mnt`文件中建立一个`demo1.tpl`文件如下：

    //文件路径./Nutjs/Home/View/Mnt/demo1.tpl
    Hello World!

我们通过`[站点URL]/Mnt/test`就可以看到如下显示：

	Hello World!

也就是说按照`./Nutjs/Home/View/`控制器名的路径规则建立模板文件就可以直接通过访问`站点URL/控制器名/模板文件名`即可直接渲染输出特定的模板文件（大部分情况是这样）。

## 资源文件

这里所说的资源文件通常来说表示css文件、js文件、图片、其他模板文件等。

请开发者尽可能的遵守资源文件存放规则，否则可能无法正常使用我们扩展的魔法常量。

### 控制器资源文件夹

不同控制器中的模板文件拥有不同的模板资源存放文件夹。也就是说同一控制器的所有模板文件共享一个资源文件夹。其路径规则为：

    CSS文件:  ./Nutjs/Public/Style/控制器名
    JS文件:   ./Nutjs/Public/Script/控制器名
    图片文件:  ./Nutjs/Public/Image/控制器名
    引用文件:  ./Nutjs/Public/Include/控制器名

所以在上面的例子中我们创建在Mnt控制器下创建的`demo1.tpl`模板文件的CSS文件（文件名可以自由命名）存放地址就应该是

	./Nutjs/Public/Style/mnt/

一旦你遵守了这些命名规范，就可以通过下面章节中的**魔法常量**来快速的引用它了。

> 通常来说，我们不推荐某个控制器的模板文件跨控制器访问非本控制器的资源文件，如果需要跨控制器访问，请使用公共资源文件夹。

### 公共资源文件夹

公共资源文件夹位于`./Public`文件夹，每个人都可以在其中建立唯一的个人文件夹来存放文件，文件夹名建议以“自己名字全拼+骆驼峰+首字母大写”的方式命名，其目录结构没有任何限制，开发者可以根据自己喜好定义个人文件夹中的目录结构。

每名开发者仅建议修改和引用自己的个人文件夹，除得到许可外任何的修改他人资源文件夹的pull request都将不会通过。

> `./Public/Libray/`文件夹为公共资源文件夹，可以自由引用，由Nutjs团队维护

如下面目录结构，我们建立了一个王尼玛和花生PeA的个人公共资源文件夹

    站点目录
    ├─Nutjs 应用目录
    ├─Public 公共资源文件目录
    │  ├─PeA_nut 花生的公共资源文件夹
    │  ├─WangNiMa 王尼玛的公共资源文件夹
    │  └─Library Nutjs团队公共资源文件夹
    ├─ThinkPHP 框架目录
    └─index.php 入口文件

## 魔法常量

除ThinkPHP系统提供的魔法常量外，我们还扩展了一些魔法常量来方便使用上面的目录结构。

在模板中，下面的魔法常量分别指向的目录为：

    __PUB__     =>  /Nutjs/Home/Public/
    __STYLE__   =>  /Nutjs/Home/Public/Style/控制器名
    __IMAGE__   =>  /Nutjs/Home/Public/Image/控制器名
    __SCRIPT__  =>  /Nutjs/Home/Public/Script/控制器名
    __INCLUDE__ =>  ./Home/Public/Include/控制器名

> 注意：每一个常量的路径是不带`/`的

如，我们将站点存放在`/ThinkPHP/web_association/`中，并在Mnt控制器建立test模板`./Nutjs/Home/View/Mnt/test.tpl`，内容如下

	资源文件夹
    	__PUB__
    样式表文件夹
    	__STYLE__
    图片文件夹
    	__IMAGE__
    JS脚本文件夹
    	__SCRIPT__
    引用模板文件夹
    	__INCLUDE__

经过渲染后的结果为

    资源文件夹
    	/ThinkPHP/web_association/Nutjs/HomePublic/
    样式表文件夹
    	/ThinkPHP/web_association/Nutjs/Home/Public/Style/Mnt
    图片文件夹
    	/ThinkPHP/web_association/Nutjs/Home/Public/Image/Mnt
    JS脚本文件夹
    	/ThinkPHP/web_association/Nutjs/Home/Public/Script/Mnt
    引用模板文件夹
    	./Nutjs/Home/Public/Include/Mnt

> 你可能注意到` __INCLUDE__`渲染出的路径明显与其他的不一样，因为它不是一个URL路径，因此只适合引用模板文件。

> 在使用每一个魔法常量时，请保持它的原有语义。

## 与原生ThinkPHP不兼容

由于某些原因，我们修改了ThinkPHP的核心源码，可能会带来与原生ThinkPHP不兼容的情况发生，请开发者在调试过程中测试指正，我们会第一时间修复不兼容现象。

    联系人：花生PeA
    邮箱：626954412@qq.com
