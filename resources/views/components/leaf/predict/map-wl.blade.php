<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            //center: {lat: 21.3143328800798, lng: 105.603779579014},
            // center: { lat: 13.751288, lng: 100.628847 },
            center: {
                lat: 8.174971,
                lng: 99.678874
            },
            //13.751288, 100.628847
            zoom: 11
        });

        // FETCH MARKERS
        fetch("{{ url('api/now/wl') }}")
            .then((data) => data.json())
            .then((data) => {
                data = data.filter((item) => {
                    return item.station.tele_station_lat >= 8.174971;
                });
                console.log("Wl : ", data);
                const infos = data.map(function(item) {
                    // console.log(item.agency_name);
                    let div = document.createElement('div');
                    let h = document.createElement('h6');
                    let h7 = document.createElement('h7');
                    let p = document.createElement('div');
                    let ul = document.createElement('div');
                    let items = [
                        `ระดับน้ำ (ม.ทรก.) : ${item.waterlevel_msl}`,
                        `สถานะ : ${item.diff_wl_bank_text} ${item.diff_wl_bank}`,
                        `ปริมาณน้ำเต็มความจุ  : ${Number(item.storage_percent).toFixed(0)}%`,
                        `เวลา : ${item.waterlevel_datetime}`,
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
                    // let color = "red";
                    let color = "rgb(255, 0, 0)";
                    if (item.storage_percent <= 10) {
                        // color = "brown";
                        color = "rgb(219, 128, 43)";
                    } else if (item.storage_percent <= 30) {
                        // color = "yellow";
                        color = "rgb(255, 192, 0)";
                    } else if (item.storage_percent <= 70) {
                        // color = "green";
                        color = "rgb(0, 176, 80)";
                    } else if (item.storage_percent <= 100) {
                        // color = "blue";
                        color = "rgb(0, 60, 250)";
                    }
                    let m = new google.maps.Marker({
                        position: {
                            lat: item.station.tele_station_lat,
                            lng: item.station.tele_station_long
                        },
                        map: map,
                        // label: item.rain_24h.toFixed(0),
                        title: `${item.station.tele_station_name.th} จ.${item.geocode.province_name.th} อ.${item.geocode.amphoe_name.th} ต.${item.geocode.tumbon_name.th}`,
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            scale: 8.5,
                            fillColor: color,
                            fillOpacity: 1.0,
                            strokeWeight: 0.4
                        },
                    });

                    m.addListener("click", () => {
                        infos[index].open({
                            anchor: m,
                            map: map,
                        });
                    });
                });

            })

        // IMG OVERLAY 
        class USGSOverlay extends google.maps.OverlayView {
            bounds;
            image;
            div;
            constructor(bounds, image) {
                super();
                this.bounds = bounds;
                this.image = image;
            }
            // [END maps_overlay_hideshow_subclass]
            // [START maps_overlay_hideshow_onadd]
            /**
             * onAdd is called when the map's panes are ready and the overlay has been
             * added to the map.
             */
            onAdd() {
                this.div = document.createElement("div");
                this.div.style.borderStyle = "none";
                this.div.style.borderWidth = "0px";
                this.div.style.position = "absolute";

                // Create the img element and attach it to the div.
                const img = document.createElement("img");

                img.src = this.image;
                img.style.width = "100%";
                img.style.height = "100%";
                img.style.position = "absolute";
                this.div.appendChild(img);

                // Add the element to the "overlayLayer" pane.
                const panes = this.getPanes();

                panes.overlayLayer.appendChild(this.div);
            }
            // [END maps_overlay_hideshow_onadd]
            // [START maps_overlay_hideshow_draw]
            draw() {
                // We use the south-west and north-east
                // coordinates of the overlay to peg it to the correct position and size.
                // To do this, we need to retrieve the projection from the overlay.
                const overlayProjection = this.getProjection();
                // Retrieve the south-west and north-east coordinates of this overlay
                // in LatLngs and convert them to pixel coordinates.
                // We'll use these coordinates to resize the div.
                const sw = overlayProjection.fromLatLngToDivPixel(
                    this.bounds.getSouthWest()
                );
                const ne = overlayProjection.fromLatLngToDivPixel(
                    this.bounds.getNorthEast()
                );

                // Resize the image's div to fit the indicated dimensions.
                if (this.div) {
                    this.div.style.left = sw.x + "px";
                    this.div.style.top = ne.y + "px";
                    this.div.style.width = ne.x - sw.x + "px";
                    this.div.style.height = sw.y - ne.y + "px";
                }
            }
            // [END maps_overlay_hideshow_draw]
            // [START maps_overlay_hideshow_onremove]
            /**
             * The onRemove() method will be called automatically from the API if
             * we ever set the overlay's map property to 'null'.
             */
            onRemove() {
                if (this.div) {
                    this.div.parentNode.removeChild(this.div);
                    delete this.div;
                }
            }
            // [END maps_overlay_hideshow_onremove]
            // [START maps_overlay_hideshow_hideshowtoggle]
            /**
             *  Set the visibility to 'hidden' or 'visible'.
             */
            hide() {
                if (this.div) {
                    this.div.style.visibility = "hidden";
                }
            }
            show() {
                if (this.div) {
                    this.div.style.visibility = "visible";
                }
            }
            toggle() {
                if (this.div) {
                    if (this.div.style.visibility === "hidden") {
                        this.show();
                    } else {
                        this.hide();
                    }
                }
            }
            toggleDOM(map) {
                if (this.getMap()) {
                    this.setMap(null);
                } else {
                    this.setMap(map);
                }
            }
            // [END maps_overlay_hideshow_hideshowtoggle]
        }

        const bounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(7.9810505258, 99.4672642786),
            new google.maps.LatLng(8.2529753306, 99.8307601372)
        );
        // The photograph is courtesy of the U.S. Geological Survey.
        let image = "https://ckartisanspace.sgp1.digitaloceanspaces.com/thungsong/predict/floodoverlay.png";

        // [START maps_overlay_hideshow_init]
        const overlay = new USGSOverlay(bounds, image);

        overlay.setMap(map);

        // [END maps_overlay_hideshow_init]
        // [START maps_overlay_hideshow_controls]

        // // CREATE ELEMENTS
        const centerControlDiv = document.createElement("div");
        centerControlDiv.style.backgroundColor = "white";
        centerControlDiv.style.borderRadius = "2px";
        const checkbox = document.createElement("input");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("checked", "true");
        checkbox.setAttribute("id", "visibleOverlayControl");
        // checkbox.setAttribute("onchange", "onToggle(this)");
        checkbox.addEventListener("change", () => {
            overlay.toggle();
        });
        checkbox.style.width = "20px";
        checkbox.style.height = "20px";
        const label = document.createElement("span");
        label.innerHTML = " Flood";
        label.style.fontFamily = "Prompt";
        label.style.fontSize = "20px";

        centerControlDiv.appendChild(checkbox);
        centerControlDiv.appendChild(label);

        centerControlDiv.index = 1;
        centerControlDiv.style.padding = "5px 10px";
        centerControlDiv.style.marginTop = "10px";


        map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);

        // const toggleButton = document.createElement("button");

        // toggleButton.textContent = "Toggle";
        // toggleButton.classList.add("custom-map-control-button");

        // const toggleDOMButton = document.createElement("button");

        // toggleDOMButton.textContent = "Toggle DOM Attachment";
        // toggleDOMButton.classList.add("custom-map-control-button");
        // toggleButton.addEventListener("click", () => {
        //     overlay.toggle();
        // });
        // toggleDOMButton.addEventListener("click", () => {
        //     overlay.toggleDOM(map);
        // });
        // // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(toggleDOMButton);
        // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(toggleButton);


        ///
        // const imageBounds = {
        //     north: 8.2529753306,
        //     south: 7.9810505258,
        //     east: 99.8307601372,
        //     west: 99.4672642786,
        // };
        // let imgURL = "https://ckartisanspace.sgp1.digitaloceanspaces.com/thungsong/predict/floodoverlay.png";
        // var historicalOverlay = new google.maps.GroundOverlay(imgURL, imageBounds);
        // historicalOverlay.setMap(map);

        // function redrawOverlay() {
        //     historicalOverlay.setMap(map);
        // }

        // function removeOverlay() {
        //     historicalOverlay.setMap(null);
        // }

        // const onToggle = (e) => {
        //     if (e.checked) {
        //         redrawOverlay()
        //     } else {
        //         removeOverlay()
        //     }
        // }

        // // CREATE ELEMENTS
        // const centerControlDiv = document.createElement("div");
        // centerControlDiv.style.backgroundColor = "white";
        // centerControlDiv.style.borderRadius = "2px";
        // const checkbox = document.createElement("input");
        // checkbox.setAttribute("type", "checkbox");
        // checkbox.setAttribute("id", "visibleOverlayControl");
        // checkbox.setAttribute("onchange", "onToggle(this)");
        // checkbox.style.width = "20px";
        // checkbox.style.height = "20px";
        // const label = document.createElement("span");
        // label.innerHTML = " Flood";
        // label.style.fontFamily = "Prompt";
        // label.style.fontSize = "20px";

        // centerControlDiv.appendChild(checkbox);
        // centerControlDiv.appendChild(label);

        // centerControlDiv.index = 1;
        // centerControlDiv.style.padding = "5px 10px";
        // centerControlDiv.style.marginTop = "10px";
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);

    }

    google.maps.event.addDomListener(window, 'load', initMap);
</script>
<div style="min-height: 500px;">
    <div id="map" style="height: 500px; padding:20"></div>
</div>
<table class="text-center table table-bordered table-sm" >
    <tr class="text-white" style="font-size : 10px;">
        <td style="background-color : rgb(219, 128, 43);">ต่ำกว่า 10%</td>
        <td style="background-color : rgb(255, 192, 0);">10% - 30%</td>
        <td style="background-color : rgb(0, 176, 80);">30% - 70%</td>
        <td style="background-color : rgb(0, 60, 250);">70% - 100%</td>
        <td style="background-color : rgb(255, 0, 0);">มากกว่า 100%</td>
    </tr>
    <tr  style="font-size : 12px;">
        <td>น้อยวิกฤติ</td>
        <td>น้อย</td>
        <td>ปกติ</td>
        <td>มาก</td>
        <td>ล้นตลิ่ง</td>
    </tr>
</table>
