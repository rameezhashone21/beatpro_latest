<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/theme.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Home</title>
</head>

<body>
<header class="fixed-top header-bg py-md-3 py-2"> <div class="container"> <div class="row d-lg-none"> <div class="col-6"> <a class="navbar-brand" href="{{route('home')}}"><img src="../storage/settings/logo/{{$logo}}" width="200px" height="70px" alt="" class="img-fluid"></a> </div><div class="col-6 text-end align-self-center"> <button data-trigger="navbar_main" class="d-lg-none btn" type="button"> <img src="../frontend_assets/img/bar_img.png" alt="">  </button> </div></div></div><nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg header"> <div class="container-fluid justify-content-start navigation-padding"> <div class="offcanvas-header"> <button class="btn-close float-end">x</button> </div><a class="navbar-brand d-none d-lg-inline" href="{{route('home')}}"><img src="../storage/settings/logo/{{$logo}}" width="200px" height="70px" alt="" class=""></a> <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0"> <li class="nav-item"> <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a> </li><li class="nav-item"> <a class="nav-link" href="{{route('aboutus')}}">About</a> </li><li class="nav-item"> <a class="nav-link" href="{{route('membership')}}">Membership</a> </li><li class="nav-item"> <a class="nav-link" href="{{route('ourservices')}}">Our Services</a> </li><li class="nav-item"> <a class="nav-link" href="{{route('faqs')}}">FAQs</a > </li > <li class="nav-item"> <a href="{{route('search')}}" class="nav-link" href="javascript:;">Beats</a> </li><li class="nav-item"> <a class="nav-link" href="{{route('contactus')}}">Contact</a></li></ul> <a href="{{route('cart')}}"><i class="fa badge" style="font-size:24px" value="{{ count((array) session('cart')) }}">&#xf07a;</i></a><form class="d-lg-flex justify-content-between"> <a class="btn-1 mx-2 text-white" href="{{route('register')}}"> Register </a> <a class="btn-2" href="{{route('login')}}">Log in</a> </form> </div></nav> </header>

    <main>
        <section style="background-image: url(../storage/settings/banner/{{$banner}});background-position: center;background-repeat: no-repeat;background-size: cover;height:320px;" class="d-flex justify-content-center align-items-center">
            <div class="container"> 
                <h1 class="banner_inner_title">Drum Kits and Loops</h1>
            </div>
        </section>
       

    <section class="tracks py-lg-5 py-3" style="background-color: #fff;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center services mb-5 pb-5">
                    <h3 class="fs-1">Drumkit and Loop Packs</h3>
                </div>
            </div>
            <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 gy-4">
            @foreach($drum_kit_loops as $drum_kit_loop)
            <div class="col"> 
                    <a href="{{ url('/drum_kit_loops/'.$drum_kit_loop->id) }}" class="d-block shadow bg-white rounded text-center text-decoration-none position-relative hover-scale">
                        <div class="drumkit-bage position-absolute">
                        @if($drum_kit_loop->type=="1")
                            Coming Soon
                        @elseif($drum_kit_loop->type=="2")
                             Sale
                        @elseif($drum_kit_loop->type=="3")
                             Hot
                        @elseif($drum_kit_loop->type=="4")
                            New Release
                        @endif
                        </div>
                        <div class="pt-5 pb-4 px-3 px-4">
                            <img src="../storage/drum_kit_loops/{{ $drum_kit_loop->image }}" alt="" class="drumkit-image">
                        </div>
                        <p class="fs-5 fw-bold text-dark">{{ $drum_kit_loop->title }}</p>
                        <div class="font-2 fw-bold pb-3"><span class="text-decoration-line-through text-red me-3">@if($drum_kit_loop->type=="2") ${{ $drum_kit_loop->strikethrough_price }} @endif</span><span class="text-dark">@if($drum_kit_loop->type!="1") ${{ $drum_kit_loop->price }} @endif</span></div>
                    </a>
            </div>
            @endforeach
            </div>
            
        </div>
    </section>

    </main>

    <script src="{{ asset('frontend_assets/js/footer.js') }}"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('frontend_assets/js/plugins.js') }} " defer></script>
<script src="https://unpkg.com/wavesurfer.js"></script>
<script src="{{ asset('frontend_assets/js/theme.js') }} " defer></script>
</html>