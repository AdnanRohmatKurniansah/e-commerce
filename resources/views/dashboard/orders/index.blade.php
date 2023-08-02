@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Orders</h3> 
            </div>
        </div>
    </div>

<div class="row mt-5" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
        </div>
        <div class="table-responsive">
          <table class="table table-striped mb-0" id="table1">
            <thead>
              <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th>No Resi</th>
                <th>Total</th>
                <th>Time Order</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)  
              @php
                  $class = '';
                  if ($order->status == 'paid') {
                      $class = 'bg-success text-white';
                  } elseif ($order->status == 'unpaid') {
                      $class = 'bg-danger text-white';
                  } elseif ($order->status == 'process') {
                      $class = 'bg-warning text-white';
                  } elseif ($order->status == 'finished') {
                      $class = 'bg-info text-white';
                  } else {
                      $class = 'bg-dark text-white';
                  }
              @endphp
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                  <td>{{ $order->resi == null ? 'No receipt' : $order->resi }}</td>
                  <td>Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
                  <td>{{ $order->created_at->format('d M Y h:i') }}</td>
                  <td>{{ \Carbon\Carbon::parse($order->due_date)->format('d M Y h:i') }}</td>
                  <td><span class="badge {{ $class }}">{{ $order->status }}</span></td>
                  <td style="vertical-align: middle; text-align: center;">
                    <a href="/dashboard/order/{{ Crypt::encryptString($order->id) }}"><i class="badge-circle badge-circle-light-secondary" data-feather="eye"></i></a>
                    @if ($order->status == 'expired')
                      <form action="/dashboard/orders/{{ $order->id }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="my-1" style="border-bottom: 1px solid gray"></div>
                        <button class="badge-circle badge-circle-light-secondary text-red border-0" style="background-color: transparent" onclick="return confirm('Remove this order?')" type="submit">
                          <i data-feather="trash"></i>
                        </button>
                      </form>
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
</div>

</div>

@endsection