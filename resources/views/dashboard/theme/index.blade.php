@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Theme Website</h3> 
            </div>
        </div>
    </div>

<div class="row mt-5" id="table-striped">
  <div class="col-12">
    <a class="btn btn-primary mb-2" href="/dashboard/theme/{{ $theme->id }}/edit">Edit</a>
    <div class="card">
      <div class="card-content">
        <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <ul class="list-unstyled" style="font-weight: 500">
                  <li class="mb-3 fw-bold">Color Primary : <span style="background-color: {{ $theme->colorPrimary }}">{{ $theme->colorPrimary }}</span></li>
                  <li class="mb-3 fw-bold">Color Secondary : <span style="background-color: {{ $theme->colorSecondary }}">{{ $theme->colorSecondary }}</span></li>
                  <li class="mb-3 fw-bold">Font Primary : <span style="font-family: {{ $theme->fontPrimary }}">{{ $theme->fontPrimary }}</span></li>
                  <li class="mb-3 fw-bold">Font Secondary : <span style="font-family: {{ $theme->fontSecondary }}">{{ $theme->fontSecondary }}</span></li>
                </ul>
              </div>
              <div class="col-lg-4">
                <p class="fw-bold">Logo :</p>
                <img class="img-fluid" width="50%" src="{{ asset('storage/' . $theme->logo) }}" alt="">
              </div>
              <div class="col-lg-4">
                <p class="fw-bold">Common Banner :</p>
                <img class="img-fluid" width="100%" src="{{ asset('storage/' . $theme->commonBanner) }}" alt="">
              </div>
            </div>
            <div class="col-12">
              <p class="fw-bold">Banner :</p>
              <img class="img-fluid" width="100%" src="{{ asset('storage/' . $theme->banner) }}" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

@endsection