<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUVQ6Qn1MqMrgH25iE31qUA3yGxPvmW8M"></script>
<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            //center: {lat: 21.3143328800798, lng: 105.603779579014},
            // center: { lat: 13.751288, lng: 100.628847 },
            center: {
                lat: 8.1170129282,
                lng: 99.6490122079
            },
            //13.751288, 100.628847
            zoom: 11
        });
        const marker = new google.maps.Marker({
            position: {
                lat: 8.1170129282,
                lng: 99.6490122079
            },
            map: map,
        });
    }
    google.maps.event.addDomListener(window, 'load', initMap);

    function initMap2() {
        const map2 = new google.maps.Map(document.getElementById('map2'), {
            //center: {lat: 21.3143328800798, lng: 105.603779579014},
            // center: { lat: 13.751288, lng: 100.628847 },
            center: {
                lat: 8.1170129282,
                lng: 99.6490122079
            },
            //13.751288, 100.628847
            zoom: 11
        });
        const marker = new google.maps.Marker({
            position: {
                lat: 8.1170129282,
                lng: 99.6490122079
            },
            map: map2,
        });
    }
    google.maps.event.addDomListener(window, 'load', initMap2);

</script>
<div class="mt-10" style="height:500px; padding:20px;">
    <div id="map" style="height: 500px;padding:20"></div>
    <!-- <div class="" style="position: absolute; bottom: 55px; left: 25px;"><img class="" src="https://weather.ckartisan.com/image/scale.png" width="30%"></div> -->



</div>

<div class="mt-10" style="height:500px; padding:20px;">
    <div id="map2" style="height: 500px;padding:20"></div>
    <!-- <div class="" style="position: absolute; bottom: 55px; left: 25px;"><img class="" src="https://weather.ckartisan.com/image/scale.png" width="30%"></div> -->



</div>
