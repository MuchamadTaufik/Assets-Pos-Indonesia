<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Asset Aktif</title>
    <style>
        @page {
            margin: 1cm;
            size: A4;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .company-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 0.5px solid #000;
            padding: 4px;
            font-size: 8px;
            vertical-align: middle;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .numeric {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
            padding: 5px 0;
            border-top: 0.5px solid #000;
        }
        .info-section {
            margin-bottom: 10px;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">POS INDONESIA</div>
        <h2 style="margin: 5px 0; font-size: 12px;">LAPORAN ASSET AKTIF</h2>
        <p style="margin: 5px 0; font-size: 9px;">Periode: {{ now()->format('d F Y') }}</p>
    </div>

    <div class="info-section">
        @if($filters['category'] || $filters['lokasi'])
            <strong>Filter:</strong>
            @if($filters['category'])
                Kategori: {{ $filters['category'] }}
            @endif
            @if($filters['lokasi'])
                @if($filters['category']) | @endif
                Lokasi: {{ $filters['lokasi'] }}
            @endif
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 8%;">Kode Asset</th>
                <th style="width: 8%;">Kategori</th>
                <th style="width: 8%;">Lokasi</th>
                <th style="width: 10%;">Nama Asset</th>
                <th style="width: 8%;">Tgl Perolehan</th>
                <th style="width: 8%;">Pengguna</th>
                <th style="width: 5%;">Vol</th>
                <th style="width: 10%;">Harga (Rp)</th>
                <th style="width: 6%;">Spek</th>
                <th style="width: 6%;">Kualitas</th>
                <th style="width: 5%;">Masa<br>Manfaat</th>
                <th style="width: 5%;">Pemakaian</th>
                <th style="width: 10%;">Nilai Asset (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHarga = 0;
                $totalNilaiAsset = 0;
            @endphp

            @foreach($assets as $index => $asset)
                @php
                    $totalHarga += $asset->harga;
                    $totalNilaiAsset += $asset->nilai_asset ?? 0;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $asset->kode_asset }}</td>
                    <td>{{ $asset->category_barang->name }}</td>
                    <td>{{ $asset->lokasi_asset->name }}</td>
                    <td>{{ $asset->nama }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($asset->tanggal_perolehan)->format('d/m/Y') }}</td>
                    <td>{{ $asset->pengguna }}</td>
                    <td class="text-center">{{ $asset->volume }}</td>
                    <td class="numeric">{{ number_format($asset->harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $asset->spesifikasi }}</td>
                    <td class="text-center">{{ $asset->kualitas }}</td>
                    <td class="text-center">{{ $asset->masa_manfaat }}</td>
                    <td class="text-center">{{ $asset->pemakaian }}</td>
                    <td class="numeric">{{ number_format($asset->nilai_asset, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="8" style="text-align: center;"><strong>TOTAL</strong></td>
                <td class="numeric"><strong>{{ number_format($totalHarga, 0, ',', '.') }}</strong></td>
                <td colspan="4"></td>
                <td class="numeric"><strong>{{ number_format($totalNilaiAsset, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div style="width: 100%; margin-top: 30px;">
        <table style="width: 100%; border: none;">
            <tr style="border: none;">
                <td style="width: 33%; border: none; vertical-align: top; text-align: center;">
                    Dibuat Oleh,
                    <br><br><br><br>
                    ________________<br>
                    Staff Aset
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>