@extends('layout.main')

@section('content')

<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">
                    @foreach ($slides as $slide)
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>{{ $slide->heading }}</h1>
                                    <p>{!! $slide->subHeading !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="{{ asset('storage/' . $slide->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-area section_gap">
    <div class="container">
        <div class="row features-inner">
            @foreach ($features as $feature) 
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('storage/' . $feature->image) }}" alt="">
                        </div>
                        <h6>{{ $feature->title }}</h6>
                        <p>{{ $feature->desc }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="category-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $galleries[0]->image) }}" alt="">
                            <a href="{{ asset('storage/' . $galleries[0]->image) }}" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">{{ $galleries[0]->text }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $galleries[1]->image) }}" alt="">
                            <a href="{{ asset('storage/' . $galleries[1]->image) }}" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">{{ $galleries[1]->text }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $galleries[2]->image) }}" alt="">
                            <a href="{{ asset('storage/' . $galleries[2]->image) }}" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">{{ $galleries[2]->text }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $galleries[3]->image) }}" alt="">
                            <a href="{{ asset('storage/' . $galleries[3]->image) }}" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">{{ $galleries[3]->text }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" src="{{ asset('storage/' . $galleries[4]->image) }}" alt="">
                    <a href="{{ asset('storage/' . $galleries[4]->image) }}" class="img-pop-up" target="_blank">
                        <div class="deal-details">
                            <h6 class="deal-title">{{ $galleries[4]->text }}</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="owl-carousel section_gap">
    <div class="single-product">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Latest Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product) 
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="">
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
        </div>
    </div>
</section>

{{-- <section class="exclusive-deal-area">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1>Exclusive Hot Deal Ends Soon!</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="row clock-wrap">
                            <div class="col clockinner1 clockinner">
                                <h1 class="days">150</h1>
                                <span class="smalltext">Days</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="hours">23</h1>
                                <span class="smalltext">Hours</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="minutes">47</h1>
                                <span class="smalltext">Mins</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="seconds">59</h1>
                                <span class="smalltext">Secs</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="primary-btn">Shop Now</a>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="active-exclusive-product-slider">
                    <div class="single-exclusive-slider">
                        <img class="img-fluid" src="/assets/img/product/e-p1.png" alt="">
                        <div class="product-details">
                            <div class="price">
                                <h6>$150.00</h6>
                                <h6 class="l-through">$210.00</h6>
                            </div>
                            <h4>addidas New Hammer sole
                                for Sports person</h4>
                            <div class="add-bag d-flex align-items-center justify-content-center">
                                <a class="add-btn" href=""><span class="ti-bag"></span></a>
                                <span class="add-text text-uppercase">Add to Bag</span>
                            </div>
                        </div>
                    </div>
                    <div class="single-exclusive-slider">
                        <img class="img-fluid" src="/assets/img/product/e-p1.png" alt="">
                        <div class="product-details">
                            <div class="price">
                                <h6>$150.00</h6>
                                <h6 class="l-through">$210.00</h6>
                            </div>
                            <h4>addidas New Hammer sole
                                for Sports person</h4>
                            <div class="add-bag d-flex align-items-center justify-content-center">
                                <a class="add-btn" href=""><span class="ti-bag"></span></a>
                                <span class="add-text text-uppercase">Add to Bag</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="brand-area section_gap mb-5 pt-0">
    <div class="container">
        <div class="row">
            @foreach ($brands as $brand)   
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('storage/' . $brand->image) }}" alt="">
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
