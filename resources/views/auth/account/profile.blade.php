@extends('layout.main')

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Account detail</h1>
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
					<div class="contact_form">
						<div class="col-md-12">
							<form class="row login_form_inner p-5" action="/update_profile" method="post" enctype="multipart/form-data">
								@method('PUT')
								@csrf			
								<div class="col-12 d-flex flex-column justify-content-start p-0" style="border-bottom: 1px solid rgb(170, 168, 168)">
									<h5 class="text-left">My profile</h5>
									<p class="text-left">Manage your profile information to control, protect, and secure your account</p>
								</div>								
								<div class="col-md-9 mt-3">
									<div class="form-group my-3">
										<input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}" disabled>
									</div>
									<div class="form-group my-3">
										<input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}" disabled>
									</div>
									<div class="form-group my-3">
										@if ($users->birth == null)
											<input type="date" class="form-control @error('birth') is-invalid @enderror" id="birth" name="birth" value="{{ old('birth') }}">
										@else
											<input type="date" class="form-control @error('birth') is-invalid @enderror" id="birth" name="birth" value="{{ old('birth', $users->birth) }}">
										@endif
									</div>
									@error('birth')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror	
									<div class="input-group-icon my-3">
										<div class="icon"></div>
										<div class="form-select text-left bg-light" id="default-select">
											<select name="gender" required>
												@if ($users->gender == null)
													@if(old('gender'))
														<option value="man" selected>man</option>
													@else
														<option value="man">man</option>
														<option value="women">women</option>
													@endif
												@else
													@if(old('gender') == $users->gender)
														<option value="{{ $users->gender }}" selected>{{ $users->gender }}</option>
														@if ($users->gender == 'man')
															<option value="women">women</option>
														@else
															<option value="man">man</option>
														@endif
													@else
														<option value="{{ $users->gender }}">{{ $users->gender }}</option>
														@if ($users->gender == 'man')
															<option value="women">women</option>
														@else
															<option value="man">man</option>
														@endif
													@endif
												@endif
											</select>
										</div>
									</div>
								</div>		
								<div class="col-md-3 my-auto">
									<div class="d-flex flex-column align-items-center">
										@if ($users->profile == null)
											<img class="img-preview" style="border-radius: 50%; max-width: 90px; min-height: 80px;" src="/assets/admin/images/user.png">
										@else
											@if ($users->provider == null)
												<img class="img-preview" style="border-radius: 50%; max-width: 90px; min-height: 80px;" src="{{ asset('storage/' . $users->profile) }}">
											@else
												<img class="img-preview" style="border-radius: 50%; max-width: 90px; min-height: 80px;" src="{{ $users->profile }}">
											@endif
										@endif
										<div class="input-group mt-3">
											<div class="custom-file">
											  <input type="hidden" name="oldProfile" value="{{ $users->profile }}">
											  <input type="file" name="profile" class="custom-file-input @error('profile') is-invalid @enderror" id="profile" onchange="previewProfile()">
											  <label class="custom-file-label d-flex justify-content-start" for="profile">
												Choose
											  </label>
											  @error('profile')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											  @enderror
											</div>
										</div>
									</div>	
								</div>  
								<div class="col-md-12 form-group d-flex justify-content-start">
									<button type="submit" value="submit" class="primary-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script>
	function previewProfile() {
      const profile = document.querySelector('#profile');
      const imgPreview = document.querySelector('.img-preview');
      imgPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(profile.files[0]);
      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
</script>

@endsection