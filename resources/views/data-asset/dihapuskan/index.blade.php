@extends('layouts.main')

@section('container')
   <div class="container-fluid px-4">
         <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Asset Dihapuskan</li>
         </ol>
         <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div>
                     <i class="fas fa-table me-1"></i>
                     Asset Dihapuskan
               </div>
               <a href="{{ route('asset.dihapuskan.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
               <table id="datatablesSimple">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Kode Asset</th>
                           <th>Nama Asset</th>
                           <th>Alasan</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($dihapuskan as $data)
                           <tr>
                              <td>{{ $loop->iteration }}.</td>
                              <td>{{ $data->asset->kode_asset }}</td>
                              <td>{{ $data->asset->nama }}</td>
                              <td>{{ $data->alasan }}</td>
                           </tr>
                        @endforeach
                     </tbody>
               </table>
            </div>
         </div>
   </div>
@endsection