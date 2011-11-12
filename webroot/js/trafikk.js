var Trafikk = (function() {
    // private vars
    var latlng = new google.maps.LatLng(65.5, 17.5),
    map,
    id = 'map_canvas';
        
    var myOptions = {
        zoom: 4,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var user = {
        position: false,
        LatLng : false
    };
    
    // constructor kinda!
    $(document).ready(function () {
        bindEvents()
        getLocation();
        map = new google.maps.Map(document.getElementById(id), myOptions);
        return this;
    });
        
    // functions
    var getLocation = function() {
        if (!user.position && navigator && navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                /* success : */
                function(Geopos){
                    setUserLocation(Geopos);
                    return this;
                }, 
                /* error : */
                function() {
                    alert("#FAIL");
                });
        }
        else {
            if (!user.position) {
                alert("Location must be enabled during alpha phase!");
            }
        }
        return this;
    }
        
    // store the users location and trigger an update
    var setUserLocation = function(Geoposition) {
        var coords = Geoposition.coords
        user.position = Geoposition
        user.LatLng = new google.maps.LatLng(coords.latitude, coords.longitude);
        $('body').trigger('onGeoposition');
        return this;
    }
        
    var bindEvents = function() {
        var self = this;
        $('body').bind('onGeoposition', function(event) {
            setCenter();
        });
        return this;
    }
        
    // more controlled version of map.setCenter
    var setCenter = function(LatLng) {
        if (!LatLng && user.LatLng) {
            map.setCenter(user.LatLng)
        }
    // probably will add more stuff here
    }
    
    // list public properties that should be accessible outside here!
    return {
        
    };
})();