<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>CPSU Library || Visitors</title>
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
    .bg-image {
        background-image: url("{{ asset('style/dist/img/bg-library.jpg') }}");
        background-size: cover; 
        background-repeat: repeat;
        display: flex;
        justify-content: center;
        align-items: center; 
        height: 100vh; 
        margin: 0; 
        padding: 0; 
        background-position: center 50%;
    }

    .floating-button {
        position: fixed;
        top: 50%;
        right: 0px;
        padding: 15px 25px;
        background-color: #d5ba33de;
        color: white;
        border-radius: 100% 0 0 100%;
        cursor: pointer;
        z-index: 1000;
        transform: translateY(-50%);
    }

    .floating-button:hover {
        
    }

    /* Hide the input field */
    #barcode-input {
        opacity: 0; /* Make the input field transparent */
        position: absolute; /* Position it absolutely so it doesn't affect layout */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Send it to the back so it's not clickable */
    }

    #submit {
        display: none;
    }

    /* Responsive adjustments */
    @media only screen and (max-width: 768px) {
        .login-page {
            padding: 20px;
        }
        .login-logo {
            text-align: center;
        }
        .login-logo img {
            width: 80%;
        }
    }

</style>
</head>
<body>
    <div class="bg-image">
        <form action="{{ route('logAttendance') }}" method="GET">
            <input type="text" name="bcodeScan" id="barcode-input" placeholder="Scan barcode" autofocus>
            <button id="submit" type="submit">Submit</button>
        </form>
        <div class="row">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
                <div class="login-page" style="background-color: rgba(249, 249, 249, 0.5); height: 660px !important;">
                    <div class="login-logo">
                        <a href="./">
                            <img src="{{ asset('style/dist/img/library-logo.png') }}" class="img-responsive" width="40%">
                        </a>
                    </div>
                    <div class="">
                        <p class="login-box-msg" style="color: #358359;">Welcome to <b>CPSU LIBRARY-MS</b></p>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-block btn-success" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Time In</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-block" style="background-color: #ffca2c;">Time Out</button>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('monitoring.modal')
</body>
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
    $('#loginModal').on('shown.bs.modal', function (e) {
        
    });
    
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
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

</script>
</html>
