@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Store Location</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/origin/{{ $origin->id }}" method="post" class="form form-vertical" >
                    @method('put')
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="province" class="form-label">Province</label>
                                    <select class="form-select" name="province_id" id="province">
                                        @foreach ($provinces as $province)
                                        @if(old('province_id', $origin->province_id) == $province->id)
                                            <option value="{{ $province->id }}" selected>{{ $province->name }}</option>
                                        @else
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div> 
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="regency" class="form-label">Regency</label>
                                    <select class="form-select" name="regency_id" id="regency">
                                        <option>-- Regency --</option>
                                        @php
                                            $regencies = \App\Models\Regency::where('province_id', $origin->province_id)->get();
                                        @endphp
                                        @foreach ($regencies as $regency)
                                            @if(old('regency_id', $origin->regency_id) == $regency->id)
                                                <option value="{{ $regency->id }}" selected>{{ $regency->name }}</option>
                                            @else
                                                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="district" class="form-label">District</label>
                                    <select class="form-select" name="district_id" id="district">
                                        <option>-- District --</option>
                                        @php
                                            $districts = \App\Models\District::where('regency_id', $origin->regency_id)->get();
                                        @endphp
                                        @foreach ($districts as $district)
                                            @if(old('district_id', $origin->district_id) == $district->id)
                                                <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                                            @else
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>

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
                        $('#regency').html(msg);
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
                        $('#district').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },
                })
            });
        });
    });
</script>

@endsection