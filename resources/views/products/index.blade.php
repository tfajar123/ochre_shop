@extends ('layouts.layouts')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 py-5">Books List</h1>
    <div class="row g-4"> <!-- gunakan row + gutter -->
        @foreach($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3"> <!-- responsive grid -->
            <div class="card position-relative p-4 border rounded-3">
                <div class="position-absolute">
                    <p class="bg-primary py-1 px-3 fs-6 text-white rounded-2"></p>
                </div>
                <img src="{{ asset('images/' . $product['image_url']) }}" class="img-fluid shadow-sm" alt="product item" style="max-height: 26rem; object-fit: cover;">
                <h6 class="mt-4 mb-0 fw-bold">
                    <a href="index">{{ $product['name'] }}</a>
                </h6>
                <div class="review-content d-flex">
                    <p class="my-2 me-2 fs-6 text-black-50">Stock {{ $product['stock'] }}</p>
                    <div class="rating text-warning d-flex align-items-center">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="star star-fill"><use xlink:href="#star-fill"></use></svg>
                        @endfor
                    </div>
                </div>
                <span class="price text-primary fw-bold mb-2 fs-5">IDR. {{ $product['price'] }}</span>
                <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                    <form class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-dark">
                            <svg class="cart"><use xlink:href="#cart"></use></svg>
                        </button>
                    </form>
                    <a href="#" class="btn btn-dark">
                        <span>
                            <svg class="wishlist"><use xlink:href="#heart"></use></svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>




@endsection