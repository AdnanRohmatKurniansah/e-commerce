@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Create Blog Categories</h3>
            </div>
        </div>

    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/blogs/categories" method="post" class="form form-vertical" >
                    @csrf
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" id="name" required class="form-control mt-3 @error('name') is-invalid @enderror" name="name"
                                placeholder="Category Name" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" id="slug" required class="form-control mt-3 @error('slug') is-invalid @enderror" name="slug"
                                placeholder="Category Slug" value="{{ old('slug') }}">
                            </div>
                            @error('slug')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

</div>

<script>
    const name = document.querySelector('#name')
    const slug = document.querySelector('#slug')
    
    name.addEventListener('change', function() {
        fetch('/dashboard/blogs/categories/checkSlug?name=' + name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script>

@endsection