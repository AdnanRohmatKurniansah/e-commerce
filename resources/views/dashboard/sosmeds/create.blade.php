@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Create Sosmed</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/sosmeds/store" method="post" class="form form-vertical" >
                    @csrf
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="icon">Icon</label>
                            <div class="previewIcon mt-2">
                                
                            </div>
                            <input type="text" id="icon" required class="icon form-control mt-3 @error('icon') is-invalid @enderror" name="icon"
                                placeholder="icon" value="{{ old('icon') }}" required oninput="previewIcon(this.value)">
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="link" class="form-label">Link</label>
                                <textarea class="form-control @error('link') is-invalid @enderror" placeholder="Link" name="link" id="link" cols="30" rows="5" required autofocus>{{ old('link') }}</textarea>
                                </div>
                                @error('link')
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
    function previewIcon(name) {
      var iconName = name.trim().toLowerCase().replace(/\s+/g, '-');
      var previewElement = document.querySelector('.previewIcon');
      previewElement.innerHTML = '<i class="fs-1 fa-brands fa-' + iconName + '"></i>';
    }
  </script>

@endsection