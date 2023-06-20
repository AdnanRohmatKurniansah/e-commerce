@if(Session::has('success'))
    <script>
        const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		iconColor: 'white',
		color: '#fff',
		timerProgressBar: true,
		background: '#a5dc86',
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

@if(Session::has('error'))
    <script>
        const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		iconColor: 'white',
		color: '#fff',
		background: '#f27474',
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
		})

		Toast.fire({
		icon: 'error',
		title: '{{ session("error") }}'
		})
    </script>
@endif
@if(Session::has('update'))
    <script>
        const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		iconColor: 'white',
		color: '#fff',
		background: '#3fc3ee',
		
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
		})

		Toast.fire({
		icon: 'success',
		title: '{{ session("update") }}'
		})
    </script>
@endif
