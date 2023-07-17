@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profile</h3>
            </div>
        </div>
    </div>

<div class="row mt-5">
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="/update_profile" method="post" enctype="multipart/form-data">
                        @method('PUT')
						@csrf
                        <div class="form-body">
                            <div class="row">
                            <div class="col-12 mb-3">
                                <div class="d-flex justify-content-center">
                                    @if ($users->profile == null)
                                        <img class="img-preview" style="border-radius: 50%; max-width: 90px; min-height: 80px;" src="/assets/admin/images/user.png">
                                    @else
                                        <img class="img-preview" style="border-radius: 50%; max-width: 90px; min-height: 80px;" src="{{ asset('storage/' . $users->profile) }}">
                                    @endif
                                </div>                                
							<div class="input-group mt-3 d-flex justify-content-center">
								<div class="custom-file">
								  <input type="hidden" name="oldProfile" value="{{ $users->profile }}">
								  <input type="file" name="profile" class="form-control @error('profile') is-invalid @enderror" id="profile" onchange="previewProfile()">
								  @error('profile')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								  @enderror
								</div>
							</div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" disabled value="{{ $users->name }}" id="first-name-icon">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="email-id-icon">Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" disabled value="{{ $users->email }}" id="email-id-icon">
                                        <div class="form-control-icon">
                                            <i data-feather="mail"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Birth</label>
                                    <div class="position-relative">
                                        @if ($users->birth == null)
                                            <input type="date" class="form-control @error('birth') is-invalid @enderror" id="birth" name="birth" value="{{ old('birth') }}">
                                        @else
                                            <input type="date" class="form-control @error('birth') is-invalid @enderror" id="birth" name="birth" value="{{ old('birth', $users->birth) }}">
                                        @endif
                                        <div class="form-control-icon">
                                            <i data-feather="gift"></i>
                                        </div>
                                        @error('birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror	
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">Gender</label>
                                    <div class="position-relative">
                                        <select class="form-select" name="gender">
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
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                    <div class="card-body">
                        <form action="/update_password" class="form form-vertical" method="post">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                <div class="col-12 p-3">
                                    <div class="form-group">
                                    <label for="password-vertical">Old Password</label>
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Old Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Old Password'">
                                    @error('old_password')
                                        <div class="invalid-feedback justify-content-start text-left">
                                            {{ $message }}
                                        </div>            
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    <label for="password-vertical">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'">
                                    @error('new_password')
                                        <div class="invalid-feedback justify-content-start text-left">
                                            {{ $message }}
                                        </div>            
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

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