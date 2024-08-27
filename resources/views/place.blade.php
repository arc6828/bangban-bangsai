<x-leaf.theme mode="navbar-light" title="สถานที่"
    description="บทความที่เกี่ยวข้องกับงายวิจัย ความรู้ที่เป็นประโยชน์และต้องการเผยแพร่สู่สาธารณะ"
    image="https://cdn-images-1.medium.com/max/1024/1*pnw6OuU-R4JXzgUUPWbmbg.jpeg">

    <script type="text/javascript">
        async function loadWaterLevel(station_id) {
            let start_date = document.querySelector("#start-date").value;
            let end_date = document.querySelector("#end-date").value;
            let url2 =
                `{{ url('api/waterlevel/station') }}/${station_id}?start_date=${start_date}&end_date=${end_date}`;
            let json_link = url2;
            let csv_link = json_link.replace("?", "/csv?");
            document.querySelector("#wlModal #wl-json").setAttribute("href", json_link);
            document.querySelector("#wlModal #wl-csv").setAttribute("href", csv_link);
            console.log(url2);
            let promise2 = await fetch(url2);
            let wl_now = await promise2.json();
            console.log(wl_now);
            //RESIZE            
            let wl_max = wl_now.data.min_bank;
            let wl_min = wl_now.data.ground_level;
            wl_now = wl_now.data.graph_data;
            wl_now = wl_now.filter(function(item) {
                return item.value != null;
            });
            wl_now = wl_now.map(function(item) {
                return [new Date(item.datetime), wl_min, wl_max, item.value];
            });
            return wl_now;
        }
        async function loadRain(station_id, group_by) {
            let url2 = `{{ url('api/rain/station') }}/${station_id}?group_by=${group_by}`;
            if (group_by == "date") {
                let year_month = document.querySelector("#month-year").value;
                let year = year_month.split("-")[0];
                let month = year_month.split("-")[1];
                url2 += `&year=${year}&month=${month}`;
            } else if (group_by == "month") {
                let year = document.querySelector("#year").value;
                url2 += `&year=${year}`;
            }
            let json_link = url2;
            let csv_link = json_link.replace("?", "/csv?");
            document.querySelector("#rainModal #rain-json").setAttribute("href", json_link);
            document.querySelector("#rainModal #rain-csv").setAttribute("href", csv_link);
            console.log(url2);
            let promise2 = await fetch(url2);
            let rain_now = await promise2.json();
            console.log(url2, group_by, rain_now);
            //RESIZE
            rain_now = rain_now.data;
            rain_now = rain_now.map(function(item) {
                if (item.rainfall_value == null) {
                    item.rainfall_value = 0;
                }
                return item;
            });
            rain_now = rain_now.map(function(item) {
                return [new Date(item.rainfall_datetime), item.rainfall_value];
            });
            return rain_now;
        }
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
    </script>
    <script>
        //WATER LEVEL 
        google.charts.setOnLoadCallback(drawChartWaterLevel);

        async function drawChartWaterLevel(station_id = 795) {
            console.log("STATION_ID : ", station_id);
            document.querySelector("#wlModal #end-date").setAttribute(
                "min",
                document.querySelector("#wlModal #start-date").value
            );
            let wl_now = await loadWaterLevel(station_id);

            var data = new google.visualization.DataTable();
            data.addColumn('datetime', 'Year');
            data.addColumn('number', 'ระดับท้องน้ำ');
            data.addColumn({
                type: 'string',
                role: 'annotation'
            });
            data.addColumn('number', 'ระดับตลิ่ง');
            data.addColumn({
                type: 'string',
                role: 'annotation'
            });
            data.addColumn('number', 'ระดับน้ำตรวจวัด');

            wl_now = wl_now.map((item, index) => {
                if (index == wl_now.length - 1)
                    return [item[0], item[1], 'ระดับท้องน้ำ', item[2], 'ระดับตลิ่ง', item[3]];
                else
                    return [item[0], item[1], null, item[2], null, item[3]];
            });
            data.addRows(wl_now);

            var options = {
                title: 'ระดับน้ำตรวจวัด',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                series: {
                    0: {
                        lineDashStyle: [10, 5],
                        color: 'black',
                        visibleInLegend: false,
                    },
                    1: {
                        lineDashStyle: [10, 5],
                        color: 'red',
                        visibleInLegend: false,
                    },
                    2: {
                        color: '#0dcaf0', // blue info
                    },
                },
                hAxis: {
                    // format: 'MMM dd, YYYY',
                    // title : 'วันที่',
                    viewWindow: {
                        // min: new Date(Date.now() - 24 * 60 * 60 * 1000),
                    },
                },
                vAxis: {
                    title: 'ม.ทรก.',
                },
                chartArea: {
                    'width': '80%',
                    // 'height': '80%'
                },
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_wl_bann_pradoo'));
            chart.draw(data, options);
        }

        //RAIN
        google.charts.setOnLoadCallback(drawChartRain);

        async function drawChartRain(station_id = 795, group_by = "hour") {


            let rain_now2 = await loadRain(station_id, group_by);
            let dataset2 = [
                ['Date', 'ปริมาณฝนตรวจวัด'],
                // ['', 0],
                // ['2003', 900, null],
                // ['2004', 1000, null],
                // ['2005', 1170, 1170],
                // ['2006', null, 1120],
                // ['2007', null, 540]
            ];
            dataset2 = dataset2.concat(rain_now2);
            // console.log(dataset);

            if (dataset2.length == 1) {
                dataset2.push(['', 0]);
            }

            var data = google.visualization.arrayToDataTable(dataset2);

            var options = {
                title: 'ปริมาณฝน',
                // curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    // format: 'MMM dd, YYYY',
                    // title : 'วันที่',
                    // viewWindow: {
                    //     // min: new Date(Date.now() - 24 * 60 * 60 * 1000),
                    // },
                },
                vAxis: {
                    title: "มิลลิเมตร",
                    viewWindow: {
                        // max: 100,
                        max: rain_now2.reduce((accumulator, item) => (Math.max(item[1], accumulator)), 0) + 0.2,
                        min: 0,
                    }
                },
                // width: 900,
                // height: 500,
                chartArea: {
                    'width': '80%',
                    // 'height': '70%'
                },
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_rain'));
            chart.draw(data, options);
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    {{-- <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script> --}}
    {{-- 
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery.min.css" /> --}}

    <!-- lightgallery plugins -->
    {{-- <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lg-zoom.min.css" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lg-thumbnail.min.css" /> --}}
    <style>
        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: #000000;
        }

        .overlay:hover {
            opacity: .5;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>

    <section class="section section-header">



        <!-- OR -->


        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>สถานี{{ $data['station']['tele_station_name']['th'] }}</h1>
                    <p class="mb-0">
                        {{-- Updated August 10th, --}}
                        {{ "ต.{$data['geocode']['tumbon_name']['th']} อ.{$data['geocode']['amphoe_name']['th']} จ.{$data['geocode']['province_name']['th']}" }}
                        <span class="current-year"></span>
                    </p>
                    <hr class="my-4" />
                </div>
            </div>

            {{-- number --}}
            <div class="row mt-4">
                <div class="col-lg-12">
                    <x-leaf.statistic.number></x-leaf.statistic.number>
                </div>
            </div>

            {{-- buttons --}}
            <div class="row my-5 ">
                <div class="col-6 text-right">

                    <a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#wlModal"
                        station-id="{{ $data['station']['id'] }}"
                        station-name="{{ $data['station']['tele_station_name']['th'] }}">
                        <i class="fas fa-water mr-2"></i> ระดับน้ำย้อนหลัง
                    </a>
                </div>
                <div class="col-6 text-start">

                    <a href="#" class="btn btn-lg btn-secondary" data-toggle="modal" data-target="#rainModal"
                        station-id="{{ $data['station']['id'] }}"
                        station-name="{{ $data['station']['tele_station_name']['th'] }}">
                        <i class="fas fa-cloud-rain mr-2"></i> ปริมาณฝนย้อนหลัง
                    </a>
                </div>
            </div>

            <div>
                <!-- WL Modal -->
                <div class="modal fade" id="wlModal" tabindex="-1" aria-labelledby="wlModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="wlModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-label-group">
                                            <input type="date" id="start-date" class="form-control"
                                                placeholder="Start Date"
                                                value="{{ date('Y-m-d', strtotime('-24 hour')) }}" required>
                                            <label for="inputEmail">วันที่เริ่มต้น</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-label-group">
                                            <input type="date" id="end-date" class="form-control"
                                                placeholder="End Date" value="{{ date('Y-m-d') }}" required>
                                            <label for="inputEmail">วันที่สิ้นสุด</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="chart_wl_bann_pradoo" style="width: 100%; height: 300px"></div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" id="wl-json" class="btn btn-secondary" target="_blank">Download
                                    JSON</a>
                                <a href="#" id="wl-csv" class="btn btn-primary" target="_blank">Download
                                    CSV</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Rain Modal -->
                <div class="modal fade" id="rainModal" tabindex="-1" aria-labelledby="rainModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rainModalLabel">ข้อมูลปริมาณน้ำฝน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <style>
                                    #nav-tab a.nav-link,
                                    #nav-tab .nav-link:active {
                                        padding-top: 10px;
                                        padding-bottom: 10px;
                                    }
                                </style>
                                <input type="hidden" id="station-id" value="hour" readonly />
                                <div id="tab-container">
                                    <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="nav-hour-tab" data-toggle="tab"
                                                data-target="#nav-hour" type="button" role="tab"
                                                aria-controls="nav-hour" aria-selected="true" value="hour">
                                                รายชั่วโมง
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="nav-day-tab" data-toggle="tab"
                                                data-target="#nav-day" type="button" role="tab"
                                                aria-controls="nav-day" aria-selected="false"
                                                value="date">รายวัน</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="nav-month-tab" data-toggle="tab"
                                                data-target="#nav-month" type="button" role="tab"
                                                aria-controls="nav-month" aria-selected="false"
                                                value="month">รายเดือน</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-4" id="nav-tabContent" style="min-height:66px;">
                                        <div class="tab-pane fade show active" id="nav-hour" role="tabpanel"
                                            aria-labelledby="nav-hour-tab">
                                            <!-- Tab 1 -->
                                        </div>
                                        <div class="tab-pane fade " id="nav-day" role="tabpanel"
                                            aria-labelledby="nav-day-tab">
                                            <!-- Tab 2 -->
                                            <div class="row">

                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-4">
                                                    <div class="form-label-group">
                                                        <input type="month" id="month-year" class="form-control"
                                                            placeholder="เลือกเดือน และ ปี ค.ศ."
                                                            value="{{ date('Y-m', strtotime('-30 day')) }}"
                                                            required />
                                                        <label for="inputEmail">เลือกเดือน และ ปี ค.ศ.</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-month" role="tabpanel"
                                            aria-labelledby="nav-month-tab">
                                            <!-- Tab 3 -->
                                            <div class="row">

                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-4">
                                                    <div class="form-label-group">
                                                        <input type="number" id="year" class="form-control"
                                                            placeholder="เลือกปี ค.ศ."
                                                            value="{{ date('Y', strtotime('-30 day')) }}" required />
                                                        <label for="inputEmail">เลือกปี ค.ศ.</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="hour" id="rain-group-by" placeholder=""
                                        readonly />
                                </div>


                                <div id="chart_rain" style="width: 100%; height: 300px"></div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" id="rain-json" class="btn btn-secondary" target="_blank">Download
                                    JSON</a>
                                <a href="#" id="rain-csv" class="btn btn-primary" target="_blank">Download
                                    CSV</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div>

                <div class="card-columns">
                    @foreach ($station->images()->get() as $item)
                        <a class="w-100 h-100 glightbox" data-type="image" href="{{ $item->url }}"
                            data-glightbox="title: โพสต์โดย {{ isset($item->lineUser) ? $item->lineUser->displayName : "" }}; description: {{ $item['created_at'] }}">
                            <div class="card card-element-hover card-overlay-hover overflow-hidden">
                                <!-- Image -->
                                <img class="lazyload card-img" src="{{ $item['url'] }}"
                                    data-src="{{ $item['url'] }}" />
                                <div class="overlay">
                                    <div class="text">
                                        <i class="fa fa-expand fs-6 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" /> --}}
    {{-- glightbox + dayjs --}}
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    {{-- + --}}
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/locale/th.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js"></script>
    <script>
        dayjs.locale('th'); // use loaded locale globally : Thailand
        dayjs.extend(window.dayjs_plugin_relativeTime);
    </script>
    <script>
        let ds = document.querySelectorAll(".glightbox");
        // console.log(ds);
        // console.log(dayjs.locale());
        // console.log(dayjs().to(dayjs('1990-01-01')));
        ds.forEach(function(node) {
            let value = node.getAttribute("data-glightbox");
            let reg = /(?<=description: ).*/g
            // const str = "Java3foobar4Script"
            let d = value.match(reg);
            let newStr = value.replace(reg, dayjs(new Date(d)).fromNow());
            // console.log(dayjs(new Date()).locale('th').format('llll'));
            node.setAttribute("data-glightbox", newStr);
            // node.innerHTML =dayjs(new Date()).locale('th').toString();
        })
        const lightbox = GLightbox();
    </script>
    {{-- masonry --}}
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
    {{-- chart --}}
    <script>
        $('#wlModal').on('show.bs.modal', function(e) {
            // do something...
            console.log("OPEN");
            let station_id = e.relatedTarget.getAttribute("station-id");
            let station_name = e.relatedTarget.getAttribute("station-name");
            document.querySelector("#wlModal h5").innerHTML = "ข้อมูลระดับน้ำ - " + station_name;
            document.querySelector("#wlModal #wl-json").setAttribute("href",
                `{{ url('api/waterlevel/station') }}/${station_id}`);
            document.querySelector("#wlModal #wl-csv").setAttribute("href",
                `{{ url('api/waterlevel/station') }}/${station_id}/csv`);
            document.querySelector("#wlModal #start-date").setAttribute("onchange",
                `drawChartWaterLevel(${station_id})`);
            document.querySelector("#wlModal #end-date").setAttribute("onchange",
                `drawChartWaterLevel(${station_id})`);
            drawChartWaterLevel(station_id);
            // drawChartWaterLevelThungsong();
        })
        $('#rainModal').on('show.bs.modal', function(e) {
            // do something...
            console.log("OPEN");
            let station_id = e.relatedTarget.getAttribute("station-id");
            let station_name = e.relatedTarget.getAttribute("station-name");
            document.querySelector("#rainModal h5").innerHTML = "ข้อมูลปริมาณน้ำฝน - " + station_name;
            document.querySelector("#rainModal #rain-json").setAttribute("href",
                `{{ url('api/rain/station') }}/${station_id}`);
            document.querySelector("#rainModal #rain-csv").setAttribute("href",
                `{{ url('api/rain/station') }}/${station_id}/csv`);
            document.querySelector("#rainModal #month-year").setAttribute("onchange",
                `drawChartRain(${station_id}, "date")`);
            document.querySelector("#rainModal #year").setAttribute("onchange",
                `drawChartRain(${station_id}, "month")`);
            document.querySelector("#rainModal #station-id").value = station_id;

            let group_by = document.querySelector("#rain-group-by").value;
            drawChartRain(station_id, group_by);
        })
        $('a[data-toggle="tab"]').on("shown.bs.tab", function(event) {
            // event.target; // newly activated tab
            // event.relatedTarget; // previous active tab
            let station_id = document.querySelector("#rainModal #station-id").value
            let group_by = event.target.getAttribute("value");
            // console.log(event.target);
            document.querySelector("#rain-group-by").value = group_by;
            drawChartRain(station_id, group_by);

        });
        // $(document).ready(function() {
        //     $('.data-table').DataTable();
        // });
    </script>

</x-leaf.theme>
