@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Message Detail</h3>
            </div>
        </div>
    </div>

    <section id="basic-vertical-layouts" class="mt-3"> 
        <div class="row match-height">
            <div class="col-9">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="m-3"><span class="font-bold">Name</span> : {{ $message->name }}</li>
                        <li class="m-3"><span class="font-bold">Email</span> : {{ $message->email }}</li>
                        <li class="m-3"><span class="font-bold">Message</span> : {{ $message->message }}</li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

</div>


@endsection