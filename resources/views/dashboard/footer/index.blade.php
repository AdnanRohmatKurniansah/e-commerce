@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Footer</h3>
            </div>
        </div>
    </div>

<div class="row" id="table-striped">
  <div class="col-9">
    <div class="card">
      <div class="card-content">
        @foreach ($footers as $footer)
        <a href="/dashboard/footer/{{ $footer->id }}/edit" class="btn btn-success m-3">Edit</a>
        <div class="row p-5 d-flex justify-content-center">
            <div class="col-4">
                <h3 class="fw-bolder">About Us</h3>
                <p>{{ $footer->about }}</p>
            </div>
            <div class="col-4">
                <h3 class="fw-bolder">Copyright</h3>
                <p>{{ $footer->copyright }}</p>
            </div>
            <div class="col-4">
                <h3 class="fw-bolder">Link</h3>
                <p>{{ $footer->link }}</p>
            </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
</div>

@endsection