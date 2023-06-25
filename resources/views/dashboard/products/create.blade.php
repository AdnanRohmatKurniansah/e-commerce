@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Create Products</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/products" method="post" enctype="multipart/form-data" class="form form-vertical" >
                    @csrf
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" required class="form-control mt-3 @error('name') is-invalid @enderror" name="name"
                                placeholder="Name" value="{{ old('name') }}">
                            </div>
                            @error('name')
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
                                <label for="desc" class="form-label">Description</label>
                                <textarea class="form-control @error('desc') is-invalid @enderror" placeholder="Description" name="desc" id="desc" cols="30" rows="5" required autofocus>{{ old('desc') }}</textarea>
                                </div>
                                @error('desc')
                                    <div class="invalid-feedback">  
                                      {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category_id">
                                  @foreach ($categories as $category)
                                    @if(old('category_id') == $category->id)
                                      <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div> 
                        </div>
                        <div class="col-12 mb-2">
                            <label for="color" class="form-label">Color</label>
                            <ul class="list-unstyled mb-0">
                                @foreach ($colors as $color)  
                                    <li class="d-inline-block me-2 mb-1">
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="form-check-input"
                                                    name="color[]" value="{{ $color }}">
                                                <label class="form-check-label" style="border-bottom: 1px solid {{ strtolower($color) }};">{{ $color }}</label>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>                            
                        </div>
                        <div class="col-12 mb-2">
                            <label for="color" class="form-label">Sizes</label>
                            <ul class="list-unstyled mb-0">
                                @foreach ($sizes as $size)  
                                    <li class="d-inline-block me-2">
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="form-check-input"
                                                    name="size[]" value="{{ $size }}">
                                                <label class="form-check-label">{{ $size }}</label>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>                            
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="weight">Weight (gram)</label>
                                <input type="text" id="weight" required class="form-control mt-3 @error('weight') is-invalid @enderror" name="weight"
                                    placeholder="weight" value="{{ old('weight') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                            </div>
                            @error('weight')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>                                          
                        <div class="col-12">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" id="price" required class="form-control mt-3 @error('price') is-invalid @enderror" name="price"
                                    placeholder="Price" value="{{ old('price') }}">
                            </div>
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>                                          
                        <div class="col-12">
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" id="qty" required class="form-control mt-3 @error('qty') is-invalid @enderror" name="qty"
                                    placeholder="Quantity" value="{{ old('qty') }}" min="1">
                            </div>
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
    const name = document.querySelector('#name')
    const slug = document.querySelector('#slug')
    
    name.addEventListener('change', function() {
        fetch('/dashboard/products/checkSlug?name=' + name.value)
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

    var price = document.getElementById("price");
    price.addEventListener("keyup", function(e) {
    price.value = formatPrice(this.value);
    });

    function formatPrice(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

    </script>

@endsection