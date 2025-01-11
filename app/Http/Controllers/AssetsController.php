<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\LokasiAsset;
use App\Models\CategoryBarang;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreAssetsRequest;
use App\Http\Requests\UpdateAssetsRequest;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Assets::latest()->get();

        return view('data-asset.berwujud.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryBarang = CategoryBarang::all();
        $lokasiAsset = LokasiAsset::all();
        return view('data-asset.berwujud.create', compact('lokasiAsset','categoryBarang'));
    }

    private function generateKodeAsset($categoryBarang, $id)
    {
        $tahun = date('Y');
        $kategoriKode = substr(str_replace(' ', '_', strtolower($categoryBarang->name)), 0, 3); // Ambil 3 karakter pertama dari nama kategori
        $nomorUrut = str_pad($id, 4, '0', STR_PAD_LEFT);
        
        return "{$nomorUrut}_{$kategoriKode}_{$tahun}";
    }



    private function hitungPemakaian($tanggalPerolehan)
    {
        $perolehan = Carbon::parse($tanggalPerolehan);
        $sekarang = Carbon::now();
        
        // Menghitung pemakaian dalam tahun (pembulatan ke bawah)
        return $perolehan->diffInYears($sekarang);
    }

    private function hitungPenyusutan($harga, $masaManfaat, $tanggalPerolehan)
    {
        // Hitung penyusutan per tahun
        $penyusutanPerTahun = $harga / $masaManfaat;
        
        // Hitung berapa tahun sudah terpakai
        $tahunTerpakai = $this->hitungPemakaian($tanggalPerolehan);
        
        // Nilai asset saat ini
        $nilaiAsset = $harga - ($penyusutanPerTahun * $tahunTerpakai);
        
        // Pastikan nilai tidak negatif
        $nilaiAsset = max(0, $nilaiAsset);
        
        return [
            'penyusutan' => $penyusutanPerTahun,
            'nilai_asset' => $nilaiAsset
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssetsRequest $request)
    {
        $validateData = $request->validate([
            'category_barang_id' => 'required|exists:category_barangs,id',
            'lokasi_asset_id' => 'required|exists:lokasi_assets,id',
            'nama' => 'required|string',
            'tanggal_perolehan' => 'required|date',
            'pengguna' => 'required|string',
            'volume' => 'required|integer',
            'harga' => 'required|numeric',
            'spesifikasi' => 'required|in:Sangat Baik,Baik,Cukup,Buruk,Sangat Buruk',
            'kualitas' => 'required|in:Sangat Baik,Baik,Cukup,Buruk,Sangat Buruk',
            'masa_manfaat' => 'required|integer|min:1',
        ]);

        // Get next ID untuk kode asset
        $nextId = Assets::max('id') + 1;
        
        // Get category untuk generate kode
        $categoryBarang = CategoryBarang::find($validateData['category_barang_id']);
        
        // Generate kode asset sebelum menyimpan
        $kodeAsset = $this->generateKodeAsset($categoryBarang, $nextId);
        
        // Tambahkan kode asset ke data yang akan disimpan
        $validateData['kode_asset'] = $kodeAsset;
        
        // Hitung pemakaian
        $validateData['pemakaian'] = $this->hitungPemakaian($validateData['tanggal_perolehan']);
        
        // Hitung penyusutan dan nilai asset
        $perhitungan = $this->hitungPenyusutan(
            $validateData['harga'],
            $validateData['masa_manfaat'],
            $validateData['tanggal_perolehan']
        );
        
        $validateData['penyusutan'] = $perhitungan['penyusutan'];
        $validateData['nilai_asset'] = $perhitungan['nilai_asset'];
        
        // Buat dan simpan asset dengan semua data sekaligus
        $asset = Assets::create($validateData);

        toast()->success('Berhasil', 'Asset Berwujud Berhasil di tambahkan');
        return redirect('/asset-berwujud')->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assets $assets)
    {
        $categoryBarang = CategoryBarang::all();
        $lokasiAsset = LokasiAsset::all();
        return view('data-asset.berwujud.edit', compact('lokasiAsset','categoryBarang','assets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetsRequest $request, Assets $assets)
    {
        $validateData = $request->validate([
            'category_barang_id' => 'exists:category_barangs,id',
            'lokasi_asset_id' => 'exists:lokasi_assets,id',
            'nama' => 'string',
            'tanggal_perolehan' => 'date',
            'pengguna' => 'string',
            'volume' => 'integer',
            'harga' => 'numeric',
            'spesifikasi' => 'in:Sangat Baik,Baik,Cukup,Buruk,Sangat Buruk',
            'kualitas' => 'in:Sangat Baik,Baik,Cukup,Buruk,Sangat Buruk',
            'masa_manfaat' => 'integer|min:1',
        ]);
    
        // Update basic fields
        $assets->fill($validateData);
        
        // Jika kategori berubah, update kode asset
        if ($request->has('category_barang_id')) {
            $categoryBarang = CategoryBarang::find($assets->category_barang_id);
            $assets->kode_asset = $this->generateKodeAsset($categoryBarang, $assets->id);
        }
        
        // Update pemakaian jika tanggal perolehan berubah
        if ($request->has('tanggal_perolehan')) {
            $assets->pemakaian = $this->hitungPemakaian($assets->tanggal_perolehan);
        }
        
        // Update penyusutan jika harga, masa manfaat, atau tanggal perolehan berubah
        if ($request->has('harga') || $request->has('masa_manfaat') || $request->has('tanggal_perolehan')) {
            $perhitungan = $this->hitungPenyusutan(
                $assets->harga,
                $assets->masa_manfaat,
                $assets->tanggal_perolehan
            );
            
            $assets->penyusutan = $perhitungan['penyusutan'];
            $assets->nilai_asset = $perhitungan['nilai_asset'];
        }
        
        $assets->save();
    
        toast()->success('Berhasil', 'Asset Berwujud Berhasil di ubah');
        return redirect('/asset-berwujud')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assets $assets)
    {
        Assets::destroy($assets->id);

        toast()->success('Berhasil', 'Asset Berwujud Berhasil dihapus');
        return redirect('/asset-berwujud')->withInput();
    }
}
