@extends('dashboard.reseller.layout.index')

@section('content')
    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex flex-column align-items-start mb-4">
                        <h3 class="fw-normal mb-2">Shopping Cart</h3>
                        <div class="mt-3">
                            <a href="{{ route('dashboard_reseller') }}" class="btn btn-secondary">Back</a>
                        </div>
                        {{-- <div>
                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                    class="text-body">price
                                    <i class="fas fa-angle-down mt-1"></i></a></p>
                        </div> --}}
                    </div>


                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (count($cart) > 0)
                        @foreach ($cart as $id => $item)
                            <div class="card rounded-3 mb-4" id="cart-item-{{ $id }}">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ $item['image_url'] }}" class="img-fluid rounded-3"
                                                alt="{{ $item['name'] }}">
                                        </div>

                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">{{ $item['name'] }}</p>
                                            <p><span class="text-muted">Size: </span>{{ $item['size'] ?? 'N/A' }} <span
                                                    class="text-muted">Color: </span>{{ $item['color'] ?? 'N/A' }}</p>
                                        </div>

                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2"
                                                onclick="updateQuantity({{ $id }}, 'decrease')">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input type="number" id="qty-{{ $id }}"
                                                value="{{ $item['quantity'] }}" min="1"
                                                class="form-control form-control-sm"
                                                oninput="saveQuantity({{ $id }})">

                                            <button class="btn btn-link px-2"
                                                onclick="updateQuantity({{ $id }}, 'increase')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                        <!-- Menampilkan nilai sessionStorage -->
                                        <p>Quantity tersimpan: <span id="saved-qty-{{ $id }}">-</span></p>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                let itemId = {{ $id }}; // Pastikan ini mendapatkan nilai yang benar
                                                let qtyInput = document.getElementById('qty-' + itemId);
                                                let savedQty = sessionStorage.getItem('qty-' + itemId);

                                                console.log("Item ID:", itemId);
                                                console.log("Saved Qty from sessionStorage:", savedQty);

                                                if (savedQty) {
                                                    qtyInput.value = savedQty;
                                                    document.getElementById('saved-qty-' + itemId).textContent = savedQty;
                                                }
                                            });

                                            function updateQuantity(id, action) {
                                                let qtyInput = document.getElementById('qty-' + id);
                                                let currentQty = parseInt(qtyInput.value);

                                                if (action === 'increase') {
                                                    currentQty++;
                                                } else if (action === 'decrease' && currentQty > 1) {
                                                    currentQty--;
                                                }

                                                qtyInput.value = currentQty;
                                                sessionStorage.setItem('qty-' + id, currentQty);
                                                document.getElementById('saved-qty-' + id).textContent = currentQty;

                                                console.log("Updated Quantity:", currentQty);
                                            }

                                            function saveQuantity(id) {
                                                let qtyInput = document.getElementById('qty-' + id);
                                                sessionStorage.setItem('qty-' + id, qtyInput.value);
                                                document.getElementById('saved-qty-' + id).textContent = qtyInput.value;

                                                console.log("Saved Quantity on Input:", qtyInput.value);
                                            }
                                        </script>


                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 id="price-{{ $id }}" class="mb-0"
                                                data-price="{{ $item['price'] }}">
                                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            </h5>
                                        </div>

                                        <!-- Remove Item -->
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="{{ route('cart.destroy', $id) }}" class="text-danger">
                                                <i class="fas fa-trash fa-lg"></i>
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2"><strong>Total</strong></p>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 id="total-price" class="mb-0">Rp {{ number_format($total, 0, ',', '.') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('cart.checkout') }}" method="POST" onsubmit="updateTotalInput()">
                                    @csrf
                                    <input type="hidden" name="total_harga" id="total-input">
                                    <button type="submit" class="btn btn-warning btn-block btn-lg">Checkout</button>
                                </form>
                            </div>
                        </div>

                        <script>
                            function updateTotalInput() {
                                let totalText = document.getElementById("total-price").innerText;
                                let totalValue = totalText.replace(/[^\d]/g, ""); // Menghapus "Rp" dan titik pemisah
                                document.getElementById("total-input").value = totalValue;
                            }
                        </script>
                    @else
                        <p>Your cart is empty.</p>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <script>
        function updateQuantity(productId, action) {
            let qtyInput = document.getElementById('qty-' + productId);
            let quantity = parseInt(qtyInput.value);

            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }

            qtyInput.value = quantity;

            updatePrice(productId, quantity);
            updateQuantityInDatabase(productId, quantity); // Update quantity in the database
        }

        function updateQuantityInDatabase(productId, quantity) {
            // Kirimkan permintaan AJAX untuk memperbarui quantity di server
            $.ajax({
                url: '/update-cart', // Ganti dengan URL yang sesuai di aplikasi Anda
                method: 'POST',
                data: {
                    productId: productId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}' // Pastikan CSRF token dikirim
                },
                success: function(response) {
                    // Tindakan setelah pembaruan berhasil
                    console.log('Cart updated successfully');
                },
                error: function(error) {
                    console.log('Error updating cart', error);
                }
            });
        }

        function updatePrice(productId, quantity) {
            let qtyInput = document.getElementById('qty-' + productId);
            let priceElement = document.getElementById('price-' + productId);
            let price = parseFloat(priceElement.getAttribute('data-price'));

            if (!price || quantity < 1) {
                console.error("Invalid price or quantity");
                return;
            }

            let newPrice = quantity * price;
            priceElement.innerText = 'Rp ' + formatPrice(newPrice);

            updateTotalPrice();
        }

        function updateTotalPrice() {
            let total = 0;

            // Menghitung total harga berdasarkan harga produk
            document.querySelectorAll('[id^="price-"]').forEach(function(item) {
                let itemPriceText = item.innerText.replace('Rp ', '').replace(/\./g, '').replace(',', '');
                let itemPrice = parseFloat(itemPriceText);

                if (!isNaN(itemPrice)) {
                    total += itemPrice;
                }
            });

            // Memperbarui total harga di tampilan
            document.getElementById('total-price').innerText = 'Rp ' + formatPrice(total);

            // Mengirimkan total harga ke server untuk diperbarui di database
            updateTotalHargaToServer(total);
        }

        // Fungsi untuk mengirim total harga ke server
        function updateTotalHargaToServer(total) {
            let orderId = document.getElementById('order-id').value; // Ambil orderId jika ada di elemen HTML

            fetch('/dashboard_reseller/cart/payment/' + orderId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        total: total
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Total updated successfully:', data);
                    // Update tampilan total harga setelah berhasil diupdate
                    document.getElementById('total-price').innerText = 'Rp ' + formatPrice(data.total);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function formatPrice(amount) {
            return amount.toLocaleString('id-ID');
        }

        function removeItem(productId) {
            const itemElement = document.getElementById('cart-item-' + productId);
            if (itemElement) {
                itemElement.remove();
            }
            updateTotalPrice();
        }
    </script>
@endsection
