<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lokasi_asset()
    {
        return $this->belongsTo(LokasiAsset::class);
    }

    public function category_barang()
    {
        return $this->belongsTo(CategoryBarang::class);
    }

    public function dihapuskan()
    {
        return $this->hasOne(Dihapuskan::class);
    }
}
