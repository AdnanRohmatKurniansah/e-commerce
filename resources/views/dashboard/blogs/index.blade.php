@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Blogs</h3>
                <a href="/dashboard/blogs/create" class="btn btn-success me-1 my-3">Create</a>
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
                <th>Title</th>
                <th>Blog Category</th>
                <th>Author</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($blogs as $blog)  
              <tr>
                  <td>{{ $blog->title }}</td>
                  <td>{{ $blog->blogCategory->name }}</td>
                  <td>{{ $blog->author }}</td>
                  <td class="d-flex">
                    <a href="/dashboard/blogs/{{ $blog->slug }}/edit"><i class="badge-circle badge-circle-light-secondary" data-feather="edit"></i></a>
                    <form action="/dashboard/blogs/{{ $blog->slug }}" method="post">
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