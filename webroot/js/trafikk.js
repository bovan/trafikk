/*jslint devel: true, browser: true, maxerr: 50, indent: 4 */
var Trafikk = (function () {
    'use strict';
    ///////////////////
    // private vars
    ///////////////////
    var latlng,
        map,
        id = 'map_canvas',
        myOptions = {
            zoom: 4,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP || "roadmap"
        },
        user = {
            position: false,
            LatLng : false
        },
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
        getMessages = function getMessages() {
            $.getJSON('messages/nearby/'+ user.LatLng.Qa + '/' + user.LatLng.Pa,
                function(data) {
                    console.log(data);
                });
        };
    //////////////////////
    // constructor kinda!
    //////////////////////
    $(document).ready(function onReady() {
        bindEvents();
        getLocation();
        myOptions.LatLng = new google.maps.LatLng(65.5, 17.5);
        map = new google.maps.Map(document.getElementById(id), myOptions);
        // scale map by using the resize event
        $(window).trigger('resize');
        return this;
    });
    /////////////////////////
    // public properties
    /////////////////////////
    return {

    };
}());