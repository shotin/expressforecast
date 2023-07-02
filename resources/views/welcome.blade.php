@extends('layouts.master')

@push('header')
    @include('components.header')
@endpush()

@section('content')
    <section class="draw-section" id="draw-section">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('banner/slider1.png') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('banner/slider2.png') }}" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <?php /*?> ?>

<?php /*?> ?>
    <section class="banner-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="banner-subtitle mlm-text"><strong>Wow! Lotto</strong></p>
                    <h1 class="banner-title">
                        LET'S PLAY
                    </h1>
                    <a href="#" class="custom-button2">Start Playing Now</a>
                </div>
            </div>
        </div>
    </section>

    <?php */ ?>


    <section class="mobilebanner-section">
        <div class="container vh-100 wh-100">
            {{-- <img src="{{ asset('banner/mobile/welcome.png') }}" alt="" srcset=""> --}}
        </div>
    </section>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/magnific-popup.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/countdown.min.js')}}"></script>
<script src="{{asset('js/bootstrap-popover-x.min.js')}}"></script>
<script src="{{asset('js/amd.js')}}"></script>
<script src="{{asset('js/nice-select.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

@endsection

@push('footer')
    @include('components.footer')
@endpush()
