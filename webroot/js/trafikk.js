/*jslint devel: true, browser: true, maxerr: 50, indent: 4 */
var Trafikk = (function () {
    'use strict';
    ///////////////////
    // private vars
    ///////////////////
    var map,
        id = 'map_canvas',
        myOptions = {
            zoom: 4,
            center: new google.maps.LatLng(65.5, 17.5),
            mapTypeId: google.maps.MapTypeId.ROADMAP || "roadmap"
        },
        user = {
            position: false,
            LatLng : false
        },
        markers = [],
        /////////////////
        // functions
        /////////////////
        //
        // store the users location and trigger an update
        setUserLocation = function setUserLocation(Geoposition) {
            var coords = Geoposition.coords;
            user.position = Geoposition;
            user.LatLng = new google.maps.LatLng(coords.latitude, coords.longitude);
            $('body').trigger('onGeoposition');
            return this;
        },
        createMarker = function createMarker(lat, lon, title, message) {
            // add marker
            var i,
                newLatLng = new google.maps.LatLng(lat, lon),
                marker = new google.maps.Marker({
                    position: newLatLng,
                    map: map,
                    title : title
                }),
                // add infowindow to marker
                infowindow = new google.maps.InfoWindow({
                    content: '<h3>' + title + '</h3>' + message,
                    size: new google.maps.Size(200, 100)
                });
            google.maps.event.addListener(marker, 'click', function () {
                for (i = 0; i < markers.length; i += 1) {
                    markers[i].infowindow.close();
                }
                infowindow.open(map, marker);
            });
            // return the marker and infowindow 
            return {
                marker: marker,
                infowindow : infowindow
            };
        },
        getMessages = function getMessages() {
            var url = 'messages/nearby/' + user.LatLng.Pa + '/' + user.LatLng.Qa;
            $.getJSON(url, function (data) {
                var i = 0;
                for (i = 0; i < data.length; i += 1) {
                    markers.push(createMarker(
                        data[i].Message.latitude,
                        data[i].Message.longitude,
                        data[i].Message.heading,
                        data[i].Message.ingress
                    ));
                }
            });
        },
        getLocation = function getLocation() {
            if (!user.position && navigator && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function success(Geopos) {
                        setUserLocation(Geopos);
                        getMessages();
                        return this;
                    },
                    function error() {
                        alert("#FAIL");
                    }
                );
            } else {
                if (!user.position) {
                    alert("Location must be enabled during alpha phase!");
                }
            }
            return this;
        },
        // more controlled version of map.setCenter
        setCenter = function setCenter(LatLng) {
            if (!LatLng && user.LatLng) {
                map.setCenter(user.LatLng);
            }
            // probably will add more stuff here
        },
        bindEvents = function bindEvents() {
            $('body').bind('onGeoposition', function () {
                setCenter();
            });
            $(window).bind('resize orentationchange', function () {
                var height = {};
                height.screen = $.mobile.getScreenHeight();
                height.header = $('#home div[data-role="header"]').outerHeight();
                height.footer = $('#home div[data-role="footer"]').outerHeight();
                $('#map_canvas').height(height.screen - height.header - height.footer);
            });
            return this;
        },
        update = function update() {
            $.getJSON('messages/update', function (data) {
                if (data.success === true) {
                    alert("update complete");
                }
            });
        };
    //////////////////////
    // constructor kinda!
    //////////////////////
    $(document).ready(function onReady() {
        bindEvents();
        getLocation();
        map = new google.maps.Map(document.getElementById(id), myOptions);
        // scale map by using the resize event
        $(window).trigger('resize');
        // TODO: remove this when cron is ready
        $('#run_update').click(function () {
            update();
        });
        return this;
    });
    /////////////////////////
    // public properties
    /////////////////////////
    return {
        // TODO: remove this when cron is ready
        update : update
    };
}());