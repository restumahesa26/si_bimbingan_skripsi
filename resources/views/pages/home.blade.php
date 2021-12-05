@extends('layouts.home')

@section('content')
<section id="home" class="slider_area">
    <div id="carouselThree" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="slider-content">
                                <h1 class="title">Informatika FTUNIB</h1>
                                <p class="text">Sistem Informasi Bimbingan Skripsi Sebagai Platform Untuk Mempermudah Mahasiswa Dalam Melakukan Bimbingan Skripsi Menuju Seminar Hasil</p>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
                <div class="slider-image-box d-none d-lg-flex align-items-end">
                    <div class="slider-image">
                        <img src="{{ url('frontend/assets/images/slider/2.png') }}" alt="Hero" width="1000">
                    </div> <!-- slider-imgae -->
                </div> <!-- slider-imgae box -->
            </div> <!-- carousel-item -->
        </div>
    </div>
</section>
@endsection
