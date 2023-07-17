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
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i data-feather="file-text" width="20"></i> 
                    <span>Form Elements</span>
                </a>
                <ul class="submenu ">
                    <li>
                        <a href="form-element-input.html">Input</a>
                    </li>
                    
                    <li>
                        <a href="form-element-input-group.html">Input Group</a>
                    </li>
                    
                    <li>
                        <a href="form-element-select.html">Select</a>
                    </li>
                    
                    <li>
                        <a href="form-element-radio.html">Radio</a>
                    </li>
                    
                    <li>
                        <a href="form-element-checkbox.html">Checkbox</a>
                    </li>
                    
                    <li>
                        <a href="form-element-textarea.html">Textarea</a>
                    </li>
                </ul>
            </li>
    </ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>