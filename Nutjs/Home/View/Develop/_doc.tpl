<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8" />
    <!-- 设定虚拟视窗 -->
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no" />
    <!-- 让IE浏览器以edge引擎渲染 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- 让双核浏览器用webkit引擎渲染 -->
    <meta name="renderer" content="webkit" />
    <!-- 定义超链接默认为行为 -->
    <base target="_blank" />
    <!-- 载入网站ICON -->
    <link rel="shortcut icon" href="__PUBLIC__/Library/Image/nutjs.ico" type="image/x-icon" />
    <!-- 引入CSS文件 -->
    <load href="__PUBLIC__/Library/bootstrap-3.3.5/css/bootstrap.css" />
    <load href="__PUBLIC__/PeA_nut/css/rewrite_bootstrap.css" />
    <load href="__PUBLIC__/PeA_nut/css/class.css" />
    <load href="__STYLE__/_doc.css" />
    <load href="__STYLE__/nav.css" />
    <!-- Extend区块title -->
    <title><block name="title">{$Think.ACTION_NAME} - 开发文档</block></title>
</head>
<body style="background:url(__PUBLIC__/PeA_nut/bg/star01.jpg)">
    <!-- 引入导航栏 -->
    <include file="__INCLUDE__/nav.tpl" />
    <!-- 输出渲染的Markdown -->
    <article class="container text-body">
        {$_data.body}
    </article>
    <!-- 版权信息 -->
    <footer class="copyright">
        <p>Copyright © Nutjs.com 鲁ICP备15006545号</p>
        <p>Powered by <a href="http://www.bootcss.com/">Bootstrap</a> and <a href="http://www.thinkphp.cn/">ThinkPHP</a>.</p>
    </footer>
</body>
<!-- 引入JS文件 -->
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/jquery-1.9.1.min.js" />
<load href="__PUBLIC__/Library/bootstrap-3.3.5/js/bootstrap.min.js" />
<load href="__SCRIPT__/create_index.js" />
<load href="__PUBLIC__/Library/PeA-target/script/PeA-target.js" />
<!-- Extend区块end_script -->
<!-- 给h2和h3添加前导数字，生成目录填充#directory元素 -->
<!--script>
<block name="end_script">
    //实例化对象
    var cIndex=new CreateIndex();
    //设置索引标签名，开始索引
    cIndex.setIndexTagName('h2,h3').createIndex();
    //生成获取目录，插入制定的位置
    cIndex.createNav();
    document.getElementById("directory").innerHTML =cIndex.navHtml;
</block>
</script-->
</html>