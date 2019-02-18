// Put your zillow.com API key here
var zwsid = "X1-ZWz18ytcuksemj_avwne";
var gAPIKey = "AIzaSyBrh1OegHYp5g_OgESygeY4xp0f78FBldE";

var myLatLng;
var map;
var marker;

function initialize () {
	//initMap(32.75, -97.13, "default location");
	myLatLng = {lat: 32.75, lng: -97.13};

	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 17,
		center: myLatLng
	});

	google.maps.event.addListener(map, "click", function (e) {

		//lat and lng is available in e object
		var mapLat = e.latLng.lat();
		var mapLng = e.latLng.lng();
		console.log(mapLat + " " + mapLng);
		reverseGeocoding(mapLat, mapLng);
		
	});
}

function callGoogleMap(zestimateAmount, address, city, stateNpin){
	var xhr = new XMLHttpRequest();
	xhr.open("GET","https://maps.googleapis.com/maps/api/geocode/json?address=" + address.split(" ").join("+") + ",+" + city.split(" ").join("+") + ",+" + stateNpin.split(" ").join("+") + "&key=AIzaSyBrh1OegHYp5g_OgESygeY4xp0f78FBldE");
	xhr.setRequestHeader("Accept","application/json");
	xhr.onreadystatechange = function(){
		if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);
			var lat = json.results["0"].geometry.location.lat; //Number(json.results["0"].geometry.location.lat.toFixed(2));
			var lng = json.results["0"].geometry.location.lng; //Number(json.results["0"].geometry.location.lng.toFixed(2));
			console.log(lat);
			console.log(lng);
			var postalAddressAmount = address + " " + city + " " + stateNpin + " - " + zestimateAmount;
			initMap(lat, lng, postalAddressAmount);
		}
	};
    xhr.send(null);
}

function initMap(lat, lng, title){
	myLatLng = {lat: lat, lng: lng};
	map.setCenter(myLatLng);

	if(marker != null && marker != undefined){
		marker.setMap(null);		
	}
	marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: title
	});
	marker.setMap(map);

}

function reverseGeocoding(mapLat, mapLng){
	var xhr = new XMLHttpRequest();
	xhr.open("GET","https://maps.googleapis.com/maps/api/geocode/json?latlng=" + mapLat + "," + mapLng + "&key=AIzaSyBrh1OegHYp5g_OgESygeY4xp0f78FBldE");
	xhr.setRequestHeader("Accept","application/json");
	xhr.onreadystatechange = function(){
		if (this.readyState == 4) {
            var revJson = JSON.parse(this.responseText);
			var formatted_address = revJson.results["0"].formatted_address;
			var mapAddress = formatted_address.split(",")[0].trim();
			var mapCity = formatted_address.split(",")[1].trim();
			var stateAndPin = formatted_address.split(",")[2].trim();
			
			var mapPostalAddress = mapAddress + ", " + mapCity + ", " + stateAndPin;
			var request = new XMLHttpRequest();
			request.onreadystatechange =  function(){
				if (request.readyState == 4) {
					displayResult(mapPostalAddress, mapAddress, mapCity, stateAndPin, request);
				}
			};
			request.open("GET","proxy.php?zws-id="+zwsid+"&address="+encodeURI(mapAddress)+"&citystatezip="+ encodeURI(mapCity+ "+" + stateAndPin));
			request.withCredentials = "true";
			request.send(null);
			//request.abort();
		}
	};
    xhr.send(null);
	//xhr.abort();
	
}


function displayResult (postalAddress, address, city, stateNpin, request) {
        var xml = request.responseXML.documentElement;
		if(xml.getElementsByTagName("message")[0].getElementsByTagName("code")[0].innerHTML == "0" && xml.getElementsByTagName("zestimate")[0].getElementsByTagName("amount")[0].innerHTML != ""){			
			var value = xml.getElementsByTagName("zestimate")[0].getElementsByTagName("amount")[0].innerHTML;
			var currency = xml.getElementsByTagName("zestimate")[0].getElementsByTagName("amount")[0].attributes["0"].nodeValue;
			var zestimateAmount = "Zestimate Amount = " + value + currency;
			document.getElementById("output").innerHTML += zestimateAmount + " - " + postalAddress + "<br />";
			callGoogleMap(zestimateAmount, address, city, stateNpin);
		}else{
			alert("Not a valid property");
		}
    //}
}

function sendRequest () {
	var request = new XMLHttpRequest();
    var address = document.getElementById("address").value;
    var city = document.getElementById("city").value;
    var state = document.getElementById("state").value;
    var zipcode = document.getElementById("zipcode").value;
	var stateNpin = state + " " + zipcode;
	var postalAddress = address + ", " + city + ", " + state + " " + zipcode;
    request.onreadystatechange = function(){
		if (request.readyState == 4) {
			displayResult(postalAddress, address, city, stateNpin, request);
		}
	};
    request.open("GET","proxy.php?zws-id="+zwsid+"&address="+encodeURI(address)+"&citystatezip="+ encodeURI(city+"+"+state+"+"+zipcode));
    request.withCredentials = "true";
    request.send(null);
	//request.abort();
}
