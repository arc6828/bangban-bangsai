<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ThaiWaterController extends Controller
{
    public $province = "พระนครศรีอยุธยา";
    // public $cache_driver = "file";

    public function now($name)
    {
        switch ($name) {
            case "wl":
                $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_load";
                // $data = Cache::store($this->cache_driver)->remember($url, now()->addMinutes(30), function () use ($url) {
                $data = Cache::remember($url, now()->addMinutes(30), function () use ($url) {
                    $response = Http::get($url);
                    $data = $response->json()["waterlevel_data"]["data"];
                    $province = $this->province;
                    $data = array_filter($data, function ($item) use ($province) {
                        return $item["geocode"]["province_name"]["th"] == $province || str_contains($item["station"]["tele_station_name"]["th"], 'ท้ายเขื่อน');
                    });
                    $data = array_values($data);
                    // $station_id = request("station_id");
                    // if (!empty($station_id)) {
                    //     $data = array_filter($data, function ($item) use ($station_id) {
                    //         return $item["station"]["id"] == $station_id;
                    //     });
                    //     $data = array_values($data);
                    // }
                    return $data;
                });

                return json_encode($data, JSON_UNESCAPED_UNICODE);
                break;
            case "rain":
                $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/rain_24h";
                // $data = Cache::store($this->cache_driver)->remember($url, now()->addMinutes(30), function () use ($url) {
                $data = Cache::remember($url, now()->addMinutes(30), function () use ($url) {
                    $response = Http::get($url);
                    $data = $response->json()["data"];
                    $province = $this->province;
                    $data = array_filter($data, function ($item) use ($province) {
                        return $item["geocode"]["province_name"]["th"] == $province;
                    });
                    $data = array_values($data);
                    return $data;
                });

                return json_encode($data, JSON_UNESCAPED_UNICODE);

                break;
            case "dam":
                $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/analyst/dam";
                // $data = Cache::store($this->cache_driver)->remember($url, now()->addMinutes(30), function () use ($url) {
                $data = Cache::remember($url, now()->addMinutes(30), function () use ($url) {
                    $response = Http::get($url);
                    $data = $response->json()["data"]["dam_daily"];
                    // $dam_whitelist = ["วชิราลงกรณ", "สิริกิติ์", "ภูมิพล", "ป่าสักชลสิทธิ์", "ศรีนครินทร์"];
                    $dam_whitelist = ["ภาคเหนือ", "ภาคกลาง"];
                    $data = array_filter($data, function ($item) use ($dam_whitelist) {
                        // return in_array($item["dam"]["dam_name"]["th"], $dam_whitelist);
                        // return $item["geocode"]["area_name"]["th"] == $province;
                        return in_array($item["geocode"]["area_name"]["th"], $dam_whitelist);
                    });
                    $data = array_values($data);
                    return $data;
                });

                return json_encode($data, JSON_UNESCAPED_UNICODE);
                break;
        }
        // otherwise
        return json_encode([], JSON_UNESCAPED_UNICODE);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
