<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThaiWaterController extends Controller
{
    public $province = "พระนครศรีอยุธยา";

    public function now($name)
    {
        switch ($name) {
            case "wl":
                $url = "https://api-v3.thaiwater.net/api/v1/thaiwater30/public/waterlevel_load";
                $response = Http::get($url);
                $data = $response->json()["waterlevel_data"]["data"];
                $province = $this->province;
                $data = array_filter($data, function ($item) use ($province) {
                    return $item["geocode"]["province_name"]["th"] == $province;
                });
                $data = array_values($data);
                // $station_id = request("station_id");
                // if (!empty($station_id)) {
                //     $data = array_filter($data, function ($item) use ($station_id) {
                //         return $item["station"]["id"] == $station_id;
                //     });
                //     $data = array_values($data);
                // }

                return json_encode($data, JSON_UNESCAPED_UNICODE);
                break;
            case "rain":
                break;
            case "dam":
                break;
        }
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
