<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StationImage;
use Illuminate\Http\Request;

class StationImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $requestData = $request->all();
        $requestData = [
            "owner" => "",
            "station_code" => "",
        ];
        if ($request->hasFile('url')) {
            // $requestData['url'] = $request->file('url')->store('uploads', 'public');

            // s3
            $requestData['url'] = $request->file('url')->store('thungsong/uploads','s3');
            $requestData['url'] = env('AWS_URL')."/".$requestData['url'];
        }

        StationImage::create($requestData);

        return 'StationImage added!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
