@extends('layout.main')

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Forget Password</h1>
					<nav class="d-flex align-items-center">
						<a href="/"><span class="lnr lnr-arrow-right"></span>Home</a>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 justify-content-center mx-auto">
					<div class="contact_form">
						<div class="col-md-12">
                            <div class="login_form_inner">
                                <h3>Reset Password</h3>
                                <form class="row login_form" action="/forget_password/submit" method="post" id="contactForm">
                                    @csrf
                                    <div class="col-md-12 form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                                        @error('email')
                                        <div class="invalid-feedback justify-content-start text-left">
                                            {{ $message }}
                                        </div>            
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group" style="margin-bottom: 80px">
                                        <button type="submit" value="submit" class="primary-btn">Send Password Reset Link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection