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
									<input id="category" value="{{ $category->id }}" class="pixel-radio" type="radio" name="category">
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
										<li class="filter-list">
											<input id="color-{{ $color }}" class="pixel-radio" value="{{ $color }}" type="radio" name="color"><label>{{ $color }}</label>
										</li>
									@endforeach
								</ul>
						</div>
						<div class="common-filter">
							<div class="head">Sizes</div>
							<div class="row">
								<div class="col-md-6">
								<ul>
									@foreach (collect($sizes)->take(10) as $size)
										<li class="filter-list">
											<input id="size-{{ $size }}" value="{{ $size }}" class="pixel-radio" type="radio" name="size">
											<label>{{ $size }}</label>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="col-md-6">
								<ul>
									@foreach (collect($sizes)->skip(10) as $size)
										<li class="filter-list">
											<input id="size-{{ $size }}" value="{{ $size }}" class="pixel-radio" type="radio" name="size">
											<label>{{ $size }}</label>
										</li>
									@endforeach
								</ul>
							</div>
							</div>
						</div>
						{{-- <div class="common-filter">
							<div class="head">Price</div>
							<div class="price-range-area">
								<div id="price-range"></div>
								<div class="value-wrapper d-flex">
									<div class="price">Price:</div>
									<span>Rp. </span>
									<div id="lower-value"></div>
									<div class="to">to</div>
									<span>Rp. </span>
									<div id="upper-value"></div>
								</div>
							</div>
						</div> --}}
					</div>
				</div>
				<div class="col-xl-9 col-lg-8 col-md-7">
					<div class="filter-bar d-flex flex-wrap align-items-center justify-content-end" style="height: 60px"></div>
					<section class="lattest-product-area pb-40 category-list">
						<div class="row" id="product-list">
							@if ($products->count())
							@foreach ($products as $product)
							<div class="col-lg-4 col-md-6">
								@php
									$colors = implode(', ', json_decode($product->color));
									$sizes = implode(', ', json_decode($product->size))
								@endphp
								<div class="single-product" id="category-{{ $product->category->name }}" data-category="{{ $product->category->id }}" data-color="{{ $colors }}" data-size="{{ $sizes }}">
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
							@else
								<div class="col-md-4 col-md-6 mx-auto">
									<h1 class="d-flex justify-content-center" style="margin: 300px 0" id="not-found" class="my-5">Not Found </h1>
								</div>
							@endif
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

	<script>
	document.addEventListener('DOMContentLoaded', function() {
	let categoryInputs = document.querySelectorAll('input[name="category"]');
	let colorInputs = document.querySelectorAll('input[name="color"]');
	let sizeInputs = document.querySelectorAll('input[name="size"]');

	categoryInputs.forEach(function(input) {
		input.addEventListener('change', function() {
		let selectedCategories = getSelectedValues(categoryInputs);
		filterProducts(selectedCategories);
		});
	});

	colorInputs.forEach(function(input) {
		input.addEventListener('change', function() {
		let selectedColors = getSelectedValues(colorInputs);
		filterColors(selectedColors);
		});
	});

	sizeInputs.forEach(function(input) {
		input.addEventListener('change', function() {
		let selectedSizes = getSelectedValues(sizeInputs);
		filterSizes(selectedSizes);
		});
	});

	function getSelectedValues(inputs) {
	let selectedValues = {
		categories: [],
		colors: [],
		sizes: []
	};

	inputs.forEach(function(input) {
		if (input.checked) {
		if (input.id.includes('category') && input.value !== 'all') {
			selectedValues.categories.push(input.value);
		} else if (input.id.includes('color') && input.value !== 'all') {
			selectedValues.colors.push(input.value);
		} else if (input.id.includes('size') && input.value !== 'all') {
			selectedValues.sizes.push(input.value);
		}
		}
	});

	return selectedValues;
	}


	function filterProducts(selectedCategories) {
		let url = '/filter-products'; 
		let params = { categories: selectedCategories };

		$.get(url, params)
		.done(function(response) {
			let productList = document.getElementById('product-list');
			if (productList) {
			productList.innerHTML = renderProductList(response);
			}
		})
		.fail(function(error) {
			console.log(error);
		});
	}

	function filterColors(selectedColors) {
	let url = '/filter-products';
	let params = { colors: selectedColors.colors };

	$.get(url, params)
		.done(function(response) {
		let productList = document.getElementById('product-list');
		if (productList) {
			productList.innerHTML = renderProductList(response);
		}
		})
		.fail(function(error) {
		console.log(error);
		});
	}

	function filterSizes(selectedSizes) {
	let url = '/filter-products';
	let params = { sizes: selectedSizes.sizes };

	$.get(url, params)
		.done(function(response) {
		let productList = document.getElementById('product-list');
		if (productList) {
			productList.innerHTML = renderProductList(response);
		}
		})
		.fail(function(error) {
		console.log(error);
		});
	}

	function renderProductList(products) {
	let html = '';
	
	if (products.length === 0) {
		html = '<h1 class="mx-auto" style="margin: 300px 0">Product Not Found</h1>'
	} else {
		products.forEach(function(product) {
		console.log(product)
		let colors = Array.isArray(product.color) ? product.color : [];
		let sizes = Array.isArray(product.size) ? product.size : [];
		let categoryId = product.category && product.category.id ? product.category.id : '';
		let imageUrl = '/storage/' + product.image;
		
		html += `
		<div class="col-lg-4 col-md-6">
			<div class="single-product" data-category="${categoryId}" data-color="${colors}" data-size="${sizes}">
			<img class="img-fluid" src="${imageUrl}" alt="">
			<div class="product-details">
				<h6>${product.name}</h6>
				<div class="price">
				<h6>RP. ${numberFormat(product.price)}</h6>
				</div>
				<div class="prd-bottom">
				<a href="/product/${product.slug}" class="social-info">
					<span class="lnr lnr-move"></span>
					<p class="hover-text">view more</p>
				</a>
				</div>
			</div>
			</div>
		</div>
		`;
	});
	}

	return html;
	}

	function numberFormat(number) {
		return number.toLocaleString('id-ID');
	}
	});

	</script>
	  

@endsection