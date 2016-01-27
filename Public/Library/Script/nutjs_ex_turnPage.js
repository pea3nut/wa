/*说明		--------------------------------------------------------------------------------------------------------------------------------------------------------
copy © web开发协会  A233 刘伯源@花生
nutjs库turnPage扩展 
手机页面的翻页效果实现
信息
	nutjs库版本		1.2
	trunPage版本		1.0
	更新时间			2015年7月23日
--------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*示例参考	--------------------------------------------------------------------------------------------------------------------------------------------------------
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="no-transform" http-equiv="Cache-Control" />
	<meta content="width=320, initial-scale=1,user-scalable=no" name="viewport" />
	<meta content="no-cache" http-equiv="Pragma" />
	<meta content="no-cache" http-equiv="Cache-Control" />
	<meta content="0" http-equiv="Expires" />
	<script charset="utf-8" src="../js/nut.js"></script>
	<script charset="utf-8" src="../js/nutjs_mobile_turnPage.js"></script>
	<title>测试demo</title>
</head>
<body>
<style>
div{
	position:absolute;
	top:0;
	left:0;
	height:10000px;
	width:100%;
	border:1px solid #000;
}
</style>
<div style="background:#fff;">0</div>
<div style="background:#fff;">1</div>
<div style="background:#600;">2</div>
<div style="background:#f00;">3</div>
<div style="background:#f60;">4</div>
<div style="background:#ff0;">5</div>                                                            
<div style="background:#ff6;">6</div>
</body>
</html>
<script>
var allDid=document.getElementsByTagName('div');
nutjs.turn_page.elts=allDid;
nutjs.turn_page.load_screen_bn=true;
nutjs.turn_page.start();
</script>
--------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*参考手册		--------------------------------------------------------------------------------------------------------------------------------------------------------
文件加载后会自动实例化，无需用new手动实例化
最多支持1个载入画面+1000张页面
脚本会自动检测手机的视图高度，把每一张页面的高度初始成与页面一样高，所有每一个页面上都不应该拥有padding-top与padding-bottom属性
每一张页面都应该预先设置好绝对定位，并且使用使用top属性
每一张页面的display都应该为none/block，暂不支持其他的属性
在刚开始，如果有载入画面，应该把其他的所有页面都定义为none，只有载入画面定义为block

脚本会用到的css属性，制作页面时应避免发生冲突
	position
	display
	top
	height

turn_page_class			未实例化的turnPage类，通常不会用到，如果需要声明多个turn_page对象或者扩展turn_page功能可以调用本类
turn_page				自动实例化后的turn_page对象
	load_screen_bn			是否有载入画面，载入画面会在整张页面载入完毕后隐藏
	load_screen				载入画面的elt对象
	elts					所有的页面elt对象
	speed=[20]				执行滑动的间隔时间，单位ms
	hz=[6]					每次滑动的距离，单位%
	start()					开始运行程序
	auto=[true]				自动修正开关，会把每一张页面初始成绝对定位，内边距为0，宽度为100%
	go(int)					页面跳转到制定索引，注意，需要写在windows.onload事件里面，-1表示打开载入画面
--------------------------------------------------------------------------------------------------------------------------------------------------------*/
reel_pointer_nutjs_proto.turn_page_class	=function(){//手机翻页效果
	this.load_screen_bn;//是否有载入画面
	this.load_screen;//载入画面
	this.elts;//要被翻页的元素数组
	this.speed=20;//隔多久滑动一次
	this.hz=6;//每次滑动的百分比
	this.auto=true;//自动修正开关
	//系统变量
	this.startY;//触摸事件开始时的Y坐标
	this.endY;//触摸事件结束时的Y坐标
};
reel_pointer_nutjs_proto . turn_page_class . prototype . start = function (){//开始执行函数
	var that=this;
	//初始化层数与显示效果
	var divIndex=Math.floor(999/this.elts.length);
	for(var i=0;i<this.elts.length;i++){
		this.elts[i].style.zIndex=divIndex*(this.elts.length-i);
		this.elts[i].style.display='none';
		if(this.auto){
			this.elts[i].style.padding='0';
			this.elts[i].style.position='absolute';
			this.elts[i].style.width='100%';
		}
		this.elts[i].style.top='0%';
	};
	nutjs.addEve(window,"resize",reH);
	setInterval(reH,1000)
	function reH(){
		for(var i=0;i<that.elts.length;i++){
			that.elts[i].style.height = window.innerHeight+"px";
		};
	}
	//判断载入画面
	if(this.load_screen_bn){
		if(!this.load_screen){//如果没有单独的载入画面，把数组中第一个当做载入画面
			this.load_screen=this.elts[0];
		};
		this.load_screen.style.zIndex=1000;
		this.load_screen.style.display='block';
		nutjs.addEve(window,'load',function(){
			that.load_screen.style.display='none';
			if(that.load_screen.style == that.elts[0]){
				that.elts[1].style.display='block';
			}else{
				that.elts[0].style.display='block';
			}
		});
	}else{
		this.elts[0].style.display='none';
	}
	//禁止页面滑动**如果写在这里，将会让页面点不了超链接**
	nutjs.addEve(window,'touchmove',function(ev){
		ev.preventDefault();
	});
	//添加滚动事件
	nutjs.addEve(window,'load',function(){
		nutjs.addEve(window,"touchstart",function (ev){
			that.startY=ev.touches[0].clientY;
		});
	});
	nutjs.addEve(window,'load',function(){
		nutjs.addEve(window,"touchmove",function (ev){
			that.endY=ev.touches[0].clientY;
			that.up_or_down(ev);
		});
	});
}
reel_pointer_nutjs_proto . turn_page_class . prototype . up_or_down = function (ev){//判断上滑下滑，具体实现翻页效果
	var that=this;
	var eve=ev||event;
	//找到当前显示的页
	var thisElt=0;
	for(var i=0;i<this.elts.length;i++){
		if(this.elts[i].style.display != 'none'){
			thisElt=i;
			break;
		}
	}
	//判断操作，初始化变量
	var runElt;//要操作的页
	var otherElt;//另一个页
	var noneElt;//要消失的元素
	var uod;//正向移动还是负向移动
	if(this.endY ==null || this.startY==null){
		return;
	}
	if(this.endY > this.startY){//从上往下滑动,查看前一页
		//不允许翻到空白页或者载入画面页
		if(thisElt == 0) return;
		//if(thisElt == 1 && this.load_screen_bn) return
		//初始化变量
		runElt=this.elts[thisElt-1];
		noneElt=otherElt=this.elts[thisElt];
		uod=1;
	}else if(this.endY < this.startY){//从下往上滑动，向下翻页
		//屏蔽最后一张依旧想向下翻的操作
		if(!this.elts[thisElt+1]) return;
		//初始化变量
		for(var i=1;this.elts[thisElt+i].style.display != 'none';i++){//运行并行翻页，将要操作的元素定位到最后一个显示的元素
			thisElt++;
		}
		noneElt=runElt=this.elts[thisElt];
		otherElt=this.elts[thisElt+1];
		uod=-1;
	}else{
		return;
	};
	this.endY =this.startY =null;
	//执行操作
	runElt.style.display=otherElt.style.display='block';
	var pTime=setInterval(function(){
		runElt.style.top = parseInt(runElt.style.top) + (that.hz*uod) + "%";
		if(uod == -1 && parseInt(runElt.style.top) < -100 ){
			clearInterval(pTime);
			noneElt.style.display='none';
			runElt.style.top="-100%";
		}else if(uod == 1 &&parseInt(runElt.style.top) > 0){
			clearInterval(pTime);
			noneElt.style.display='none';
			runElt.style.top="0%";
		};
	},this.speed);
};
reel_pointer_nutjs_proto . turn_page_class . prototype . go = function (index){//跳转到某张页面
	for(var i=0;i<this.elts.length;i++){
		this.elts[i].style.display='none';
	};
	if(index ==-1){
		this.load_screen.style.display='block';	
	}else{
		this.elts[index].style.display='block';	
	}
}




reel_pointer_nutjs_proto . turn_page=new reel_pointer_nutjs_proto . turn_page_class();//实例化对象