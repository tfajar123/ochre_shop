<li class="pe-3">
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <svg class="user">
            <use xlink:href="#user"></use>
        </svg>
    </a>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tabs-listing">
                        <nav>
                            <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                                <button class="nav-link text-capitalize active" id="nav-sign-in-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab"
                                    aria-controls="nav-sign-in" aria-selected="true">Sign
                                    In</button>
                                <button class="nav-link text-capitalize" id="nav-register-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register"
                                    aria-selected="false">Register</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <!-- Sign In -->
                            <div class="tab-pane fade active show" id="nav-sign-in" role="tabpanel">
                                <form id="loginForm">
                                    <div class="form-group py-3">
                                        <label class="mb-2">Email address *</label>
                                        <input type="email" name="email" placeholder="Your Email"
                                            class="form-control w-100 rounded-3 p-3" required>
                                    </div>
                                    <div class="form-group pb-3">
                                        <label class="mb-2">Password *</label>
                                        <input type="password" name="password" placeholder="Your Password"
                                            class="form-control w-100 rounded-3 p-3" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 my-3">Login</button>
                                </form>
                            </div>

                            <!-- Register -->
                            <div class="tab-pane fade" id="nav-register" role="tabpanel">
                                <form id="registerForm">
                                    <div class="form-group py-3">
                                        <label class="mb-2">Name *</label>
                                        <input type="text" name="name" placeholder="Your Name"
                                            class="form-control w-100 rounded-3 p-3" required>
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="mb-2">Email address *</label>
                                        <input type="email" name="email" placeholder="Your Email Address"
                                            class="form-control w-100 rounded-3 p-3" required>
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="mb-2">Password *</label>
                                        <input type="password" name="password" placeholder="Your Password"
                                            class="form-control w-100 rounded-3 p-3" required>
                                    </div>
                                    <div class="form-group pb-3">
                                        <label class="mb-2">Confirm Password *</label>
                                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                            class="form-control w-100 rounded-3 p-3" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 my-3">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>