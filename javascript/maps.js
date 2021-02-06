function myMap() 
{
	var mapOptions = 
	{
	    center: new google.maps.LatLng(45.655583, 25.596280),
	    zoom: 17,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var myCenter = new google.maps.LatLng(45.655883, 25.595077);
	var map = new google.maps.Map(document.getElementById("map"), mapOptions);

	var marker = new google.maps.Marker({position: myCenter});
	marker.setMap(map);
}



