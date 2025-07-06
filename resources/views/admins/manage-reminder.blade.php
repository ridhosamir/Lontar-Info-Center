<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reminder - PLN Indonesia Power</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Jura', sans-serif;
        }

        .top-container {
            position: relative;
            width: 94%;
            height: 15px;
            background-color: #13097C;
        }

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
            height: 32px;
            background-color: #ffff0c;
        }

        .flag-red {
            width: 15px;
            height: 32px;
            background-color: #e53935;
        }

        .header {
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 2px solid #d0d0d0;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            height: 35px;
            width: auto;
            margin-right: 10px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #13097C;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .user-name {
            font-weight: bold;
        }

        .logout-btn {
            color: #e53935;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dashboard-container {
            display: flex;
            height: calc(100vh - 67px);
            position: relative;
        }

        .sidebar {
            width: 275px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding: 20px 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            position: relative;
            z-index: 1000;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-item {
            padding: 10px 20px;
            border-left: 4px solid transparent;
        }

        .sidebar-item.active {
            border-left-color: #13097C;
            background-color: rgba(19, 9, 124, 0.1);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar-logo-container {
            padding: 15px 20px;
            text-align: center;
        }

        .sidebar-logo-container .logo-img {
            height: 35px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        .sidebar-item.active .sidebar-link {
            color: #13097C;
            font-weight: bold;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f0f2f5;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #13097C;
        }

        /* Styles for the single reminder card */
        .reminder-card-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 2rem;
        }

        .reminder-card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            border: 1px solid #e0e0e0;
        }

        .reminder-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .reminder-title {
            font-size: 22px;
            font-weight: bold;
            color: #13097C;
        }

        .btn-update {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        .reminder-content {
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }

        .reminder-content p {
            font-size: 20px;
            color: #333;
            white-space: pre-wrap;
            /* To respect newlines in the message */
        }

        .reminder-content img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 8px;
            object-fit: contain;
        }

        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: linear-gradient(135deg, #e6e9ff, #fff);
            border-bottom: 1px solid #dee2e6;
            color: #13097C;
            padding: 15px 20px;
        }

        .modal-title {
            font-weight: bold;
            font-size: 18px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 15px 20px;
        }

        .btn-save {
            background-color: #13097C;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .btn-save:hover {
            background-color: #0f0766;
        }

        .btn-cancel {
            background-color: #9c9797;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .btn-cancel:hover {
            background-color: #858383;
        }

        .hamburger-menu {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            color: #13097C;
            cursor: pointer;
            padding: 10px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-logo-container {
            display: none;
        }

        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 2000;
            text-align: center;
            min-width: 300px;
        }

        .popup.show {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1999;
        }

        .popup-overlay.show {
            display: block;
        }

        .popup-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .popup-icon.success {
            color: #28a745;
        }

        .popup-icon.error {
            color: #e53935;
        }

        .popup-message {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 20px;
            color: #333;
        }

        .popup-message ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 0;
            text-align: center;
        }

        .popup-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-popup {
            padding: 8px 20px;
            border-radius: 5px;
            border: none;
            color: white;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-popup-confirm {
            background-color: #13097C;
        }

        .btn-popup-confirm:hover {
            background-color: #0f0766;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: calc(100vh);
                z-index: 1000;
                padding-top: 0;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-logo-container {
                display: block;
                padding: 20px;
                text-align: center;
                border-bottom: 1px solid #dee2e6;
            }

            .sidebar-logo-container .logo-img {
                height: 40px;
                width: auto;
                display: block;
                margin: 0 auto;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .hamburger-menu {
                display: block;
            }

            .dashboard-container {
                flex-direction: column;
            }

            .main-content {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="top-container">
        <div class="flag-container">
            <div class="flag-yellow"></div>
            <div class="flag-red"></div>
        </div>
    </div>

    <div class="header">
        <div class="logo-container">
            <button class="hamburger-menu" id="hamburger-btn"><i class="fas fa-bars"></i></button>
            <img src="{{ asset('storage/images/ip-logo.png') }}" alt="PLN Logo" class="logo-img">
        </div>

        <div class="user-menu">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-name">{{ Auth::guard('admin')->user()->nama }}</div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn" style="background: none; border: none;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-logo-container">
                <img src="{{ asset('storage/images/ip-logo.png') }}" alt="PLN Logo" class="logo-img">
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="{{ route('admins.dashboard-admin') }}" class="sidebar-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admins.portal-admin') }}" class="sidebar-link">
                        <i class="fas fa-users"></i>
                        <span>Manage Portal Admin</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admins.portal-utama') }}" class="sidebar-link">
                        <i class="fas fa-users"></i>
                        <span>Manage Portal Utama</span>
                    </a>
                </li>
                <li class="sidebar-item active">
                    <a href="{{ route('admins.manage-reminder') }}" class="sidebar-link">
                        <i class="fas fa-bell"></i>
                        <span>Manage Reminder</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admins.manage-poster') }}" class="sidebar-link">
                        <i class="fas fa-image"></i>
                        <span>Manage Poster</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <h1 class="dashboard-title text-center">Manage Reminder</h1>

            <div class="reminder-card-container">
                <div class="reminder-card">
                    <div class="reminder-header">
                        <h2 class="reminder-title">Current Reminder</h2>
                        <button class="btn-update" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-edit"></i> Update Reminder
                        </button>
                    </div>
                    <div class="reminder-content">
                        @if ($reminder->gambar)
                            <img src="{{ asset('images/reminders/' . $reminder->gambar) }}" alt="Reminder Image">
                        @elseif($reminder->pesan)
                            <p>{{ $reminder->pesan }}</p>
                        @else
                            <p class="text-muted">No reminder is set.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Update Reminder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST"
                    action="{{ route('admins.reminder.update', $reminder->id_reminder) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Update Type</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="update_type"
                                        id="type_pesan" value="pesan" checked>
                                    <label class="form-check-label" for="type_pesan">Message</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="update_type"
                                        id="type_gambar" value="gambar">
                                    <label class="form-check-label" for="type_gambar">Image</label>
                                </div>
                            </div>
                        </div>

                        <div id="pesan-input-group" class="mb-3">
                            <label for="edit-pesan" class="form-label">Message</label>
                            <textarea class="form-control" id="edit-pesan" name="pesan" rows="4">{{ $reminder->pesan }}</textarea>
                        </div>

                        <div id="gambar-input-group" class="mb-3" style="display: none;">
                            <label for="edit-gambar" class="form-label">Image (Max: 10MB)</label>
                            <input type="file" class="form-control" id="edit-gambar" name="gambar"
                                accept="image/jpeg,image/png,image/jpg,image/gif">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="popup" id="success-popup">
        <i class="fas fa-check-circle popup-icon success"></i>
        <div class="popup-message" id="success-message"></div>
        <div class="popup-buttons">
            <button class="btn-popup btn-popup-confirm" onclick="closePopup('success-popup')">OK</button>
        </div>
    </div>

    <div class="popup" id="error-popup">
        <i class="fas fa-exclamation-triangle popup-icon error"></i>
        <div class="popup-message" id="error-message"></div>
        <div class="popup-buttons">
            <button class="btn-popup btn-popup-confirm" onclick="closePopup('error-popup')">OK</button>
        </div>
    </div>

    <div class="popup-overlay" id="popup-overlay"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            hamburgerBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            const pesanInput = document.getElementById('pesan-input-group');
            const gambarInput = document.getElementById('gambar-input-group');

            document.querySelectorAll('input[name="update_type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'pesan') {
                        pesanInput.style.display = 'block';
                        gambarInput.style.display = 'none';
                    } else {
                        pesanInput.style.display = 'none';
                        gambarInput.style.display = 'block';
                    }
                });
            });

            // Popup close function
            window.closePopup = function(popupId) {
                document.getElementById(popupId).classList.remove('show');
                document.getElementById('popup-overlay').classList.remove('show');
            };

            // Show success popup if session has success message
            @if (session('success'))
                document.getElementById('success-message').textContent = "{{ session('success') }}";
                document.getElementById('success-popup').classList.add('show');
                document.getElementById('popup-overlay').classList.add('show');

                setTimeout(() => {
                    closePopup('success-popup');
                }, 3000);
            @endif

            @if ($errors->any())
                let errorHtml = '<ul>';
                @foreach ($errors->all() as $error)
                    errorHtml += '<li>{{ $error }}</li>';
                @endforeach
                errorHtml += '</ul>';

                document.getElementById('error-message').innerHTML = errorHtml;
                document.getElementById('error-popup').classList.add('show');
                document.getElementById('popup-overlay').classList.add('show');
            @endif

            if (window.location.hash) {
                var modalId = window.location.hash;

                var targetModal = document.querySelector(modalId);

                if (targetModal) {
                    var modal = new bootstrap.Modal(targetModal);
                    modal.show();
                }
            }
        });
    </script>
</body>

</html>
