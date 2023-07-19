@extends('layout.dashboard')

@section('content')   
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Order</h3>
            </div>
        </div>
    </div>
<div class="row mt-5" id="table-striped">
  <div class="col-12">
    <div class="print-pdf mb-4">
        <button id="print" class="btn btn-info">Print Pdf</button>
    </div>
    <div class="card" id="canvas">
      <div class="card-content">
        <div class="card-body">
            <h3 class="ml-3 mb-5"><span>No Invoice</span> : #INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h3>
                @if ($order->status != 'expired' && $order->status != 'process')
                    <form class="d-flex justify-content-end" action="/dashboard/orderProcess" method="post">
                        @method('PUT')
                        @csrf
                        @php
                            $resi = 'RS' . $order->created_at->format('dmy') . $order->regency . $order->id;
                        @endphp
                        <input type="hidden" value="{{ $order->id }}" name="id">
                        <input type="text" id="resi" required class="form-control w-25 mb-4 @error('resi') is-invalid @enderror" name="resi" placeholder="{{ $resi }}" value="{{ $resi }}">
                        @error('resi')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                        <button type="submit" class="btn btn-danger h-25">Process</button>
                    </form>
                @endif
            <div class="row order_d_inner">
                <div class="col">
                    <div class="details_item">
                        <h4>Customer Details</h4>
                        <ul class="list-unstyled m-3">
                            <li class="py-1"><a><span>First Name</span> : {{ $order->fname }}</a></li>
                            <li class="py-1"><a><span>Last Name</span> : {{ $order->lname }}</a></li>
                            <li class="py-1"><a><span>Phone Number</span> : {{ $order->pnumber }}</a></li>
                            <li class="py-1"><a><span>Email </span> : {{ $order->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="details_item">
                        <h4>Order Info</h4>
                        <ul class="list-unstyled m-3">
                            <li><a><span>No Resi</span> : {{ $order->resi == null ? 'No receipt' : $order->resi }}</a></li>
                            <li class="py-1"><a><span>Shipping</span> : {{ strtoupper($order->courier) }} | {{ $order->shipping_cost }} | {{ $order->service }}</a></li>
                            <li class="py-1"><a><span>Time Order</span> : {{ $order->created_at->format('d M Y h:i') }}</a></li>
                            <li><a><span>Due Date</span> : {{ \Carbon\Carbon::parse($order->due_date)->format('d M Y h:i') }}</a></li>
                            <li class="py-1"><a><span>Total</span> : Rp. {{ number_format($order->total, 0, ',', '.') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="details_item">
                        <h4>Shipping Address</h4>
                        <ul class="list-unstyled m-3">
                            <li class="py-1"><a><span>Street</span> : {{ $order->street }}</a></li>
                            @php
                                $province = \App\Models\Province::where('id', $order->province)->pluck('name')->first();
                            @endphp
                            <li class="py-1"><a><span>Province</span> : {{ $province }}</a></li>
                            @php
                                $regency = \App\Models\Regency::where('id', $order->regency)->pluck('name')->first();
                            @endphp
                            <li class="py-1"><a><span>Regency</span> : {{ $regency }}</a></li>
                            @php
                                $district = \App\Models\District::where('id', $order->district)->pluck('name')->first();
                            @endphp
                            <li class="py-1"><a><span>District</span> : {{ $district }}</a></li>
                            <li class="py-1"><a><span>Postcode </span> : {{ $order->zip }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="order_details_table">
                <h3>Order Details</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $products = $order->carts;
                            @endphp
                            @foreach ($products as $cart)
                                <tr>
                                    <td><p>{{ $cart->product_name }}</p></td>
                                    <td><h5>x {{ $cart->qty }}</h5></td>
                                    <td><p>Rp. {{ number_format($cart->price, 0, ',', '.') }}</p></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><h6>Subtotal</h6></td>
                                <td><h6></h6></td>
                                <td><p>Rp. {{ number_format($order->sub_total, 0, ',', '.') }}</p></td>
                            </tr>
                            <tr>
                                <td><h6>Shipping</h6></td>
                                <td><h6></h6></td>
                                <td><p>Rp. {{ number_format($order->shipping_cost, 0, ',', '.') }}</p></td>
                            </tr>
                            <tr>
                                <td><h6>Total</h6></td>
                                <td><h6></h6></td>
                                <td><p>Rp. {{ number_format($order->total, 0, ',', '.') }}</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
  let printLink = document.getElementById("print");
  let container = document.getElementById("canvas");

  printLink.addEventListener("click", event => {
    event.preventDefault();
    printContent(container);
  }, false);

  container.addEventListener("click", event => {
    printLink.style.display = "flex";
  }, false);

  function printContent(element) {
    var originalContents = document.body.innerHTML;
    var printContents = element.innerHTML;
    document.body.innerHTML = '<div style="margin-top: 80px">' + printContents + '</div>';
    window.print();
    document.body.innerHTML = originalContents;
  }
}, false);

</script>

@endsection