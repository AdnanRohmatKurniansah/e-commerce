<div class="sidebar-menu">
    <ul class="menu">
            <li class='sidebar-title'>Main Menu</li>
            <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class='sidebar-link'>
                    <i data-feather="home" width="20"></i> 
                    <span>Dashboard</span>
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
            <li class='sidebar-title'>Forms &amp; Tables</li>
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
            
        
            
            <li class="sidebar-item  ">

                <a href="form-layout.html" class='sidebar-link'>
                    <i data-feather="layout" width="20"></i> 
                    <span>Form Layout</span>
                </a>

                
            </li>
            
        
            
            <li class="sidebar-item  ">

                <a href="form-editor.html" class='sidebar-link'>
                    <i data-feather="layers" width="20"></i> 
                    <span>Form Editor</span>
                </a>

                
            </li>
            
        
            
            <li class="sidebar-item  ">

                <a href="table.html" class='sidebar-link'>
                    <i data-feather="grid" width="20"></i> 
                    <span>Table</span>
                </a>

                
            </li>
            
        
            
            <li class="sidebar-item  ">

                <a href="table-datatable.html" class='sidebar-link'>
                    <i data-feather="file-plus" width="20"></i> 
                    <span>Datatable</span>
                </a>

                
            </li>
            
        
            
            <li class='sidebar-title'>Extra UI</li>
            
        
            
            <li class="sidebar-item  has-sub">

                <a href="#" class='sidebar-link'>
                    <i data-feather="user" width="20"></i> 
                    <span>Widgets</span>
                </a>

                
                <ul class="submenu ">
                    
                    <li>
                        <a href="ui-chatbox.html">Chatbox</a>
                    </li>
                    
                    <li>
                        <a href="ui-pricing.html">Pricing</a>
                    </li>
                    
                    <li>
                        <a href="ui-todolist.html">To-do List</a>
                    </li>
                    
                </ul>
                
            </li>
            
        
            
            <li class="sidebar-item  has-sub">

                <a href="#" class='sidebar-link'>
                    <i data-feather="trending-up" width="20"></i> 
                    <span>Charts</span>
                </a>

                
                <ul class="submenu ">
                    
                    <li>
                        <a href="ui-chart-chartjs.html">ChartJS</a>
                    </li>
                    
                    <li>
                        <a href="ui-chart-apexchart.html">Apexchart</a>
                    </li>
                    
                </ul>
                
            </li>
            
        
            
            <li class='sidebar-title'>Pages</li>
            
        
            
            <li class="sidebar-item  has-sub">

                <a href="#" class='sidebar-link'>
                    <i data-feather="user" width="20"></i> 
                    <span>Authentication</span>
                </a>

                
                <ul class="submenu ">
                    
                    <li>
                        <a href="auth-login.html">Login</a>
                    </li>
                    
                    <li>
                        <a href="auth-register.html">Register</a>
                    </li>
                    
                    <li>
                        <a href="auth-forgot-password.html">Forgot Password</a>
                    </li>
                    
                </ul>
                
            </li>
            
        
            
            <li class="sidebar-item  has-sub">

                <a href="#" class='sidebar-link'>
                    <i data-feather="alert-circle" width="20"></i> 
                    <span>Errors</span>
                </a>

                
                <ul class="submenu ">
                    
                    <li>
                        <a href="error-403.html">403</a>
                    </li>
                    
                    <li>
                        <a href="error-404.html">404</a>
                    </li>
                    
                    <li>
                        <a href="error-500.html">500</a>
                    </li>
                    
                </ul>
                
            </li>
            
        
    </ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>