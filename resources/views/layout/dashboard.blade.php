<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard | Karma</title>
    
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.css">
    
    <script src="/assets/admin/vendors/chartjs/Chart.min.js?v=1"></script>
    <link rel="stylesheet" href="/assets/admin/vendors/chartjs/Chart.min.css?v=1">

    <link rel="stylesheet" href="/assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/admin/css/app.css?v=3">
    <link rel="shortcut icon" href="/assets/admin/images/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/admin/vendors/summernote/summernote-lite.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/assets/admin/vendors/summernote/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="/assets/admin/vendors/simple-datatables/style.css?v=2">
    <style>
        @media print {
            #no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header text-info pb-0" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 40px">
                    <i class="fa-solid fa-cart-shopping text-primary fs-2"></i> Karma<span class="text-primary">.</span>
                </div>
                @include('components.dashboard.sidebar')
                </div>
            </div>
            <div id="main">
                @include('components.dashboard.header')
                    @yield('content')
                @include('components.dashboard.footer')
        </div>
    </div>
    <script src="/assets/admin/js/feather-icons/feather.min.js"></script>
    <script src="/assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/admin/js/app.js"></script>
    <script src="/assets/admin/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/admin/js/pages/dashboard.js?v=1"></script>
    <script src="/assets/admin/vendors/simple-datatables/simple-datatables.js?v=2"></script>
    <script src="/assets/admin/js/vendors.js?v=1"></script>
    <script src="/assets/admin/js/main.js"></script>
    @include('vendor.alert')
</body>
</html>
