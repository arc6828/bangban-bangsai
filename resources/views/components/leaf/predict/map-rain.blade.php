<script>
    function initMap2() {
        const map2 = new google.maps.Map(document.getElementById('map2'), {
            //center: {lat: 21.3143328800798, lng: 105.603779579014},
            // center: { lat: 13.751288, lng: 100.628847 },
            center: {
                lat: 8.174971,
                lng: 99.678874
            },
            //13.751288, 100.628847
            zoom: 11
        });

        fetch("{{ url('api/now/rain') }}")
            .then((data) => data.json())
            .then((data) => {
                data = data.filter((item) => {
                    return item.station.tele_station_lat >= 8.174971;
                });
                console.log("Rain : ", data);
                const infos = data.map(function(item) {
                    // console.log(item.agency_name);
                    let div = document.createElement('div');
                    let h = document.createElement('h6');
                    let h7 = document.createElement('h7');
                    let p = document.createElement('div');
                    let ul = document.createElement('div');
                    let items = [
                        `ปริมาณฝน (มม.) : ${item.rain_24h}`,
                        `เวลา : ${item.rainfall_datetime}`,
                        `รหัสสถานี : ${item.station.id}`,
                        `แหล่งข้อมูล : ${item.agency.agency_name.th}`,
                    ];
                    items.map(function(item) {
                        let li = document.createElement('div');
                        li.innerHTML = item;
                        ul.appendChild(li);
                        return li;
                    });
                    div.appendChild(h);
                    // div.appendChild(p);
                    div.appendChild(ul);
                    h.innerHTML =
                        ` ${item.station.tele_station_name.th} <br />จ.${item.geocode.province_name.th} อ.${item.geocode.amphoe_name.th} ต.${item.geocode.tumbon_name.th}`;
                    h.classList.add("mb-2");
                    p.innerHTML = item.geocode.province_name.th;
                    return new google.maps.InfoWindow({
                        content: div,
                        ariaLabel: item.station.tele_station_name.th,
                    });
                });
                const markers = data.map(function(item, index) {
                    
                    let color = "rgb(218, 53, 46)";
                    if (item.rain_24h == 0) {
                        color = "white";
                    } 
                    else if (item.rain_24h <= 10) {
                        color = "rgb(174, 211, 255)";
                    } 
                    else if (item.rain_24h <= 20) {
                        color = "rgb(174, 236, 183)";
                    }
                     else if (item.rain_24h <= 35) {
                        color = "rgb(127, 198, 60)";
                    } 
                    else if (item.rain_24h <= 50) {
                        color = "rgb(240, 212, 71)";
                    }
                    else if (item.rain_24h <= 70) {
                        color = "rgb(239, 144, 54)";
                    }
                    else if (item.rain_24h <= 90) {
                        color = "rgb(189, 106, 39)";
                    }
                    let m = new google.maps.Marker({
                        position: {
                            lat: item.station.tele_station_lat,
                            lng: item.station.tele_station_long
                        },
                        map: map2,
                        // label: item.rain_24h.toFixed(0),
                        title: `${item.station.tele_station_name.th} จ.${item.geocode.province_name.th} อ.${item.geocode.amphoe_name.th} ต.${item.geocode.tumbon_name.th}`,
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            scale: 8.5,
                            fillColor: color,
                            fillOpacity: item.rain_24h?1.0:0.0,
                            strokeWeight: 0.4
                        },
                    });
                    m.addListener("click", () => {
                        infos[index].open({
                            anchor: m,
                            map: map2,
                        });
                    });
                });

            })



    }
    google.maps.event.addDomListener(window, 'load', initMap2);
    // window.initMap2 = initMap2;
</script>
<div style="min-height: 500px;">
    <div id="map2" style="height: 500px; padding:20">
    </div>
</div>
<table class="text-center table table-bordered table-sm" >
    <tr class="text-white" style="font-size : 10px;">
        <td style="background-color : rgb(174, 211, 255);"> >0-10 </td>
        <td style="background-color : rgb(174, 236, 183);"> >10-20 </td>
        <td style="background-color : rgb(127, 198, 60);"> >20-35 </td>
        <td style="background-color : rgb(240, 212, 71);"> >35-50 </td>
        <td style="background-color : rgb(239, 144, 54);"> >50-70 </td>
        <td style="background-color : rgb(189, 106, 39);"> >70-90 </td>
        <td style="background-color : rgb(218, 53, 46);"> >90 </td>
    </tr>
    <tr  style="font-size : 12px;">
        <td>เล็กน้อย</td>
        <td colspan="2">ปานกลาง</td>
        <td colspan="3">หนัก</td>
        <td>หนักมาก</td>
    </tr>
</table>
