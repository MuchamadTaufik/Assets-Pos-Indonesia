<?php

namespace App\Http\Controllers;

use App\Models\Dihapuskan;
use App\Http\Requests\StoreDihapuskanRequest;
use App\Http\Requests\UpdateDihapuskanRequest;
use App\Models\Assets;

class DihapuskanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dihapuskan = Dihapuskan::latest()->get();

        return view('data-asset.dihapuskan.index', compact('dihapuskan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asset = Assets::all();
        return view('data-asset.dihapuskan.create', compact('asset'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDihapuskanRequest $request)
    {
        $validateData = $request->validate([
            'asset_id' => 'required',
            'alasan' => 'required'
        ]);

        Dihapuskan::create($validateData);

        toast()->success('Berhasil', 'Asset DIhapuskan Berhasil di tambahkan');
        return redirect('/asset-dihapuskan')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Dihapuskan $dihapuskan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dihapuskan $dihapuskan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDihapuskanRequest $request, Dihapuskan $dihapuskan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dihapuskan $dihapuskan)
    {
        //
    }
}
