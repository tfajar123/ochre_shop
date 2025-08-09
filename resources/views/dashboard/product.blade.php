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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                         <h1 class="h3 mb-2 text-gray-800">Products</h1>
                         <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">Add Product</a>
                     </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Products Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product['name'] }}</td>
                                            <td>{{ $product['description'] }}</td>
                                            <td>{{ $product['stock'] }}</td>
                                            <td>IDR. {{ $product['price'] }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.products.edit', $product['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm" onclick="deleteProduct({{ $product['id'] }})">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
@endsection

@section('scripts')
<script>
async function deleteProduct(id) {
    if (!confirm("Are you sure you want to delete this product?")) return;

    const token = localStorage.getItem("api_token");
    if (!token) {
        alert("You must login first!");
        return;
    }

    try {
        let res = await fetch(`/api/products/${id}`, {
            method: "DELETE",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        });

        if (!res.ok) {
            let err = await res.json();
            alert("Failed to delete: " + (err.message || JSON.stringify(err)));
            return;
        }

        alert("Product deleted successfully!");
        location.reload();
    } catch (err) {
        console.error(err);
        alert("An error occurred while deleting.");
    }
}
</script>
@endsection