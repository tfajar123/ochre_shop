@extends('dashboard.layouts')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('dashboard.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('dashboard.topbar')
                <div class="container mt-4">
                    <h2 class="mb-4">Edit Product</h2>

                    <form id="edit-product-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="product-id" value="{{ $product['id'] }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name *</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $product['name'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ $product['description'] }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock *</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ $product['stock'] }}" required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (IDR) *</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ $product['price'] }}" required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small>Leave blank if you don't want to change the image</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <a href="{{ route('dashboard.products') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>
document.getElementById("edit-product-form").addEventListener("submit", async function(e) {
    e.preventDefault();

    const token = localStorage.getItem("api_token");
    if (!token) {
        alert("You must login first!");
        return;
    }

    const id = document.getElementById("product-id").value;
    let formData = new FormData(this);

    try {
        let res = await fetch(`/api/products/${id}`, {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            body: (() => {
                formData.append('_method', 'PUT');
                return formData;
            })()
        });

        if (!res.ok) {
            let err = await res.json();
            alert("Failed to update product: " + (err.message || JSON.stringify(err)));
            return;
        }

        alert("Product updated successfully!");
        window.location.href = "{{ route('dashboard.products') }}";
    } catch (err) {
        console.error(err);
        alert("An error occurred while updating the product.");
    }
});
</script>
@endsection