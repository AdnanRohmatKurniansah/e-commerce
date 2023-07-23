<header class="header_area sticky-header">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light main_box">
      <div class="container">
        <a class="navbar-brand logo_h" href="/"><img src="/assets/img/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav ml-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item {{ Request::is('products*') || Request::is('product*') ? 'active' : '' }}"><a class="nav-link" href="/products">Products</a></li>
            <li class="nav-item {{ Request::is('blog*') ? 'active' : '' }}"><a class="nav-link" href="/blog">Blog</a></li>
            <li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}"><a class="nav-link" href="/contact">Contact</a></li>
            @auth 
              <li class="nav-item submenu dropdown">
                <a class="nav-link dropdown-toggle user" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false" href="#">
                @if (auth()->user()->profile == null)
                  <img src="/assets/admin/images/user.png" style="border-radius: 50%" width="25" alt="">
                @else
                  @if (auth()->user()->provider == null)
                    <img src="{{ asset('storage/' . auth()->user()->profile) }}" style="border-radius: 50%" width="25" alt="">
                  @else
                    <img src="{{ auth()->user()->profile }}" style="border-radius: 50%" width="25" alt="">
                  @endif
                @endif
              </a>
                <ul class="dropdown-menu">
                  @if (auth()->user()->role == 'admin')
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                  @else
                    <li class="nav-item"><a class="nav-link" href="/profile">Account</a></li>
                    <li class="nav-item"><a class="nav-link" href="/transaction">Transaction</a></li>
                  @endif
                  <li class="nav-item">
                    <form action="/logout" method="post">
                      @csrf
                      <button type="submit" class="nav-link border-0 w-100 text-left">Logout</button>
                    </form>
                  </li>
                </ul>
              </li>
            @endauth
            @guest 
              <li class="nav-item"><a class="nav-link" href="/login"><span class="ti-user"></span></a></li>
            @endguest
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @auth
            @php
              $user = Auth::user();
              $id = $user->id;
              $count = \App\Models\Cart::where('user_id', $id)
                      ->whereDoesntHave('orders')
                      ->count();
            @endphp
            <li class="nav-item"><a href="/show_cart" class="cart"><span class="ti-bag"></span><sup class="pl-1 text-info">{{ $count }}</sup></a></li>
            @endauth
            @guest
            <li class="nav-item"><a href="/show_cart" class="cart"><span class="ti-bag"></span></a></li>
            @endguest
            <li class="nav-item">
              <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div class="search_input" id="search_input_box">
    <div class="container">
      <form class="d-flex justify-content-between" action="/products">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" id="search_input" placeholder="Search Here">
        <button type="submit" class="btn"></button>
        <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
      </form>
    </div>
  </div>
</header>