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
            <div class="row">
                <div class="col-lg-3">
					<div class="sidebar-categories pb-5">
						<div class="head">My Account</div>
						<ul class="main-categories py-3">
							<li class="filter-list pb-2">
								<a href="/profile"><span class="lnr lnr-user pr-2 text-info" style="font-size: 18px; font-weight: 800"></span><u class="text-dark">Profile</u></a>
							</li>
							<li class="filter-list pb-2">
								<a href="/transaction"><span class="lnr lnr-cart text-danger pr-2" style="font-size: 18px; font-weight: 800"></span><u class="text-dark">Transaction</u></a>
							</li>
							<li class="filter-list pb-2">
								<a href="/change_password"><span class="lnr lnr-lock pr-2 text-secondary" style="font-size: 18px; font-weight: 800"></span><u class="text-dark">Change Password</u></a>
							</li>
							<li class="filter-list pb-2">
								<a href="/address"><span class="lnr lnr-home pr-2 text-dark" style="font-size: 18px; font-weight: 800"></span><u class="text-dark">Address</u></a>
							</li>
						</ul>
					</div>
				</div>
                <div class="col-lg-9">
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
                                            @foreach ($unpaid as $order)
                                                <div class="col-12 mb-3 p-3" style="border: 1px solid whitesmoke; box-shadow: 2px 2px 2px whitesmoke">
                                                    <div class="row" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                                        <div class="col">
                                                            <p>No Invoice : <a href="/invoice/{{ Crypt::encryptString($order->id) }}">#INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a></p>
                                                        </div>
                                                        <div class="col d-flex justify-content-end align-items-center">
                                                            <div class="status mr-3">
                                                                <h6 class="text-danger">{{ $order->status }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach ($order->carts as $cart)
                                                        <div class="info mt-2">
                                                            <div class="row pb-2" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                                                <div class="col-md-2 col-sm-4 col">
                                                                    <img width="100px" height="90px" src="{{ asset('storage/' . $cart->image) }}" alt="">
                                                                </div>
                                                                <div class="col-md-5 col-sm-4 col">
                                                                    <h5>{{ $cart->product_name }}</h5>
                                                                    <p>x {{ $cart->qty }}</p>
                                                                </div>
                                                                <div class="col-md-5 col-sm-4 col d-flex align-items-center justify-content-end">
                                                                    <p>Rp. {{ number_format($cart->price, 0, ',', '.') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach  
                                                    <div class="more d-flex justify-content-end p-2 mt-2">
                                                        <p class="my-auto"><span style="font-weight: 700">Order total: </span>Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
                                                    </div>                                                  
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="empty d-flex flex-column align-items-center">
                                                <h2 class="my-5 text-center">Transactions not found</h2>
                                            </div>                
                                        @endif
                                    </div>
                                @if ($unpaid->lastPage() > 1)
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
                                    @foreach ($paid as $order)
                                        <div class="col-12 mb-3 p-3" style="border: 1px solid whitesmoke; box-shadow: 2px 2px 2px whitesmoke">
                                            <div class="row" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                                <div class="col">
                                                    <p>No Invoice : <a href="/invoice/{{ Crypt::encryptString($order->id) }}">#INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a></p>
                                                </div>
                                                <div class="col d-flex justify-content-end align-items-center">
                                                    <div class="status mr-2">
                                                        <h6 class="text-danger">{{ $order->status }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($order->carts as $cart)
                                            <div class="info mt-2">
                                                <div class="row pb-2" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                                    <div class="col-md-2 col-sm-4 col">
                                                        <img width="100px" height="90px" src="{{ asset('storage/' . $cart->image) }}" alt="">
                                                    </div>
                                                    <div class="col-md-5 col-sm-4 col">
                                                        <h5>{{ $cart->product_name }}</h5>
                                                        <p>x {{ $cart->qty }}</p>
                                                    </div>
                                                    <div class="col-md-5 col-sm-4 col d-flex align-items-center justify-content-end">
                                                        <p>Rp. {{ number_format($cart->price, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach  
                                            <div class="more d-flex justify-content-end p-2 mt-2">
                                                <p class="my-auto"><span style="font-weight: 700">Order total: </span>Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
                                            </div>                                                
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="empty d-flex flex-column align-items-center">
                                        <h2 class="my-5 text-center">Transactions not found</h2>
                                    </div>                
                                    @endif
                                </div>
                                @if ($paid->lastPage() > 1)
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
                                    @foreach ($process as $order)
                                    <div class="col-12 mb-3 p-3" style="border: 1px solid whitesmoke; box-shadow: 2px 2px 2px whitesmoke">
                                        <div class="row" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                            <div class="col">
                                                <p>No Invoice : <a href="/invoice/{{ Crypt::encryptString($order->id) }}">#INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a></p>
                                            </div>
                                            <div class="col d-flex justify-content-end align-items-center">
                                                <div class="status mr-3">
                                                    <h6 class="text-danger">{{ $order->status }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($order->carts as $cart)
                                            <div class="info mt-2">
                                                <div class="row pb-2" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                                    <div class="col-md-2 col-sm-4 col">
                                                        <img width="100px" height="90px" src="{{ asset('storage/' . $cart->image) }}" alt="">
                                                    </div>
                                                    <div class="col-md-5 col-sm-4 col">
                                                        <h5>{{ $cart->product_name }}</h5>
                                                        <p>x {{ $cart->qty }}</p>
                                                    </div>
                                                    <div class="col-md-5 col-sm-4 col d-flex align-items-center justify-content-end">
                                                        <p>Rp. {{ number_format($cart->price, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach  
                                        <div class="more d-flex justify-content-end p-2 mt-2">
                                            <p class="my-auto"><span style="font-weight: 700">Order total: </span>Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
                                        </div>                                                  
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="empty d-flex flex-column align-items-center">
                                        <h2 class="my-5 text-center">Transactions not found</h2>
                                    </div>                
                                    @endif
                                </div>
                                @if ($process->lastPage() > 1)
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
                                        @foreach ($finished as $order)
                                            <div class="col-12 mb-3 p-3" style="border: 1px solid whitesmoke; box-shadow: 2px 2px 2px whitesmoke">
                                                <div class="row" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                                    <div class="col">
                                                        <p>No Invoice : <a href="/invoice/{{ Crypt::encryptString($order->id) }}">#INV{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a></p>
                                                    </div>
                                                    <div class="col d-flex justify-content-end align-items-center">
                                                        <div class="status mr-3">
                                                            <h6 class="text-danger">{{ $order->status }}</h6>
                                                        </div>
                                                        <div class="review mb-2">
                                                            <button class="bg-info border-0 text-light px-2 py-1" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-star"></i> Review</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach ($order->carts as $cart)
                                                <div class="info mt-2">
                                                    <div class="row pb-2" style="border-bottom: 1px solid rgb(221, 220, 220)">
                                                        <div class="col-md-2 col-sm-4 col">
                                                            <img width="100px" height="90px" src="{{ asset('storage/' . $cart->image) }}" alt="">
                                                        </div>
                                                        <div class="col-md-5 col-sm-4 col">
                                                            <h5>{{ $cart->product_name }}</h5>
                                                            <p>x {{ $cart->qty }}</p>
                                                        </div>
                                                        <div class="col-md-5 col-sm-4 col d-flex align-items-center justify-content-end">
                                                            <p>Rp. {{ number_format($cart->price, 0, ',', '.') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach  
                                            <div class="more d-flex justify-content-end p-2 mt-2">
                                                <p class="my-auto"><span style="font-weight: 700">Order total: </span>Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
                                            </div>                                                 
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="empty d-flex flex-column align-items-center">
                                        <h2 class="my-5 text-center">Transactions not found</h2>
                                    </div>                
                                    @endif
                                </div>
                                @if ($finished->lastPage() > 1)
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
            </div>
        </div>
    </section>

    @foreach ($finished as $order)
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
    @endforeach

@endsection 