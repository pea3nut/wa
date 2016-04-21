<extend name="./Nutjs/Home/Public/Include/basic.tpl" />
<block name="head">
    <load href="__STYLE__/_doc.css" />
</block>
<block name="body">
    <script>
        $(document.body).css("background","url(__PUBLIC__/PeA_nut/bg/star01.jpg)");
    </script>
    <article class="container text-body">
        {$_data.body}
    </article>
    <load href="__PUBLIC__/Library/PeA-index/script/PeA-index.js" />
    <load href="__PUBLIC__/Library/PeA-target/script/PeA-target.js" />
    <script>
        var pea =new jQuery.PeAIndex(2);
        pea.addPrefix=true;
        pea.prefix =pea.prefixTpl.zhTier;
        pea.indexElt=[$("h2"),$("h3")];
        pea.index();
        $("p:contains(TOC):last").html(pea.indexHtml).addClass('toc');
        
        $.PeATarget.deviation=80;
    </script>
</block>3.yij 