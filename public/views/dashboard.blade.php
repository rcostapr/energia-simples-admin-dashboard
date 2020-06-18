<!doctype html>
<html lang="pt">

<head>
    <title>{{ $metatitle }}</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $metadescr }}" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet" type="text/css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="/css/energia-simples-admin.min.css" rel="stylesheet" />

</head>

<body id="page-top">
    <!-- Brand Mobiles -->
    @include('partials.brandmobile')
    <!-- End of Brand Mobiles -->

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('partials.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('modal.logout')

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/energia-simples-admin.min.js"></script>

    <!-- CK Editor -->
    <script src="/js/components/ckeditor/ckeditor.js"></script>
    <script src="/js/components/ckeditor.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/toastr/toastr.min.js"></script>
    <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>

    @if (is_array($customScript))
    @foreach ($customScript as $script)
    <script src="{{ $script }}"></script>
    @endforeach
    @else
    <script src="{{ $customScript }}"></script>
    @endif
</body>

</html>