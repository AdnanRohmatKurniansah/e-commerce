@extends('layout.main')

@section('content')
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>My Address</h1>
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
                <div class="col-md-12 login_form_inner p-5">
                    <div class="col-12 d-flex flex-column justify-content-start p-0" style="border-bottom: 1px solid rgb(170, 168, 168)">
                    <div class="row">
                        <div class="col">
                            <h5 class="text-left mt-3">Address</h5>
                        </div>
                        <div class="col pb-3 d-flex justify-content-end">
                            <button class="bg-danger border-0 text-light p-2" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-plus-circle pr-2"></span>Add new address</button>
                        </div>
                    </div>
                </div>	
                    <div class="address d-flex flex-column justify-content-start">
                    @if ($addresses->isEmpty())
                    <h5 class="py-5">No addresses have been added yet</h5>
                    @else
                    @foreach ($addresses as $address)
                    <div class="row py-3">
                        <div class="col text-left">
                            <h6>{{ $address->name }}</h6>
                            <div class="street">{{ $address->street }}</div>
                            @php
                                $district = \App\Models\District::where('id', $address->district_id)->first();
                                $regency = \App\Models\Regency::where('id', $address->regency_id)->first();
                                $province = \App\Models\Province::where('id', $address->province_id)->first();
                            @endphp
                            <div class="address">{{ $district->name }}, {{ $regency->name }}, {{ $province->name }}, {{ $address->zip }}</div>
                            @if ($address->primary == true)
                            <div class="status mt-2">
                                <span class="genric-btn danger-border small">Primary</span>
                            </div>
                            @endif
                        </div>
                        <div class="col text-right">
                            <div class="d-flex justify-content-end">
                                <button class="border-0 bg-transparent text-info" data-toggle="modal" data-target="#editModal{{ $address->id }}" type="button">Edit</button>
                                @if ($address->primary == false)
                                    <form action="/removeAddress" method="POST">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $address->id }}">
                                        <button onclick="return confirm('Remove this address?')" class="border-0 bg-transparent text-info" type="submit">Remove</button>
                                    </form>
                                @endif
                            </div>

                            <div class="stat mt-2">
                                <form action="/changePrimary" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $address->id }}">
                                    <button type="submit" onclick="return confirm('Change to primary address?')" class="genric-btn {{ $address->primary == true ? 'disable' : 'info-border' }} medium" {{ $address->primary == true ? 'disabled' : '' }}>Change primary</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    </div>             
                    </div>
                </div>
                </div>
            </div>
	    </div>
  </section>

{{-- add modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body billing_details">
        <form class="row contact_form" action="/addAddress" method="post">
          @csrf
          <div class="col-md-12 form-group p_star">
              <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" required name="name">
              @error('name')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="col-md-12 form-group p_star">
              <select class="country_select" id="province" name="province_id" required>
                  <label for="">-- Province -- </label>
                  @foreach ($provinces as $province)
                     <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
              </select>
          </div>
          <div class="col-md-12 form-group p_star">
              <select class="country_select" name="regency_id" id="regency" required>
                  <option>-- Regency --</option>
              </select>
          </div>
          <div class="col-md-12 form-group p_star">
              <select class="country_select" name="district_id" id="district" required>
                  <option>-- District --</option>
              </select>
          </div>
          <div class="col-md-12 form-group p_star">
              <input type="text" class="form-control @error('street') is-invalid @enderror" value="{{ old('street') }}" placeholder="Street Address" id="add2" name="street" required>
              @error('street')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="col-md-12 form-group">
              <input type="text" class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip') }}" id="zip" name="zip" required placeholder="Postcode/ZIP">
              @error('zip')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>

{{-- edit modal --}}
@foreach ($addresses as $address)
    <div class="modal fade" id="editModal{{ $address->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body billing_details">
            <form class="row contact_form" action="/updateAddress" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{ $address->id }}">
            <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $address->name) }}" placeholder="Name" required name="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-12 form-group p_star">
                <select class="country_select" id="editProvince{{ $address->id }}" name="province_id" required>
                    <label for="">-- Province -- </label>
                    @foreach ($provinces as $province)
                        @if(old('province_id', $address->province_id) == $province->id)
                            <option value="{{ $province->id }}" selected>{{ $province->name }}</option>
                        @else
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group p_star">
                <select class="country_select" name="regency_id" id="editRegency{{ $address->id }}" required>
                    <option>-- Regency --</option>
                    @php
                        $regencies = \App\Models\Regency::where('province_id', $address->province_id)->get();
                    @endphp
                    @foreach ($regencies as $regency)
                        @if(old('regency_id', $address->regency_id) == $regency->id)
                            <option value="{{ $regency->id }}" selected>{{ $regency->name }}</option>
                        @else
                            <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group p_star">
                <select class="country_select" name="district_id" id="editDistrict{{ $address->id }}" required>
                    <option>-- District --</option>
                    @php
                        $districts = \App\Models\District::where('regency_id', $address->regency_id)->get();
                    @endphp
                    @foreach ($districts as $district)
                        @if(old('district_id', $address->district_id) == $district->id)
                            <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                        @else
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control @error('street') is-invalid @enderror" value="{{ old('street', $address->street) }}" placeholder="Street Address" id="add2" name="street" required>
                @error('street')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-12 form-group">
                <input type="text" class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip', $address->zip) }}" id="zip" name="zip" required placeholder="Postcode/ZIP">
                @error('zip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endforeach

<script type="text/javascript">
  $(function() {
      $.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
      });

      $(function() {
          $('#province').on('change', function() {
              let id_province = $('#province').val();
              $.ajax({
                  type: 'POST',
                  url: '/checkout/getRegencies',
                  data: {id_province: id_province},
                  cache: false,

                  success: function(msg) {
                      console.log("Received data:",msg);
                      $('#regency').html(msg).niceSelect('update');
                  },
                  error: function(data) {
                      console.log('error:', data)
                  },
              })
          });

          $('#regency').on('change', function() {
              let id_regency = $('#regency').val();
              $.ajax({
                  type: 'POST',
                  url: '/checkout/getDistricts',
                  data: {id_regency: id_regency},
                  cache: false,

                  success: function(msg) {
                      console.log("Received data:",msg);
                      $('#district').html(msg).niceSelect('update');
                  },
                  error: function(data) {
                      console.log('error:', data)
                  },
              })
          });
      });
  });
</script>

@foreach ($addresses as $address)
    <script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $(function() {
           $('#editProvince{{ $address->id }}').on('change', function() {
              let id_province = $('#editProvince{{ $address->id }}').val();
              $.ajax({
                  type: 'POST',
                  url: '/checkout/getRegencies',
                  data: {id_province: id_province},
                  cache: false,

                  success: function(msg) {
                      console.log("Received data:",msg);
                      $('#editRegency{{ $address->id }}').html(msg).niceSelect('update');
                  },
                  error: function(data) {
                      console.log('error:', data)
                  },
              })
          });

          $('#editRegency{{ $address->id }}').on('change', function() {
              let id_regency = $('#editRegency{{ $address->id }}').val();
              $.ajax({
                  type: 'POST',
                  url: '/checkout/getDistricts',
                  data: {id_regency: id_regency},
                  cache: false,

                  success: function(msg) {
                      console.log("Received data:",msg);
                      $('#editDistrict{{ $address->id }}').html(msg).niceSelect('update');
                  },
                  error: function(data) {
                      console.log('error:', data)
                  },
              })
          });
        });
    })
    </script>
@endforeach

@endsection