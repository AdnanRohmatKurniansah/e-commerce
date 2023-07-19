@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Contact</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/contacts/{{ $contact->id }}" method="post" enctype="multipart/form-data" class="form form-vertical" >
                    @method('put')
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="map" class="form-label">Map</label>
                                    <textarea class="form-control @error('map') is-invalid @enderror" placeholder="map" rows="8" name="map" id="map" required autofocus>{{ old('map', $contact->map) }}</textarea>
                                    </div>
                                    @error('map')
                                        <div class="invalid-feedback">  
                                          {{ $message }}
                                        </div>
                                @enderror
                            </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="summernote form-control @error('address') is-invalid @enderror" placeholder="address" name="address" id="address" required autofocus>{{ old('address', $contact->address) }}</textarea>
                                </div>
                                @error('address')
                                    <div class="invalid-feedback">  
                                      {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pnumber" class="form-label">Phone Number</label>
                                <textarea class="summernote form-control @error('pnumber') is-invalid @enderror" placeholder="pnumber" name="pnumber" id="pnumber" required autofocus>{{ old('pnumber', $contact->pnumber) }}</textarea>
                                </div>
                                @error('pnumber')
                                    <div class="invalid-feedback">  
                                      {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <textarea class="summernote form-control @error('email') is-invalid @enderror" placeholder="email" name="email" id="email" required autofocus>{{ old('email', $contact->email) }}</textarea>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">  
                                      {{ $message }}
                                    </div>
                            @enderror
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

<script>
    $('.summernote').summernote({
        placeholder: 'Write Here...',
        tabsize: 2,
        height: 150,
        toolbar: [
          ['style', ['style']],
          ['fontsize', ['fontsize']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']],
          ['height', ['height']]
        ], 
        callbacks: {
            onEnterFullscreen: function () {
            $('.note-editor').addClass('fullscreen');
            },
            onExitFullscreen: function () {
            $('.note-editor').removeClass('fullscreen');
            }
        }
      });
    </script>

@endsection