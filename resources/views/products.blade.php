@extends('layout.main') 

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="/"><span class="lnr lnr-arrow-right"></span>Home</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5 mb-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories mt-3">
						@foreach ($categories as $category)
							<li class="filter-list">
								<input class="pixel-radio" type="radio" name="category">
								<label>{{ $category->name }}</label>
							</li>
						@endforeach
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>
					<div class="common-filter">
						<div class="head">Colors</div>
							<ul>
								@foreach ($colors as $color)
									<li class="filter-list"><input class="pixel-radio" type="radio" name="color"><label>{{ $color }}</label></li>
								@endforeach
							</ul>
					</div>
					<div class="common-filter">
						<div class="head">Color</div>
						<div class="row">
							<div class="col-md-6">
							<ul>
								@foreach (collect($sizes)->take(10) as $size)
									<li class="filter-list">
										<input class="pixel-radio" type="radio" name="size">
										<label>{{ $size }}</label>
									</li>
								@endforeach
							</ul>
						</div>
						<div class="col-md-6">
							<ul>
								@foreach (collect($sizes)->skip(10) as $size)
									<li class="filter-list">
										<input class="pixel-radio" type="radio" name="size">
										<label>{{ $size }}</label>
									</li>
								@endforeach
							</ul>
						</div>
						</div>
					</div>
					<div class="common-filter">
						<div class="head">Price</div>
						<div class="price-range-area">
							<div id="price-range"></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span>
								<div id="lower-value"></div>
								<div class="to">to</div>
								<span>$</span>
								<div id="upper-value"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<div class="filter-bar d-flex flex-wrap align-items-center justify-content-end" style="height: 70px"></div>
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						@foreach ($products as $product)
							<div class="col-lg-4 col-md-6">
								<div class="single-product">
									<img class="img-fluid" src="{{ asset('storage/'. $product->image) }}" alt="">
									<div class="product-details">
										<h6>{{ $product->name }}</h6>
										<div class="price">
											<h6>RP. {{ number_format($product->price, 0, ',', '.') }}</h6>
										</div>
										<div class="prd-bottom">
											<a href="/product/{{ $product->slug }}" class="social-info">
												<span class="lnr lnr-move"></span>
												<p class="hover-text">view more</p>
											</a>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</section>
				<div class="filter-bar d-flex flex-wrap align-items-center justify-content-center">
					<ul class="pagination">
						<li class="page-item {{ ($products->currentPage() == 1) ? 'disabled' : '' }}">
							<a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
						</li>
						@foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
							<li class="page-item {{ ($products->currentPage() == $page) ? 'active' : '' }}">
								<a class="page-link" href="{{ $url }}">{{ $page }}</a>
							</li>
						@endforeach
						<li class="page-item {{ ($products->currentPage() == $products->lastPage()) ? 'disabled' : '' }}">
							<a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
						</li>
					</ul>
				</div>
				
			</div>
		</div>
	</div>
	
@endsection