@extends('layout.main')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Transactions</h1>
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
                    @if ($orders->isEmpty())
                        <h2 class="my-5 text-center">You haven't made any transactions yet</h2>
                    @else
                </div>                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Order date</th>
                                <th scope="col">Shipping cost</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order) 
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="media-body">
                                            <p>{{ implode(', ', $order->carts->pluck('product_name')->toArray()) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{ implode(', ', $order->carts->pluck('qty')->toArray()) }}</h5>
                                </td>
                                <td>
                                    <h5>{{ $order->created_at->format('d M Y') }}</h5>
                                </td>                        
                                <td>
                                    <h5>RP. {{ number_format($order->shipping_cost, 0, ',', '.') }}</h5>
                                </td>
                                <td>
                                    <h5>RP. {{ number_format($order->total, 0, ',', '.') }}</h5>
                                </td>
                                @php
                                    $status = $order->status;
                                    $class = $status == 'paid' ? 'text-success ' : 'text-danger';
                                @endphp
                                <td>
                                    <h5 class="{{ $class }}">{{ $order->status }}</h5>
                                </td>
                                <td>
                                    <a class="bg-info text-light p-2" href="/invoice/{{ Crypt::encryptString($order->id) }}">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @if ($orders->perPage() > 10)
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <ul class="pagination">
                        <li class="page-item {{ ($orders->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
                        </li>
                        @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                            <li class="page-item {{ ($orders->currentPage() == $page) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ ($orders->currentPage() == $orders->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endsection