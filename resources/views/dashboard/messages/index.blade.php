@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Messages</h3>
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
          <table class="table table-striped mb-0" id="table1">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr> 
            </thead>
            <tbody>
              @foreach ($messages as $message)  
              @php
                  $status = $message->status;
                  $class = $status == 'read' ? 'bg-success text-white' : 'bg-danger text-white';
              @endphp
              <tr>
                  <td>{{ $message->name }}</td>
                  <td>{{ $message->email }}</td>
                  <td>
                    <span class="{{ $class }}">{{ $message->status }}</span>
                  </td>
                  <td class="d-flex">
                    <a href="/dashboard/messages/{{ $message->id }}/show"><i class="badge-circle badge-circle-light-secondary" data-feather="eye"></i></a>
                    <form action="/dashboard/messages/{{ $message->id }}" method="post">
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