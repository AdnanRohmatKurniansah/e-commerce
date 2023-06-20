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
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Colors</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)  
              <tr>
                  <td>{{ $product->name }}</td>
                  <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                  <td>{{ implode(', ', json_decode($product->color)) }}</td>
                  <td>{{ implode(', ', json_decode($product->size)) }}</td>
                  <td>{{ $product->qty }}</td>
                  <td class="d-flex">
                    <a href="/dashboard/products/{{ $product->slug }}/edit"><i class="badge-circle badge-circle-light-secondary" data-feather="edit"></i></a>
                    <form action="/dashboard/products/{{ $product->slug }}" method="post">
                      @method('delete')
                      @csrf
                        <button class="badge-circle badge-circle-light-secondary text-red border-0" style="background-color: transparent" onclick="return confirm('Are you sure?')" type="submit"><i data-feather="trash"></i></button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

@endsection