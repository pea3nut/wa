# 部署安装Web开发协会网站

[TOC]

本章节主要介绍如何获取&部署Web开发协会站点在你的电脑上。

以下过程采用**Windows系统**作为例子，Linux请根据情况作出相应调整。

## 获取网站源码

开发者可以访问github来获取最新的协会站点源码。

	https://github.com/pea3nut/wa

## 配置运行环境

### wamp环境

根据协会的网站运行环境搭建一个尽可能接近的wamp运行环境，协会网站运行环境请参考网站构架信息章节。配置过程这里就不再赘述。

### Apache

用Notepad++或其他编辑器打开Apache配置文件，注意不要用Windows自带的笔记本或写字板

配置文件所在路径

	Wamp安装目录\bin\apache\Apache+版本号\conf\httpd.conf

打开配置文件后，搜索定位URL重写模块，去掉前面的#注释符，让Apache加载URL重写模块

	#LoadModule rewrite_module modules/mod_rewrite.so

在配置文件末尾添加如下配置信息

    <IfModule dir_module>
        DirectoryIndex index.php index.php3 index.html index.htm default.html
    </IfModule>

保存配置文件，重启Apache服务器生效。

### PHP

用Notepad++或其他编辑器打开PHP配置文件，注意不要用Windows自带的笔记本或写字板

配置文件所在路径

	Wamp安装目录\bin\php\php+版本号\php.ini

打开配置文件后，搜索定位GD库，去掉前面的;注释符，让PHP加载GD库

	;extension=php_gd2.dll

保存配置文件，重启Apache服务器生效。

## 项目配置

### 数据库

#### 修改项目数据库配置文件

打开项目文件./Nutjs/Home/Conf/config.php，修改数据库信息为自己的数据库信息。

开发者需要根据文件中注释进行配置即可，如需详细数据库配置规则可以参考[ThinkPHP官方文档](http://document.thinkphp.cn/manual_3_2.html#connect_db)

#### 导入数据库

`./Nutjs/Home/Conf/`中的`.sql`文件，为项目运行数据库

打开phpMyAdmin，建立一个数据库，确保和config.php中的数据库名一致。进入刚刚建立的数据库，选择`操作->导入`，导入`./Nutjs/Home/Conf/`下的sql文件

配置完成后运行`站点URL/Mnt/test_db`测试数据库连接是否成功。若连接成功会提示“连接成功！”，若失败则会报错，开发者可根据错误信息进行排查。
