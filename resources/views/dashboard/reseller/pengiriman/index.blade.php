@extends('dashboard.reseller.layout.index')

@section('content')
    <style>
        .container2 {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .tabs {
            padding: 10px 20px;
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            display: flex;
            gap: 20px;
        }

        .tab {
            color: #999;
            cursor: pointer;
        }

        .tab.active {
            font-size: 18px;
            font-weight: bold;
            color: black;
        }

        .product {
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .product:last-child {
            border-bottom: none;
        }

        .product-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-header .actions button {
            padding: 5px 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
            cursor: pointer;
            margin-left: 10px;
        }

        .product-body {
            display: flex;
            gap: 20px;
        }

        .product-body img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-body .details {
            flex-grow: 1;
        }

        .product-body .details h3 {
            margin: 0;
            font-size: 16px;
        }

        .product-body .details p {
            margin: 5px 0;
        }

        .product-body .details .price {
            font-weight: bold;
            color: #ff5722;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .buttons button {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .buttons .complete {
            background-color: #ff5722;
            color: #fff;
        }

        .buttons .return,
        .buttons .contact {
            background-color: #ddd;
            color: #666;
            margin-left: 10px;
        }
    </style>
    <script>
        function showTab(tabName) {
            const allProducts = document.querySelectorAll('.product');
            allProducts.forEach(product => {
                if (tabName === 'Semua' || product.classList.contains(tabName)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
        }
    </script>

    <div class="container2">
        <div class="tabs">
            <span id="Semua" class="tab active" onclick="showTab('Semua')">Semua</span>
            <span id="BelumBayar" class="tab" onclick="showTab('BelumBayar')">Belum Bayar</span>
            <span id="Dikemas" class="tab" onclick="showTab('Dikemas')">Sedang Dikemas</span>
            <span id="Selesai" class="tab" onclick="showTab('Selesai')">Selesai</span>
        </div>
        @foreach ($pengiriman as $index => $item)
            <div class="product {{ $item->pemesanan->status_pengiriman }}">
                <div class="product-header">
                    <span style="color: #ff5722; font-weight: bold;">Star+</span>
                    <span
                        style="margin-left: 10px; font-size: 18px; font-weight: bold;">{{ $item->produk->kategori->nama }}</span>
                </div>
                <div class="product-body">
                    @if ($item->produk->image)
                        <img src="{{ $item->produk->image_url }}" alt="{{ $item->produk->nama }}" style="width: 100px; height: auto;">
                    @else
                        <span>No Image</span>
                    @endif

                    <div class="details">
                        <h3>{{ $item->produk->nama }}</h3>
                        {{-- <p>Variasi:</p> --}}
                        <p class="price">
                        <p class="price">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
@endsection
