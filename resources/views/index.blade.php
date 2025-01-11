@extends('layouts.main')

@section('container')
   <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Dashboard</li>
      </ol>
      <div class="row">
         <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                  <div class="card-body">Total Asset</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                     <span>{{ $totalAsset }} Asset</span>
                  </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                  <div class="card-body">Asset Dihapuskan</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                     <span>{{ $assetDihapus }} Asser</span>
                  </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                  <div class="card-body">Asset Aktif</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                     <span>{{ $assetAktif }} Asset</span>
                  </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                  <div class="card-body">Asset Penyusutan</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                     <span>{{ $assetPenyusutan }} Asset</span>
                  </div>
            </div>
         </div>
      </div>
   </div>
@endsection