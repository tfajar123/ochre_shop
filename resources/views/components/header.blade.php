<header id="header" class="site-header">

    <div class="top-info border-bottom d-none d-md-block ">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-md-4">
                    <p class="fs-6 my-2 text-center">Need any help? Call us <a href="#">112233344455</a></p>
                </div>
                <div class="col-md-4 border-start border-end">
                    <p class="fs-6 my-2 text-center">Summer sale discount off 60% off! <a
                            class="text-decoration-underline" href="index.html">Shop Now</a></p>
                </div>
                <div class="col-md-4">
                    <p class="fs-6 my-2 text-center">2-3 business days delivery & free returns</p>
                </div>
            </div>
        </div>
    </div>

    <nav id="header-nav" class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="navbar-brand" href="\">
                <img src="{{ asset('images/ochre.png') }}" class="logo" style="width: 100px;" >
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg class="navbar-icon">
                    <use xlink:href="#navbar-icon"></use>
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="\">
                        <img src="{{ asset('images/ochre.png') }}" class="logo" style="width: 100px;">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                        aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar"
                        class="navbar-nav text-uppercase justify-content-start justify-content-lg-center align-items-start align-items-lg-center flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#">Blogs</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link me-4 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu animate slide border">
                                <li>
                                    <a href="#" class="dropdown-item fw-light">About</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item fw-light">Shop</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item fw-light">Single Product</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item fw-light">Blog</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item fw-light">Single Post</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item fw-light">Contact</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="index.html">Contact</a>
                        </li>
                    </ul>
                    <div class="user-items d-flex">
                        <ul class="d-flex justify-content-end list-unstyled mb-0">
                            <li class="search-item pe-3">
                                <a href="#" class="search-button">
                                    <svg class="search">
                                        <use xlink:href="#search"></use>
                                    </svg>
                                </a>
                            </li>
                            @include('components.login')           
                            <li class="cart-dropdown dropdown" id="cart-dropdown">
                              <!-- tombol dan badge akan diisi JS -->
                              <a id="cart-toggle" class="dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <svg class="cart"><use xlink:href="#cart"></use></svg>
                                <span id="cart-count" class="fs-6 fw-light"></span>
                              </a>
                              <div id="cart-menu" class="dropdown-menu animate slide dropdown-menu-start dropdown-menu-lg-end p-3" data-bs-popper="static"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>