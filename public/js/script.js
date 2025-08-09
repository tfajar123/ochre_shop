(function ($) {
    "use strict";

    var searchPopup = function () {
        // open search box
        $("#header-nav").on("click", ".search-button", function (e) {
            $(".search-popup").toggleClass("is-visible");
        });

        $("#header-nav").on("click", ".btn-close-search", function (e) {
            $(".search-popup").toggleClass("is-visible");
        });

        $(".search-popup-trigger").on("click", function (b) {
            b.preventDefault();
            $(".search-popup").addClass("is-visible"),
                setTimeout(function () {
                    $(".search-popup").find("#search-popup").focus();
                }, 350);
        }),
            $(".search-popup").on("click", function (b) {
                ($(b.target).is(".search-popup-close") ||
                    $(b.target).is(".search-popup-close svg") ||
                    $(b.target).is(".search-popup-close path") ||
                    $(b.target).is(".search-popup")) &&
                    (b.preventDefault(), $(this).removeClass("is-visible"));
            }),
            $(document).keyup(function (b) {
                "27" === b.which &&
                    $(".search-popup").removeClass("is-visible");
            });
    };

    var countdownTimer = function () {
        function getTimeRemaining(endtime) {
            const total = Date.parse(endtime) - Date.parse(new Date());
            const seconds = Math.floor((total / 1000) % 60);
            const minutes = Math.floor((total / 1000 / 60) % 60);
            const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
            const days = Math.floor(total / (1000 * 60 * 60 * 24));
            return {
                total,
                days,
                hours,
                minutes,
                seconds,
            };
        }

        function initializeClock(id, endtime) {
            const clock = document.getElementById(id);
            const daysSpan = clock.querySelector(".days");
            const hoursSpan = clock.querySelector(".hours");
            const minutesSpan = clock.querySelector(".minutes");
            const secondsSpan = clock.querySelector(".seconds");

            function updateClock() {
                const t = getTimeRemaining(endtime);
                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
                minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
                secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);
                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }
            updateClock();
            const timeinterval = setInterval(updateClock, 1000);
        }

        $("#countdown-clock").each(function () {
            const deadline = new Date(
                Date.parse(new Date()) + 28 * 24 * 60 * 60 * 1000
            );
            initializeClock("countdown-clock", deadline);
        });
    };

    var initProductQty = function () {
        $(".product-qty").each(function () {
            var $el_product = $(this);
            var quantity = 0;

            $el_product.find(".quantity-right-plus").click(function (e) {
                e.preventDefault();
                var quantity = parseInt($el_product.find("#quantity").val());
                $el_product.find("#quantity").val(quantity + 1);
            });

            $el_product.find(".quantity-left-minus").click(function (e) {
                e.preventDefault();
                var quantity = parseInt($el_product.find("#quantity").val());
                if (quantity > 0) {
                    $el_product.find("#quantity").val(quantity - 1);
                }
            });
        });
    };

    $(document).ready(function () {
        searchPopup();
        initProductQty();
        countdownTimer();

        /* Video */
        var $videoSrc;
        $(".play-btn").click(function () {
            $videoSrc = $(this).data("src");
        });

        $("#myModal").on("shown.bs.modal", function (e) {
            $("#video").attr(
                "src",
                $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
            );
        });

        $("#myModal").on("hide.bs.modal", function (e) {
            $("#video").attr("src", $videoSrc);
        });

        var mainSwiper = new Swiper(".main-swiper", {
            speed: 500,
            navigation: {
                nextEl: ".main-slider-button-next",
                prevEl: ".main-slider-button-prev",
            },
        });

        var productSwiper = new Swiper(".product-swiper", {
            spaceBetween: 20,
            navigation: {
                nextEl: ".product-slider-button-next",
                prevEl: ".product-slider-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                660: {
                    slidesPerView: 3,
                },
                980: {
                    slidesPerView: 4,
                },
                1500: {
                    slidesPerView: 5,
                },
            },
        });

        var testimonialSwiper = new Swiper(".testimonial-swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: ".testimonial-button-next",
                prevEl: ".testimonial-button-prev",
            },
        });

        var thumb_slider = new Swiper(".thumb-swiper", {
            slidesPerView: 1,
        });
        var large_slider = new Swiper(".large-swiper", {
            spaceBetween: 10,
            effect: "fade",
            thumbs: {
                swiper: thumb_slider,
            },
        });
    }); // End of a document ready

    window.addEventListener("load", function () {
        const preloader = document.getElementById("preloader");
        preloader.classList.add("hide-preloader");
    });
})(jQuery);

async function loadCart() {
    try {
        const res = await fetch("/api/cart", {
            headers: {
                Accept: "application/json",
                Authorization: "Bearer " + localStorage.getItem("api_token"),
            },
        });

        if (!res.ok) throw new Error("Failed to fetch cart");

        const data = await res.json();
        const items = data.cart_items || [];

        const count = items.reduce((s, it) => s + (it.quantity || 0), 0);
        const total = items.reduce(
            (s, it) => s + (Number(it.product.price * it.quantity) || 0),
            0
        );

        document.getElementById("cart-count").textContent = `(${String(
            count
        ).padStart(2, "0")})`;

        const listHtml = items.length
            ? items
                  .map(
                      (it) => `
                <li class="list-group-item bg-transparent d-flex justify-content-between lh-sm">
                    <div>
                        <h5><a href="#">${it.product.name}</a></h5>
                        <small>Qty: ${it.quantity}</small>
                    </div>
                    <span class="text-primary">Rp ${new Intl.NumberFormat(
                        "id-ID"
                    ).format(it.product.price * it.quantity)}</span>
                </li>
            `
                  )
                  .join("")
            : '<li class="list-group-item bg-transparent text-center">Cart is empty</li>';

        const menuHtml = `
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill">${count}</span>
            </h4>
            <ul class="list-group mb-3">
                ${listHtml}
                <li class="list-group-item bg-transparent d-flex justify-content-between">
                    <span class="text-capitalize"><b>Total (IDR)</b></span>
                    <strong>Rp ${new Intl.NumberFormat("id-ID").format(
                        total
                    )}</strong>
                </li>
            </ul>
            <div class="d-flex flex-wrap justify-content-center">
                
                <a href="/checkout" class="w-100 btn btn-primary">Go to checkout</a>
            </div>
        `;

        document.getElementById("cart-menu").innerHTML = menuHtml;
    } catch (err) {
        console.error(err);
        document.getElementById("cart-menu").innerHTML =
            '<div class="p-3">Please login first!</div>';
    }
}

document.addEventListener("DOMContentLoaded", loadCart);

document
    .getElementById("loginForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        let res = await fetch("/api/login", {
            method: "POST",
            body: formData,
        });

        if (res.ok) {
            let data = await res.json();
            localStorage.setItem("api_token", data.token);
            alert("Login berhasil. Selamat datang " + data.user.name);
            location.reload();
        } else {
            let err = await res.json();
            alert(err.message || "Login gagal");
        }
    });

document
    .getElementById("registerForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        let res = await fetch("/api/register", {
            method: "POST",
            body: formData,
        });

        if (res.ok) {
            let data = await res.json();
            alert("Registrasi berhasil. Silakan login.");
            // Pindah ke tab login
            document.querySelector("#nav-sign-in-tab").click();
        } else {
            let err = await res.json();
            alert(err.message || "Registrasi gagal");
        }
    });

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".add-to-cart-form").forEach((form) => {
        form.addEventListener("submit", async function (e) {
            e.preventDefault();

            const token = localStorage.getItem("api_token");
            if (!token) {
                alert("Silakan login dulu.");
                return;
            }

            const formData = new FormData(this);
            const res = await fetch("/api/cart/add", {
                method: "POST",
                headers: {
                    Authorization: "Bearer " + token,
                },
                body: formData,
            });

            if (res.ok) {
                alert("Produk berhasil ditambahkan ke cart!");
                loadCart();
            } else {
                alert("Gagal menambahkan produk.");
            }
        });
    });
});
