@extends('layout.main')

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login</h1>
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
							<a class="primary-btn" href="/login">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner pt-5">
						<h3 class="pt-3">Log in to enter</h3>
						<form class="row login_form" action="/login" method="post" id="contactForm">
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
								<button type="submit" value="submit" class="primary-btn">Log In</button>
							</div>
							<a href="/forget_password" class="text-decoration-none mx-3 mt-1">Forget Password?</a>
						</form>
						<h5>Or</h5>
						<div class="oauth pt-2">
							<a style="border: 1px solid rgb(192, 192, 192)" class="genric-btn p-1 mx-5 mb-3 d-flex justify-content-center align-items-center google-btn" href="/auth/google">
									<svg class="fill-current mr-2" width="25px" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">                        
										<path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"/>                        
										<path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"/>                        
										<path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04"/>                        
										<path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"/>                    
									</svg>
									<span style="font-size: 15px; color: #000">Login with Google</span>    
							</a>
							<a style="border: 1px solid rgb(192, 192, 192)" class="genric-btn p-1 mx-5 d-flex justify-content-center align-items-center fb-btn" href="/auth/facebook">
									<svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="25px" data-name="Ebene 1" viewBox="0 0 1024 1024" id="facebook-logo-2019"><path fill="#1877f2" d="M1024,512C1024,229.23016,794.76978,0,512,0S0,229.23016,0,512c0,255.554,187.231,467.37012,432,505.77777V660H302V512H432V399.2C432,270.87982,508.43854,200,625.38922,200,681.40765,200,740,210,740,210V336H675.43713C611.83508,336,592,375.46667,592,415.95728V512H734L711.3,660H592v357.77777C836.769,979.37012,1024,767.554,1024,512Z"></path><path fill="#fff" d="M711.3,660,734,512H592V415.95728C592,375.46667,611.83508,336,675.43713,336H740V210s-58.59235-10-114.61078-10C508.43854,200,432,270.87982,432,399.2V512H302V660H432v357.77777a517.39619,517.39619,0,0,0,160,0V660Z"></path></svg>
									<span style="font-size: 15px; color: #000">Login with Facebook</span>  
							</a>
						</div>
						<p class="d-flex justify-content-center mx-auto text-center mt-3">Not Registered? <a href="/register" class="text-decoration-none ml-1"> Register Now!</a></p>
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