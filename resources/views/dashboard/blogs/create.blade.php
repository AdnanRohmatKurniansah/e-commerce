@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Create Blogs</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/blogs" method="post" enctype="multipart/form-data" class="form form-vertical" >
                    @csrf
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" required class="form-control mt-3 @error('title') is-invalid @enderror" name="title"
                                placeholder="Title" value="{{ old('title') }}">
                            </div>
                            @error('title')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" required class="form-control mt-3 @error('slug') is-invalid @enderror" name="slug"
                                placeholder="Slug" value="{{ old('slug') }}">
                            </div>
                            @error('slug')
                                <div class="invalid-feedback">
                                   {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="body" class="form-label">Body</label>
                                <textarea id="body" class="summernote form-control @error('body') is-invalid @enderror" placeholder="Body" name="body" required autofocus>{{ old('body') }}</textarea>
                                </div>
                                @error('body')
                                    <div class="invalid-feedback">  
                                      {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="blogCategory" class="form-label">Category</label>
                                <select class="form-select" name="blogCategory_id">
                                  @foreach ($blogCategories as $blogCategory)
                                    @if(old('blogCategory_id') == $blogCategory->id)
                                      <option value="{{ $blogCategory->id }}" selected>{{ $blogCategory->name }}</option>
                                    @else
                                       <option value="{{ $blogCategory->id }}">{{ $blogCategory->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div> 
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image" onchange="previewImage()">
                            </div>
                                @error('image')
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
    $('.summernote').summernote({
        placeholder: 'Write Here...',
        tabsize: 2,
        height: 350,
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
    const title = document.querySelector('#title')
    const slug = document.querySelector('#slug')
    
    title.addEventListener('change', function() {
        fetch('/dashboard/blogs/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');
      imgPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
    </script>

@endsection