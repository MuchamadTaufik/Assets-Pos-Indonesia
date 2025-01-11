<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use Barryvdh\DomPDF\PDF;
use App\Models\Dihapuskan;
use App\Models\LokasiAsset;
use Illuminate\Http\Request;
use App\Models\CategoryBarang;

class LaporanController extends Controller
{
    public function index()
    {
        $categoryBarang = CategoryBarang::all();
        $lokasiAsset = LokasiAsset::all();
        
        return view('laporan.index', compact('categoryBarang', 'lokasiAsset'));
    }

    public function export(Request $request)
    {
        // Base query for active assets
        $assetQuery = Assets::with(['category_barang', 'lokasi_asset'])
            ->whereNotIn('id', function ($query) {
                $query->select('asset_id')->from('dihapuskans');
            })
            ->when($request->category_id, function ($q) use ($request) {
                return $q->where('category_barang_id', $request->category_id);
            })
            ->when($request->lokasi_id, function ($q) use ($request) {
                return $q->where('lokasi_asset_id', $request->lokasi_id);
            });

        // Query for deleted assets
        $deletedQuery = Dihapuskan::with(['asset.category_barang', 'asset.lokasi_asset'])
            ->when($request->category_id, function ($q) use ($request) {
                return $q->whereHas('asset.category_barang', function ($query) use ($request) {
                    $query->where('id', $request->category_id);
                });
            })
            ->when($request->lokasi_id, function ($q) use ($request) {
                return $q->whereHas('asset.lokasi_asset', function ($query) use ($request) {
                    $query->where('id', $request->lokasi_id);
                });
            });

        // Get filters
        $filters = [
            'category' => $request->category_id ? CategoryBarang::find($request->category_id)->name : null,
            'lokasi' => $request->lokasi_id ? LokasiAsset::find($request->lokasi_id)->name : null,
        ];

        $tipeLaporan = $request->tipe_laporan;
        // Prepare data based on report type
        switch ($tipeLaporan) {
            case 'aktif':
                $assetsData = $assetQuery->get();
                $viewTemplate = 'laporan.pdf-active';
                $filename = 'laporan-asset-aktif.pdf';
                break;

            case 'dihapuskan':
                $assetsData = $deletedQuery->get();
                $viewTemplate = 'laporan.pdf-deleted';
                $filename = 'laporan-asset-dihapuskan.pdf';
                break;
        }

        if ($request->format === 'pdf') {
            $pdf = app(PDF::class);
            
            // Set PDF options for A4 size
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

            $pdf->loadView($viewTemplate, [
                'assets' => $assetsData,
                'filters' => $filters,
                'tipeLaporan' => $tipeLaporan
            ]);

            return $pdf->download($filename);
        }

        return back()->with('error', 'Format laporan tidak valid');
    }


}
