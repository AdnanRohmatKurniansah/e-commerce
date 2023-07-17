@extends('layout.main')

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Register</h1>
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
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="/assets/img/login.jpg" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="registration.html">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Register to enter</h3>
						<form class="row login_form" action="" method="post" id="contactForm">
							@csrf
							<div class="col-md-12 form-group">
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
								@error('email')
								<div class="invalid-feedback justify-content-start text-left">
									{{ $message }}
								</div>            
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
								@error('name')
								<div class="invalid-feedback text-left">
									{{ $message }}
								</div>            
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
								@error('password')
								<div class="invalid-feedback text-left">
									{{ $message }}
								</div>            
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Register</button>
							</div>
							<p class="d-flex mx-auto text-center mt-3">Already have an account ?<a href="/login" class="text-decoration-none ml-1"> Login Now!</a></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection