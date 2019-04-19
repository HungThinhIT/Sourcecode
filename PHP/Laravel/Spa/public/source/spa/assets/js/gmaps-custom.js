"use strict;";
/*----------------------------------------------------
 google map
 ----------------------------------------------------*/
var map;
map = new GMaps({
	el: '#googleMap',
	lat: 15.9729989,
	lng: 108.2500629,
	scrollwheel: false
});
map.addMarker({
	lat: 15.9729989,
	lng: 108.2500629,
	title: '2T Spa',
	infoWindow: {
		content: '<p>2T Spa - Da Nang</p>'
	}
});