@extends('layouts.layouts')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Order Detail</h2>

    <div id="order-detail">
        <div class="text-center text-muted">Loading order detail...</div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("api_token");

    if (!token) {
        document.getElementById("order-detail").innerHTML =
            '<div class="alert alert-warning">Silakan login untuk melihat detail pesanan.</div>';
        return;
    }

    const orderId = window.location.pathname.split("/").pop();

    try {
        const res = await fetch(`/api/orders/${orderId}`, {
            headers: {
                Accept: "application/json",
                Authorization: "Bearer " + token
            },
        });

        if (!res.ok) throw new Error("Gagal mengambil detail pesanan");

        const order = await res.json();

        let html = `
            <div class="mb-3">
                <b>Order ID:</b> ${order.id}<br>
                <b>Status:</b> <span class="badge bg-warning text-dark">${order.status}</span><br>
                <b>Tanggal:</b> ${new Date(order.created_at).toLocaleString()}<br>
                <b>Customer:</b> ${order.user.name} (${order.user.email})<br>
                <b>Total Harga:</b> Rp ${new Intl.NumberFormat("id-ID").format(order.total_price)}
            </div>

            <h4>Items</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
        `;

        order.order_items.forEach(item => {
            const subtotal = Number(item.price) * item.quantity;
            html += `
                <tr>
                    <td>${item.product.name}</td>
                    <td>${item.quantity}</td>
                    <td>Rp ${new Intl.NumberFormat("id-ID").format(item.price)}</td>
                    <td>Rp ${new Intl.NumberFormat("id-ID").format(subtotal)}</td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
        `;

        document.getElementById("order-detail").innerHTML = html;

    } catch (err) {
        console.error(err);
        document.getElementById("order-detail").innerHTML =
            '<div class="alert alert-danger">Terjadi kesalahan saat memuat detail pesanan.</div>';
    }
});
</script>
@endsection
