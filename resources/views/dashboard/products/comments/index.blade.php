@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Product Comments</h3>
            </div>
        </div>
    </div>

<div class="row mt-5" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
        </div>
        <div class="table-responsive">
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
              </tr> 
            </thead>
            <tbody>
              @foreach ($productComments as $comment)  
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $comment->name }}</td>
                  <td>{{ Str::limit($comment->message, 200) }}</td>
                  <td>{{ $comment->created_at->format('F j, Y \a\t g:i a') }}</td>
                  <td class="d-flex">
                    <form action="/dashboard/products/comments/{{ $comment->id }}" method="post">
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

    <div class="d-flex justify-content-center mt-5">
      <ul class="pagination pagination-primary">
          <li class="page-item"><a class="page-link" href="{{ $productComments->previousPageUrl() }}">Prev</a></li>
          @foreach ($productComments->getUrlRange(1, $productComments->lastPage()) as $page => $url)
              <li class="page-item {{ $productComments->currentPage() == $page ? 'active' : '' }}">
                  <a class="page-link" href="{{ $url }}">{{ $page }}</a>
              </li>
          @endforeach
          <li class="page-item"><a class="page-link" href="{{ $productComments->nextPageUrl() }}">Next</a></li>
      </ul>        
    </div>

  </div>
</div>

</div>

@endsection