<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | BiteStore</title>
    
    <link rel="stylesheet" href="assets/admin/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/admin/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/admin/css/app.css">
    <link rel="shortcut icon" href="assets/admin/images/favicon.svg" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="assets/admin/images/logo.svg" alt="" srcset="">
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
    <script src="assets/admin/js/feather-icons/feather.min.js"></script>
    <script src="assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/admin/js/app.js"></script>
    
    <script src="assets/admin/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/admin/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/admin/js/pages/dashboard.js"></script>

    <script src="assets/admin/js/main.js"></script>
    @if(Session::has('success'))
    <script>
        const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
		})

		Toast.fire({
		icon: 'success',
		title: '{{ session("success") }}'
		})
    </script>
    @endif
</body>
</html>
