@extends('dashboard.reseller.layout.index')

@section('content')
    <header class="bg-light py-5 mt-0">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-black">
                <h1 class="display-4 fw-bolder">Catalog Product</h1>
                <p class="lead fw-normal text-black-50 mb-0">choose our product to shop</p>
            </div>
        </div>
    </header>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        @if ($product->is_sale)
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                            </div>
                        @endif
                        <img class="card-img-top" src="{{ $product->image_url }}" alt="{{ $product->nama }}" />

                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">{{ $product->nama }}</h5>

                                @if ($product->rating)
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            <div class="bi-star{{ $i < $product->rating ? '-fill' : '' }}"></div>
                                        @endfor
                                    </div>
                                @endif

                                {{-- Cek apakah harga mendapat diskon --}}
                                @php
                                    $diskon = 0;
                                    if ($product->harga > 100000) {
                                        $diskon = 20;
                                    } elseif ($product->harga > 50000) {
                                        $diskon = 10;
                                    } else {
                                        $diskon = 5;
                                    }
                                    $hargaSetelahDiskon = $product->harga - $product->harga * ($diskon / 100);
                                @endphp

                                @if ($diskon > 0)
                                    <span class="text-muted text-decoration-line-through">
                                        Rp{{ number_format($product->harga, 2, ',', '.') }}
                                    </span>
                                    <br>
                                    <span class="fw-bold text-danger">
                                        Rp{{ number_format($hargaSetelahDiskon, 2, ',', '.') }}
                                    </span>
                                @else
                                    <span class="fw-bold">
                                        Rp{{ number_format($product->harga, 2, ',', '.') }}
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-dark mt-auto">Add to cart</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
