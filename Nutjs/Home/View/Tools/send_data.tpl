<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="image/nutjs.ico" type="image/x-icon" />
    <load href="__PUBLIC__/Library/Script/nut2.0.js" />
    <load href="__PUBLIC__/Library/Script/nutjs_ex_ajax.js" />
    <load href="__SCRIPT__/{$Think.ACTION_NAME}.js" />
    <load href="__STYLE__/{$Think.ACTION_NAME}.css" />
    <title>发送数据工具</title>
</head>
<body>
<h1>发送数据工具</h1>
<div id="tool">
    <ul>
        <li>请求地址：<input type="text" id="url" /></li>
        <li class="text-align-up">数据：</li>
        <li><textarea id="sendMsg" rows="4"></textarea></li>
        <li class="child-align-center">
            <label><input type="radio" id="get" name="mode" />Get方式</label>
            <label><input type="radio" id="post" name="mode" />Post方式</label>
        </li>
        <!--li class="child-align-center"><label><input type="checkbox" id="link" />用服务器中转解决跨域</label></li-->
        <li class="child-align-center"><button id="send">发送</button><button id="clear">清空返回信息</button></li>
    </ul>
</div>
<div id="takeDate">2015年12月27日</div>
<pre id="showData"></pre>
</body>
</html>