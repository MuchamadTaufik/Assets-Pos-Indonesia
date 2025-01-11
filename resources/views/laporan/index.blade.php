{{-- resources/views/laporan/index.blade.php --}}
@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan</li>
    </ol>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-file-pdf me-1"></i>
                Generator Laporan Asset
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.export') }}" method="GET" id="reportForm">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="tipe_laporan" class="form-label">Tipe Laporan</label>
                            <select class="form-select" name="tipe_laporan" id="tipe_laporan" required>
                                <option value="aktif">Asset Aktif</option>
                                <option value="dihapuskan">Asset Dihapuskan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Kategori Barang</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option value="">Semua Kategori</option>
                                @foreach ($categoryBarang as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="lokasi_id" class="form-label">Lokasi Asset</label>
                            <select class="form-select" name="lokasi_id" id="lokasi_id">
                                <option value="">Semua Lokasi</option>
                                @foreach ($lokasiAsset as $lokasi)
                                    <option value="{{ $lokasi->id }}">{{ $lokasi->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="format" class="form-label">Format Laporan</label>
                            <select class="form-select" name="format" id="format">
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-file-export me-1"></i> Generate Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reportForm');
        
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Generating...';
        });
    });
</script>
@endpush
@endsection