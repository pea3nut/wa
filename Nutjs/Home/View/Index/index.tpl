<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <title>Web开发协会-主页</title>
    <style type="text/css">
        body{
            background-color: #293134;
            color:#fff;
        }
        #my-body{
            margin-top: 50px;
            position: relative;
        }
        #_foot{
            background-color: #293134;
            color: #fff;
        }
        .show-inf{
            margin-top:50px;
        }
        .show-inf *{
            text-shadow:
                0 0 5px #000,
                0 0 5px #000,
                0 0 5px #000,
                0 0 5px #000
            ;
        }
        .project-inf td{
            vertical-align:baseline;
            padding-left: 10px;
            font-size: 50px;
            font-family: "仿宋";
        }
        .project-inf tr td.data-number{
            font-size: 1.5em;
            padding-right: 10px;
            font-size: 90px;
            font-family: inherit;
        }
        .wa_name{
            font-size: 30px;
            text-align: right;
            font-family: "楷体";
        }
        .wa_name strong{
            font-size: 3em;
            margin:0 20px;
            position: relative;
            top:15px;
            font-family:"ItalicT","华文行楷";
            color: #fffee9;
            text-shadow: 0 0 10px #fff723;
        }
        .wa_link{
            margin-top: 130px;
        }
        .wa_link a{
            background: none;
            color: #fff;
            text-decoration: none;
        }
        .wa_link a:hover{
            text-shadow: none;
        }
    </style>
</block>
<block name="body">
    <div id="my-body" class="container">
        <div class="col-xm-12 col-md-10 center-block no-float show-inf">
            <table border="0" cellspacing="0" cellpadding="0" class="project-inf">
                <tr>
                    <td>超过</td>
                    <td class="data-number">30,000</td>
                    <td>行代码</td>
                </tr>
                <tr>
                    <td>包括</td>
                    <td class="data-number">150+</td>
                    <td>个文件</td>
                </tr>
                <tr>
                    <td>耗时</td>
                    <td class="data-number">90</td>
                    <td>天</td>
                </tr>
            </table>
            <div class="wa_name">—— Web开发协会<strong class="default-font">5</strong>.0</div>
            <div class="form-group form-group-towbtn-3-1 col-xm-11 col-md-8 center-block no-float wa_link">
                <a class="btn btn-info btn-block pull-left" href="#" role="button">查看说明</a>
                <a class="btn btn-warning btn-block pull-right" href="https://github.com/pea3nut/wa" target="_blank" role="button">获取源码</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">$(function(){
        //设定主部分高度
        $('#my-body').css("min-height",innerHeight-100);
        $(window).on("resize",function(){
            $('#my-body').css("min-height",innerHeight-100));
        });
        $(document.body).css("background","url(__IMAGE__/bg.png) center")
        //导航条反色
        $("#_nav").addClass("navbar-inverse").css("height");
        //版权声明反色
        $("#_foot").css("backgroundColor","#293134").css("color","#fff");
    });</script>    
</block> 