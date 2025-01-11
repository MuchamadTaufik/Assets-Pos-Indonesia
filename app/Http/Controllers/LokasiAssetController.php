<?php

namespace App\Http\Controllers;

use App\Models\LokasiAsset;
use App\Http\Requests\StoreLokasiAssetRequest;
use App\Http\Requests\UpdateLokasiAssetRequest;

class LokasiAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasiAsset = LokasiAsset::latest()->get();

        return view('master.lokasi-asset.index', compact('lokasiAsset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.lokasi-asset.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLokasiAssetRequest $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255'
        ]);

        LokasiAsset::create($validateData);

        toast()->success('Berhasil', 'Lokasi Asset Berhasil di tambahkan');
        return redirect('/lokasi-asset')->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LokasiAsset $lokasiAsset)
    {
        return view('master.lokasi-asset.edit', compact('lokasiAsset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLokasiAssetRequest $request, LokasiAsset $lokasiAsset)
    {
        try {
            $rules = [
                'name' => 'required|max:255'
            ];

            $validateData = $request->validate($rules);

            $lokasiAsset->update($validateData);

            alert()->success('Berhasil', 'Lokasi Asset Berhasil diubah');
            return redirect('/lokasi-asset')->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LokasiAsset $lokasiAsset)
    {
        LokasiAsset::destroy($lokasiAsset->id);

        toast()->success('Berhasil', 'Lokasi Asset Berhasil dihapus');
        return redirect('/lokasi-asset')->withInput();
    }
}
