var lit;
var model_info = [];
var _distance;
var _duration;
var _from;
var _to;
var _fuelConsumed;
var markers = [];
var total = 0;
var _price = 38.10;
let input;
let inputTwo;
var totalThree;
var map;
var mapTwo;
var myOptions;
var myTwoOptions;
var abeokuta;
var listener1;
var listener2;
function initMap() {
  function initTheMapOptions(conditions) {
    input = document.getElementById('start');
    inputTwo = document.getElementById('end');

    new google.maps.places.Autocomplete(input);
    new google.maps.places.Autocomplete(inputTwo);
    
   
    // create the maps
    
}
  
  google.maps.event.addDomListener(window, 'load', initTheMapOptions);
  var service = new google.maps.DistanceMatrixService();
  var directionsService = new google.maps.DirectionsService();
  
  abeokuta = { lat: 52.90777390171538, lng: 18.67429568938101 };
 
  myOptions = {
    zoom: 6,
    center: abeokuta
  }


map = new google.maps.Map(document.getElementById("map"), myOptions);
mapTwo = new google.maps.Map(document.getElementById("map2"), myOptions);

map.addListener('mouseover', function() {
  google.maps.event.removeListener(listener2);
  listener1 = google.maps.event.addListener(map, 'bounds_changed', (function() {
    mapTwo.setCenter(map.getCenter());
    mapTwo.setZoom(map.getZoom());
  }));
});

mapTwo.addListener('mouseover', function() {
  google.maps.event.removeListener(listener1);
  listener2 = google.maps.event.addListener(mapTwo, 'bounds_changed', (function() {
    map.setCenter(mapTwo.getCenter());
    map.setZoom(mapTwo.getZoom());
  }));
});


  // Create a map and center it on Mauritius.
 
 
  
  // Create a renderer for directions and bind it to the map.
  var directionsDisplay = new google.maps.DirectionsRenderer({
    draggable: false,
    map: map
  });
  var directionsDisplayTwo = new google.maps.DirectionsRenderer({
    draggable: false,
    map: mapTwo
  });
 
  // Listen direction change
  directionsDisplay.addListener('directions_changed', function () {
  
    computeTotalDistance(directionsDisplay.getDirections());
  });
  directionsDisplayTwo.addListener('directions_changed', function () {
  
    computeTotalDistance(directionsDisplayTwo.getDirections());
  });


  // Instantiate an info window to hold step text.
  var stepDisplay = new google.maps.InfoWindow;

  // Display the route between the initial start and end selections.
  calculateAndDisplayRoute( directionsDisplay, directionsService, markers, stepDisplay, map );
  calculateAndDisplayRouteTwo( directionsDisplayTwo, directionsService, markers, stepDisplay, mapTwo );
  
  var onChangeHandler = function () {
    calculateAndDisplayRoute(directionsDisplay, directionsService, markers, stepDisplay, map);
    calculateAndDisplayRouteTwo(directionsDisplayTwo, directionsService, markers, stepDisplay, mapTwo);
  };
 
  document.getElementById('calc_km').addEventListener('click', onChangeHandler);

  function calculate() {
    
  }

  function computeTotalDistance(result) {

    var myroute = result.routes[0];
    var duration, start, end;
    for (var i = 0; i < myroute.legs.length; i++) {
      total += myroute.legs[i].distance.value;
      duration = myroute.legs[i].duration.value;  
      start = myroute.legs[i].start_address;
      end = myroute.legs[i].end_address;
      
      document.getElementById("start").value = start;
      document.getElementById("end").value = end; 
    }
    total = total / 1000;
    _distance = total;
 
    totalThree = Math.round(total * 100) / 100;
    
    if(totalThree <= 300){
      alert('Zbyt krótka trasa! Trasa nie może być krótsza niż 300km!');
    }else{
      document.getElementById('total').value =  Math.round(total * 100) / 100;
      document.getElementById('totalTwo').value =  Math.round(total * 100) / 100;
    }
  }
  document.getElementById('calc_km').addEventListener('click', function(){
    if(totalThree <= 300){
      alert('Zbyt krótka trasa! Trasa nie może być krótsza niż 300km!');
    }else{
      document.getElementById('total').value =  Math.round(total * 100) / 100;
      document.getElementById('totalTwo').value =  Math.round(total * 100) / 100;
    }
    
  })

  function calculateAndDisplayRoute(directionsDisplay, directionsService,
    markers, stepDisplay, map) {
     
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }

    directionsService.route({
      origin: document.getElementById('start').value,
      destination: document.getElementById('end').value,
      travelMode: 'DRIVING'
    }, function (response, status) {
      
      if (status === 'OK') {
        document.getElementById('warnings-panel').innerHTML =
          '<b>' + response.routes[0].warnings + '</b>';
        directionsDisplay.setDirections(response);
        
      }
    });
  }
  function calculateAndDisplayRouteTwo(directionsDisplayTwo, directionsService,
    markers, stepDisplay, mapTwo) {
     
    for (var j = 0; j < markers.length; j++) {
      markers[j].setMap(null);
    }

    directionsService.route({
      origin: document.getElementById('start').value,
      destination: document.getElementById('end').value,
      travelMode: 'DRIVING'
    }, function (response, status) {
      if (status === 'OK') {
        document.getElementById('warnings-panel').innerHTML =
          '<b>' + response.routes[0].warnings + '</b>';
        directionsDisplayTwo.setDirections(response);

      }
    });
  }

  function showSteps(directionResult, markers, stepDisplay, map) {
    
    var myRoute = directionResult.routes[0].legs[0];
    for (var i = 0; i < myRoute.steps.length; i++) {
      var marker = markers[i] = markers[i] || new google.maps.Marker;
      marker.setMap(map);
      marker.setPosition(myRoute.steps[i].start_location);
      attachInstructionText(
        stepDisplay, marker, myRoute.steps[i].instructions, map);
    }
  
  }
  function showStepsTwo(directionResult, markers, stepDisplay, mapTwo) {
    
    var myRoute = directionResult.routes[0].legs[0];
    for (var j = 0; j < myRoute.steps.length; j++) {
      var marker = markers[j] = markers[j] || new google.maps.Marker;
      marker.setMap(mapTwo);
      marker.setPosition(myRoute.steps[j].start_location);
      attachInstructionTextTwo(
        stepDisplay, marker, myRoute.steps[j].instructions, mapTwo);
    }
  
  }
  function attachInstructionText(stepDisplay, marker, text, map) {
    google.maps.event.addListener(marker, 'click', function () {

      stepDisplay.setContent(text);
      stepDisplay.open(map, marker);
    });
  }
  function attachInstructionTextTwo(stepDisplay, marker, text, mapTwo) {
    google.maps.event.addListener(marker, 'click', function () {

      stepDisplay.setContent(text);
      stepDisplay.open(mapTwo, marker);
    });
  }

  
}