@extends('layouts.layouts')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    <div id="cart-container" class="mb-4">
        <div class="text-center text-muted">Loading cart...</div>
    </div>
    <div class="d-flex justify-content-end">
        <form id="checkout-form">
        @csrf
        <div id="checkout-summary" class="" style="display:none;">
                <h4>Summary</h4>
                <p><b>Total Items:</b> <span id="summary-items">0</span></p>
                <p><b>Total Price:</b> Rp <span id="summary-total">0</span></p>
                <button class="btn btn-primary" type="submit">Proceed to Payment</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("api_token");

    if (!token) {
        document.getElementById("cart-container").innerHTML =
            '<div class="alert alert-warning">Silakan login untuk melihat cart.</div>';
        return;
    }

    try {
        const res = await fetch("/api/cart", {
            headers: {
                Accept: "application/json",
                Authorization: "Bearer " + token,
            },
        });

        if (!res.ok) throw new Error("Gagal mengambil cart");

        const data = await res.json();
        const items = data.cart_items || [];

        if (items.length === 0) {
            document.getElementById("cart-container").innerHTML =
                '<div class="alert alert-info">Keranjang belanja kosong.</div>';
            return;
        }

        let html = '<ul class="list-group">';
        let totalItems = 0;
        let totalPrice = 0;

        items.forEach(item => {
            const qty = item.quantity;
            const price = Number(item.product.price);
            const subtotal = qty * price;

            totalItems += qty;
            totalPrice += subtotal;

            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <b>${item.product.name}</b><br>
                        <small>Qty: ${qty}</small>
                    </div>
                    <span>Rp ${new Intl.NumberFormat("id-ID").format(subtotal)}</span>
                </li>
            `;
        });

        html += '</ul>';
        document.getElementById("cart-container").innerHTML = html;

        // Tampilkan summary
        document.getElementById("summary-items").textContent = totalItems;
        document.getElementById("summary-total").textContent = new Intl.NumberFormat("id-ID").format(totalPrice);
        document.getElementById("checkout-summary").style.display = "block";

    } catch (err) {
        console.error(err);
        document.getElementById("cart-container").innerHTML =
            '<div class="alert alert-danger">Terjadi kesalahan saat memuat cart.</div>';
    }
});

document.getElementById("checkout-form").addEventListener("submit", async function (e) {
    e.preventDefault();
    
    const token = localStorage.getItem("api_token");
    if (!token) {
        alert("Silakan login dulu.");
        return;
    }

    const formData = new FormData(this);

    try {
        const res = await fetch("/api/cart/checkout", {
            method: "POST",
            headers: {
                Accept: "application/json",
                Authorization: "Bearer " + token,
            }
        });

        if (res.ok) {
            alert("Produk berhasil dicheckout!");
            window.location.href = "/orders";
        } else {
            const err = await res.json();
            alert(err.message || "Gagal checkout.");
        }
    } catch (err) {
        console.error(err);
        alert("Terjadi kesalahan saat checkout.");
    }
});

</script>
@endsection
