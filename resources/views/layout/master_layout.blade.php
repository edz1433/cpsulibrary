<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Library Management System</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('style/plugins/fontawesome-free-v6/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('style/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/css/custom.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('style/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('style/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('style/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('style/plugins/fullcalendar/fullcalendar.css') }}">

    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('style/dist/img/CPSU_L.png') }}">

    <style>
        /* body{
            background-image: url('style/dist/img/bg-gradient.jpg');
            background-size: cover; /* or contain, depending on your needs */
            background-repeat: no-repeat;
            background-attachment: fixed; /* or scroll, depending on your needs */
        } */
        .bg-none{
            background-color: transparent !important;
            background: none !important;
        }
        .main-header-new{
            height: 38px !important;
        }
        .bblr{
            border-bottom-left-radius: 20px !important;
        }
        .mtop-n{
            margin-top: -6px;
        }
        .bg-g{
            background-color: #09993f;
        }
        td, th{
            padding: 5px !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12 bblr bg-light" style="margin-left: 2%; margin-top: 9px; background-color: #09993f !important; position: sticky; top: 9px; z-index:999;">
                <nav class="main-header-new bblr navbar navbar-expand navbar-default bg-g mt-2">
                    <ul class="navbar-nav mr-auto mtop-n">
                        <li class="">
                            <a href="#" aria-expanded="false" style="background-color: transparent !important;">
                                <img src="{{ asset('style/dist/img/library-logo.png') }}" class="circle" width="30">
                               <span class="text-light ml-1" ><b>CPSU LIBRARY</b></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mtop-n">
                        <li class="nav-item d-sm-none">
                            <a data-widget="pushmenu" href="#" role="button" style="color: #fff"><i class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav ml-auto mtop-n" >
                        <li class="nav-item dropdown" style="margin-top: 0.6%;">
                            <a data-toggle="dropdown" href="#" aria-expanded="false" style="color: #fff; margin-right: 10px; background-color: transparent !important;">
                                <img src="{{ asset('style/dist/img/CPSU_L.png') }}" class="circle" width="30" style="margin-right: 7px; margin-right: 16px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; margin-right: 20px;">
                                <div class="dropdown-divider"></div>
                                <div class="pt-3 pb-3 pl-3 pr-3 text-center">
                                    <p class="pt-3">
                                        {{ auth()->user()->fname }} {{ auth()->user()->lname }} {{ auth()->user()->mname }}<br>
                                    </p>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="modal-footer justify-content-between">
                                    <a href="" class="btn btn-default btn-sm">
                                        <i class="fas fa-user"></i> Account
                                    </a>
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-sm">
                                        <i class="fas fa-sign-out"></i> Sign Out
                                    </a>
                                </div>
                                {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-2">
                <aside class="main-sidebar elevation-0 mt-2">
                    <div class="sidebar bg-none">
                        @include('control.sidebar')     
                    </div>
                </aside>
            </div>
            <div class="col-md-10">
                @yield('body')
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

    <!-- Toastr -->
    <script src="{{ asset('style/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('style/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('style/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('style/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
    <script src="{{ asset('style/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('style/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('style/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('style/dist/js/dark-mode.js') }}"></script>
    
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('style/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('style/plugins/fullcalendar/fullcalendar.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('style/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('style/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('style/plugins/chart.js/Chart.min.js') }}"></script>

    <script>
        @if(Session::has('error'))
            toastr.options = {
                "closeButton":true,
                "progressBar":true,
                'positionClass': 'toast-bottom-right'
            }
            toastr.error("{{ session('error') }}")
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    'positionClass': 'toast-bottom-center'
                }
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        @if(Session::has('success'))
            toastr.options = {
                "closeButton":true,
                "progressBar":true,
                'positionClass': 'toast-bottom-right'
            }
            toastr.success("{{ session('success') }}")
        @endif
    </script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": true, 
                "autoWidth": true,
                //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
        labels: [
            'Student',
            'Faculty',
            'Staff',
            'Visitor',
        ],
        datasets: [
            {
            data: [700,500,400,600],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
            }
        ]
        }
        var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
        })
    </script>
    <script>
         //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
    </script>

</body>
</html>