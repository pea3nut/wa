function over1_left(){
	if(isNaN(over1_right())){
		var s =5
	}else{
		var s =over1_right();
	}
	if(s ==1){
		s =5;
	}
	--s;
	var over_1 =document.getElementById("over_1");
	var over_2 =document.getElementById("over_2");
	var over_3 =document.getElementById("over_3");
	var over_4 =document.getElementById("over_4");
	switch(s){
	case 1:
		over_1.style.display ="block";
		over_2.style.display ="none";
		over_3.style.display ="none";
		over_4.style.display ="none";
		break;
	case 2:
		over_1.style.display ="none";
		over_2.style.display ="block";
		over_3.style.display ="none";
		over_4.style.display ="none";
		break;
	case 3:
		over_1.style.display ="none";
		over_2.style.display ="none";
		over_3.style.display ="block";
		over_4.style.display ="none";
		break;
	case 4:
		over_1.style.display ="none";
		over_2.style.display ="none";
		over_3.style.display ="none";
		over_4.style.display ="block";
		break;
	}
	return s;
}

function over1_right(){
	if(isNaN(over1_left())){
		var m =1
	}else{
		var m =over1_left();
	}

	if(m ==4){
		m =0;
	}
	++m;
	var over_1 =document.getElementById("over_1");
	var over_2 =document.getElementById("over_2");
	var over_3 =document.getElementById("over_3");
	var over_4 =document.getElementById("over_4");
	switch(m){
	case 1:
		over_1.style.display ="block";
		over_2.style.display ="none";
		over_3.style.display ="none";
		over_4.style.display ="none";
		break;
	case 2:
		over_1.style.display ="none";
		over_2.style.display ="block";
		over_3.style.display ="none";
		over_4.style.display ="none";
		break;
	case 3:
		over_1.style.display ="none";
		over_2.style.display ="none";
		over_3.style.display ="block";
		over_4.style.display ="none";
		break;
	case 4:
		over_1.style.display ="none";
		over_2.style.display ="none";
		over_3.style.display ="none";
		over_4.style.display ="block";
		break;
	}
	return m;
}
