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
                        <img src="{{ asset('storage/images/bg-login.jpeg') }}" alt="PLN Indonesia Power Plant" class="company-image">
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
        background-color: #0a0a5d; /* Biru tua seperti pada gambar */
        border-radius: 30px;
        height: 100%;
    }
    
    .company-image-border {
        position: relative;
        overflow: hidden;
        border: 3px solid #f8da29; /* Border kuning */
        border-radius: 20px;
        height: 100%;
    }
    
    .company-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
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
        background-color: #0a0a5d; /* Biru tua seperti pada gambar */
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
</style>
@endsection