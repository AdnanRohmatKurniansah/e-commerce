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

    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="unpaid-tab" data-toggle="tab" href="#unpaid" role="tab" aria-controls="unpaid"
                     aria-selected="false">Unpaid</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="paid-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="paid"
                     aria-selected="false">Paid</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="process-tab" data-toggle="tab" href="#process" role="tab" aria-controls="process"
                     aria-selected="false">Process</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="finish-tab" data-toggle="tab" href="#finish" role="tab" aria-controls="finish"
                     aria-selected="false">Finished</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="unpaid" role="tabpanel" aria-labelledby="unpaid-tab">
                    <div class="container mt-2">
                        <div class="cart_inner">
                                @php
                                    $id = Auth::id();
                                    $unpaid = \App\Models\Order::where('user_id', '=', $id)
                                        ->where(function ($query) {
                                        $query->where('status', 'unpaid')
                                            ->orWhere('status', 'expired');
                                        })
                                        ->orderBy('id', 'desc')
                                        ->paginate(10);
                                @endphp
                            @if ($unpaid->count())
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">No Invoice</th>
                                                <th scope="col">No Resi</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Order date</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Due date</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($unpaid as $order) 
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <a href="/invoice/{{ Crypt::encryptString($order->id) }}">INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a>
                                                </td>
                                                <td>
                                                    {{ $order->resi == null ? 'No receipt' : $order->resi }}
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
                                                    <h5>{{ $order->created_at->format('d M Y h:i') }}</h5>
                                                </td>                        
                                                <td>
                                                    <h5>RP. {{ number_format($order->total, 0, ',', '.') }}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{ \Carbon\Carbon::parse($order->due_date)->format('d M Y h:i') }}</h5>
                                                </td>
                                                <td>
                                                    @php
                                                        $class = $order->status == 'unpaid' ? 'text-danger' : 'text-secondary   '
                                                    @endphp
                                                    <h5 class="{{ $class }}">{{ $order->status }}</h5>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                            <div class="empty d-flex flex-column align-items-center">
                                <h2 class="my-2 text-center">Transactions not found</h2>
                            </div>                
                            @endif
                        </div>
                        @if ($unpaid->perPage() > 10)
                            <div class="d-flex flex-wrap align-items-center justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item {{ ($unpaid->currentPage() == 1) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $unpaid->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
                                    </li>
                                    @foreach ($unpaid->getUrlRange(1, $unpaid->lastPage()) as $page => $url)
                                        <li class="page-item {{ ($unpaid->currentPage() == $page) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item {{ ($unpaid->currentPage() == $unpaid->lastPage()) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $unpaid->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                    <div class="container mt-2">
                        <div class="cart_inner">
                                @php
                                    $paid = \App\Models\Order::where('user_id', '=', $id)
                                        ->where('status', 'paid')
                                        ->orderBy('id', 'desc')
                                        ->paginate(10);
                                @endphp
                            @if ($paid->count())
                                <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">No Invoice</th>
                                                    <th scope="col">No Resi</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Order date</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Due date</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($paid as $order) 
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        <a href="/invoice/{{ Crypt::encryptString($order->id) }}">INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $order->resi == null ? 'No receipt' : $order->resi }}
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
                                                        <h5>{{ $order->created_at->format('d M Y h:i') }}</h5>
                                                    </td>                        
                                                    <td>
                                                        <h5>RP. {{ number_format($order->total, 0, ',', '.') }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5>{{ \Carbon\Carbon::parse($order->due_date)->format('d M Y h:i') }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="text-success">{{ $order->status }}</h5>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            @else
                            <div class="empty d-flex flex-column align-items-center">
                                <h2 class="my-2 text-center">Transactions not found</h2>
                            </div>                
                            @endif
                        </div>
                        @if ($paid->perPage() > 10)
                            <div class="d-flex flex-wrap align-items-center justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item {{ ($paid->currentPage() == 1) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $paid->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
                                    </li>
                                    @foreach ($paid->getUrlRange(1, $paid->lastPage()) as $page => $url)
                                        <li class="page-item {{ ($paid->currentPage() == $page) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item {{ ($paid->currentPage() == $paid->lastPage()) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $paid->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="process" role="tabpanel" aria-labelledby="process-tab">
                    <div class="container mt-2">
                        <div class="cart_inner">
                                @php
                                    $process = \App\Models\Order::where('user_id', '=', $id)
                                        ->where('status', 'process')
                                        ->orderBy('id', 'desc')
                                        ->paginate(10);
                                @endphp
                            @if ($process->count())
                                <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">No Invoice</th>
                                                    <th scope="col">No Resi</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Order date</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Due date</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($process as $order) 
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        <a href="/invoice/{{ Crypt::encryptString($order->id) }}">INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $order->resi == null ? 'No receipt' : $order->resi }}
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
                                                        <h5>{{ $order->created_at->format('d M Y h:i') }}</h5>
                                                    </td>                        
                                                    <td>
                                                        <h5>RP. {{ number_format($order->total, 0, ',', '.') }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5>{{ \Carbon\Carbon::parse($order->due_date)->format('d M Y h:i') }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="text-warning">{{ $order->status }}</h5>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            @else
                            <div class="empty d-flex flex-column align-items-center">
                                <h2 class="my-2 text-center">Transactions not found</h2>
                            </div>                
                            @endif
                        </div>
                        @if ($process->perPage() > 10)
                            <div class="d-flex flex-wrap align-items-center justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item {{ ($process->currentPage() == 1) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $process->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
                                    </li>
                                    @foreach ($process->getUrlRange(1, $process->lastPage()) as $page => $url)
                                        <li class="page-item {{ ($process->currentPage() == $page) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item {{ ($process->currentPage() == $process->lastPage()) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $process->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="finish" role="tabpanel" aria-labelledby="finish-tab">
                    <div class="container mt-2">
                        <div class="cart_inner">
                                @php
                                    $finished = \App\Models\Order::where('user_id', '=', $id)
                                        ->where('status', 'finished')
                                        ->orderBy('id', 'desc')
                                        ->paginate(10);
                                @endphp
                            @if ($finished->count())
                                <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">No Invoice</th>
                                                    <th scope="col">No Resi</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Order date</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Due date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($finished as $order) 
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        <a href="/invoice/{{ Crypt::encryptString($order->id) }}">INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $order->resi == null ? 'No receipt' : $order->resi }}
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
                                                        <h5>{{ $order->created_at->format('d M Y h:i') }}</h5>
                                                    </td>                        
                                                    <td>
                                                        <h5>RP. {{ number_format($order->total, 0, ',', '.') }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5>{{ \Carbon\Carbon::parse($order->due_date)->format('d M Y h:i') }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="text-info">{{ $order->status }}</h5>
                                                    </td>
                                                    <td>
                                                        <button class=" bg-info border-0 text-light p-2" data-toggle="modal" data-target="#exampleModal" href="/invoice/{{ Crypt::encryptString($order->id) }}">Review</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            @else
                            <div class="empty d-flex flex-column align-items-center">
                                <h2 class="my-2 text-center">Transactions not found</h2>
                            </div>                
                            @endif
                        </div>
                        @if ($finished->perPage() > 10)
                            <div class="d-flex flex-wrap align-items-center justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item {{ ($finished->currentPage() == 1) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $finished->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
                                    </li>
                                    @foreach ($finished->getUrlRange(1, $finished->lastPage()) as $page => $url)
                                        <li class="page-item {{ ($finished->currentPage() == $page) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item {{ ($finished->currentPage() == $finished->lastPage()) ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $finished->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add a review</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="row contact_form" action="/addReview" method="post" id="contactForm">
            @csrf
                <div class="form-row">
                    <div class="form-group pl-4 pb-3 col-12">
                        <div class="form-check">
                            @php
                                $products = $order->carts;
                            @endphp
                            @foreach ($products as $product)
                                <input type="checkbox" name="product_id" required value="{{ $product->product_id }}" class="form-check-input @error('product_id') is-invalid @enderror" id="checkbox">
                                <label class="form-check-label" for="checkbox">{{ $product->product_name }}</label>
                                @error('product_id')
                                    <div class="invalid-feedback">  
                                    {{ $message }}
                                    </div>
                                @enderror
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h6>Your review :</h6>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                            <input type="radio" id="star1" name="rating" value="1" checked />
                            <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                          </div>
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
                        @error('message')
                            <div class="invalid-feedback">  
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>

@endsection 