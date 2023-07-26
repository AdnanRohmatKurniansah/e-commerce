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
                            <div class="login_form_inner p-5">
                                <div class="col-12 d-flex flex-column justify-content-start pb-2 px-0" style="border-bottom: 1px solid rgb(170, 168, 168)">
									<h5 class="text-left">Change password</h5>
								</div>	
                                <form class="row login_form mt-5" action="/update_password" method="post" id="contactForm">
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
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection