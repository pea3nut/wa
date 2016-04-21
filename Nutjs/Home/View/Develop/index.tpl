<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/_doc.css" />
    <style type="text/css">
        h1{
            text-align: center;
            margin:80px 0 40px 0;
        }
    </style>
</block>
<block name="body">
    <article class="container text-body">
        <div class="col-xs-12 col-sm-8 center-block no-float">
            <h1>欢迎你，开发者</h1>
            <p>亲爱的开发者，当你点开此页面时，我们由衷的希望你能够成为我们众多开发者中的一员，帮助我们一同建设Web开发协会线上、推广互联网开发技术、培养互联网开发人才。</p>
            <p>Web开发协会自诞生以来一直致力于人才培养、推广W3C标准、推动网络文明。2015年2月25日，协会网站Nutjs上线，在网站中提供了大量的学习资源与资料以供会员免费使用。我们一直坚持开源并以非盈利为目的，希望能成为最具认可的Web开发学习组织并一直努力着！</p>
            <p>我们认为，作为一名Web开发者，在自己所在的高校推广Web开发技术不仅是<strong>荣誉</strong>，更是<strong>使命</strong>！</p>
            <p class="text-right">—— Nutjs团队，2015.12.27</p>
        </div>
    </article>
    <script>
        $(document.body).css("background","url(__PUBLIC__/PeA_nut/bg/star01.jpg)");
        //设定主部分高度
        $('.text-body').css("min-height",innerHeight);
        $(window).on("resize",function(){
            $('.text-body').css("min-height",innerHeight);
        })
    </script>
</block>