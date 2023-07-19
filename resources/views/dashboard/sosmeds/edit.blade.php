@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Sosmed</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/sosmeds/{{ $sosmed->id }}" method="post" enctype="multipart/form-data" class="form form-vertical" >
                    @method('put')
                    @csrf
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="icon">Icon</label>
                            <div class="previewIcon mt-2">
                                @if (old('icon'))
                                    <i class="fs-1 fa-brands fa-{{ Str::slug(old('icon')) }}"></i>
                                  @else
                                    <i class="fs-1 fa-brands fa-{{ Str::slug($sosmed->icon) }}"></i>
                                  @endif
                            </div>
                            <input type="text" id="icon" required class="form-control mt-3 @error('icon') is-invalid @enderror" name="icon"
                                placeholder="icon" value="{{ old('icon', $sosmed->icon) }}" oninput="previewIcon(this.value)">
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
                                <textarea class="form-control @error('link') is-invalid @enderror" placeholder="link" name="link" id="link" cols="30" rows="5" required autofocus>{{ old('link', $sosmed->link) }}</textarea>
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
    function previewIcon(icon) {
      var iconName = icon.trim().toLowerCase().replace(/\s+/g, '-');
      var previewElement = document.querySelector('.previewIcon');
      if (icon) {
        previewElement.innerHTML = '<i class="fs-1 fa-brands fa-' + iconName + '"></i>';
      } else {
        var previousIcon = '{{ Str::slug($sosmed->name) }}';
        previewElement.innerHTML = '<i class="fs-1 fa-brands fa-' + previousIcon + '"></i>';
      }
    }
  </script>

@endsection