
	window.onload = function checkAddblock(){
		if(!window.showAds){
			document.getElementById('addblockId').style.display = "block";
		}
	}

	function closeAdblock()
	{
		document.getElementById('addblockId').style.display = "none";
		document.cookie = "popUp=true;";
	}