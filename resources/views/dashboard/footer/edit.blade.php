@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Footer</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/footer/{{ $footer->id }}" method="post" enctype="multipart/form-data" class="form form-vertical" >
                    @method('put')
                    @csrf
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="about" class="form-label">About</label>
                                <textarea class="form-control @error('about') is-invalid @enderror" placeholder="about" rows="8" name="about" id="about" required autofocus>{{ old('about', $footer->about) }}</textarea>
                                </div>
                                @error('about')
                                    <div class="invalid-feedback">  
                                      {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="copyright">Copyright</label>
                            <input type="text" id="copyright" required class="form-control mt-3 @error('copyright') is-invalid @enderror" name="copyright"
                                placeholder="copyright" value="{{ old('copyright', $footer->copyright) }}">
                            </div>
                            @error('copyright')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" id="link" required class="form-control mt-3 @error('link') is-invalid @enderror" name="link"
                                placeholder="link" value="{{ old('link', $footer->link) }}">
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

@endsection