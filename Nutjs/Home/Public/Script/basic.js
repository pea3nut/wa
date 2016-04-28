$(function(){
    $("*[role='verifycode']").on("click",function(){
        this.src +="?"+Math.random();
    });
});