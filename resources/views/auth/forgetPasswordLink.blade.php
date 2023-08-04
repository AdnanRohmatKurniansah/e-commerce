@extends('layout.main')

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Reset Password</h1>
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
                                <form class="row login_form" action="/reset_password" method="post" id="contactForm">
                                    @csrf
									<input type="hidden" name="token" value="{{ $token }}">
                                    <div class="col-md-12 form-group">
										<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required>
										@error('email')
										<div class="invalid-feedback justify-content-start text-left">
											{{ $message }}
										</div>            
										@enderror
									</div>
									<div class="col-md-12 form-group">
										<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
										<div class="password-toggle-btn position-absolute" onclick="togglePasswordVisibility()" style="right: 10px; top: 50%; transform: translate(0, -50%);">
											<span class="password-toggle-icon mr-3" id="password-toggle-icon">
												<i class="fa fa-eye-slash"></i>
											</span>
										</div>
										@error('password')
										<div class="invalid-feedback justify-content-start text-left">
											{{ $message }}
										</div>            
										@enderror
									</div>
									<div class="col-md-12 form-group">
										<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required>
										@error('password_confirmation')
										<div class="invalid-feedback justify-content-start text-left">
											{{ $message }}
										</div>            
										@enderror
									</div>
                                    <div class="col-md-12 form-group" style="margin-bottom: 80px">
                                        <button type="submit" value="submit" class="primary-btn">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script>
	function togglePasswordVisibility() {
		const passwordInput = document.getElementById('password');
		const passwordToggleIcon = document.getElementById('password-toggle-icon');
		
		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			passwordToggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
		} else {
			passwordInput.type = 'password';
			passwordToggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
		}
	}
</script>

@endsection