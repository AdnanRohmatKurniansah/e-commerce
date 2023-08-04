<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown nav-icon">
                <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-lg-inline-block">
                        <i data-feather="bell"></i>
                        @php
                            $orders = \App\Models\Order::where('status', '!=', 'finished')->orderBy('id', 'desc')->paginate(3);
                        @endphp
                        <sup class="mb-3 fs-6 text-info">{{ $orders->count() }}</sup>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                    <h6 class='py-2 px-4'>Notifications</h6>
                    <ul class="list-group rounded-none">
                        @foreach ($orders as $order) 
                            <li class="list-group-item border-0 align-items-start">
                                <div class="avatar bg-success me-3">
                                    <span class="avatar-content"><i data-feather="shopping-cart"></i></span>
                                </div>
                                <div>
                                    <h6 class='text-bold'>New Order</h6>
                                    <div class='text-xs'>
                                        An order from <a href="/dashboard/order/{{ Crypt::encryptString($order->id) }}">{{ $order->fname }}</a>
                                    </div>
                                    <small style="font-size: 11px">{{ $order->created_at->format('d M Y h:i') }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="dropdown nav-icon me-2">
                <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-lg-inline-block">
                        <i data-feather="mail"></i>
                        @php
                            $messages = \App\Models\Message::where('status', 'unread')->get();
                        @endphp
                        <sup class="mb-3 fs-6 text-info">{{ $messages->count() }}</sup>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                    <h6 class='py-2 px-4'>Messages</h6>
                    <ul class="list-group rounded-none">
                        @if ($messages->count())
                            @foreach ($messages as $message)   
                            <li class="list-group-item border-0 align-items-start">
                                <div class="avatar bg-info me-3">
                                    <span class="avatar-content"><i data-feather="message-circle"></i></span>
                                </div>
                                <a href="/dashboard/messages/{{ $message->id }}/show">
                                    <div>
                                        <h6 class='text-bold'>New Message</h6>
                                        <p class='text-xs'>
                                            An message from {{ $message->name }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @else
                            <li class="list-group-item border-0 align-items-start">
                                <small class='font-bold'>There are no messages for now</small>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar me-1">
                        @if (auth()->user()->profile != null)
                            <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="" srcset="">
                        @else
                            <img src="/assets/admin/images/user.png" alt="" srcset="">
                        @endif
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="/dashboard/profile"><i data-feather="user"></i> Account</a>
                    <div class="dropdown-divider"></div>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i data-feather="log-out"></i> Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>