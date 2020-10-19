/** getting the latitude and longitude from php script */

var data = JSON.parse(my_data);
var keys = Object.keys(data);
var values = Object.values(data);
var distance = JSON.parse(my_distance);
var new_name = JSON.parse(name);
var new_location = JSON.parse(my_location);
var my_place = 'Karigar Web Solutions Kashmir Road';

/** function fom showing google map with given markers */
function initMap() {
    var get = {lat: 30.3753, lng: 69.3451};
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 5, center: get});
    var infowindow = new google.maps.InfoWindow();

    /** getting all the markers in the given city */
    for (let k = 0; k < keys.length; k++) {
        var latlng = new google.maps.LatLng(parseFloat(keys[k]), parseFloat(values[k]));
        var markerAdd = new google.maps.Marker({position: latlng, map: map});

        /** add event listener */
        google.maps.event.addListener(markerAdd, "click", function () {

            infowindow.setContent(
                "<div><strong style='color: green'>" +
                new_name[k] +
                "</strong><br>" +
                "<span style='color: red'>" + new_location[k] + "</span><br>" +
                "<a href='https://www.google.com/maps/dir/" + my_place + "/ " + new_location[k] + " '                       style='color: blue' target=\"_blank\"> goto direction </a>" +
                "</div>"
            );

            infowindow.open(map, this);
        });
    }

    /** showing dynamic circle */
    const citymap = {

        sialkot: {
            center: {lat: 32.497223, lng: 74.53611},
            population: 2714856,
        },
    };

    /** showing city circle with given radius */
    for (const city in citymap) {

        const cityCircle = new google.maps.Circle({

            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
            map,
            center: citymap[city].center,
            radius: Math.sqrt(citymap[city].population) * distance,
        });
    }
}