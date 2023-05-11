<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield("title", "Dashboard") | LEVEL-UP</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("admin-assets/vendors/css/vendor.bundle.base.css") }}">
    <link rel="stylesheet" href="{{ asset("admin-assets/vendors/css/vendor.bundle.addons.css") }}">
    <link rel="stylesheet" href="{{ asset("admin-assets/css/shared/style.css") }}">
    <link rel="stylesheet" href="{{ asset("admin-assets/css/demo_1/style.css") }}">

    @livewireStyles
    <style>
        .nav .nav-item.dropdown .dropdown-toggle:after, .navbar-nav .nav-item.dropdown .dropdown-toggle:after {
            content: "arrow_drop_down";
            font-family: "Material Icons Outlined";
        }
        .sidebar > .nav > .nav-item:not(.nav-profile) > .nav-link:before {
            display: none;
        }
        .sidebar > .nav > .nav-item i {
            font-size: 18px;
            margin-right: 5px;
            margin-top: -3px;
        }
        .sidebar > .nav:not(.sub-menu) > .nav-item.active > .nav-link {
            background: #0f25d5!important;
        }
    </style>
    @stack("style")
</head>
<body>
    <div class="container-scroller">
        @include("admin.partials.navbar")

        <div class="container-fluid page-body-wrapper">
            @include("admin.partials.sidebar")

            <div class="main-panel">
                <div class="content-wrapper">
                    @if (isset($slot))
                    {{ $slot }}
                    @else
                    @yield("content")
                    @endif
                </div>

                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">
                            Copyright &copy; LEVEL-UP {{ date("Y") }}
                        </span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset("admin-assets/vendors/js/vendor.bundle.base.js") }}"></script>
    <script src="{{ asset("admin-assets/vendors/js/vendor.bundle.addons.js") }}"></script>
    <script src="{{ asset("admin-assets/js/shared/off-canvas.js") }}"></script>
    <script src="{{ asset("admin-assets/js/shared/misc.js") }}"></script>
    <script src="{{ asset("admin-assets/js/demo_1/dashboard.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireScripts
    <script>
        @if (session()->has("popup_message"))
            Swal.fire({
                title: "Success",
                text: "{{ session("popup_message") }}",
                icon: "success"
                ,showConfirmButton: false,
                timer: 1500
            });
        @endif

        Livewire.on("popup", function (data) {
            Swal.fire({
                icon: data.type ?? "success",
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            });
        })

        Livewire.on("confirm", function (data) {
            Swal.fire({
                title: data.title,
                text: data.message,
                icon: data.type ?? "warning",
                showCancelButton: true,
                confirmButtonText: data.confirmButtonText ?? "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit(data.trigger, data.id);
                }
            });
        });
    </script>
    @stack("javascript")
</body>
</html>
