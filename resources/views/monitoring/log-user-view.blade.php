<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CPSU || Library</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('style/plugins/fontawesome-free-v6/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('style/plugins/icheck-bootstrap/icheck-bootstrap.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('style/dist/css/adminlte.css') }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('style/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- DataTable -->
        <link rel="stylesheet" href="{{ asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('style/plugins/toastr/toastr.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('style/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

        <!-- Logo  -->
        <link rel="shortcut icon" type="" href="{{ asset('style/dist/img/CPSU_L.png') }}">
        
        <style>
            body {
                overflow: hidden;
            }
            
            .loginpage-left {
                background-image: url({{ asset('style/dist/img/bg-library.jpg') }});
                background-size: cover;
                background-position: center;
                height: 100vh !important;
            }
            
            .loginpage-right {
                height: 100%;
            }

            #barcode-input {
                opacity: 0; 
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1; 
            }

            #submit {
                display: none;
            }

            .capitalize-first {
                text-transform: capitalize;
            }
        </style>
    </head>
    <body class="hold-transition">
        <div class="container-fluid">
            <form action="{{ route('logAttendance') }}" method="GET">
                @csrf
                <input type="text" name="bcodeScan" id="barcode-input" placeholder="Scan barcode" autofocus>
                <button id="submit" type="submit">Submit</button>
            </form>
            
            @include('monitoring.modal')
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8 loginpage-left"></div>
                <div class="col-md-4 col-sm-12 loginpage-right">
                    <div class="login-page" style="background-color: rgba(249, 249, 249, 0.5) !important; height: 660px !important;">
                        <div class="login-logo">
                            <a href="./">
                                <img src="{{ asset('style/dist/img/library-logo.png') }}" class="img-responsive" width="40%">
                            </a>
                        </div>
                        <div class="">
                            <p class="login-box-msg" style="color: #358359;">Welcome to <b>CPSU LIBRARY-MS</b></p>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-block btn-success" onclick="changeAction('in')" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Mark Attendance</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- jQuery -->
    <script src="{{ asset('app.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('style/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('style/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('style/dist/js/adminlte.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('style/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('style/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('style/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('style/plugins/chart.js/Chart.min.js') }}"></script>

    <script>
    $(function () {
        $('.select2').select2();
        trigerStudent('Students');
    });
    </script>
    <script>
        function trigerStudent(val){
            var userType = val;

            $.ajax({
                url: '{{ route("getUserType") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { userType: userType },
                success: function(response) {
                    $('#fullName').empty();
                    $('#fullName').empty().append('<option value=""></option>'); // Append empty option
                    $.each(response, function(index, value) {
                        $('#fullName').append('<option value="' + value.id + '">' + value.lname + ', ' + value.fname + ' ' + value.mname + '</option>');
                    });
                    $('#fullName').select2({
                        theme: 'bootstrap4',
                        minimumResultsForSearch: 0 // Enable search box
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
    <script>
        function nameTrigger(val){

            var usertype = document.getElementById("userType").value;
            var user_name = document.getElementById("user-name-div");

            if(val != ''){
                $('.visitor-staff').css('display', 'none');
            }else{
                $('.visitor-staff').css('display', 'block');
            }
            if(usertype == "Staff" || usertype == "Guest"){
                user_name.classList.remove("col-4");
                user_name.classList.add("col-8");
            }
        }
    </script>
    <script>
        @if(Session::has('success'))
            Swal.fire({
                text: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false, 
                timer: 1500 
            });
        @endif

        @if(Session::has('error'))
            Swal.fire({
                text: '{{ session('error') }}',
                icon: 'error',
                showConfirmButton: false, 
                timer: 1500 
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                text: '{{ $errors->first() }}',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        $(document).ready(function () {
            $('#submit').on('click', function (event) {
                event.preventDefault(); 
                var barcode = $('#barcode-input').val();
                $.ajax({
                    url: "{{ route('logAttendance') }}",
                    type: "GET",
                    data: {
                        bcodeScan: barcode
                    },
                    success: function (data) {
                        Swal.fire({
                            text: data,
                            icon: 'success',
                            showConfirmButton: false, 
                            timer: 1500 
                        });

                        setTimeout(function() {
                            $('#barcode-input').val('');
                        }, 1500);
                    }
                });
            });

        });

        $('#loginModal').on('hidden.bs.modal', function (e) {
            location.reload();
        });

        $('#userType').change(function() {
            var userType = $(this).val();

            $.ajax({
                url: '{{ route("getUserType") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { userType: userType },
                success: function(response) {
                    $('#fullName').empty().append('<option value=""></option>');
                    $.each(response, function(index, value) {
                        $('#fullName').append('<option value="' + value.id + '">' + value.lname + ', ' + value.fname + ' ' + value.mname + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

    </script> 

    <script>
        $(function () {
            $('.visitor-staff').css('display', 'none');
        });

        function typeChange(val){
            var user_type = document.getElementById("user-type-div");
            var user_name = document.getElementById("user-name-div");
            if(val == 'Students' || val == 'Faculty'){ 
                $('.student-faculty').css('display', 'block');
                $('.visitor-staff').css('display', 'none');          
                user_type.classList.remove("col-4");
                user_type.classList.add("col-6");
                user_name.classList.remove("col-4");
                user_name.classList.add("col-6");
            }else{
                $('.student-faculty').css('display', 'none');
                $('.visitor-staff').css('display', 'block');
                if(val == 'Staff'){
                    $('.office').css('display', 'block');
                    $('.campus').css('display', 'none');
                }
                if(val == 'Guest'){
                    $('.office').css('display', 'none');
                    $('.campus').css('display', 'block');
                }
                user_type.classList.remove("col-6");
                user_type.classList.add("col-4");
                user_name.classList.remove("col-6");
                user_name.classList.add("col-4");

                user_name.classList.remove("col-8");
                user_name.classList.add("col-4");
            }
        } 
    </script>

    <script>
        function changeAction(action){
            $('#action').val(action);
        }
    </script>
</html>