@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Contact</h3>
            </div>
        </div>
    </div>

<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        @foreach ($contacts as $contact)
        <a href="/dashboard/contacts/{{ $contact->id }}/edit" class="btn btn-success m-3">Edit</a>
            <div class="map mx-3">
                {!! $contact->map !!}
            </div> 
            <div class="info mx-3 mb-3">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                <i data-feather="home"></i>
                            </div>
                            <div class="col-md-10">
                                <p>{!! $contact->address !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                <i data-feather="phone"></i>
                            </div>
                            <div class="col-md-10">
                                <p>{!! $contact->pnumber !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                <i data-feather="mail"></i> 
                            </div>
                            <div class="col-md-10">
                                <p>{!! $contact->email !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
</div>

@endsection