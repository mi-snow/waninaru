//2重投稿防止
sent = false;
function send_check(){  
	if(sent){  
		alert("二重投稿はしないでください");
		return false;
	}else{  
		sent = true;
		return true; 
	}
}  