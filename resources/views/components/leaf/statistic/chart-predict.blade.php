<script>
    async function loadWaterLevelThungsong() {
        let url = "{{ url('api/waterlevel/predict') }}";
        let promise = await fetch(url);
        let wl_predict = await promise.json();
        // console.log(waterlevel);
        let url2 = "{{ url('api/waterlevel/station/795') }}"; //THUNGSONG
        let promise2 = await fetch(url2);
        let wl_now = await promise2.json();
        // console.log(wl_predict);
        // console.log(wl_now);

        //PREPARE DATA
        let wl_max = wl_now.data.min_bank;
        let wl_min = wl_now.data.ground_level;
        wl_now = wl_now.data.graph_data;
        wl_now = wl_now.filter(function(item) {
            // return (item.datetime.includes(":00") || item.datetime.includes(":30")) && item.value !== null;
            return item.value !== null;
        });
        wl_now = wl_now.map(function(item) {
            return [new Date(item.datetime), wl_min, wl_max, item.value, null];
        });
        let current_date = wl_now[wl_now.length - 1][0];
        wl_predict = wl_predict.map(function(item, index) {
            return [
                (new Date(item.datetime + 30 * 60 * 1000 * index - 60 * 60 * 7 * 1000)),
                wl_min,
                wl_max,
                null,
                item["forecast_wl(msl)"],
            ];
        });
        wl_predict = wl_predict.filter(function(item, index) {
            return item[0] > current_date;
        });
        // console.log(wl_predict);
        return [wl_now, wl_predict];
    }
</script>
<script>
    //WATER LEVEL THUNGSONG
    google.charts.setOnLoadCallback(drawChartWaterLevelThungsong);

    async function drawChartWaterLevelThungsong() {

        let [wl_now, wl_predict] = await loadWaterLevelThungsong();

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
        data.addColumn({
            type: 'string',
            role: 'annotation',
            p: {
                html: true
            },
        });
        data.addColumn('number', 'ระดับน้ำคาดการณ์');
        let dataset = [].concat(wl_now, wl_predict);

        dataset = dataset.map((item, index) => {
            if (index == dataset.length - 1) {
                return [item[0], item[1], 'ระดับท้องน้ำ', item[2], 'ระดับตลิ่ง', item[3], null, item[4]];
            } else if (index == wl_now.length - 1) {
                let label =
                    `${item[0].getHours()}:${item[0].getMinutes()} น. / ${item[3]} ม.ทรก. / ${(Number(item[3]-item[1])/(item[2]-item[1])*100).toFixed(0)}%`;
                return [item[0], item[1], null, item[2], null, item[3], label, item[4]];
            } else {
                return [item[0], item[1], null, item[2], null, item[3], null, item[4]];
            }
        });
        data.addRows(dataset);

        var options = {
            title: 'ระดับน้ำตรวจวัด / คาดการณ์',
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
                3: {
                    // lineDashStyle: [2.5, 10],
                    // color: '#ffc107', // orange warning
                    lineDashStyle: [3, 10],
                    // color: '#ffc107', // orange warning
                    color: 'orange', // orange warning
                    lineWidth: 3,
                },
            },

            // pointSize: 2,
            hAxis: {
                // format: 'HH:mm',
                // title : 'วันที่',
                viewWindow: {
                    min: new Date(Date.now() - 20 * 60 * 60 * 1000),
                },
            },
            vAxis: {
                title: 'ม.ทรก.',
            },
            chartArea: {
                'width': '80%',
                'height': '80%'
            },

        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_wl_thungsong'));
        chart.draw(data, options);
    }
</script>




<div id="chart_wl_thungsong" style="width: 100%; height: 400px"></div>
