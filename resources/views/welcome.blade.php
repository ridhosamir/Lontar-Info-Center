@extends('layouts.app')

@section('content')
<!-- Konten halaman dengan informasi perusahaan -->
<div class="container mt-4">
    <h3 class="login-title">Application Corporate</h3>
    
    <!-- Restructured layout: Carousel on left, Portal Cards on right -->
    <div class="row mt-4">
        <!-- Left side: Carousel - increased width from col-md-4 to col-md-5 -->
        <div class="col-md-5">
            <div class="company-image-wrapper">
                <div class="company-image-border">
                    <!-- Simplified Carousel -->
                    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/images/bg-login.jpeg') }}" alt="PLN Indonesia Power Plant 1" class="company-image">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/images/bg-banner.jpeg') }}" alt="PLN Indonesia Power Plant 2" class="company-image">
                            </div>
                             <div class="carousel-item"> 
                                <img src="{{ asset('storage/images/poster.jpeg') }}" alt="PLN Indonesia Power Plant 3" class="company-image">
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
        
        <!-- Right side: Portal Cards - reduced width from col-md-8 to col-md-7 -->
        <div class="col-md-7">
            <div class="portal-section">
                <!-- Card container with fixed height -->
                <div class="card-container">
                    <div class="row">
                        @if(isset($portalItems) && count($portalItems) > 0)
                            @foreach($portalItems as $item)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <a href="{{ route('portal.click', $item->id_portal_utama) }}" class="text-decoration-none">
                                    <div class="card portal-card">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center py-2">
                                            <h4 class="text-center portal-title mb-1">{{ $item->nama_portal_user }}</h4>
                                            <div class="text-center portal-subtitle">{{ $item->keterangan_user }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            
                            <!-- Add empty placeholder cards if less than 9 items to maintain layout -->
                            @for($i = count($portalItems); $i < 9; $i++)
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="card-placeholder"></div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>

                <!-- Pagination - keeping unchanged -->
                <div class="pagination-container">
                    @if(isset($portalItems) && $portalItems->lastPage() > 1)
                    <div class="row mt-3">
                        <div class="col-12">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <!-- Previous Page Link -->
                                    @if($portalItems->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $portalItems->previousPageUrl() }}">&laquo;</a>
                                        </li>
                                    @endif

                                    <!-- Numbered Page Links -->
                                    @for($i = 1; $i <= $portalItems->lastPage(); $i++)
                                        <li class="page-item {{ $portalItems->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $portalItems->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Next Page Link -->
                                    @if($portalItems->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $portalItems->nextPageUrl() }}">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @else
                    <!-- Always show the pagination container even when there's only one page -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                    <li class="page-item active">
                                        <span class="page-link">1</span>
                                    </li>
                                    <li class="page-item disabled">
                                        <span class="page-link">&raquo;</span>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copyright footer - updated with white text and no underline -->
<div class="copyright-footer">
    <div class="container">
         <a href="#" class="copyright-link" data-bs-toggle="modal" data-bs-target="#loginModal">Copyright © 2025 PLN Indonesia Power Services. All Rights Reserved</a>
    </div>
</div>

<style>
    /* Enhanced styling for wider carousel */
    .company-info-container {
        padding: 20px 0;
    }
    
    .company-image-wrapper {
        position: relative;
        padding: 15px;
        background-color: #0a0a5d;
        border-radius: 30px;
        height: 100%;
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
        /* Removed fixed max-height to prevent cropping */
    }
    
    .company-image {
        width: 100%;
        height: auto;
        display: block;
        object-fit: contain; /* Changed from 'cover' to 'contain' to prevent cropping */
        max-height: 450px; /* Set a reasonable max-height for the image */
    }
    
    /* Carousel styling */
    .carousel {
        width: 100%;
    }
    
    .carousel-inner {
        width: 100%;
    }
    
    .carousel-item {
        width: 100%;
        text-align: center; /* Center images horizontally */
        padding: 10px 0; /* Add some padding to prevent images touching the borders */
    }
    
    /* Styling untuk tombol next/prev */
    .carousel-control-prev, .carousel-control-next {
        width: 10%;
        opacity: 0.7;
        background-color: rgba(0,0,0,0.2); /* Added slight background to buttons */
        border-radius: 0 15px 15px 0; /* Rounded corners on right button */
    }
    
    .carousel-control-prev {
        border-radius: 15px 0 0 15px; /* Rounded corners on left button */
    }
    
    .carousel-control-prev:hover, .carousel-control-next:hover {
        opacity: 1;
        background-color: rgba(0,0,0,0.4); /* Darker on hover */
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
    
    /* Updated copyright link styling */
    .copyright-link {
        color: white !important;
        text-decoration: none !important;
        text-align: center;
        margin: 0;
        font-size: 18px;
        font-family: 'Jura', sans-serif;
        display: block;
    }
    
    .copyright-link:hover {
        color: #f8da29 !important;
        text-decoration: none !important;
    }
    
    /* Portal Cards Styling */
    .portal-section {
        margin-bottom: 30px;
    }
    
    /* Card container with fixed minimum height */
    .card-container {
        min-height: 370px; /* Height for 3 rows of cards */
    }
    
    .portal-card {
        border-radius: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
        background-color: #333;
        color: white;
        min-height: 100px;
        overflow: hidden;
        width: 100%;
        max-width: 100%; /* Make cards fill their container */
    }
    
    /* Empty placeholder for maintaining layout */
    .card-placeholder {
        min-height: 100px;
        visibility: hidden;
    }
    
    .portal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .portal-title {
        font-family: 'Jura', sans-serif;
        font-weight: bold;
        margin-bottom: 0;
        color: white;
        font-size: 1.1rem;
    }
    
    .portal-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.8rem;
        padding: 0 5px;
    }
    
    /* Fixed position for pagination */
    .pagination-container {
        position: relative;
        height: 80px;
    }
    
    /* Pagination styling */
    .pagination {
        margin-top: 20px;
        margin-bottom: 10px;
    }
    
    .pagination .page-link {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin: 0 5px;
        background-color: #333;
        color: white;
        border-color: #444;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #444;
        border-color: #555;
        color: white;
    }
    
    .pagination .page-item.disabled .page-link {
        background-color: #333;
        color: #666;
        border-color: #444;
    }
    
    /* Media query untuk layar kecil */
    @media (max-width: 767.98px) {
        .company-image-wrapper {
            margin-bottom: 20px;
            height: auto;
        }
        
        .portal-card {
            min-height: 90px;
        }
        
        .card-container {
            min-height: 300px;
        }
        
        .company-image {
            max-height: 350px; /* Smaller max-height on mobile */
        }
    }
</style>

@push('scripts')
<script>
    $(document).ready(function(){
        // Initialize the carousel with settings
        $('#bannerCarousel').carousel({
            interval: 5000,  // 5 seconds
            wrap: true,      
            keyboard: false  
        });
        
        // Improved function to adjust carousel for all images
        function adjustCarouselImages() {
            // Set a proper height for all carousel items based on their natural aspect ratios
            $('.carousel-item img').each(function() {
                $(this).css({
                    'max-width': '100%',
                    'height': 'auto',
                    'max-height': '450px' // Consistent max height
                });
            });
            
            // Make sure the carousel container adjusts to content
            $('.company-image-border').css({
                'height': 'auto',
                'min-height': '300px' // Minimum height to avoid layout shifts
            });
        }
        
        // Call on page load and after each image loads
        adjustCarouselImages();
        
        // Handle image loading
        $('.carousel-item img').on('load', function() {
            adjustCarouselImages();
        });
        
        // Call when carousel slides
        $('#bannerCarousel').on('slid.bs.carousel', function() {
            adjustCarouselImages();
        });
        
        // Call on window resize
        $(window).resize(function() {
            adjustCarouselImages();
        });
    });
</script>
@endpush
@endsection