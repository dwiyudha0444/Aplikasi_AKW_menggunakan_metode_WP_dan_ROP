@extends('dashboard.admin.index')
@section('content')
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title">
                <span class="pg-title-icon">
                    <span class="feather-icon"><i data-feather="credit-card"></i></span>
                </span>
                Daftar Transaksi
            </h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="hk-sec-title">Tabel Transaksi</h5>
                    <a href="{{ route('penjualan.exportPDF') }}" class="btn btn-danger mb-3">Print Pemesanan</a>
                    <a href="{{ route('penjualan.exportPdfProduk') }}" class="btn btn-warning mb-3">Print Detail Pemesanan Produk</a>


                    <p class="mb-40">Daftar transaksi pemesanan yang dilakukan oleh reseller.</p>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <table class="table table-hover table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reseller</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Status Pemesanan</th>
                                                <th>Total Harga</th>
                                                <th>Bukti Transfer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pemesanan as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        <span
                                                            class="badge 
        @if ($item->status_pemesanan == 'Pending') badge-warning
        @elseif($item->status_pemesanan == 'Selesai') badge-success
        @elseif($item->status_pemesanan == 'Dibatalkan') badge-danger @endif">
                                                            {{ $item->status_pemesanan }}
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if ($item->bukti_transfer)
                                                            <a href="{{ asset('uploads/' . $item->bukti_transfer) }}"
                                                                target="_blank">
                                                                <img src="{{ asset('uploads/' . $item->bukti_transfer) }}"
                                                                    width="50" height="50">
                                                            </a>
                                                        @else
                                                            <span class="text-danger">Belum ada</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->

    </div>
    <!-- /Container -->
@endsection
