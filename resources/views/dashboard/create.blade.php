@extends('dashboard.layouts')

@section('content')

<div id="wrapper">
    @include('dashboard.sidebar')
    <div id="content-wrapper" class="d-flex flex-column" >

        <div id="content">
            @include('dashboard.topbar')
            <div class="container-fluid">
                <h2 class="mb-4">Add New Product</h2>
                <form id="create-product-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock *</label>
                        <input type="number" name="stock" id="stock" class="form-control" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price (IDR) *</label>
                        <input type="number" name="price" id="price" class="form-control" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image *</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Product</button>
                    <a href="{{ route('dashboard.products') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
        
    </div>

</div>

@endsection

@section('scripts')
<script>
document.getElementById("create-product-form").addEventListener("submit", async function(e) {
    e.preventDefault();

    const token = localStorage.getItem("api_token");
    if (!token) {
        alert("You must login first!");
        return;
    }

    let formData = new FormData(this);

    try {
        let res = await fetch("/api/products", {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            body: formData
        });

        if (!res.ok) {
            let err = await res.json();
            alert("Failed to save product: " + (err.message || JSON.stringify(err)));
            return;
        }

        alert("Product added successfully!");
        window.location.href = "{{ route('dashboard.products') }}";
    } catch (err) {
        console.error(err);
        alert("An error occurred while saving the product.");
    }
});
</script>
@endsection
