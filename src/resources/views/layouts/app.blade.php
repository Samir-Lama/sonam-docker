<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "LEVEL-UP")</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="{{ asset("assets/css/feather.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @livewireStyles
    @stack('styles')
</head>
<body>
    @include('partials.topbar')

    @if (isset($slot))
        {{ $slot }}
    @else
        @yield("content")
    @endif

    @include('partials.footer')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init({
            once: true
        });
        Livewire.on("popup", function (data) {
            Swal.fire({
                icon: data.type ?? "success",
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (data.trigger) {
                    Livewire.emit(data.trigger);
                }
            });
        })
    </script>
    @stack('scripts')
</body>
</html>
