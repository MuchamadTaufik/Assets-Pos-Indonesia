@extends('layouts.main')

@section('container')
   <div class="container-fluid px-4">
         <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Penyusutan</li>
         </ol>
         <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div>
                     <i class="fas fa-table me-1"></i>
                     Data Penyusutan
               </div>
            </div>
            <div class="card-body">
               <table id="datatablesSimple">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Kode Asset</th>
                           <th>Nama Asset</th>
                           <th>Tanggal Perolehan</th>
                           <th>Harga</th>
                           <th>Masa Manfaat</th>
                           <th>Masa Pemakaian</th>
                           <th>Penyusutan</th>
                           <th>Nilai Asset</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($assets as $data)
                           @php
                              $isDeleted = $deletedAssets->contains('asset_id', $data->id);
                           @endphp
                           <tr>
                              <td>{{ $loop->iteration }}.</td>
                              <td>{{ $data->kode_asset }}</td>
                              <td>{{ $data->nama }}</td>
                              <td>{{ $data->tanggal_perolehan }}</td>
                              <td>Rp. {{ number_format($data->harga, 0, ',', '.') }}</td>
                              <td>{{ $data->masa_manfaat }} Tahun</td>
                              
                              <td>
                                 @if ($data->pemakaian > $data->masa_manfaat)
                                    <p class="text-danger">{{ $data->pemakaian }} Tahun</p>
                                 @else
                                 {{ $data->pemakaian }} Tahun
                                 @endif
                              </td>
                              
                              <td>Rp. {{ number_format($data->penyusutan, 0, ',', '.') }}</td>
                              <td>
                                 @if ($data->nilai_asset == 0)
                                    <p class="text-danger">Rp. {{ number_format($data->nilai_asset, 0, ',', '.') }}</p>
                                 @else
                                 Rp. {{ number_format($data->nilai_asset, 0, ',', '.') }}
                                 @endif
                              </td>
                              <td>
                                 @if ($isDeleted)
                                    <span class="btn btn-danger">Telah dihapus</span>
                                 @else
                                    <span class="btn btn-success">Available</span>
                                 @endif
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
               </table>
            </div>
         </div>
   </div>
@endsection