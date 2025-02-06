@extends('dashboard.admin.index')
@section('content')
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Tabel</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin_produk') }}">Daftar Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                            data-feather="archive"></i></span></span>Edit Produk</h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="hk-sec-title">Form Edit Produk</h5>
                    <p class="mb-40">Edit data produk yang telah ada</p>
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
                    <!-- Form -->
                    <form action="{{ route('update_admin_produk', $produk->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $produk->nama }}" placeholder="Nama Produk" required>
                        </div>

                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>
                            <select class="form-control" id="id_kategori" name="id_kategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $kate)
                                    <option value="{{ $kate->id }}"
                                        {{ $produk->id_kategori == $kate->id ? 'selected' : '' }}>
                                        {{ $kate->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                value="{{ $produk->harga }}" placeholder="Harga Produk" required>
                        </div>

                        <div class="form-group">
                            <label for="harga_setelah_diskon">Harga Setelah Diskon</label>
                            <input type="number" class="form-control" id="harga_setelah_diskon" name="harga_setelah_diskon"
                                value="{{ $produk->harga_setelah_diskon ?? 0 }}" placeholder="Harga Setelah Diskon"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok"
                                value="{{ $produk->stok }}" placeholder="Stok Produk" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Gambar Produk</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>

                        @if ($produk->image)
                            <div class="form-group">
                                <label>Gambar Saat Ini</label>
                                <img src="{{ $produk->image_url }}" style="width: 100px; height: auto;">
                            </div>
                        @else
                            <div class="form-group">
                                <label>Gambar Saat Ini</label>
                                <span>No Image</span>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->
    <script>
        // Function to calculate the discount based on the price
        function calculateDiscount() {
            var harga = parseFloat(document.getElementById('harga').value);
            var diskon = 0;

            // Discount logic
            if (harga > 100000) {
                diskon = 20;
            } else if (harga > 50000) {
                diskon = 10;
            } else {
                diskon = 5;
            }

            // Calculate the price after discount
            var hargaSetelahDiskon = harga - (harga * (diskon / 100));

            // Display the discounted price
            document.getElementById('harga_setelah_diskon').value = hargaSetelahDiskon.toFixed(2);
        }

        // Event listener to call calculateDiscount when the harga field is changed
        document.getElementById('harga').addEventListener('input', calculateDiscount);

        // Initialize the discount calculation on page load
        calculateDiscount();
    </script>
@endsection
