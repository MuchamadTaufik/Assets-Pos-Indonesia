@extends('layouts.main')

@section('container')
   <div class="container-fluid px-4">
         <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Asset Berwujud</li>
         </ol>
         <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div>
                     <i class="fas fa-table me-1"></i>
                     Asset Berwujud
               </div>
               <a href="{{ route('asset.berwujud.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
               <table id="datatablesSimple">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Kode Asset</th>
                           <th>Nama Asset</th>
                           <th>Category Asset</th>
                           <th>Lokasi Asset</th>
                           <th>Tanggal Perolehan</th>
                           <th>Pengguna</th>
                           <th>Volume</th>
                           <th>Harga</th>
                           <th>Spesifikasi</th>
                           <th>Kualitas</th>
                           <th>Masa Manfaat</th>
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
                                 <td>{{ $data->category_barang->name }}</td>
                                 <td>{{ $data->lokasi_asset->name }}</td>
                                 <td>{{ $data->tanggal_perolehan }}</td>
                                 <td>{{ $data->pengguna }}</td>
                                 <td>{{ $data->volume }}</td>
                                 <td>Rp. {{ number_format($data->harga, 0, ',', '.') }}</td>
                                 <td>{{ $data->spesifikasi }}</td>
                                 <td>{{ $data->kualitas }}</td>
                                 <td>{{ $data->masa_manfaat }} Tahun</td>
                                 <td>
                                       @if ($isDeleted)
                                          <span class="btn btn-danger">Telah dihapus</span>
                                       @else
                                          <div class="form-button-action">
                                             <a href="{{ route('asset.berwujud.edit', $data->id) }}" class="btn-action btn-edit" title="Edit Task">
                                                   <i class="fa fa-edit"></i>
                                             </a>
                                             <form action="{{ route('asset.berwujud.delete', $data->id) }}" method="POST" style="display: inline;">
                                                   @csrf
                                                   @method('delete')
                                                   <button type="submit" class="btn-action btn-delete" title="Remove" onclick="return confirm('Apakah yakin ingin menghapus data?')">
                                                      <i class="fa fa-times"></i>
                                                   </button>
                                             </form>
                                          </div>
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