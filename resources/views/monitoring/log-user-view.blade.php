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
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('style/dist/css/adminlte.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('style/plugins/toastr/toastr.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('style/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('style/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{ asset('style/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
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
                                <div class="col-6">
                                    <button type="button" class="btn btn-block btn-success" onclick="changeAction('in')" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Time In</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-block" onclick="changeAction('out')" data-dismiss="modal" data-toggle="modal" data-target="#loginModal" style="background-color: #ffca2c;">Time Out</button>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <!-- jQuery -->
    <script src="{{ asset('style/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('style/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('style/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('style/dist/js/adminlte.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('style/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('style/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('style/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('style/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
    $(function () {
            $('.select2').select2();
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
        });
    </script>
    <script>
        @if(Session::has('success1'))
            Swal.fire({
                text: '{{ session('success1') }}',
                icon: 'success',
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
                    $('#fullName').empty();
                    $.each(response, function(index, value) {
                        $('#fullName').append('<option value="' + value.id + '">' + value.lname + ', ' + value.s_fname + ' ' + value.s_mname + '</option>');
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
        });

    </script> 

    <script>
        $(function () {
            $('.visitor-staff').css('display', 'none');
        });

        function typeChange(val){
            if(val == 'Students' || val == 'Faculty'){
                $('.student-faculty').css('display', 'block');
                $('.visitor-staff').css('display', 'none');
            }else{
                $('.student-faculty').css('display', 'none');
                $('.visitor-staff').css('display', 'block');
                if(val == 'Staff'){
                    $('.office').css('display', 'block');
                    $('.campus').css('display', 'none');
                }
                if(val == 'Visitor'){
                    $('.office').css('display', 'none');
                    $('.campus').css('display', 'block');
                }
            }
        } 
    </script>

    <script>
        function changeAction(action){
            $('#action').val(action);
        }
    </script>
</body>
</html>