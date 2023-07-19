<div class="sidebar-menu">
    <ul class="menu">
            <li class='sidebar-title'>Main Menu</li>
            <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class='sidebar-link'>
                    <i data-feather="home" width="20"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/orders') || Request::is('dashboard/order*') ? 'active' : '' }}">
                <a href="/dashboard/orders" class='sidebar-link'>
                    <i data-feather="shopping-cart" width="20"></i> 
                    <span>Orders</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/products*') ? 'active' : '' }} has-sub">
                <a href="#" class='sidebar-link'>
                    <i data-feather="package" width="20"></i> 
                    <span>Products</span>
                </a>
                <ul class="submenu">
                    <li><a href="/dashboard/products">Products</a></li>
                    <li><a href="/dashboard/products/categories">Category</a></li>
                    <li><a href="/dashboard/products/comments">Comments</a></li>
                    <li><a href="/dashboard/products/reviews">Reviews</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/blogs*') ? 'active' : '' }} has-sub">
                <a href="#" class='sidebar-link'>
                    <i data-feather="book" width="20"></i> 
                    <span>Blogs</span>
                </a>
                <ul class="submenu">
                    <li><a href="/dashboard/blogs">Blogs</a></li>
                    <li><a href="/dashboard/blogs/categories">Categories</a></li>
                    <li><a href="/dashboard/blogs/comments">Comments</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/messages*') ? 'active' : '' }}">
                <a href="/dashboard/messages" class='sidebar-link'>
                    <i data-feather="mail" width="20"></i> 
                    <span>Messages</span>
                </a>
            </li>
            <li class='sidebar-title'>Interface</li>
            <li class="sidebar-item {{ Request::is('dashboard/slides*') ? 'active' : '' }}">
                <a href="/dashboard/slides" class='sidebar-link'>
                    <i data-feather="image" width="20"></i> 
                    <span>Slides</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/features*') ? 'active' : '' }}">
                <a href="/dashboard/features" class='sidebar-link'>
                    <i data-feather="check-square" width="20"></i> 
                    <span>Features</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/galleries*') ? 'active' : '' }}">
                <a href="/dashboard/galleries" class='sidebar-link'>
                    <i data-feather="camera" width="20"></i> 
                    <span>Galleries</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/brands*') ? 'active' : '' }}">
                <a href="/dashboard/brands" class='sidebar-link'>
                    <i data-feather="award" width="20"></i> 
                    <span>Brands</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/contacts*') ? 'active' : '' }}">
                <a href="/dashboard/contacts" class='sidebar-link'>
                    <i data-feather="phone-call" width="20"></i> 
                    <span>Contact</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('dashboard/footer*') || Request::is('dashboard/sosmeds*') ? 'active' : '' }} has-sub">
                <a href="#" class='sidebar-link'>
                    <i data-feather="instagram" width="20"></i> 
                    <span>Footer and Sosmed</span>
                </a>
                <ul class="submenu">
                    <li><a href="/dashboard/footer">Footer</a></li>
                    <li><a href="/dashboard/sosmeds">Sosmeds</a></li>
                </ul>
            </li>
        </ul>
    </div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>