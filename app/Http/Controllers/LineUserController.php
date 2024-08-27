<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\LineUser;
use Illuminate\Http\Request;

class LineUserController extends Controller
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
            $lineuser = LineUser::where('userId', 'LIKE', "%$keyword%")
                ->orWhere('displayName', 'LIKE', "%$keyword%")
                ->orWhere('pictureUrl', 'LIKE', "%$keyword%")
                ->orWhere('statusMessage', 'LIKE', "%$keyword%")
                ->orWhere('language', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $lineuser = LineUser::latest()->paginate($perPage);
        }

        return view('line-user.index', compact('lineuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('line-user.create');
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
        
        LineUser::create($requestData);

        return redirect('line-user')->with('flash_message', 'LineUser added!');
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
        $lineuser = LineUser::findOrFail($id);

        return view('line-user.show', compact('lineuser'));
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
        $lineuser = LineUser::findOrFail($id);

        return view('line-user.edit', compact('lineuser'));
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
        
        $lineuser = LineUser::findOrFail($id);
        $lineuser->update($requestData);

        return redirect('line-user')->with('flash_message', 'LineUser updated!');
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
        LineUser::destroy($id);

        return redirect('line-user')->with('flash_message', 'LineUser deleted!');
    }
}
