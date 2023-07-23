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
			<div class="row contact_form">
				<div class="{{ $users->provider == null ? 'col-lg-6' : 'col-lg-6 mx-auto' }}">
					<form class="login_form_inner p-5" action="/update_profile" method="post" enctype="multipart/form-data">
						@method('PUT')
						@csrf
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
								  <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
								  @error('profile')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								  @enderror
								</div>
							</div>
						</div>						  
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
						<div class="col-md-12 form-group">
							<button type="submit" value="submit" class="primary-btn">Update</button>
						</div>
					</form>
				</div>
				@if ($users->provider == null)
					<div class="col-lg-6">
						<div class="login_form_inner">
							<h3>Change Password</h3>
							<form class="row login_form" action="/update_password" method="post" id="contactForm">
								@csrf
								<div class="col-md-12 form-group">
									<input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Old Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Old Password'">
									@error('old_password')
									<div class="invalid-feedback justify-content-start text-left">
										{{ $message }}
									</div>            
									@enderror
								</div>
								<div class="col-md-12 form-group">
									<input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'">
									@error('new_password')
									<div class="invalid-feedback justify-content-start text-left">
										{{ $message }}
									</div>            
									@enderror
								</div>
								<div class="col-md-12 form-group" style="margin-bottom: 80px">
									<button type="submit" value="submit" class="primary-btn">Update</button>
								</div>
							</form>
						</div>
					</div>
				@endif
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