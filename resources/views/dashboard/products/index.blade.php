@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Products</h3>
                <a href="/dashboard/products/create" class="btn btn-success me-1 my-3">Create</a>
            </div>
        </div>
    </div>

<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
        </div>
        <div class="table-responsive">
          <table class="table table-striped mb-0" id="table1">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Weight</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)  
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><img src="{{ asset('storage/' . $product->image) }}" width="50" alt=""></td>
                  <td>{{ Str::limit($product->name, 20) }}</td>
                  <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                  <td>{{ $product->weight }} gram</td>
                  <td>{{ $product->qty }}</td>
                  <td style="vertical-align: middle; text-align: center;">
                    <a  href="/dashboard/products/{{ $product->slug }}/edit">
                      <i class="badge-circle badge-circle-light-secondary" data-feather="edit"></i>
                    </a>
                    <form action="/dashboard/products/{{ $product->slug }}" method="post">
                      @method('delete')
                      @csrf
                      <div class="my-1" style="border-bottom: 1px solid gray"></div>
                      <button class="badge-circle badge-circle-light-secondary text-red border-0" style="background-color: transparent" onclick="return confirm('Are you sure?')" type="submit">
                        <i data-feather="trash"></i>
                      </button>
                    </form>
                  </td>  
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- <div class="d-flex justify-content-center mt-5">
      <ul class="pagination pagination-primary">
          <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}">Prev</a></li>
          @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
              <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                  <a class="page-link" href="{{ $url }}">{{ $page }}</a>
              </li>
          @endforeach
          <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a></li>
      </ul>        
  </div> --}}

  </div>
</div>

</div>

@endsection