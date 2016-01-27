/*说明

copy © web开发协会  A233 刘伯源@花生
	nutjs库ajax解析器 
	信息
		nutjs库版本		1.2
		解析器版本			1.0
		更新时间			2015年8月15日
Ajax解析器json格式
	url				要提交的URL
	mode			要提交的模式，get/post
	submit_btn		发送数据的按钮
	submit_date		要发送的字段
	callback		回调函数，当服务器返回值时，会将第一个参数作为返回值调用此函数
属性说明：
	par_type		支持解析的input type，如非特殊需要，请勿修改
	submit_date		要发送的数据，会自动生成，如非特殊需要，请勿修改
	ajax_json		配置信息json，在使用时应将其初始化
	start()			配置好时，请调用此函数来完成初始化，程序开始运行
注意:
	在使用本扩展时请预先加载nutjs基础库与ajax扩展
	在json中需要传入元素时，直接使用 key=value 的方式定位元素即可，比如"name=code"、"class=su_bon"
*/

reel_pointer_nutjs_proto . parser_ajax_class=function(ajax_json){
	this.par_type=['text','password','radio','checkbox','select'];//可以解析的input type
	this.autoSub=true;//敲击回车直接提交
	this.submit_date=[];//发送的数据
	this.ajax_json=ajax_json;//json配置
	this.bn_value="立即提交";
};
reel_pointer_nutjs_proto . parser_ajax_class .prototype . start =function(){
	var temp_arr_btn= this.getElt_ajax( this.ajax_json. submit_btn);
	var that=this;
	__nutjs__.addEve(temp_arr_btn, 'click',function(){
		that.update();//更新字段值
		__nutjs__.ajax.sendMsg= that.submit_date.join("&");//更新字段数据
		__nutjs__.ajax.send();//发送数据
		this.disabled="disabled";
		that.bn_value=this.value;
		this.value="提交中...";
	});	
	__nutjs__.ajax.mode	=	this.ajax_json.mode;
	__nutjs__.ajax.url	=	this.ajax_json.url;
	__nutjs__.ajax.fn	=	function(reMsg){
		temp_arr_btn.disabled=false;
		temp_arr_btn.value=that.bn_value;
		that.ajax_json.callback(reMsg);
	};
	//给回车添加事件
	if(this.autoSub){
		nutjs.addEve(window,'keypress',function(e){
			var ev=e||event;
			if(ev.keyCode == 13){
				temp_arr_btn.click();
			};
		});
	};
}
reel_pointer_nutjs_proto . parser_ajax_class .prototype . update =function(){
	this.submit_date=[];//清空上一次数据
	var temp_obj_date=this.ajax_json.submit_date;
	var temp_arr_elt=null;
	var temp_elt_dateElt=null;
	for(var par_i=0; par_i<this.par_type.length; par_i++){//定位input的type值
		temp_arr_elt= this.ajax_json ["submit_date"] [this.par_type[par_i]]
		if(temp_arr_elt === undefined) continue;
		//要兼容字符串和字符串数组
		if(typeof temp_arr_elt === 'string'){
			temp_elt_dateElt= this.getElt_ajax(temp_arr_elt);
			this.submit_date.push( eval( "this."+this.par_type[par_i]+"(temp_elt_dateElt)" ));
		}else if(typeof temp_arr_elt === 'array' ||typeof temp_arr_elt === 'object'){
			for(var arr_elt_i=0; arr_elt_i < temp_arr_elt.length;arr_elt_i++){//定位每个元素
				temp_elt_dateElt= this.getElt_ajax( temp_arr_elt [arr_elt_i]);
				this.submit_date.push( eval( "this."+this.par_type[par_i]+"(temp_elt_dateElt)" ));
			};
		}else{
			alert("submit_date Error:\n"+
				this.par_type[par_i]+" is "+typeof temp_arr_elt
			);
		};
	};
}
reel_pointer_nutjs_proto . parser_ajax_class .prototype . text=function(elt){
	return elt.name+"="+elt.value;
}
reel_pointer_nutjs_proto . parser_ajax_class .prototype . password=function(elt){
	return elt.name+"="+elt.value;
}
reel_pointer_nutjs_proto . parser_ajax_class .prototype . radio=function(elt){
	var all_radio=document.getElementsByName(elt.name);
	for(var i=0;i<all_radio.length;i++){
		if(all_radio[i].checked) return all_radio[i].name+"="+all_radio[i].value;
	};
	return '';
}
reel_pointer_nutjs_proto . parser_ajax_class .prototype . checkbox=function(elt){
	if(elt.checked){
		return elt.name+'='+elt.value;
	}
	return '';
}
reel_pointer_nutjs_proto . parser_ajax_class .prototype . select=function(elt){
	return elt.name+"="+elt.value;
}
/* 工具类的函数 */
reel_pointer_nutjs_proto . parser_ajax_class .prototype . getElt_ajax=function(str){//可以通过 key=value 这样的字符串来获取元素节点
	var temp_arr_btn= str.split('=');
	return __nutjs__.getE(temp_arr_btn[0],temp_arr_btn[1]);
}




reel_pointer_nutjs_proto . parser_ajax= new reel_pointer_nutjs_proto . parser_ajax_class();