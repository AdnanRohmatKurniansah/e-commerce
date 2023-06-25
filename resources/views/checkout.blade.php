@extends('layout.main')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/"><span class="lnr lnr-arrow-right"></span>Home</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="" method="GET">
                            @csrf
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="fname">
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="last" name="lname">
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="pnumber">
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="email" class="form-control" id="email" name="email">
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" id="province" name="province" required>
                                    <label for="">-- Province -- </label>
                                    @foreach ($provinces as $province)
                                       <option value="{{ $province->id }}">{{ $province->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="regency" id="regency">
                                    <option>-- Regency --</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="district" id="district">
                                    <option>-- District --</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="village" id="village">
                                    <option>-- Village --</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="street">
                                <span class="placeholder" data-placeholder="Street Address"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <input type="checkbox" id="f-option3" name="selector" onclick="toggleForm()">
                                    <label for="f-option3">Ship to a different address?</label>
                                </div>
                                {{-- <div class="differentAddress" id="differentAddress" style="display: none">
                                    <div class="col-md-6 form-group p_star">
                                        <input type="text" class="form-control" id="first" name="fname">
                                        <span class="placeholder" data-placeholder="First name"></span>
                                    </div>
                                    <div class="col-md-6 form-group p_star">
                                        <input type="text" class="form-control" id="last" name="lname">
                                        <span class="placeholder" data-placeholder="Last name"></span>
                                    </div>
                                    <div class="col-md-6 form-group p_star">
                                        <input type="text" class="form-control" id="number" name="pnumber">
                                        <span class="placeholder" data-placeholder="Phone number"></span>
                                    </div>
                                    <div class="col-md-6 form-group p_star">
                                        <input type="email" class="form-control" id="email" name="email">
                                        <span class="placeholder" data-placeholder="Email Address"></span>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <select class="country_select" id="province" name="province" required>
                                            <label for="">-- Province -- </label>
                                            @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <select class="country_select" name="regency" id="regency">
                                            <option>-- Regency --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <select class="country_select" name="district" id="district">
                                            <option>-- District --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <select class="country_select" name="village" id="village">
                                            <option>-- Village --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="add2" name="street">
                                        <span class="placeholder" data-placeholder="Street Address"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                                    </div>
                                </div> --}}
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="courier" id="courier">
                                    <option value="">-- Courier -- </option>
                                    @foreach ($couriers as $courier => $value)
                                       <option value="{{ $courier }}">{{ $value }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @foreach ($carts as $cart)
                                    <li><a>{{ $cart->product_name }}<span class="middle">x {{ $cart->qty }}</span><span class="last">Rp. {{ number_format($cart->price, 0, ',', '.') }}</span></a></li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Subtotal <span>Rp. {{ number_format($subTotal, 0, ',', '.') }}</span></a></li>
                                <li><a>Weight<span> {{ $subWeight }} gram</span></a></li>
                                <li><a>Shipping  :
                                    <div class="input-group-icon my-3">
                                        <div class="form-select bg-light" id="default-select">
                                            <select name="shipping" id="shipping" required>
                                                <option value="cost">-- Select Service --</option>
                                            </select>
                                        </div>
                                    </div>
                                </a></li>
                                <li class="mt-5"><a>Total<span id="total">Rp. {{ number_format($subTotal, 0, ',', '.') }}</span></a></li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selector">
                                    <label for="f-option5">Check payments</label>
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                    Store Postcode.</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selector">
                                    <label for="f-option6">Paypal </label>

                                    <div class="check"></div>
                                </div>
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                    account.</p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector">
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            <a class="primary-btn" href="#">Proceed to Paypal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $(function() {
                $('#province').on('change', function() {
                    let id_province = $('#province').val();
                    $.ajax({
                        type: 'POST',
                        url: '/checkout/getRegencies',
                        data: {id_province: id_province},
                        cache: false,

                        success: function(msg) {
                            console.log("Received data:",msg);
                            $('#regency').html(msg).niceSelect('update');
                        },
                        error: function(data) {
                            console.log('error:', data)
                        },
                    })
                });

                $('#regency').on('change', function() {
                    let id_regency = $('#regency').val();
                    $.ajax({
                        type: 'POST',
                        url: '/checkout/getDistricts',
                        data: {id_regency: id_regency},
                        cache: false,

                        success: function(msg) {
                            console.log("Received data:",msg);
                            $('#district').html(msg).niceSelect('update');
                        },
                        error: function(data) {
                            console.log('error:', data)
                        },
                    })
                });

                $('#district').on('change', function() {
                    let id_district = $('#district').val();
                    $.ajax({
                        type: 'POST',
                        url: '/checkout/getVillages',
                        data: {id_district: id_district},
                        cache: false,

                        success: function(msg) {
                            console.log("Received data:",msg);
                            $('#village').html(msg).niceSelect('update');
                        },
                        error: function(data) {
                            console.log('error:', data)
                        },
                    })
                });
                
                $('#courier').on('change', function() {
                    let provinceId = $('select[name=province]').val();
                    let regencyId = $('select[name=regency]').val();
                    let weight = {{ $carts->sum('allWeight') }}; 
                    let courier = $('select[name=courier]').val();
                    $.ajax({
                        url: '/checkout/cost',
                        type: 'POST',
                        data: {
                            provinceId: provinceId,
                            regencyId: regencyId,
                            weight: weight,
                            courier: courier
                        },
                        cache: false,
                        success: function(response) {
                            console.log(response)
                            $('#shipping').empty();
                            $('#shipping').append('<option value="cost">-- Select Service --</option>');
                            $.each(response.services, function(index, service) {
                                let serviceName = service['service'];
                                let serviceCost = service['cost'][0]['value'];
                                let serviceEtd = service['cost'][0]['etd'];
                                let formattedServiceCost = formatRupiah(serviceCost);
                                let optionText = serviceName + ' | Rp. ' + formattedServiceCost + ' |  ' + serviceEtd;
                                $('#shipping').append('<option value="' + serviceCost + '">' + optionText + '</option>');
                                
                            });
                            $('#shipping').niceSelect('update');

                            $('#shipping').on('change', function() {
                                let subtotal = {{ $subTotal }};
                                let shippingCost = parseInt($('#shipping').val());
                                let total = subtotal + shippingCost;
                                $('#total').html('Total <span>Rp. ' + formatRupiah(total) + '</span>');
                            });
                        }
                    });
                });

                function formatRupiah(angka) {
                    let reverse = angka.toString().split('').reverse().join('');
                    let ribuan = reverse.match(/\d{1,3}/g);
                    let formatted = ribuan.join('.').split('').reverse().join('');
                    return formatted;
                }
            });
        });

        function toggleForm() {
            var shippingForm = document.getElementById("differentAddress");
            var checkbox = document.getElementById("f-option3");

            if (checkbox.checked) {
                shippingForm.style.display = "block";
            } else {
                shippingForm.style.display = "none";
            }
        }
    </script>

@endsection