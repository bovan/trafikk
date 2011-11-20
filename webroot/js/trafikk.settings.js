// make stuff happen on flip
// TODO: disable this flipper when not having sessionStorage
$('#flip-range').change(function () {
    if (Trafikk && Trafikk.toggleRange) {
        Trafikk.toggleRange(this.value);
    }
});