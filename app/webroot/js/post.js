flag =false;
var index;
function allChange(){
	flag = !flag; // trueとfalseの切り替え ! 否定演算子
	var elem = document.getElementsByName("select[]");
	for(index = 0; index < elem.length; index++){
		elem[index].checked = flag;
	}
}

