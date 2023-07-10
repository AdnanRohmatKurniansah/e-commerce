@extends('layout.main')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/"><span class="lnr lnr-arrow-right"></span>Home</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="empty d-flex flex-column align-items-center">
                    @if ($carts->isEmpty())
                        <h2 class="my-5 text-center">You haven't added any items to your cart yet</h2>
                        <a href="/products" class="primary-btn rounded-0">Shop Now</a>
                    @else
                </div>                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart) 
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $cart->image) }}" style="max-width: 50px" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $cart->product_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>RP. {{ number_format($cart->price, 0, ',', '.') }}</h5>
                                </td>
                                <td>
                                    <h5>{{ $cart->color }}</h5>
                                </td>
                                <td>
                                    <h5>{{ $cart->size }}</h5>
                                </td>
                                <td>
                                    <div class="product_count" id="product_count_{{ $cart->id }}">
                                        <input type="text" name="qty" id="sst{{ $cart->id }}" maxlength="12" value="{{ $cart->qty }}" title="Quantity:" class="input-text qty">
                                        <button onclick="increaseQuantity({{ $cart->id }})" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="decreaseQuantity({{ $cart->id }})" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                </td>                                
                                <td>
                                    <h5>RP. {{ number_format($cart->total, 0, ',', '.') }}</h5>
                                </td>
                                <td>
                                    <form action="/remove_cart/{{ $cart->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Remove this item in your cart?')" class="primary-btn border-0 rounded-0">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><h5>Subtotal</h5></td>
                                <td><h5>RP. {{ number_format($subTotal, 0, ',', '.') }}</h5></td>
                            </tr>
                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="/products">Continue Shopping</a>
                                        <a class="primary-btn" href="/checkout">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            @if ($carts->perPage() > 10)
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <ul class="pagination">
                        <li class="page-item {{ ($carts->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $carts->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
                        </li>
                        @foreach ($carts->getUrlRange(1, $carts->lastPage()) as $page => $url)
                            <li class="page-item {{ ($carts->currentPage() == $page) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ ($carts->currentPage() == $carts->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $carts->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
            @endif

        </div>
    </section>
    
    <script>
        function increaseQuantity(cartId) {
            var quantityInput = document.getElementById('sst' + cartId);
            var currentQuantity = parseInt(quantityInput.value);
            quantityInput.value = currentQuantity + 1;
    
            updateCart(cartId, quantityInput.value);
        }
    
        function decreaseQuantity(cartId) {
            var quantityInput = document.getElementById('sst' + cartId);
            var currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
                updateCart(cartId, quantityInput.value);
            }
        }
    
        function updateCart(cartId, newQuantity) {
            var url = '/update_cart/' + cartId;
            var data = {
                qty: newQuantity
            };
    
            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error(error);
            });
        }
    </script>
    

@endsection