@extends('layouts.main')

@section('container')
   <div class="container-fluid px-4">
         <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Category Asset</li>
         </ol>
         <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div>
                     <i class="fas fa-table me-1"></i>
                     Category Asset
               </div>
               <a href="{{ route('category.barang.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
               <table id="datatablesSimple">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama Category Asset</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($categoryBarang as $data)
                           <tr>
                              <td>{{ $loop->iteration }}.</td>
                              <td>{{ $data->name }}</td>
                              <td>
                                 <div class="form-button-action">
                                    <a href="{{ route('category.barang.edit', $data->id) }}" class="btn-action btn-edit" title="Edit Task">
                                       <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('category.barang.delete', $data->id) }}" method="POST" style="display: inline;">
                                       @csrf
                                       @method('delete')
                                       <button type="submit" class="btn-action btn-delete" title="Remove" onclick="return confirm('Apakah yakin ingin menghapus data?')">
                                          <i class="fa fa-times"></i>
                                       </button>
                                    </form>
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
               </table>
            </div>
         </div>
   </div>
@endsection