<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lontar Information Center</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/icons/Logo_PLN.png') }}" type="image/png">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        /* Container untuk topbar dan bendera */
        .top-container {
            position: relative;
            width: 94%;
            height: 15px;
            background-color: #13097C;
        }

        /* Flag container */
        .flag-container {
            position: absolute;
            top: 0;
            right: -50px;
            height: 15px;
            display: flex;
            gap: 10px;
        }

        .flag-yellow {
            width: 15px;
            height: 20px;
            background-color: #ffff0c;
        }

        .flag-red {
            width: 15px;
            height: 20px;
            background-color: #e53935;
        }

        /* Header Utama */
        .header {
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 15px;
            border-bottom: 2px solid #d0d0d0;
        }

        /* Logo dan Teks Container */
        .logo-container {
            display: flex;
            align-items: center;
        }

        /* Logo Image */
        .logo-img {
            height: 35px;
            width: auto;
            margin-right: 10px;
        }

        .create-ticket-btn {
            font-size: 18px;
            font-weight: bold;
            color: white;
            text-decoration: none;
            font-family: 'Jura', 'Helvetica', sans-serif;
            padding: 8px 10px;
            border-radius: 5px;
            background-color: #13097C !important;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: center;
        }

        /* Modal Styles */
        .modal-dialog {
            max-width: 800px;
            margin: 1.75rem auto;
        }

        .modal-content {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .modal-body {
            padding: 0;
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
            height: 30px;
            width: 80%;
            border-radius: 10px;
            background-color: #13097C;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Jura', sans-serif;
            cursor: pointer;
        }

        .component-label {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            font-size: 20px;
            font-family: 'Jura', sans-serif;
            display: flex;
            align-items: center;
        }

        .component-icon {
            color: #b19aff;
            margin-right: 10px;
            font-size: 24px;
        }

        /* Banner LONTAR INFORMATION CENTER */
        .banner-container {
            position: relative;
            width: 100%;
            height: 100px;
            overflow: hidden;
        }

        .banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-title {
            color: white;
            font-size: 4rem;
            font-weight: bold;
            text-align: center;
            font-family: 'Jura', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Security Warning Modal */
        .security-modal .modal-dialog {
            max-width: 700px;
        }

        .security-modal .modal-content {
            border-radius: 8px;
            padding: 20px;
        }

        .security-warning {
            font-family: 'Jura', sans-serif;
            font-size: 24px;
            text-align: center;
            margin: 30px 20px;
            line-height: 1.5;
        }

        .security-close-btn {
            background-color: #e53935;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 15px 30px;
            font-size: 24px;
            font-family: 'Jura', sans-serif;
            font-weight: bold;
            display: block;
            width: 60%;
            margin: 20px auto 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .security-close-btn:hover {
            background-color: #c62828;
        }

        /* Reminder Modal Styles */
        .reminder-modal .modal-dialog {
            max-width: 700px;
        }

        .reminder-modal .modal-content {
            border-radius: 8px;
            padding: 0;
        }

        .reminder-modal .modal-header {
            background-color: #13097C;
            color: white;
            padding: 15px 20px;
            border-bottom: none;
        }

        .reminder-modal .modal-title {
            font-family: 'Jura', sans-serif;
            font-weight: bold;
            font-size: 22px;
        }

        .reminder-modal .modal-body {
            padding: 20px;
        }

        .reminder-message {
            font-family: 'Jura', sans-serif;
            font-size: 20px;
            text-align: center;
            margin: 20px;
            line-height: 1.6;
        }

        .reminder-image {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
            border-radius: 5px;
            max-height: 500px;
            object-fit: contain;
        }

        .reminder-modal .modal-footer {
            border-top: none;
            justify-content: center;
            padding-bottom: 20px;
        }

        .reminder-close-btn {
            background-color: #13097C;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-size: 18px;
            font-family: 'Jura', sans-serif;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .reminder-close-btn:hover {
            background-color: #0a0557;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="top-container">

        <!-- Bendera di atas topbar -->
        <div class="flag-container">
            <div class="flag-blue"></div>
            <div class="flag-yellow"></div>
            <div class="flag-red"></div>
        </div>
    </div>

    <div class="header">
        <div class="logo-container">
            <img src="{{ asset('storage/images/ip-logo.png') }}" alt="PLN Logo" class="logo-img">
        </div>

        <a href="http://helpdesk.plnindonesiapower.co.id/helpdesk/WebObjects/Helpdesk.woa" class="create-ticket-btn"
            target="_blank">Buat Tiket</a>
    </div>

    <!-- LONTAR INFORMATION CENTER Banner -->
    <div class="banner-container">
        <img src="{{ asset('storage/images/bg-banner.jpeg') }}" alt="Power Plant" class="banner-image">
        <div class="banner-overlay">
            <h1 class="banner-title">LONTAR INFORMATION CENTER</h1>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Security Warning Modal -->
    <div class="modal fade security-modal" id="securityModal" tabindex="-1" aria-labelledby="securityModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="securityMessageContainer" class="security-warning">
                    </div>

                    <div id="securityImageContainer" style="display: none;" class="text-center mb-4">
                        <img id="securityImage" src="" alt="Security Warning" class="img-fluid rounded"
                            style="max-height: 400px;">
                    </div>

                    <div id="securityLoading" class="text-center py-3">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <button type="button" class="security-close-btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function fetchSecurityContent() {
            console.log("Fetching security content...");
            $.ajax({
                url: '/get-reminder',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log("Security content response:", response);
                    $('#securityLoading').hide();
                    if (response.success) {
                        if (response.type === 'gambar') {
                            $('#securityImage').attr('src', response.image_path);
                            $('#securityImageContainer').show();
                            $('#securityMessageContainer').hide();
                        } else if (response.type === 'pesan') {
                            $('#securityMessageContainer').text(response.message);
                            $('#securityMessageContainer').show();
                            $('#securityImageContainer').hide();
                        }
                    } else {
                        $('#securityMessageContainer').text(
                            'Harap berhati-hati saat mengakses website ini; pastikan untuk melindungi informasi pribadi Anda, membaca kebijakan privasi dan syarat penggunaan, serta menghindari berbagi data sensitif, karena penggunaan yang tidak tepat dapat menimbulkan risiko.'
                        );
                        $('#securityMessageContainer').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load security content:', error);
                    $('#securityLoading').hide();
                    $('#securityMessageContainer').text(
                        'Harap berhati-hati saat mengakses website ini; pastikan untuk melindungi informasi pribadi Anda, membaca kebijakan privasi dan syarat penggunaan, serta menghindari berbagi data sensitif, karena penggunaan yang tidak tepat dapat menimbulkan risiko.'
                    );
                    $('#securityMessageContainer').show();
                }
            });
        }

        function fetchAndShowReminder() {
            console.log("Fetching reminder...");
            $.ajax({
                url: '/get-reminder',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log("Reminder response:", response);
                    $('#reminderLoading').hide();
                    if (response.success) {
                        if (response.type === 'gambar') {
                            console.log("Showing image reminder:", response.image_path);
                            $('#reminderImage').attr('src', response.image_path);
                            $('#reminderImageContainer').show();
                            $('#reminderMessageContainer').hide();
                        } else if (response.type === 'pesan') {
                            console.log("Showing text reminder:", response.message);
                            $('#reminderMessage').text(response.message);
                            $('#reminderMessageContainer').show();
                            $('#reminderImageContainer').hide();
                        }
                        var reminderModal = new bootstrap.Modal(document.getElementById('reminderModal'));
                        reminderModal.show();
                    } else {
                        console.log("No reminder available or error occurred");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load reminder:', error);
                    console.error('Status:', status);
                    $('#reminderLoading').hide();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Setup CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            @if (!$errors->any())

                console.log("Tidak ada error login, menjalankan logika security modal.");

                const hasVisited = sessionStorage.getItem('hasVisited');
                const navigationType = performance.getEntriesByType("navigation")[0].type;

                if (navigationType === 'navigate' && !hasVisited) {
                    console.log("Kunjungan baru terdeteksi. Menampilkan modal.");
                    var securityModal = new bootstrap.Modal(document.getElementById('securityModal'));
                    fetchSecurityContent();
                    securityModal.show();
                    sessionStorage.setItem('hasVisited', 'true');
                } else if (navigationType === 'reload') {
                    console.log("Refresh manual terdeteksi. Menampilkan modal.");

                    var securityModal = new bootstrap.Modal(document.getElementById('securityModal'));
                    fetchSecurityContent();
                    securityModal.show();
                } else {
                    console.log("Navigasi internal (pencarian, hapus filter, dll.), tidak menampilkan modal.");
                }

                document.getElementById('securityModal').addEventListener('hidden.bs.modal', function() {
                    console.log("Security modal closed, fetching reminder...");
                    fetchAndShowReminder();
                });
            @else
                console.log("Terdeteksi error login, logika security modal diabaikan.");
            @endif
        });
    </script>
    @stack('scripts')
</body>

</html>
