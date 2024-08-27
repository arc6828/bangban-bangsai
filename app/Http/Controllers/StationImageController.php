<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\StationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StationImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $stationimage = StationImage::where('url', 'LIKE', "%$keyword%")
                ->orWhere('owner', 'LIKE', "%$keyword%")
                ->orWhere('station_code', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $stationimage = StationImage::latest()->paginate($perPage);
        }

        return view('station-image.index', compact('stationimage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('station-image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();
        if ($request->hasFile('url')) {
            // $requestData['url'] = $request->file('url')->store('uploads', 'public');

            // s3
            $requestData['url'] = $request->file('url')->store('thungsong/uploads','s3');
            $requestData['url'] = env('AWS_URL')."/".$requestData['url'];
        }

        StationImage::create($requestData);

        return redirect('station-image')->with('flash_message', 'StationImage added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $stationimage = StationImage::findOrFail($id);

        return view('station-image.show', compact('stationimage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $stationimage = StationImage::findOrFail($id);

        return view('station-image.edit', compact('stationimage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();
        if ($request->hasFile('url')) {
            // $requestData['url'] = $request->file('url')->store('uploads', 'public');

            // s3
            $requestData['url'] = $request->file('url')->store('thungsong/uploads','s3');
            $requestData['url'] = env('AWS_URL')."/".$requestData['url'];
        }

        $stationimage = StationImage::findOrFail($id);
        $stationimage->update($requestData);

        return redirect('station-image')->with('flash_message', 'StationImage updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        // delete from s3
        $stationimage = StationImage::findOrFail($id);
        $url = str_replace(env('AWS_URL')."/","",$stationimage->url);
        Storage::disk('s3')->delete($url);
        // Storage::disk('s3')->delete($stationimage->url);
        // echo $stationimage->url;
        // echo "<br>";
        // echo $url;
        
        // delete from db
        StationImage::destroy($id);

        return redirect('station-image')->with('flash_message', 'StationImage deleted!');
    }
}
