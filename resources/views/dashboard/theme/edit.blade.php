@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Theme</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/theme/{{ $theme->id }}" method="post" enctype="multipart/form-data" class="form form-vertical" >
                    @method('put')
                    @csrf
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="colorPrimary">Color Primary</label>
                            <input type="color" id="colorPrimary" required class="form-control mt-3 @error('colorPrimary') is-invalid @enderror" name="colorPrimary"
                                placeholder="colorPrimary" value="{{ old('colorPrimary', $theme->colorPrimary) }}">
                            </div>
                            @error('colorPrimary')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="colorSecondary">Color Secondary</label>
                            <input type="color" id="colorSecondary" required class="form-control mt-3 @error('colorSecondary') is-invalid @enderror" name="colorSecondary"
                                placeholder="colorSecondary" value="{{ old('colorSecondary', $theme->colorSecondary) }}">
                            </div>
                            @error('colorSecondary')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                @php
                                    $fonts = ['Roboto', 'Open Sans', 'Montserrat', 'Lato', 'Poppins', 'Ubuntu', 'Raleway', 'Noto Sans', 'Inter', 'Roboto Mono'];
                                @endphp
                                <label for="fontPrimary" class="form-label">Font Primary</label>
                                <select class="form-select" name="fontPrimary">
                                  @foreach ($fonts as $font)
                                    @if(old('fontPrimary', $theme->fontPrimary) == $font)
                                      <option style="font-family: {{ $font }}" value="{{ $font }}" selected>{{ $font }}</option>
                                    @else
                                       <option style="font-family: {{ $font }}" value="{{ $font }}">{{ $font }}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="fontSecondary" class="form-label">Font Secondary</label>
                                <select class="form-select" name="fontSecondary">
                                  @foreach ($fonts as $font)
                                    @if(old('fontSecondary', $theme->fontSecondary) == $font)
                                      <option style="font-family: {{ $font }}" value="{{ $font }}" selected>{{ $font }}</option>
                                    @else
                                       <option style="font-family: {{ $font }}" value="{{ $font }}">{{ $font }}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="hidden" name="oldLogo" value="{{ $theme->logo }}">
                                @if ($theme->logo)
                                    <img src="{{ asset('storage/' . $theme->logo) }}" class="logo-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                    <img class="logo-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo"
                                name="logo" onchange="previewLogo()">
                            </div>
                                @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <div class="mb-3">
                                <label for="banner" class="form-label">Banner</label>
                                <input type="hidden" name="oldBanner" value="{{ $theme->banner }}">
                                @if ($theme->banner)
                                    <img src="{{ asset('storage/' . $theme->banner) }}" class="banner-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                    <img class="banner-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input class="form-control @error('banner') is-invalid @enderror" type="file" id="banner"
                                name="banner" onchange="previewBanner()">
                            </div>
                                @error('banner')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <div class="mb-3">
                                <label for="commonBanner" class="form-label">Common Banner</label>
                                <input type="hidden" name="oldCommonBanner" value="{{ $theme->commonBanner }}">
                                @if ($theme->commonBanner)
                                    <img src="{{ asset('storage/' . $theme->commonBanner) }}" class="commonBanner-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                    <img class="commonBanner-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input class="form-control @error('commonBanner') is-invalid @enderror" type="file" id="commonBanner"
                                name="commonBanner" onchange="previewCommonBanner()">
                            </div>
                                @error('commonBanner')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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

<script>
    function previewLogo() {
      const logo = document.querySelector('#logo');
      const logoPreview = document.querySelector('.logo-preview');
      logoPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(logo.files[0]);
      oFReader.onload = function(oFREvent) {
        logoPreview.src = oFREvent.target.result;
      }
    }

    function previewBanner() {
      const banner = document.querySelector('#banner');
      const bannerPreview = document.querySelector('.banner-preview');
      bannerPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(banner.files[0]);
      oFReader.onload = function(oFREvent) {
        bannerPreview.src = oFREvent.target.result;
      }
    }

    function previewCommonBanner() {
      const commonBanner = document.querySelector('#commonBanner');
      const commonBannerPreview = document.querySelector('.commonBanner-preview');
      commonBannerPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(commonBanner.files[0]);
      oFReader.onload = function(oFREvent) {
        commonBannerPreview.src = oFREvent.target.result;
      }
    }
</script>

@endsection 