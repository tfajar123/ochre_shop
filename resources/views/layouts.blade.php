<!DOCTYPE html >
<html lang="en" data-mdb-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayuh.id</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbarScroll">
        <div class="container">
            <a class="navbar-brand text-black" href="/">Kayuh.id</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-black" href="/" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ route('bicycles.index') }}">Bicycles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/contact">Contact</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ route('login') }}">Login</a>
                    </li>
                    @else
                        @if(Auth::user()->roles === 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-black" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link text-black" href="{{ route('order') }}">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form action="{{ route('logout') }}" id="logout-form" method="post">@csrf</form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        @yield('content')

    </div>

    <!-- footer section-->
    <footer class="footer">
        <div class="footer-content">
            <div class="social-icons">
                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="copyright">
                &copy; 2024 Kayuh.id.
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // add class navbarDark on navbar scroll
        const header = document.querySelector('.navbar');

        window.onscroll = function() {
            var top = window.scrollY;
            if(top >=100) {
                header.classList.add('navbarColor');
            }
            else {
                header.classList.remove('navbarColor');
            }
        }
    </script>
</body>
</html>