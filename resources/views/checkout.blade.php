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
                        <form class="row contact_form" action="/doCheckout" method="post">
                            @csrf
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" value="{{ old('fname') }}" placeholder="First Name" required id="first" name="fname">
                                @error('fname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" value="{{ old('lname') }}" placeholder="Last Name" required id="last" name="lname">
                                @error('lname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('pnumber') is-invalid @enderror" value="{{ old('pnumber') }}" placeholder="Phone Number" required id="number" name="pnumber">
                                @error('pnumber')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email Address" required id="email" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <select class="country_select" name="regency" id="regency" required>
                                    <option>-- Regency --</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="district" id="district" required>
                                    <option>-- District --</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('street') is-invalid @enderror" value="{{ old('street') }}" placeholder="Street Address" id="add2" name="street" required>
                                @error('street')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip') }}" id="zip" name="zip" required placeholder="Postcode/ZIP">
                                @error('zip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <input type="checkbox" id="f-option3" name="ship_to" onclick="toggleForm()">
                                    <label for="f-option3">Ship to a different address?</label>
                                    <div class="row">
                                        <div class="differentAddress mt-3" id="differentAddress" style="display: none">
                                            <div class="col-md-12 form-group p_star">
                                                <input type="text" class="form-control" id="first" placeholder="First Name" name="difFname">
                                            </div>
                                            <div class="col-md-12 form-group p_star">
                                                <input type="text" class="form-control" id="last" placeholder="Last Name" name="difLname">
                                            </div>
                                            <div class="col-md-12 form-group p_star">
                                                <input type="text" class="form-control" id="number" name="difPnumber" placeholder="Phone Number">
                                            </div>
                                            <div class="col-md-12 form-group p_star">
                                                <input type="email" class="form-control" id="email" name="difEmail" placeholder="Email Address">
                                            </div>
                                            <div class="col-md-12 form-group p_star">
                                                <select class="country_select" id="difProvince" name="difProvince" required>
                                                    <label for="">-- Province -- </label>
                                                    @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group p_star">
                                                <select class="country_select" name="difRegency" id="difRegency">   
                                                    <option>-- Regency --</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group p_star">
                                                <select class="country_select" name="difDistrict" id="difDistrict">
                                                    <option>-- District --</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group p_star">
                                                <input type="text" class="form-control" id="add2" name="difStreet" placeholder="Street Address">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input type="text" class="form-control" id="zip" name="difZip" placeholder="Postcode/ZIP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <textarea class="form-control" name="note" id="note" rows="1" placeholder="Order Notes">{{ old('note') }}</textarea>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="courier" required id="courier">
                                    <option value=""> -- Courier -- </option>
                                    @foreach ($couriers as $courier => $value)
                                       <option value="{{ $courier }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li><a>Product <span>Total</span></a></li>
                                    @foreach ($carts as $cart)
                                        <input type="hidden" name="cart_ids[]" value="{{ $cart->id }}">
                                        <li><a>{{ Str::limit($cart->product_name, 10) }}<span class="middle">x {{ $cart->qty }}</span><span class="last">Rp. {{ number_format($cart->price, 0, ',', '.') }}</span></a></li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li><a>Subtotal <span>Rp. {{ number_format($subTotal, 0, ',', '.') }}</span></a></li>
                                    <li><a>Weight<span> {{ $subWeight }} gram</span></a></li>
                                    <li><a>Shipping  :
                                        <div class="input-group-icon my-3">
                                            <div class="form-select bg-light" id="default-select">
                                                <div class="service" id="service">

                                                </div>
                                                <select name="shipping" id="shipping" required>
                                                    <option value="cost">-- Select Service --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </a></li>
                                    <li class="mt-5"><a>Total<span id="total">Rp. {{ number_format($subTotal, 0, ',', '.') }}</span></a></li>
                                </ul>
                                <div class="creat_account">
                                    <input class="@error('term') is-invalid @enderror" type="checkbox" id="f-option4" name="term" required>
                                    @error('term')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                    <label for="f-option4">I’ve read and accept the </label>
                                    <a>terms & conditions*</a>
                                </div>
                                <button type="submit" class="primary-btn border-0 w-100">Order Now</button>
                            </form>
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

                $('#difProvince').on('change', function() {
                    let id_province = $('#difProvince').val();
                    $.ajax({
                        type: 'POST',
                        url: '/checkout/getRegencies',
                        data: {id_province: id_province},
                        cache: false,

                        success: function(msg) {
                            console.log("Received data:",msg);
                            $('#difRegency').html(msg).niceSelect('update');
                        },
                        error: function(data) {
                            console.log('error:', data)
                        },
                    })
                });

                $('#difRegency').on('change', function() {
                    let id_regency = $('#difRegency').val();
                    $.ajax({
                        type: 'POST',
                        url: '/checkout/getDistricts',
                        data: {id_regency: id_regency},
                        cache: false,

                        success: function(msg) {
                            console.log("Received data:",msg);
                            $('#difDistrict').html(msg).niceSelect('update');
                        },
                        error: function(data) {
                            console.log('error:', data)
                        },
                    })
                });

                $('#courier').on('change', function() {
                    let provinceId = $('#province').val();
                    let regencyId = $('#regency').val();
                    let weight = {{ $carts->sum('allWeight') }};
                    let courier = $('select[name=courier]').val();

                    if ($('#f-option3').is(':checked')) {
                        provinceId = $('#difProvince').val();
                        regencyId = $('#difRegency').val();
                    }
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
                                $('#shipping').append('<option value="' + optionText + '">' + optionText + '</option>');
                            });
                            $('#shipping').niceSelect('update');

                            $('#f-option3').on('change', function() {
                                if ($('#f-option3').is(':checked')) {
                                    $('#shipping').empty();
                                    $('#shipping').append('<option value="cost">-- Select Service --</option>');
                                    $('#courier').val('');
                                    $('#shipping').niceSelect('update');
                                    $('#courier').niceSelect('update');
                                } else {
                                    $('#shipping').empty();
                                    $.each(response.services, function(index, service) {
                                        let serviceName = service['service'];
                                        let serviceCost = service['cost'][0]['value'];
                                        let serviceEtd = service['cost'][0]['etd'];
                                        let formattedServiceCost = formatRupiah(serviceCost);
                                        let optionText = serviceName + ' | Rp. ' + formattedServiceCost + ' |  ' + serviceEtd;
                                        $('#shipping').append('<option value="' + optionText + '">' + optionText + '</option>');
                                    });
                                    $('#shipping').niceSelect('update');
                                    $('#courier').val(courier).niceSelect('update');
                                }
                            });

                            $('#shipping').on('change', function() {
                                let subtotal = {{ $subTotal }};
                                let values = $('#shipping').val()
                                let value = values.split(" | ")
                                console.log(value)
                                let shippingCost = parseInt(value[1].replace(/[^\d]/g, ''));
                                let total = subtotal + shippingCost;
                                $('#total').html('<span>Rp. ' + formatRupiah(total) + '</span>');
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