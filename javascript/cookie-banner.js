// JavaScript Document
// wir schauen ob im LocalStorage ein Wert gespeichert ist
document.addEventListener("DOMContentLoaded", function(event) { 
  	//do work
	var cookieBannerAkzeptiert = localStorage.getItem('banner-geklickt');
	// nein cookie banner zeigen
	var cookieBanner = document.querySelector(".cookie-banner");
	// steht das was drin?
	if( ! cookieBannerAkzeptiert){
		// wir fügen dem cookie banner eine neue class
		cookieBanner.classList.add("sichtbar_cookie-banner");
	}
	
	// Button programmieren
	function akzeptieren() {
		// Cookie Banner verstecken
		cookieBanner.classList.remove("sichtbar_cookie-banner");
		// wir merken uns, dass der banner geklickt wurde
		localStorage.setItem('banner-geklickt','ja');
	}
	// Diese Funktion ausführen bei Klick auf Button
	var okButton = document.querySelector("#akzeptieren-button");
	okButton.addEventListener('click',akzeptieren); // event, funktionsname ohne klammer
});

		