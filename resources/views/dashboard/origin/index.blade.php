@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Store Location</h3> 
            </div>
        </div>
    </div>

<div class="row mt-5" id="table-striped">
  <div class="col-8">
    <a class="btn btn-primary mb-2" href="/dashboard/origin/{{ $origin[0]->id }}/edit">Edit</a>
    <div class="card">
      <div class="card-content">
        <div class="card-body">
            <ul class="list-unstyled" style="font-size: 17px; font-weight: 500">
                @php
                    $province = \App\Models\Province::where('id', $origin[0]->province_id)->first();
                @endphp
                <li class="mb-3">Province : {{ $province->name }}</li>
                @php
                    $regency = \App\Models\Regency::where('id', $origin[0]->regency_id)->first();
                @endphp
                <li class="mb-3">Regency : {{ $regency->name }}</li>
                @php
                    $district = \App\Models\District::where('id', $origin[0]->district_id)->first();
                @endphp
                <li class="mb-3">District : {{ $district->name }}</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

@endsection