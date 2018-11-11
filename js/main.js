function toggleNav(){
	var open_state = document.getElementById("main-side").style.marginLeft;
	if (open_state == null || open_state === "0px")   {
		console.log("close");
		console.log(open_state);
		document.getElementById("main-side").style.marginLeft = "-210px";
		document.getElementById("content-container").style.marginLeft = "40px"; 
	} else  {
		console.log("open");
		console.log(open_state);
		document.getElementById("main-side").style.marginLeft = "0px";
		document.getElementById("content-container").style.marginLeft = "250px";                    
	}
}