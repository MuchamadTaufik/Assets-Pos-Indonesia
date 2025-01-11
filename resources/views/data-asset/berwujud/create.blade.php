@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
   <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('asset.berwujud') }}">Asset Berwujud</a></li>
      <li class="breadcrumb-item active">Tambah Asset Berwujud</li>
   </ol>
   <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
         <div>
               <i class="fas fa-table me-1"></i>
               Tambah Asset Berwujud
         </div>
      </div>
      <div class="card-body">
         <form class="row" action="{{ route('asset.berwujud.store') }}" method="POST">
            @csrf
            <div class="col-md-6">
                  <div class="mb-3">
                     <label for="kode_asset" class="form-label">Kode Asset</label>
                     <input type="text" 
                           class="form-control" 
                           id="kode_asset" 
                           name="kode_asset" 
                           value="{{ $asset->kode_asset ?? '' }}" 
                           readonly 
                           disabled />
                     <small class="text-muted">Kode asset akan digenerate otomatis oleh sistem</small>
                  </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                     <label for="category_barang_id" class="form-label">Category Asset</label>
                     <select class="form-control @error('category_barang_id') is-invalid @enderror" id="category_select" name="category_barang_id" required value="{{ old('category_barang_id') }}">
                        <option value="" disabled selected>Pilih Category Asset</option>
                        @foreach($categoryBarang as $categories)
                           <option value="{{ $categories->id }}" {{ (old('category_barang_id') ?? '') == $categories->id ? 'selected' : '' }}>
                              {{ $categories->name }}
                           </option>
                        @endforeach
                     </select>
                     @error('category_barang_id')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                     <label for="lokasi_asset_id" class="form-label">Lokasi Asset</label>
                     <select class="form-control @error('lokasi_asset_id') is-invalid @enderror" id="category_select" name="lokasi_asset_id" required value="{{ old('lokasi_asset_id') }}">
                        <option value="" disabled selected>Pilih Lokasi Asset</option>
                        @foreach($lokasiAsset as $categories)
                           <option value="{{ $categories->id }}" {{ (old('lokasi_asset_id') ?? '') == $categories->id ? 'selected' : '' }}>
                              {{ $categories->name }}
                           </option>
                        @endforeach
                     </select>
                     @error('lokasi_asset_id')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="nama" class="form-label">Nama Asset</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukan Nama Asset..." value="{{ old('nama') }}" required />
                  @error('nama')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="tanggal_perolehan" class="form-label">Tanggal Perolehan</label>
                  <input type="date" class="form-control @error('tanggal_perolehan') is-invalid @enderror" id="tanggal_perolehan" name="tanggal_perolehan" value="{{ old('tanggal_perolehan') }}" required />
                  @error('tanggal_perolehan')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="pengguna" class="form-label">Pengguna</label>
                  <input type="text" class="form-control @error('pengguna') is-invalid @enderror" id="pengguna" name="pengguna" placeholder="Masukan Pengguna Asset..." value="{{ old('pengguna') }}" required />
                  @error('pengguna')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="volume" class="form-label">Volume</label>
                  <input type="number" class="form-control @error('volume') is-invalid @enderror" id="volume" name="volume" placeholder="Masukan Volume..." value="{{ old('volume') }}" required />
                  @error('volume')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="harga" class="form-label">Harga Asset</label>
                  <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Masukan Harga Asset..." value="{{ old('harga') }}" required />
                  @error('harga')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="spesifikasi" class="form-label">Spesifikasi</label>
                  <select class="form-control @error('spesifikasi') is-invalid @enderror" id="category" name="spesifikasi" required value="{{ old('spesifikasi') }}">
                     <option value="" disabled selected>Pilih Spesifikasi</option>
                     <option value="Sangat Baik" {{ old('spesifikasi') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                     <option value="Baik" {{ old('spesifikasi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                     <option value="Cukup" {{ old('spesifikasi') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                     <option value="Buruk" {{ old('spesifikasi') == 'Buruk' ? 'selected' : '' }}>Buruk</option>
                     <option value="Sangat Buruk" {{ old('spesifikasi') == 'Sangat Buruk' ? 'selected' : '' }}>Sangat Buruk</option>
                  </select>
                  @error('spesifikasi')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="kualitas" class="form-label">Kualitas</label>
                  <select class="form-control @error('kualitas') is-invalid @enderror" id="category" name="kualitas" required value="{{ old('kualitas') }}">
                     <option value="" disabled selected>Pilih Kualitas</option>
                     <option value="Sangat Baik" {{ old('kualitas') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                     <option value="Baik" {{ old('kualitas') == 'Baik' ? 'selected' : '' }}>Baik</option>
                     <option value="Cukup" {{ old('kualitas') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                     <option value="Buruk" {{ old('kualitas') == 'Buruk' ? 'selected' : '' }}>Buruk</option>
                     <option value="Sangat Buruk" {{ old('kualitas') == 'Sangat Buruk' ? 'selected' : '' }}>Sangat Buruk</option>
                  </select>
                  @error('kualitas')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="masa_manfaat" class="form-label">Masa Manfaat</label>
                  <div class="input-group">
                     <input type="number" class="form-control @error('masa_manfaat') is-invalid @enderror" id="masa_manfaat" name="masa_manfaat" placeholder="Masukan Masa Manfaat..." value="{{ old('masa_manfaat') }}" required />
                     <span class="input-group-text">tahun</span>
                  </div>
                  @error('masa_manfaat')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
            </div>            

            <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-success">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
