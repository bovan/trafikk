$(document).ready(function() {
    Trafikk.init();
})

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
 
    return {
        // initialize the map and get location
        init: function() {
            this.bindEvents().getLocation();
            map = new google.maps.Map(document.getElementById(id), myOptions);
            return this;
        },
        getLocation : function() {
            var self = this;
            if (!user.position && navigator && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    /* success : */
                    function(Geopos){
                        self.setUserLocation(Geopos);
                        return self;
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
                return this;
            }
        },
        // store the users location and trigger an update
        setUserLocation : function(Geoposition) {
            var coords = Geoposition.coords
            user.position = Geoposition
            user.LatLng = new google.maps.LatLng(coords.latitude, coords.longitude);
            $('body').trigger('onGeoposition');
            return this;
        },
        bindEvents: function() {
            var self = this;
            $('body').bind('onGeoposition', function(event) {
                self.setCenter();
            });
            return this;
        },
        // more controlled version of map.setCenter
        setCenter : function(LatLng) {
            if (!LatLng && user.LatLng) {
                console.log(user.LatLng);
                map.setCenter(user.LatLng)
            }
            // probably will add more stuff here
        }
    }
})();