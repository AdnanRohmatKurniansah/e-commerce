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
							<a class="primary-btn" href="/register">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner pt-5">
						<h3>Register to enter</h3>
						<form class="row login_form" action="" method="post" id="contactForm">
							@csrf
							<div class="col-md-12 form-group">
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required>
								@error('email')
								<div class="invalid-feedback justify-content-start text-left">
									{{ $message }}
								</div>            
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required>
								@error('name')
								<div class="invalid-feedback text-left">
									{{ $message }}
								</div>            
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
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
						<h5>Or</h5>
						<div class="oauth px-5 pt-2">
							<a style="border: 1px solid rgb(192, 192, 192)" class="genric-btn p-1 mx-5 mb-3 d-flex justify-content-center align-items-center google-btn" href="/auth/google">
								<svg class="fill-current mr-2" width="25px" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">                        
									<path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"/>                        
									<path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"/>                        
									<path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04"/>                        
									<path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"/>                    
								</svg>
								<span style="font-size: 15px; color: #000">Login with Google</span>    
							</a>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection