nutjs.addEve(window,'load',function(){
    var showData=document.getElementById("showData");
    var takeDate=document.getElementById("takeDate");
    var getElt=document.getElementById("get");
    var postElt=document.getElementById("post");
    var sendMsgElt=document.getElementById("sendMsg");
    var url=document.getElementById("url");
    var send=document.getElementById("send");
    var link=document.getElementById("link");
    var clear=document.getElementById("clear");
    nutjs.ajax.fn=function(reMsg){
        var time=new Date();
        showData.innerHTML=reMsg;
        takeDate.innerHTML=time.toLocaleString();
    };
    nutjs.addEve(clear,'click',function(){
        showData.innerHTML="";
    });
    nutjs.addEve(send,'click',function(){
        if(getElt.checked){
            nutjs.ajax.mode='get';
        }else if(postElt.checked){
            nutjs.ajax.mode='post';
        }
//        if(link.checked){
            // nutjs.ajax.url="php/link.php";
            // nutjs.ajax.mode='post';
            // nutjs.ajax.sendMsg=JSON.stringify({
                // "mode":nutjs.ajax.mode,
                // "value":sendMsgElt.value,
                // "url":url.value
            // });
        // }else{
            nutjs.ajax.url=url.value;
            if(nutjs.ajax.mode == 'post'){
                nutjs.ajax.sendMsg=sendMsgElt.value;
            }else if(nutjs.ajax.mode == 'get'){
                nutjs.ajax.url +='?'+sendMsgElt.value;
            }
        //}
        nutjs.ajax.send();
    });
});