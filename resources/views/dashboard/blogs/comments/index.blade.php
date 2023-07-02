@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Blog Comments</h3>
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
                <th>Name</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
              </tr> 
            </thead>
            <tbody>
              @foreach ($blogComments as $comment)  
              <tr>
                  <td>{{ $comment->name }}</td>
                  <td>{{ Str::limit($comment->message, 200) }}</td>
                  <td>{{ $comment->created_at->format('F j, Y \a\t g:i a') }}</td>
                  <td class="d-flex">
                    <form action="/dashboard/blogs/comments/{{ $comment->id }}" method="post">
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