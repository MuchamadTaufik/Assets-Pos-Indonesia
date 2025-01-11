@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
   <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('asset.dihapuskan') }}">Asset Dihapuskan</a></li>
      <li class="breadcrumb-item active">Tambah Asset Dihapuskan</li>
   </ol>
   <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
         <div>
               <i class="fas fa-table me-1"></i>
               Tambah Asset Dihapuskan
         </div>
      </div>
      <div class="card-body">
         <form class="row" action="{{ route('asset.dihapuskan.store') }}" method="POST">
            @csrf
            <div class="col-md-6">
               <div class="mb-3">
                     <label for="asset_id" class="form-label">Asset</label>
                     <select class="form-control @error('asset_id') is-invalid @enderror" id="category_select" name="asset_id" required value="{{ old('asset_id') }}">
                        <option value="" disabled selected>Pilih Asset</option>
                        @foreach($asset as $categories)
                           <option value="{{ $categories->id }}" {{ (old('asset_id') ?? '') == $categories->id ? 'selected' : '' }}>
                              {{ $categories->nama }}
                           </option>
                        @endforeach
                     </select>
                     @error('asset_id')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
               </div>
            </div>

            <div class="col-md-6">
               <div class="mb-3">
                  <label for="alasan" class="form-label">Alasan Penghapusan Asset</label>
                  <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" placeholder="Masukan Alasan Penghapusan Asset..." value="{{ old('alasan') }}" required />
                  @error('alasan')
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
