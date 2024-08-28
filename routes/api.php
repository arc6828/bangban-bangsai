<?php

use App\Http\Controllers\API\LineWebhookController;
use App\Http\Controllers\API\ThaiWaterController;
use App\Models\ExportFile;
use App\Models\LineMessageAPI;
use App\Models\LineUser;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("waterlevel/station/{station_id}", function (Request $request, $station_id) {
    //station_id 795 สถานีทุ่งสง
    //station_id 1101568 สถานีบ้านประดู่
    //station_id 13892 สถานีฝายคลองท่าเลา
    $current = date('Y-m-d');
    $current = $request->query('end_date', $current) . " 23:59:59";
    $past = date('Y-m-d', strtotime('-24 hour'));
    $past = $request->query('start_date', $past);
    $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id={$station_id}&start_date={$past}&end_date={$current}";
    // $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id={$station_id}";
    $response = Http::get($url);
    return $response->json();
});
Route::get("rain/station/{station_id}", function (Request $request, $station_id) {
    // https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_monthly_graph?station_id=795&month=10&year=2022
    // https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_yearly_graph?station_id=795&year=2022
    //station_id 795 ทุ่งสง
    //station_id 13892 สถานีฝายคลองท่าเลา
    $current = date('Y-m-d');
    $past = date('Y-m-d', strtotime('-24 hour'));
    $group_by = $request->query('group_by', "hour"); // ["hour","date","month"]

    if ($group_by == "month") {
        $year = $request->query('year', date('Y')); // 2022
        $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_yearly_graph?station_id={$station_id}&year={$year}";
        $response = Http::get($url);
        // return $response->json();

        $json = $response->json();
        $json_data = $json["data"];
        $json["data"] = array_map(function ($item) {
            return ["rainfall_datetime" => $item["date_time"], "rainfall_value" => $item["rainfall"],];
        }, $json_data);
        // return $json;
    } else if ($group_by == "date") {
        $year = $request->query('year', date('Y')); // 2022
        $month = $request->query('month', date('m')); // 12
        $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_monthly_graph?station_id={$station_id}&month={$month}&year={$year}";
        $response = Http::get($url);
        $json = $response->json();
    } else {
        $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_24h_graph?station_id={$station_id}";
        $response = Http::get($url);
        $json = $response->json();
    }
    return $json;
});

// MAKE CSV in statistic.blade.php

Route::get("waterlevel/station/{station_id}/csv", function (Request $request, $station_id) {
    $current = date('Y-m-d');
    $current = $request->query('end_date', $current) . " 23:59:59";
    $past = date('Y-m-d', strtotime('-24 hour'));
    $past = $request->query('start_date', $past);
    $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id={$station_id}&start_date={$past}&end_date={$current}";
    // $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id={$station_id}";
    $response = Http::get($url);
    $json = $response->json();
    $json_data = $json["data"]["graph_data"];
    $body = array_map(function ($item) {
        return [$item["datetime"], $item["value"], $item["value_out"], $item["discharge"],];
    }, $json_data);
    $head = ["datetime", "value", "value_out", "discharge"];
    return ExportFile::toCSV($request, "wl-{$station_id}.csv", $body, $head);
    // return 
});
Route::get("rain/station/{station_id}/csv", function (Request $request, $station_id) {
    //station_id 795 ทุ่งสง
    //station_id 13892 สถานีฝายคลองท่าเลา
    $current = date('Y-m-d H:i:s');
    $past = date('Y-m-d H:i:s', strtotime('-24 hour'));
    // $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_24h_graph?station_id={$station_id}";
    // $response = Http::get($url);
    // $json = $response->json();
    $group_by = $request->query('group_by', "hour"); // ["hour","date","month"]

    if ($group_by == "month") {
        $year = $request->query('year', date('Y')); // 2022
        $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_yearly_graph?station_id={$station_id}&year={$year}";
        $response = Http::get($url);
        // return $response->json();

        $json = $response->json();
        $json_data = $json["data"];
        $json["data"] = array_map(function ($item) {
            return ["rainfall_datetime" => $item["date_time"], "rainfall_value" => $item["rainfall"],];
        }, $json_data);
        // return $json;
    } else if ($group_by == "date") {
        $year = $request->query('year', date('Y')); // 2022
        $month = $request->query('month', date('m')); // 12
        $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_monthly_graph?station_id={$station_id}&month={$month}&year={$year}";
        $response = Http::get($url);
        $json = $response->json();
    } else {
        $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_24h_graph?station_id={$station_id}";
        $response = Http::get($url);
        $json = $response->json();
    }

    $json_data = $json["data"];
    $body = array_map(function ($item) {
        return [$item["rainfall_datetime"], $item["rainfall_value"]];
    }, $json_data);
    $head = ["rainfall_datetime", "rainfall_value"];
    return ExportFile::toCSV($request, "rain-{$station_id}.csv", $body, $head);
});

// use for predict chart

Route::get("waterlevel/predict", function () {
    $url = "https://ckartisanspace.sgp1.digitaloceanspaces.com/thungsong/predict/floodwaterlevel.json";
    $response = Http::get($url);
    return $response->json();
});

// USE FOR number.blade.php

Route::get("now/{name}", [ThaiWaterController::class,"now"]);

Route::get("now2/{name}", function ($name) {
    $url = "https://ckartisanspace.sgp1.digitaloceanspaces.com/thungsong/now/now-{$name}.json";
    $response = Http::get($url);
    $data = $response->json();
    $station_id = request("station_id");
    if (!empty($station_id)) {
        $data = array_filter($data, function ($item) use ($station_id) {
            return $item["station"]["id"] == $station_id;
        });
        $data = array_values($data);
    }

    return json_encode($data, JSON_UNESCAPED_UNICODE);
});

// USE FOR number.blade.php > deprecate

Route::get("statistic/now", function () {
    $wl_urls = [
        "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id=795",
        "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id=1101568",
    ];
    $rain_urls = [
        "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_24h_graph?station_id=795",
        "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_24h_graph?station_id=13892",
    ];

    $wl_data = array_map(function ($item) {
        $response = Http::get($item);
        $d = $response->json()["data"]["graph_data"];
        $collection = collect($d);
        $first = $collection->first(function ($item) {
            return $item["value"] != null;
        });
        $last = $collection->last(function ($item) {
            return $item["value"] != null;
        });
        $d = 0;
        try {
            $d = $last["rainfall_value"] - $first["rainfall_value"];
        } catch (Exception $e) {
        }
        return [
            "oldest" => $first,
            "avg" => $collection->avg('value'),
            "min" => $collection->min('value'),
            "max" => $collection->max('value'),
            "latest" => $last,
            "d" => $d,
        ];
    }, $wl_urls);


    $rain_data = array_map(function ($item) {
        $response = Http::get($item);
        $d = $response->json()["data"];
        $collection = collect($d);
        $first = $collection->first(function ($item) {
            return $item["rainfall_value"] != null;
        });
        $last = $collection->last(function ($item) {
            return $item["rainfall_value"] != null;
        });
        $d = 0;
        try {
            $d = $last["rainfall_value"] - $first["rainfall_value"];
        } catch (Exception $e) {
        }
        return [
            "oldest" => $first,
            "avg" => $collection->avg('rainfall_value'),
            "min" => $collection->min('rainfall_value'),
            "max" => $collection->max('rainfall_value'),
            "latest" => $last,
            "d" => $d,
        ];
    }, $rain_urls);

    $data = [
        "wl_thungsong" => $wl_data[0],
        "wl_baanpradoo" => $wl_data[1],
        "rain_thungsong" => $rain_data[0],
        "rain_faiklongtalao" => $rain_data[1],
    ];

    return $data;
});

Route::get("waterlevel/now", function () {
    //station_id 795 ทุ่งสง
    $current = date('Y-m-d H:i:s');
    $past = date('Y-m-d H:i:s', strtotime('-4 hour'));
    // $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id=795&start_date={$past}&end_date={$current}";
    $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_graph?station_type=tele_waterlevel&station_id=795";
    $response = Http::get($url);
    return $response->json();
});


Route::post('/line/webhook', [LineWebhookController::class, 'store']);
Route::get('/line/profile/{userId}', function ($userId) {
    // GET USER
    // $userId = $event["source"]["userId"];
    $line = new LineMessageAPI();
    $user = $line->getProfile($userId);

    $requestData = [
        // "userId" => $user->userId,
        "displayName" => $user->displayName,
        "pictureUrl" => $user->pictureUrl,
        "statusMessage" => $user->statusMessage,
        "language" => $user->language,
    ];

    // LineUser::create($requestData);
    LineUser::firstOrCreate(
        ['userId' => $userId],
        $requestData
    );
    
});
Route::get('/station/feed', function () {
    //WL
    $response = Http::get(url('api/now/wl'));
    $wl = $response->json();
    $wl = array_filter($wl, function ($item) {
        if (!isset($item['station']['tele_station_lat'])) return false;
        return $item['station']['tele_station_lat'] >= 8.174971;
    });
    foreach ($wl as $item) {
        Station::firstOrCreate(
            ['code' => $item['station']['id'],],
            [                
                'name' => $item['station']['tele_station_name']['th'],
                'latitude' => $item['station']['tele_station_lat'], 
                'longitude' => $item['station']['tele_station_long'],
            ],
        );
    }
    //RAIN
    $response = Http::get(url('api/now/rain'));
    $rain = $response->json();
    $rain = array_filter($rain, function ($item) {
        return $item['station']['tele_station_lat'] >= 8.174971;
    });
    foreach ($rain as $item) {
        Station::firstOrCreate(
            ['code' => $item['station']['id'],],
            [                
                'name' => $item['station']['tele_station_name']['th'],
                'latitude' => $item['station']['tele_station_lat'], 
                'longitude' => $item['station']['tele_station_long'],
            ],
        );
    }
    return "Update Successfully";
});