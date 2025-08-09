@extends('layouts.layouts')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Orders</h2>
    <div id="orders-container">
        <div class="text-center text-muted">Loading orders...</div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("api_token");

    if (!token) {
        document.getElementById("orders-container").innerHTML =
            '<div class="alert alert-warning">Silakan login untuk melihat pesanan.</div>';
        return;
    }

    try {
        const res = await fetch("/api/orders", {
            headers: {
                Accept: "application/json",
                Authorization: "Bearer " + token
            },
        });

        if (!res.ok) throw new Error("Gagal mengambil data pesanan");

        const orders = await res.json();

        if (!orders.length) {
            document.getElementById("orders-container").innerHTML =
                '<div class="alert alert-info">Belum ada pesanan.</div>';
            return;
        }

        let html = '<table class="table table-bordered">';
        html += '<thead><tr><th>#</th><th>Status</th><th>Total</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>';

        orders.forEach(order => {
            html += `
                <tr>
                    <td>${order.id}</td>
                    <td><span class="badge bg-warning text-dark">${order.status}</span></td>
                    <td>Rp ${new Intl.NumberFormat("id-ID").format(order.total_price)}</td>
                    <td>${new Date(order.created_at).toLocaleString()}</td>
                    <td><a href="/orders/${order.id}" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
            `;
        });

        html += '</tbody></table>';
        document.getElementById("orders-container").innerHTML = html;

    } catch (err) {
        console.error(err);
        document.getElementById("orders-container").innerHTML =
            '<div class="alert alert-danger">Terjadi kesalahan saat memuat pesanan.</div>';
    }
});
</script>
@endsection
