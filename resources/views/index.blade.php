@extends('layouts')

@section('content')

    <section class="bgimage" id="home">
        <div class="overlay"></div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-text">
                <h2 class="hero_title">Gowes Seru, Jelajah Lebih Jauh!</h2>
                <p class="hero_desc">Sewa sepeda dengan mudah, cepat, dan nyaman. Temukan rute terbaikmu bersama kami!</p>
            </div>
            </div>
        </div>
    </section>
    
    <!-- services section-->
    <section id="services">
        <div class="container mt-5">
            <h1 class="text-center">Rental Sepeda</h1>
            <div class="row">
                @foreach ($bicycles as $bicycle)
                    <div class="col-lg-4 mt-4">
                        <a href="{{ route('bicycles.show', $bicycle->id) }}">
                        <div class="card servicesText">
                            <img src="{{ asset('images/' . $bicycle->images) }}" class="bicycle-cover">
                            
                            <div class="card-body">
                                <p class="card-title">{{ $bicycle->name }}</p>
                                <p class="card-text mt-1">IDR {{ $bicycle->price }}</p>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-success" onclick="window.location='{{ route('bicycles.index') }}'">Lainnya</button>
            </div>
        </div>
    </section>
    <!-- about section-->
    <section id="about">
        <div class="responsive-container-block bigContainer">
  <div class="responsive-container-block Container">
    <div class="imgContainer">
      
      <img class="mainImg" src="{{ asset('images/about.webp') }}">
    </div>
    <div class="responsive-container-block textSide">
      <p class="text-blk heading">
        About Us
      </p>
      <p class="text-blk subHeading">
        Kami adalah layanan rental sepeda berbasis digital yang hadir untuk memudahkan siapa saja menjelajahi kota, alam, atau sekadar menikmati udara segar dengan cara yang sehat dan menyenangkan. Berawal dari kecintaan kami terhadap sepeda dan gaya hidup aktif, Kayuh.id lahir sebagai solusi sewa sepeda yang praktis, terpercaya, dan ramah lingkungan.
      </p>
      <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
        <div class="cardImgContainer">
          <img class="cardImg" src="{{ asset('images/mouse-pointer-click.svg') }}">
        </div>
        <div class="cardText">
          <p class="text-blk cardHeading">
            Kemudahan
          </p>
          <p class="text-blk cardSubHeading">
            Pemesanan cepat via online tanpa ribet.
          </p>
        </div>
      </div>
      <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
        <div class="cardImgContainer">
          <img class="cardImg" src="{{ asset('images/wrench.svg') }}">
        </div>
        <div class="cardText">
          <p class="text-blk cardHeading">
            Keamanan & Perawatan
          </p>
          <p class="text-blk cardSubHeading">
            Semua sepeda kami dicek secara rutin.
          </p>
        </div>
      </div>
      <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
        <div class="cardImgContainer">
          <img class="cardImg" src="{{ asset('images/handshake.svg') }}">
        </div>
        <div class="cardText">
          <p class="text-blk cardHeading">
            Dukungan Lokal
          </p>
          <p class="text-blk cardSubHeading">
            Kami bangga menjadi bagian dari pertumbuhan gaya hidup bersepeda di Indonesia.
          </p>
        </div>
      </div>
      <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
        <div class="cardImgContainer">
          <img class="cardImg" src="{{ asset('images/leaf.svg') }}">
        </div>
        <div class="cardText">
          <p class="text-blk cardHeading">
            Ramah Lingkungan
          </p>
          <p class="text-blk cardSubHeading">
            Kami ingin jadi bagian dari kota yang lebih bersih dan hijau.
          </p>
        </div>
      </div>
      
    </div>
    <img class="redDots" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/cw3.svg">
  </div>
</div>
    </section>
    
@endsection