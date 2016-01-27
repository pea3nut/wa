/*说明--------------------------------------------------------------------------------------------------------------------------------------------------------
copy © Web开发协会  A233 刘伯源@花生
nutjs 类库 V1.3
更新时间：2015年7月22日18:27:03
--------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*更新日志		--------------------------------------------------------------------------------------------------------------------------------------------------------
1.2
	改变原始nutjs对象的赋值方式
	增加变量reel_pointer_nutjs_proto，始终指向原始nutjs对象
	增加变量__nutjs__，始终指向实例化后的nutjs对象
	允许扩展nutjs类库
1.3
	更新的新功能，
--------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*参考手册		--------------------------------------------------------------------------------------------------------------------------------------------------------
display			(btn,elt,[dis]=block,[eve]=click,val)	将某个元素的显示与隐藏绑定在某个元素的事件上
				可以实现在元素消失是，通过某一事件触发(比如click)显示，在元素display不为none时，触发事件隐藏(none)
				btn触发事件的对象，elt要隐藏消失的对象,eve触发的事件类型,val当display变换是改变elt的value与innerHTML

reel_pointer_nutjs_proto
				始终指向原始nutjs对象

getE			(key,value,[bn],[win]=window)		通过某个属性获取元素节点
				返回win对象内key=value的一个bom节点，如果bn为true，则返回一个数组，里面装载着所有符合条件的元素

getByTag		(tagName,[win]=window)				通过标签名获取元素节点
				返回win对象内所有标签为tagName的bom节点

getByCss		(cssName,[bn],[win]=window)			通过css类获取元素节点
				返回win对象内所有标签为tagName的bom节点，如果bn为true，则返回一个数组，里面装载着所有符合条件的元素

addEve			(elements,eventType,fn)				给元素添加事件
				给elements绑定事件句柄为eventType的函数fn，采用递归，支持elements为元素数组。
				注意，此函数是追加绑定，并不是替换绑定

delEve			(elements,eventType,fn)				给元素移除事件
				给elements解除事件句柄为eventType的函数fn，采用递归，支持elements为元素数组。

addKey			(elements,Key,Value,[add])			给元素添加属性和值
				改变elements的属性Key的值为Value，若add=true，会追加值而不是改变值(适用于绑定多个css类)，采用递归，支持elements为元素数组。

setHtml			(elements,[html])					设置或获取innerHTML
				以数组的形式返回elements里面的所有inerHTML值，若html不为空，则产生赋值操作，不返回任何值

getUrlObj		([url]=document.URL)				模拟php获取get对象
				解析链接，返回$_GET对象，模拟PHP

showAndHender	(elements,[display]=block)			显示与隐藏元素
				若elements的display属性不为参数里的display，则将elements的style.display设置为none

time			获取当前时刻的时间戳

arrPlus			(array1,array2....)					数组相加
				将参数里面的所有数组相加，也可以将getElementsBy[xx]返回的节点列表转换为纯数组

print_r			(array,[onlyString],[echo]){		alert出 对象/数组的全部元素
				类似于php中的print_r，如果onlyString为true，仅会输出value为string的属性，如果echo为true，则会返回值，而不会alert

ftrHTML			(str)								将str内的html转义元素替换成文本，去掉所有标签

--------------------------------------------------------------------------------------------------------------------------------------------------------*/
function nutjs(){

};
var NUTJS_CLA=nutjs;
var NUTJS_PRO=NUTJS_CLA.prototype;
var reel_pointer_nutjs_proto=nutjs.prototype;
nutjs.prototype.put_nut_js	=function(name){//释放对nutjs的控制
	var js=name+"=nutjs";
	eval(js);
	nutjs=null;
};
nutjs.prototype.getE		=function(key,value,bn,win){/*通过某个属性获取元素节点*/
	var win=win||window.document;
	var aAES=win.getElementsByTagName("*");
	if(bn){
		var arr=[];
		for (var i=0;i<aAES.length;i++){
			if (aAES[i].getAttribute(key)==value){
				arr.push(aAES[i]);
			};
		};
		if(arr.length==0){
			return null;
		}
		return arr;
	}else{
		for (var i=0;i<aAES.length;i++){
			if (aAES[i].getAttribute(key)==value){
				return aAES[i];
			};
		};
	};
};
nutjs.prototype.getByTag	=function(tagName,win){/*通过标签名获取元素节点*/
	var win=win||window.document;
	var aAES=win.getElementsByTagName(tagName);
	return aAES;
};
nutjs.prototype.getByCss	=function(cssName,bn,win){/*通过css类获取元素节点，bn表示是否获取多个*/
	var win=win||window.document;
	var aAES=win.getElementsByTagName("*");
	var cssReg=new RegExp(cssName);
	if (bn){
		var array=[];
		for (var i=0;i<aAES.length;i++){
			if (cssReg.test(aAES[i].className)){
				array.push(aAES[i]);
			};
		};
		if(array.length==0){
			return null;
		}
		return array;
	}else{
		for (var i=0;i<aAES.length;i++){
			if (cssReg.test(aAES[i].className)){
				return aAES[i];
			};
		};
	};
	return null;
};
nutjs.prototype.addEve		=function(elements,eventType,fn){/*给元素添加事件，采用递归,支持元素数组*/
	if(elements){
		if(elements.length==undefined||elements.document){
			if (elements.addEventListener){//火狐
				elements.addEventListener(eventType,fn,false);
			}else if (window.attachEvent){//IE
				elements.attachEvent("on"+eventType,fn);
			}else{//最传统的替换事件
				try{
					elements['on'+eventType]=fn;
				}catch(e){
					return e;
				}
			};
		}else if(elements.length>=1){//兼容多维数组
			for(var i=0;i<elements.length;i++){
				this.addEve(elements[i],eventType,fn);
			};
		}else{//错误
			alert(this+"\t$_addEve error!\n"+elements+elements.length);
		};
	}else{
		return null;
	};
};
nutjs.prototype.addKey		=function(elements,Key,Value,add){/*给元素添加属性和值，采用递归,支持元素数组*/
	if(elements){
		if(elements.length==undefined){
			if(add){
				elements.setAttribute(Key,
				function(){
					if(elements.getAttribute(Key)){
						return elements.getAttribute(Key);
					}else{
						return "";
					};
				}()
				+Value);
			}else{
				elements.setAttribute(Key,Value);
			};
		}else if(elements.length>=1){//兼容多维数组
			for(var i=0;i<elements.length;i++){
				this.addKey(elements[i],Key,Value,add);
			};
		}else{//错误
			alert(this+"\t$_addEve error!\n"+elements+elements.length);
		};
	}else{
		return null;
	};
};
nutjs.prototype.setHtml		=function(elements,html){/*设置或获取innerHTML*/
	if(elements){
		if(elements.length==undefined){
			if(html){
				elements.innerHTML=html;
			}else{
				return elements.innerHTML;
			};
		}else if(elements.length>=1){//兼容多维数组
			if(html){
				for(var i=0;i<elements.length;i++){
					elements[i].innerHTML=html;
				};
			}else{
				var arr_html=[];
				for(var i=0;i<elements.length;i++){
					arr_html.push(elements[i].innerHTML);
				};
				return arr_html;
			};
		}else{//错误
			alert(this+"\t$_setInnerHTML error!\n"+elements+elements.length);
		};
	}else{
		return null;
	};
}
nutjs.prototype.getUrlObj	=function(url){/*模拟php获取get对象，为空获取当前URL*/
	var str=url||decodeURI(document.URL);
	var reg_get_str=/\?.+/;
	if(reg_get_str.test(str)){
		var obj={};
		var temp=str
			.match(reg_get_str)[0]
			.replace("?","")
			.split("&")
			;
		for(var i=0;i<temp.length;i++){
			var key=temp[i].match(/^[^=]+/)[0];
			var value=temp[i].replace(key+"=","");
			obj[key]=value;
		};
		return obj;
	};
	return null;
};
nutjs.prototype.showAndHender=function(elements,display){/*显示与隐藏元素*/
	if(elements){
		if(elements.length==undefined){
			var style=elements.style;
			display=display||"block";
			if(!style.display){
				style=getComputedStyle(elements,null);
			};
			if(style.display!="none"){
				elements.style.display="none";
			}else{
				elements.style.display=display;
			};
		}else if(elements.length>=1){//兼容多维数组
			for(var i=0;i<elements.length;i++){
				this.showAndHender(elements[i]);
			};
		}else{//错误
			alert(this+"\t$_show_and_hender error!\n"+elements+elements.length);
		};
	}else{
		return null;
	};
};
nutjs.prototype.time		=function(){//获取当前时刻的时间戳
	var date=new Date();
	var time=date.getTime();
	return time;
};
nutjs.prototype.arrPlus		=function(){//数组的相加，为了兼容形如getElementsByTagName获得的伪数组
	var myArray=[];
	for(var i=0;i<arguments.length;i++){
		if(typeof arguments[i] === "string"){
			myArray.push(arguments[i]);
		}else{
			for(var v=0;v<arguments[i].length;v++){
				myArray.push(arguments[i][v]);
			};
		};
	};
	return myArray;
}
nutjs.prototype.print_r		=function(array,onlyString,echo){/*输出对象/数组的全部元素模拟php中的print_r*/
	var str="";
	for (var key in array){
		if(onlyString&&typeof array[key]!="string"&&typeof array[key]!="number"){
			continue;
		};
		str+=key+"\t->\t"+array[key]+"\n";
	};
	if(echo){
		return str;
	};
	alert(str);
};
nutjs.prototype.ftrHtml		=function(str){//获取html元素
	if(str){
		var res=str;
		res=str.replace(/\<[\w\\\/ ]+\>/g,"");
		res=res.replace(/&amp;/g,"&");
		res=res.replace(/&copy;/g,"©");
		return res;
	}else{
		return null;
	};
};
nutjs.prototype.display		=function(btn,elt,dis,eve,val){
	var d=dis||'block';
	var e=eve||'click';
	var oldV=btn.value ||btn.innerHTML;
	__nutjs__.addEve(btn,e,function(){
		var styl=getComputedStyle(elt,null);
		if(styl.display == 'none'){
			elt.style.display=d;
			if(val) btn.value=btn.innerHTML=val;
		}else{
			elt.style.display='none';
			if(val) btn.value=btn.innerHTML=oldV;
		};
	});
};



//激活
var nutjs=__nutjs__=new nutjs();
var NUTJS_OBJ=__nutjs__;