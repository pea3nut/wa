(function(){
    window.NUT={};
    // 定义根路径，项目部署时需要更改
    NUT.URL_ROOT="http://127.0.0.1/ThinkPHP/web_association";
    // 定义时间常量
    var D =new Date();
    NUT.SHOT_DATE =
        D.getFullYear()+"-"
        +((D.getMonth()>=10)?(+D.getMonth()+1):("0"+(+D.getMonth()+1)))
        +"-"
        +D.getDate()
    ;
    NUT.LONG_DATE =NUT.SHOT_DATE
        +" "
        +((D.getHours()>=10)?(+D.getHours()+1):("0"+(+D.getHours()+1)))
        +":"
        +((D.getMinutes()>=10)?(+D.getMinutes()+1):("0"+D.getMinutes()))
        +":"
        +((D.getSeconds()>=10)?(+D.getSeconds()+1):("0"+D.getSeconds()))
    ;
})()
