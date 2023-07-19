@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Brands</h3>
                <a href="/dashboard/brands/create" class="btn btn-success me-1 my-3">Create</a>
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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($brands as $brand)  
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><img src="{{ asset('storage/' . $brand->image) }}" width="50" alt=""></td>
                  <td style="vertical-align: middle; text-align: center;">
                    <a  href="/dashboard/brands/{{ $brand->id }}/edit">
                      <i class="badge-circle badge-circle-light-secondary" data-feather="edit"></i>
                    </a>
                    <form action="/dashboard/brands/{{ $brand->id }}" method="post">
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
  </div>
</div>
</div>

@endsection