@extends('dashboard.admin.index')
@section('content')
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Tabel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                            data-feather="archive"></i></span></span>Daftar Produk</h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="hk-sec-title">Tabel Produk</h5>
                    <p class="mb-40">Daftar produk yang tersedia</p>
                    <div class="row mb-3">
                        <div class="col-sm">
                            <a href="{{ route('create_admin_produk') }}" class="btn btn-primary">
                                <i class="icon-plus"></i> Tambah Produk
                            </a>
                        </div>
                    </div>
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
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($produk as $index => $product)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $product->nama }}</td>
                                                    <td>{{ $product->kategori->nama }}</td>
                                                    <td>
                                                        @if ($product->harga_setelah_diskon < $product->harga)
                                                            <span style="text-decoration: line-through; color: red;">
                                                                Rp{{ number_format($product->harga, 0, ',', '.') }}
                                                            </span>
                                                            <br>
                                                            <strong>Rp{{ number_format($product->harga_setelah_diskon, 0, ',', '.') }}</strong>
                                                        @else
                                                            <strong>Rp{{ number_format($product->harga, 0, ',', '.') }}</strong>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->stok }}</td>
                                                    <td>
                                                        <!-- Menampilkan gambar produk jika ada -->
                                                        @if ($product->image)
                                                            <img src="{{ $product->image_url }}"
                                                                alt="{{ $product->nama }}"
                                                                style="width: 100px; height: auto;">
                                                        @else
                                                            <span>No Image</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('edit_admin_produk', $product->id) }}"
                                                            class="mr-25" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        {{-- <a href="{{ route('products.destroy', $product->id) }}",
                                                            class="text-danger" data-toggle="tooltip"
                                                            data-original-title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                            <i class="icon-trash"></i>
                                                        </a> --}}
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
