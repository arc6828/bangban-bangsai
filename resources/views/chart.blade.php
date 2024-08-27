<x-leaf.theme mode="navbar-light">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        async function loadWaterLevelThungsong() {
            let url = "{{ url('api/waterlevel/predict') }}";
            let promise = await fetch(url);
            let wl_predict = await promise.json();
            // console.log(waterlevel);
            let url2 = "{{ url('api/waterlevel/now/station/795') }}"; //THUNGSONG
            let promise2 = await fetch(url2);
            let wl_now = await promise2.json();
            // console.log(wl_predict);
            // console.log(wl_now);

            //PREPARE DATA
            wl_now = wl_now.data.graph_data;
            wl_now = wl_now.filter(function(item) {
                return (item.datetime.includes(":00") || item.datetime.includes(":30")) && item.value !== null;
            });
            wl_now = wl_now.map(function(item) {
                return [item.datetime, item.value, null];
            });
            //
            wl_predict = wl_predict.map(function(item, index) {
                return [
                    (new Date(item.datetime + 30 * 60 * 1000 * index)).toISOString(),
                    null,
                    item["forecast_wl(msl)"]
                ];
            });
            // console.log(wl_predict);
            return [wl_now, wl_predict];
        }
        async function loadWaterLevelBannPradoo() {
            let url2 = "{{ url('api/waterlevel/now/station/1101568') }}"; //BannPradoo
            let promise2 = await fetch(url2);
            let wl_now = await promise2.json();
            console.log(wl_now);
            //RESIZE
            wl_now = wl_now.data.graph_data;
            wl_now = wl_now.filter(function(item) {
                return (item.datetime.includes(":00") || item.datetime.includes(":30")) && item.value != null;
            });
            wl_now = wl_now.map(function(item) {
                return [item.datetime, item.value];
            });
            return wl_now;
        }
        async function loadRain(station_id) {
            let url2 = "{{ url('api/rain/now/station') }}/" + station_id;
            let promise2 = await fetch(url2);
            let rain_now = await promise2.json();
            console.log(rain_now);
            //RESIZE
            rain_now = rain_now.data;
            rain_now = rain_now.filter(function(item) {
                return (item.rainfall_datetime.includes(":00") || item.rainfall_datetime.includes(":30")) && item.rainfall_value != null;
            });
            rain_now = rain_now.map(function(item) {
                return [item.rainfall_datetime, item.rainfall_value];
            });
            return rain_now;
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });

        //WATER LEVEL THUNGSONG
        google.charts.setOnLoadCallback(drawChartWaterLevelThungsong);

        async function drawChartWaterLevelThungsong() {
            let [wl_now, wl_predict] = await loadWaterLevelThungsong();

            let dataset = [
                ['Year', 'ข้อมูลจริง', 'ข้อมูลทำนาย'],
                // ['2003', 900, null],
                // ['2004', 1000, null],
                // ['2005', 1170, 1170],
                // ['2006', null, 1120],
                // ['2007', null, 540]
            ];

            dataset = dataset.concat(wl_now, wl_predict);
            // console.log(dataset);

            var data = google.visualization.arrayToDataTable(dataset);

            var options = {
                title: 'ระดับน้ำข้อมูลจริง/ทำนาย',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_wl_thungsong'));
            chart.draw(data, options);
        }

        //WATER LEVEL BANN PRA DOO
        google.charts.setOnLoadCallback(drawChartWaterLevelBannPradoo);

        async function drawChartWaterLevelBannPradoo() {
            let wl_now = await loadWaterLevelBannPradoo();

            let dataset = [
                ['Year', 'ข้อมูลจริง'],
                // ['2003', 900, null],
                // ['2004', 1000, null],
                // ['2005', 1170, 1170],
                // ['2006', null, 1120],
                // ['2007', null, 540]
            ];
            dataset = dataset.concat(wl_now);
            // console.log(dataset);

            var data = google.visualization.arrayToDataTable(dataset);

            var options = {
                title: 'ระดับน้ำข้อมูลจริง',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                // width: 900,
                // height: 500,
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_wl_bann_pradoo'));
            chart.draw(data, options);
        }

        //RAIN
        google.charts.setOnLoadCallback(drawChartRain);

        async function drawChartRain() {
            //THUNGSONG
            let rain_now = await loadRain(795);
            let dataset = [
                ['Year', 'ข้อมูลจริง'],
                // ['2003', 900, null],
                // ['2004', 1000, null],
                // ['2005', 1170, 1170],
                // ['2006', null, 1120],
                // ['2007', null, 540]
            ];
            dataset = dataset.concat(rain_now);
            // console.log(dataset);

            var data = google.visualization.arrayToDataTable(dataset);

            var options = {
                title: 'ปริมาณฝน',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                // width: 900,
                // height: 500,
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_rain_thungsong'));
            chart.draw(data, options);

            //fai_klong_ta_lao
            let rain_now2 = await loadRain(13892);
            let dataset2 = [
                ['Year', 'ข้อมูลจริง'],
                // ['2003', 900, null],
                // ['2004', 1000, null],
                // ['2005', 1170, 1170],
                // ['2006', null, 1120],
                // ['2007', null, 540]
            ];
            dataset2 = dataset2.concat(rain_now2);
            // console.log(dataset);

            var data = google.visualization.arrayToDataTable(dataset2);

            var options = {
                title: 'ปริมาณฝน',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                // width: 900,
                // height: 500,
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_rain_fai_klong_ta_lao'));
            chart.draw(data, options);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUVQ6Qn1MqMrgH25iE31qUA3yGxPvmW8M"></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                //center: {lat: 21.3143328800798, lng: 105.603779579014},
                // center: { lat: 13.751288, lng: 100.628847 },
                center: {
                    lat: 8.1170129282,
                    lng: 99.6490122079
                },
                //13.751288, 100.628847
                zoom: 11
            });

        }
        google.maps.event.addDomListener(window, 'load', initMap);

        function initMap2() {
            var map2 = new google.maps.Map(document.getElementById('map2'), {
                //center: {lat: 21.3143328800798, lng: 105.603779579014},
                // center: { lat: 13.751288, lng: 100.628847 },
                center: {
                    lat: 8.1170129282,
                    lng: 99.6490122079
                },
                //13.751288, 100.628847
                zoom: 11
            });

        }
        google.maps.event.addDomListener(window, 'load', initMap2);
    </script>



    <section class="section section-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>กราฟ</h1>
                    <p class="mb-0"> </p>
                    <hr class="my-4" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5>ระดับน้ำและระบบคาดการณ์อุทกภัยเรียลไทม์</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4" style="min-height: 400px;">
                    <div id="map" style="height: 400px; padding:20"></div>
                </div>
                <div class="col-lg-8">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        ระดับน้ำ - สถานีทุ่งสง
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div id="chart_wl_thungsong" style="width: 100%; height: 200px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        ระดับน้ำ - สถานีบ้านประดู่
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div id="chart_wl_bann_pradoo" style="width: 100%; height: 200px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5>ปริมาณฝน</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4" style="min-height: 400px;">
                    <div id="map2" style="height: 400px; padding:20"></div>
                </div>
                <div class="col-lg-8">
                    <div class="accordion" id="accordionExample2">
                        <div class="card">
                            <div class="card-header" id="headingOne2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                                        ปริมาณน้ำฝน - สถานีทุ่งสง
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne2" class="collapse show" aria-labelledby="headingOne2" data-parent="#accordionExample2">
                                <div class="card-body">
                                    <div id="chart_rain_thungsong" style="width: 100%; height: 200px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo">
                                        ปริมาณน้ำฝน - สถานีฝายคลองท่าเลา
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionExample2">
                                <div class="card-body">
                                    <div id="chart_rain_fai_klong_ta_lao" style="width: 100%; height: 200px"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
        <script>
            $('#accordionExample').on('show.bs.collapse', function() {
                // do something...
                console.log("OPEN");
                drawChartWaterLevelBannPradoo();
                drawChartWaterLevelThungsong();
            })
            $('#accordionExample2').on('show.bs.collapse', function() {
                // do something...
                console.log("OPEN");
                drawChartRain();
            })
        </script>
    </section>
</x-leaf.theme>