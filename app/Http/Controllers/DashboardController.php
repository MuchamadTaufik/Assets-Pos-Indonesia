<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Dihapuskan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah total aset
        $totalAsset = Assets::count();
    
        // Menghitung jumlah aset yang dihapus
        $assetDihapus = Dihapuskan::count();
    
        // Menghitung aset aktif, yaitu total aset dikurangi aset yang dihapus
        $assetAktif = $totalAsset - $assetDihapus;
    
        // Menghitung aset penyusutan (nilai aset 0)
        $assetPenyusutan = Assets::where('nilai_asset', 0)->count();
    
        // Mengembalikan data ke view
        return view('index', [
            'totalAsset' => $totalAsset,
            'assetDihapus' => $assetDihapus,
            'assetAktif' => $assetAktif,
            'assetPenyusutan' => $assetPenyusutan
        ]);
    }
    
}
