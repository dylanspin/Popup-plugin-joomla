

	/*
		moet voor cookies kijken als cookie popUp is set dont run function
		moet de cookie kunnen zetten na dat er op een knop is gedrukt(closebutton).
		moet een tijd op zitten voor de pop up om te voor schijn te komen.
		moet de tijd in de backend kunnen pakken idk how yet.
		
	*/

	if(window.showAds){
		console.log("Geen adblocker");
	}
	else{
		console.log("Adblocker used");
	}

	function closePop()
	{
		document.getElementById('popUpId').style.display = "none";
		document.cookie = "popUp=true;";
	}