@extends('layout.main')

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Contact Us</h1>
					<nav class="d-flex align-items-center">
						<a href="/"><span class="lnr lnr-arrow-right"></span>Home</a>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<section class="contact_area section_gap_bottom">
		<div class="container">
			{!! $contacts[0]->map !!}
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							{!! $contacts[0]->address !!}
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							{!! $contacts[0]->pnumber !!}
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							{!! $contacts[0]->email !!}
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" action="/addMessage" method="post" id="contactForm">
						@csrf
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" required>
							</div>
							@error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
							<div class="form-group">
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" required>
							</div>
							@error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
							<div class="form-group">
								<textarea required class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="1" placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"></textarea>
							</div>
							@error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
						</div>
						<div class="col-md-12 text-right">
							<button type="submit" value="submit" class="primary-btn">Send Message</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection