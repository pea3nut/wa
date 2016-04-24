<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/basic.css" />
    <style type="text/css">
        .author-inf{
            margin-top: -1em;
            text-align: right;
        }
        .works-name{
            text-overflow:ellipsis; 
            white-space:nowrap; 
            overflow:hidden;
            margin:0 0 5px 0;
        }
        .works-price strong{
            color: #f40;
            font-family: verdana,arial;
            font-weight: 700;
        }
        .works-intro{
            text-overflow:ellipsis; 
            overflow:hidden;
            height: 60px;
            white-space: nowrap;
            width:100%;
            margin-bottom:20px;
        }
        .works-btn-group{
            margin-top: 30px;
            text-align: right;
        }
        .img-banner{
            border:1px solid #ddd;
        }
        .order-nav a{
            text-decoration: none;
            cursor: pointer !important;
        }
        .order-nav .glyphicon{
            font-size: 12px;
        }
    </style>
    <script src="__PUBLIC__/Library/jQuery.dotdotdot-1.8.1/src/jquery.dotdotdot.min.js" type="text/javascript" charset="utf-8"></script>
</block>
<block name="body">

<article class="container my-body">
<ul class="nav nav-tabs order-nav">
    <if condition="$_data['order'] eq 'update_date desc'">
        <li role="presentation" class="active"><a target="_self" href="{:U('NutStore/works_list/update_date/asc')}">时间 <span class="glyphicon glyphicon-download"></span></a></li>
    <elseif condition="$_data['order'] eq 'update_date asc'"/>
        <li role="presentation" class="active"><a target="_self" href="{:U('NutStore/works_list/update_date/desc')}">时间 <span class="glyphicon glyphicon-upload"></span></a></li>
    <else />
        <li role="presentation"><a target="_self" href="{:U('NutStore/works_list/update_date/desc')}">时间</a></li>
    </if>
    <if condition="$_data['order'] eq 'price desc'">
        <li role="presentation" class="active"><a target="_self" href="{:U('NutStore/works_list/price/asc')}">价格 <span class="glyphicon glyphicon-download"></span></a></li>
    <elseif condition="$_data['order'] eq 'price asc'"/>
        <li role="presentation" class="active"><a target="_self" href="{:U('NutStore/works_list/price/desc')}">价格 <span class="glyphicon glyphicon-upload"></span></a></li>
    <else />
        <li role="presentation"><a target="_self" href="{:U('NutStore/works_list/price/asc')}">价格</a></li>
    </if>
</ul>
    
    <section class="row">
    <volist name="_data.works" id="works">
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="thumbnail">
                <a href="{:U(CONTROLLER_NAME.'/works/'.$works['inf']['id'])}">
                    <img src="__IMAGE__/article/{$works.inf.id}.jpg" alt="banner" class="img-banner" />
                </a>
                <div class="caption">
                    <h3 class="works-name">{$works.inf.works_name}</h3>
                    <div>
                        <p class="pull-left">作者：{$works.author.nickname|default=$works.inf.author_uid}</p>
                        <p class="pull-right works-price"><strong>{$works.inf.price}</strong>果仁</p>
                        <div class="clearfix"></div>
                    </div>
                    <p class="works-intro">{$works.inf.works_intro}</p>
                    <div class="works-inf">
                        购买：{$works.info.sum} 人&nbsp;&nbsp;
                        评分：
                            {//遍历平均分，每1点加一个星，一开始初始成0.99是为了防止整数少一颗星}
                            <php>
                                if(is_null($works['info']['score'])) $works['info']['score']=5;
                                $score =number_format($works['info']['score']/2 ,1);
                            </php>
                            <for start="0.99" end="$score">
                                <span class="glyphicon glyphicon-star"></span>
                            </for>
                            <egt name="works['info']['score']%2" value="1">
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </egt>
                            {$score}
                    </div>
                    <div class="works-btn-group">
                        <a href="{:U(CONTROLLER_NAME.'/buy/'.$works['inf']['id'])}" class="btn btn-primary" role="button">
                            <php>
                                $msg =array('立即购买!','买买买!','买他喵的!');
                                $msg =$msg[mt_rand(0,2)];
                                echo $msg;
                            </php>
                        </a>
                        <a href="{:U(CONTROLLER_NAME.'/works/'.$works['inf']['id'])}" class="btn btn-primary" role="button">查看</a>
                    </div>
                </div>
            </div>
        </div>
    </volist>
    </section>
</article>


<script type="text/javascript">
    //图片加载失败
    $("img.img-banner").on('error',function(){
        this.src="__PUBLIC__/Library/Image/no-image.png";
    });
    //文本裁剪
    $(".works-intro").dotdotdot({
        "ellipsis"    : ' [...]',
        "watch"       : true,
    });
</script>

</block>