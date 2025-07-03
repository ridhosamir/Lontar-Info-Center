@extends('layouts.app')

@section('content')
<!-- Konten halaman dengan informasi perusahaan -->
<div class="container mt-4">
    <h3 class="login-title">Application Corporate</h3>
    
    <!-- Section informasi perusahaan seperti pada gambar -->
    <div class="company-info-container mt-4">
        <div class="row">
            <div class="col-md-5">
                <div class="company-image-wrapper">
                    <div class="company-image-border">
                        <!-- Carousel untuk berganti gambar -->
                        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                            <!-- Indicators/dots -->
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
            
                            </div>
                            
                            <!-- The slideshow/carousel -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/images/bg-login.jpeg') }}" alt="PLN Indonesia Power Plant 1" class="company-image">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/images/bg-banner.jpeg') }}" alt="PLN Indonesia Power Plant 2" class="company-image">
                                </div>
                            </div>
                            
                            <!-- Left and right controls/icons -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="company-description">
                    <p>
                        PLN Indonesia Power merupakan salah satu subholding perusahaan pembangkit listrik PT PLN (Persero) yang didirikan pada tanggal 3 Oktober 1995 dengan nama PT PLN Pembangkitan Jawa Bali I (PT PJB I). Pada tanggal 8 Oktober 2000, PT PJB I berganti nama menjadi Indonesia Power sebagai penegasan atas tujuan Perusahaan untuk menjadi Perusahaan pembangkit tenaga listrik independen yang berorientasi bisnis murni.
                    </p>
                    <p>
                        Pada tanggal 21 September 2022, struktur perusahaan mengalami transformasi menjadi PLN Indonesia Power yang menjadi Perusahaan pembangkitan terbesar se-Asia Tenggara dengan Total Kapasitas 21,08 GW. Kegiatan utama bisnis Perusahaan saat ini yakni sebagai penyedia solusi energi yang meliputi penyediaan tenaga listrik melalui pembangkitan tenaga listrik yang tersebar di Indonesia serta pengembangan bisnis beyond KWh.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copyright footer -->
<div class="copyright-footer">
    <div class="container">
        <p class="copyright-text">Copyright © 2025 PLN Indonesia Power Services. All Rights Reserved</p>
    </div>
</div>

<style>
    /* Styling untuk informasi perusahaan */
    .company-info-container {
        padding: 20px 0;
    }
    
    .company-image-wrapper {
        position: relative;
        padding: 15px;
        background-color: #0a0a5d;
        border-radius: 30px;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .company-image-border {
        position: relative;
        overflow: hidden;
        border: 3px solid #f8da29;
        border-radius: 20px;
        width: 100%;
    }
    
    .company-image {
        width: 100%;
        height: auto;
        display: block;
    }
    
    /* Styling untuk carousel */
    .carousel {
        width: 100%;
    }
    
    .carousel-inner {
        width: 100%;
    }
    
    .carousel-item {
        width: 100%;
    }
    
    /* Membuat indikator carousel lebih terlihat */
    .carousel-indicators {
        bottom: 0;
    }
    
    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 4px;
    }
    
    .carousel-indicators button.active {
        background-color: #f8da29;
    }
    
    /* Styling untuk tombol next/prev */
    .carousel-control-prev, .carousel-control-next {
        width: 10%;
        opacity: 0.7;
    }
    
    .carousel-control-prev:hover, .carousel-control-next:hover {
        opacity: 1;
    }
    
    .company-description {
        padding: 20px;
        font-size: 18px;
        line-height: 1.6;
        text-align: justify;
    }
    
    .login-title {
        font-family: 'Jura', sans-serif;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }
    
    /* Styling untuk copyright footer */
    .copyright-footer {
        border-top-right-radius: 15px; 
        border-top-left-radius: 15px; 
        margin-left:17px;
        background-color: #0a0a5d; 
        padding: 15px 0;
        margin-top: 40px;
        width: 98%;
    }
    
    .copyright-text {
        color: white;
        text-align: center;
        margin: 0;
        font-size: 18px;
        font-family: 'Jura', sans-serif;
    }
    
    /* Media query untuk layar kecil */
    @media (max-width: 767.98px) {
        .company-image-wrapper {
            margin-bottom: 20px;
        }
    }
</style>

@push('scripts')
<script>
    $(document).ready(function(){
        // Initialize the carousel with settings
        $('#bannerCarousel').carousel({
            interval: 3000,  
            wrap: true,      
            keyboard: false  
        });
        
        // Function to adjust frame height based on image dimensions
        function adjustFrameHeight() {
            // Get active carousel item image
            const activeImage = $('.carousel-item.active img');
            if (activeImage.length) {
                // When image is loaded, set wrapper height
                activeImage.on('load', function() {
                    const imageHeight = $(this).height();
                    const imageWidth = $(this).width();
                    const aspectRatio = imageWidth / imageHeight;
                    
                    // Adjust container sizing if needed
                    if (aspectRatio > 1.5) { // For very wide images
                        $('.company-image-border').css('max-height', '400px');
                    } else {
                        $('.company-image-border').css('max-height', 'none');
                    }
                });
            }
        }
        
        // Call on page load
        adjustFrameHeight();
        
        // Call when carousel slides
        $('#bannerCarousel').on('slid.bs.carousel', function() {
            adjustFrameHeight();
        });
        
        // Call on window resize
        $(window).resize(function() {
            adjustFrameHeight();
        });
    });
</script>
@endpush
@endsection