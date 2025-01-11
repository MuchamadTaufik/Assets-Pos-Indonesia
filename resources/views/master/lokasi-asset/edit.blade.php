@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
   <ol class="breadcrumb mb-4 mt-4">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lokasi') }}">Lokasi Asset</a></li>
      <li class="breadcrumb-item active">Edit Lokasi Asset</li>
   </ol>
   <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
         <div>
               <i class="fas fa-table me-1"></i>
               Edit Lokasi Asset
         </div>
      </div>
      <div class="card-body">
         <form class="row" action="{{ route('lokasi.update', $lokasiAsset->id) }}" method="POST">
            @method('put')
            @csrf
            <div class="col-md-6">
               <div class="mb-3">
                  <label for="name" class="form-label">Lokasi</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan Lokasi Asset..." value="{{ old('name', $lokasiAsset->name) }}" required />
                  @error('name')
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
