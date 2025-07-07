@extends('layouts.app')

@section('content')
<!-- Konten halaman dengan informasi perusahaan -->
<div class="container mt-4">
    <h3 class="login-title">Application Corporate</h3>
    
    <!-- Restructured layout: Carousel on left, Portal Cards on right -->
    <div class="row mt-4">
        <!-- Left side: Carousel -->
        <div class="col-md-5">
            <div class="company-image-wrapper">
                <div class="company-image-border">
                    <!-- Dynamic Carousel from Database -->
                    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            @forelse($posters as $index => $poster)
                                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                            @empty
                                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            @endforelse
                        </div>
                        
                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            @forelse($posters as $index => $poster)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="poster-container">
                                        <img src="{{ asset('images/posters/' . $poster->gambar) }}" alt="PLN Indonesia Power Plant {{ $index + 1 }}" class="company-image">
                                    </div>
                                </div>
                            @empty
                                <!-- Fallback images if no posters in database -->
                                <div class="carousel-item active">
                                    <div class="poster-container">
                                        <img src="{{ asset('storage/images/bg-login.jpeg') }}" alt="PLN Indonesia Power Plant 1" class="company-image">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="poster-container">
                                        <img src="{{ asset('storage/images/bg-banner.jpeg') }}" alt="PLN Indonesia Power Plant 2" class="company-image">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="poster-container">
                                        <img src="{{ asset('storage/images/poster.jpeg') }}" alt="PLN Indonesia Power Plant 3" class="company-image">
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right side: Portal Cards -->
        <div class="col-md-7">
            <div class="portal-section">
            <!-- Search Form with Red Clear Button -->
<div class="row mb-4">
    <div class="col-12">
        <form action="{{ route('welcome') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" 
                placeholder="Search portals..." value="{{ request('search') }}">
                <button class="btn btn-primary search-btn" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('welcome') }}" class="btn btn-danger clear-btn">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

                @if($portalItems->isEmpty() && request('search'))
                    <div class="alert alert-info text-center">
                        No portals found for "{{ request('search') }}". 
                        <a href="{{ route('welcome') }}" class="alert-link">Show all portals</a>
                    </div>
                @endif
                
                <!-- Card container with fixed height -->
                <div class="card-container">
                    <div class="row">
                        @if(isset($portalItems) && count($portalItems) > 0)
                            @foreach($portalItems as $item)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <!-- Added target="_blank" to open in new tab -->
                                <a href="{{ route('portal.click', $item->id_portal_utama) }}" class="text-decoration-none" target="_blank">
                                    <div class="card portal-card">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center py-2">
                                            <div class="portal-icon-wrapper">
                                                <i class="fas fa-portal"></i>
                                            </div>
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

                <!-- Pagination -->
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

<!-- Copyright footer -->
<div class="copyright-footer">
    <div class="container">
         <a href="#" class="copyright-link" data-bs-toggle="modal" data-bs-target="#loginModal">Copyright © 2025 PLN Indonesia Power Services. All Rights Reserved</a>
    </div>
</div>
 <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="login-container">
                        <!-- Left side - Image with Component label -->
                        <div class="login-image" style="background-image: url('{{asset('storage/images/bg-login.jpeg') }}')">
                            <div class="component-label">
                                <span class="component-icon"></span> 
                            </div>
                        </div>
                        
                        <!-- Right side - Login form -->
                        <div class="login-form">
                            <!-- Logo and title -->
                            <div class="login-logo">
                                <img src="{{ asset('storage/images/ip-logo.png') }}" alt="PLN Logo">
                                <div>
                                    <br>
                                </div>
                            </div>
                            
                            <h3 class="login-title">Login Admin</h3>
                            
                            <!-- Login form -->
                            <form method="POST" action="{{ route('login') }}" style="width: 100%;">
                                @csrf
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <button type="submit" class="login-submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<style>
    /* Enhanced styling for wider carousel */
    .company-info-container {
        padding: 20px 0;
    }
    
    /* ENHANCED: Updated carousel container styling for more elegant look */
    .company-image-wrapper {
        position: relative;
        padding: 15px;
        background-color: #0a0a5d;
        border-radius: 20px;
        height: 90%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    
    /* ENHANCED: Improved border styling with gradient effect */
    .company-image-border {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        width: 100%;
        background: linear-gradient(135deg, rgba(248, 218, 41, 0.1), rgba(248, 218, 41, 0.3));
        box-shadow: inset 0 0 0 2px #f8da29;
    }
    
    /* ENHANCED: Added poster container for better framing */
    .poster-container {
        padding: 10px;
        position: relative;
        overflow: hidden;
    }
    
    /* ENHANCED: Improved image styling */
    .company-image {
        width: 100%;
        height: auto;
        display: block;
        object-fit: contain;
        max-height: 450px;
        border-radius: 8px;
        transition: transform 0.5s ease;
    }
    
    /* ENHANCED: Added hover effect for images */
    .poster-container:hover .company-image {
        transform: scale(1.02);
    }
    
    /* ENHANCED: Carousel indicators styling */
    .carousel-indicators {
        margin-bottom: 0;
        bottom: 10px;
    }
    
    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
        background-color: rgba(248, 218, 41, 0.5);
        border: 1px solid rgba(248, 218, 41, 0.8);
    }
    
    .carousel-indicators button.active {
        background-color: #f8da29;
    }
    
    /* Carousel styling */
    .carousel {
        width: 100%;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .carousel-inner {
        width: 100%;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .carousel-item {
        width: 100%;
        text-align: center;
        padding: 10px 0;
    }
    
    /* ENHANCED: Improved control buttons styling */
    .carousel-control-prev, .carousel-control-next {
        width: 40px;
        height: 40px;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(10, 10, 93, 0.7);
        border-radius: 50%;
        opacity: 0.8;
        margin: 0 10px;
    }
    
    .carousel-control-prev {
        left: 10px;
    }
    
    .carousel-control-next {
        right: 10px;
    }
    
    .carousel-control-prev:hover, .carousel-control-next:hover {
        opacity: 1;
        background-color: rgba(10, 10, 93, 0.9);
    }
    
    /* ENHANCED: Control icons styling */
    .carousel-control-prev-icon, .carousel-control-next-icon {
        width: 20px;
        height: 20px;
        filter: drop-shadow(0 0 2px rgba(248, 218, 41, 0.8));
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
        min-height: 370px;
    }
    
.portal-card {
    border-radius: 10px;
    border: none;
    background-color: #0a0a5d;
    color: white;
    height: 150px;
    width: 100%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border: 2px solid #f8da29;
}

.portal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.portal-icon {
    width: 50px;
    height: 50px;
    background-color: #f8da29;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.portal-icon i {
    color: #0a0a5d;
    font-size: 1.5rem;
}

.portal-title {
    font-family: 'Jura', sans-serif;
    font-weight: bold;
    font-size: 1.1rem;
    color: white;
    margin-bottom: 8px;
}

.portal-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.8rem;
    line-height: 1.3;
    padding: 0 10px;
}

/* Optional: Add yellow accent to card */
.portal-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 30px;
    height: 30px;
    background-color: #f8da29;
    border-bottom-left-radius: 100%;
}
    
    /* Fixed position for pagination */
    .pagination-container {
        position: relative;
        height: 80px;
    }
    
    /* Pagination styling - Updated to blue */
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
        background-color: #0a0a5d;
        color: white;
        border: 1px solid #f8da29;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #f8da29;
        border-color: #f8da29;
        color: #0a0a5d;
        font-weight: bold;
    }
    
    .pagination .page-item.disabled .page-link {
        background-color: #0a0a5d;
        color: #fff;
        border-color: #f8da29;
        opacity: 0.7;
    }
    
    /* Search Form Styling */
    .search-input {
        border-radius: 20px 0 0 20px;
        padding: 10px 20px;
        border: 2px solid #0a0a5d;
        height: 45px;
    }
    
    .search-btn {
        border-radius: 0 20px 20px 0;
        background-color: #0a0a5d;
        color: white;
        border: none;
        height: 45px;
        padding: 0 20px;
    }
    

/* Clear button styling - changed to red with white text */
.clear-btn {
    border-radius: 20px;
    margin-left: 10px;
    height: 45px;
    padding: 0 15px;
    background-color: #e53935; /* Red background */
    color: white; 
    border: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
    .search-btn:hover {
        background-color: #0a0a5d;
        opacity: 0.9;
    }
    

    
    /* No results message */
    .alert-info {
        background-color: #0a0a5d;
        color: white;
        border-color: #f8da29;
        border-radius: 10px;
    }
    
    .alert-link {
        color: #f8da29;
        text-decoration: underline;
    }
           .login-container {
            display: flex;
            height: 550px;
        }
        
        .login-image {
            flex: 1;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .login-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .login-logo img {
            height: 45px; 
            width: auto; 
        }
        
        .login-title {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Jura', sans-serif;
        }
        
        .form-control {
            height: 50px;
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 16px;
            margin-bottom: 20px;
            width: 100%;
        }
        
        .login-submit {
            height: 40px;
            width: 100%;
            border-radius: 10px;
            background-color: #13097C;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Jura', sans-serif;
            cursor: pointer;
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
            max-height: 350px;
        }
        
        .search-input, .search-btn, .clear-btn {
            height: 40px;
            font-size: 0.9rem;
        }
        
        .portal-icon-wrapper {
            width: 40px;
            height: 40px;
        }
        
        /* ENHANCED: Mobile adjustments for carousel */
        .carousel-control-prev, .carousel-control-next {
            width: 30px;
            height: 30px;
        }
        
        .carousel-control-prev-icon, .carousel-control-next-icon {
            width: 15px;
            height: 15px;
        }
        
        .carousel-indicators button {
            width: 8px;
            height: 8px;
            margin: 0 3px;
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
                    'max-height': '450px'
                });
            });
            
            // Make sure the carousel container adjusts to content
            $('.company-image-border').css({
                'height': 'auto',
                'min-height': '300px'
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