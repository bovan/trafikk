$(document).ready(function() {
    Trafikk.init();
})

var Trafikk = (function() {
    var latlng = new google.maps.LatLng(65.5, 17.5),
        myOptions = {
            zoom: 4,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        map;
        
    return {
        init: function() {
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            return this;
        }
    }
})();