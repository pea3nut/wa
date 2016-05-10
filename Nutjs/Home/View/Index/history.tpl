<!DOCTYPE html>
<html>
<head>
    <include file="./Public/PeA_nut/inc/tpl/head2.tpl" />
    <load href="__SCRIPT__/history.conf.js" />
    <script type="text/javascript">
        HIS_CONF.IMG_BODY_SRC="__IMAGE__/history/tree_body.jpg";
    </script>
    <style>
        #tree_body{
            background-image: url(__IMAGE__/history/tree_body.jpg);
            background-size: 100%;
        }
        ul#timebase_l li{
            background-image:url("__IMAGE__/history/tree_sign_left.png")
        }
        ul#timebase_r li{
            background-image:url("__IMAGE__/history/tree_sign_right.png")
        }
    </style>
    <title>大事记时间轴</title>
</head>
<body>
    <div id="main">
        <a href="{:U('Index/index')}" target="_self"><img src="__IMAGE__/history/foot.png" /><br />点击这里返回首页</a>
        <div id="tree">
            <img id="tree_head" src="__IMAGE__/history/tree_head.jpg" />
            <div id="tree_body"></div>
            <img id="tree_foot" src="__IMAGE__/history/tree_foot.jpg" />
        </div>
        <div id="timebase"><ul id="timebase_l"></ul><ul id="timebase_r"></ul></div>
    </div>
</body>
<load href="__SCRIPT__/history.js" />
</html>