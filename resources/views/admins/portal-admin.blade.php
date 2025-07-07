<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Portal Admin</title>

    <link rel="icon" href="{{ asset('storage/images/Logo_PLN.png') }}" type="image/png">

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

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: transparent;
            border-radius: 10px;
        }

        body:hover::-webkit-scrollbar-thumb,
        .main-content:hover::-webkit-scrollbar-thumb {
            background: #c1c1c1;
        }

        body::-webkit-scrollbar-thumb:active,
        .main-content::-webkit-scrollbar-thumb:active {
            background: #a8a8a8;
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
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #13097C;
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
            color: #13097C;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            background-color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
        }

        .portal-list-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .portal-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #e6e9ff, #fff);
            transition: transform 0.2s;
            border: 1px solid #e0e0e0;
            cursor: pointer;
        }

        .portal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .portal-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            cursor: pointer;
        }

        .portal-name {
            font-size: 25px;
            text-align: center;
            font-weight: bold;
            color: #13097C;
            margin-bottom: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.3;
        }

        .portal-description {
            color: #6c757d;
            font-size: 15px;
            text-align: center;
            margin-bottom: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            line-height: 1.4;
        }

        .portal-link {
            color: #13097C;
            font-size: 12px;
            text-align: center;
            text-decoration: none;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-top: auto;
            pointer-events: auto;
        }

        .portal-link:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .btn-create {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-create:hover {
            background-color: #218838;
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

        .btn-visit {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .btn-visit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #e53935;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            margin-left: auto;
        }

        .btn-delete:hover {
            background-color: #c62828;
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

        .popup-icon.alert {
            color: #fbbf24;
        }

        .popup-message {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 20px;
            color: #333;
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

        .btn-popup-delete {
            background-color: #e53935;
        }

        .btn-popup-delete:hover {
            background-color: #c62828;
        }

        .btn-popup-cancel {
            background-color: #9c9797;
        }

        .btn-popup-cancel:hover {
            background-color: #858383;
        }

        .page-item.active .page-link {
            background-color: #13097C;
            color: #fff;
            border-color: #13097C;
        }

        .page-link {
            color: #13097C;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .btn-custom-danger {
            background-color: #e53935;
            color: white;
            border-color: #e53935;
        }

        .btn-custom-danger:hover {
            background-color: #c62828;
            color: white;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .btn-custom-primary {
            background-color: #13097C;
            border-color: #13097C;
            color: #fff;
        }

        .btn-custom-primary:hover {
            background-color: #0f0766;
            color: #fff;
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

            .portal-list-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .portal-card {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            .portal-list-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .portal-card {
                height: 160px;
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
                <li class="sidebar-item active">
                    <a href="{{ route('admins.portal-admin') }}" class="sidebar-link">
                        <i class="fas fa-user"></i>
                        <span>Manage Portal Admin</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admins.portal-utama') }}" class="sidebar-link">
                        <i class="fas fa-users"></i>
                        <span>Manage Portal Utama</span>
                    </a>
                </li>
                <li class="sidebar-item">
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
            <h1 class="dashboard-title text-center">Manage Portal Admin</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn-create" data-bs-toggle="modal" data-bs-target="#createModal">
                    + Create New Portal
                </button>

                <form action="{{ route('admins.portal-admin') }}" method="GET" class="d-flex gap-2"
                    style="max-width: 500px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari portal..."
                        value="{{ request('search') }}">
                    <input type="hidden" name="sort" id="sort-input" value="{{ request('sort') }}">
                    <button type="submit" class="btn btn-custom-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('admins.portal-admin') }}" id="clear-search-btn" class="btn btn-custom-danger"
                        style="display: {{ request('search') ? 'inline-block' : 'none' }};">
                        <i class="fas fa-times"></i>
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item sort-option" href="#" data-sort="default">Default</a>
                            </li>
                            <li><a class="dropdown-item sort-option" href="#" data-sort="asc">Abjad (A-Z)</a>
                            </li>
                            <li><a class="dropdown-item sort-option" href="#" data-sort="desc">Abjad (Z-A)</a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">Portal Admin List</div>
                <div class="card-body">
                    <div class="portal-list-container" id="portal-list">
                        @foreach ($portalAdmins as $portal)
                            <div class="portal-card" data-id="{{ $portal->id_portal_admin }}"
                                data-nama="{{ $portal->nama_portal_admin }}"
                                data-keterangan="{{ $portal->keterangan_admin }}" data-link="{{ $portal->link }}">
                                <div class="portal-content">
                                    <div class="portal-name">{{ $portal->nama_portal_admin }}</div>
                                    <div class="portal-description">{{ $portal->keterangan_admin }}</div>
                                </div>
                                <a href="{{ $portal->link }}" class="portal-link"
                                    target="_blank">{{ $portal->link }}</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-container mt-3">
                        {{ $portalAdmins->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Portal Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" method="POST" action="{{ route('admins.portal-admin.store') }}" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-nama" class="form-label">Portal Name</label>
                            <input type="text" class="form-control" id="create-nama" name="nama_portal_admin">
                            <div class="invalid-feedback" id="create-nama_portal_admin-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="create-keterangan" class="form-label">Description</label>
                            <textarea class="form-control" id="create-keterangan" name="keterangan_admin" rows="4"></textarea>
                            <div class="invalid-feedback" id="create-keterangan_admin-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="create-link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="create-link" name="link">
                            <div class="invalid-feedback" id="create-link-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Portal Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="edit-nama" class="form-label">Portal Name</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama_portal_admin">
                            <div class="invalid-feedback" id="edit-nama_portal_admin-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-keterangan" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-keterangan" name="keterangan_admin" rows="4"></textarea>
                            <div class="invalid-feedback" id="edit-keterangan_admin-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="edit-link" name="link">
                            <div class="invalid-feedback" id="edit-link-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn-delete" id="delete-btn">Delete</button>
                        <button type="button" class="btn-visit" id="visit-btn">Visit</button>
                        <button type="submit" class="btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Popup -->
    <div class="popup" id="success-popup">
        <i class="fas fa-check-circle popup-icon success"></i>
        <div class="popup-message" id="success-message"></div>
        <div class="popup-buttons">
            <button class="btn-popup btn-popup-confirm" onclick="closePopup('success-popup')">OK</button>
        </div>
    </div>

    <!-- Delete Confirmation Popup -->
    <div class="popup" id="delete-confirm-popup">
        <i class="fas fa-exclamation-circle popup-icon alert"></i>
        <div class="popup-message">Are you sure you want to delete this portal?</div>
        <div class="popup-buttons">
            <button class="btn-popup btn-popup-cancel" onclick="closePopup('delete-confirm-popup')">Cancel</button>
            <button class="btn-popup btn-popup-delete" id="confirm-delete-btn">Delete</button>
        </div>
    </div>

    <!-- Popup Overlay -->
    <div class="popup-overlay" id="popup-overlay"></div>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const portalList = document.getElementById('portal-list');
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            const createForm = document.getElementById('createForm');
            const editForm = document.getElementById('editForm');
            const deleteBtn = document.getElementById('delete-btn');
            const visitBtn = document.getElementById('visit-btn');
            const successPopup = document.getElementById('success-popup');
            const successMessage = document.getElementById('success-message');
            const deleteConfirmPopup = document.getElementById('delete-confirm-popup');
            const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
            const popupOverlay = document.getElementById('popup-overlay');
            const createModal = new bootstrap.Modal(document.getElementById('createModal'));
            const searchInput = document.querySelector('input[name="search"]');
            const clearSearchBtn = document.getElementById('clear-search-btn');
            const sortInput = document.getElementById('sort-input');
            const sortOptions = document.querySelectorAll('.sort-option');

            sortOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();

                    const sortValue = this.dataset.sort;
                    sortInput.value = sortValue;

                    this.closest('form').submit();
                });
            });

            if (searchInput && searchInput.value) {
                clearSearchBtn.style.display = 'inline-block';
            }

            // Fungsi untuk membersihkan pesan error validasi
            function clearValidationErrors(form) {
                form.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                form.querySelectorAll('.invalid-feedback').forEach(element => {
                    element.textContent = '';
                });
            }

            // Fungsi untuk menampilkan pesan error validasi
            function displayValidationErrors(errors, form) {
                for (const field in errors) {
                    const input = form.querySelector(`[name="${field}"]`);
                    const errorDiv = input ? input.nextElementSibling : null;

                    if (input && errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                        input.classList.add('is-invalid');
                        const serverMessage = errors[field][0];
                        let customMessage = serverMessage;

                        if (serverMessage.toLowerCase().includes('required')) {
                            if (field === 'nama_portal_admin') customMessage = 'Portal Name cannot be empty.';
                            if (field === 'link') customMessage = 'Link cannot be empty.';
                        } else if (serverMessage.toLowerCase().includes(
                                'has already been taken')) {
                            if (field === 'nama_portal_admin') customMessage = 'Portal Name is already in use.';
                        } else if (serverMessage.toLowerCase().includes(
                                'must be a valid url')) {
                            if (field === 'link') customMessage = 'Link must be a URL.';
                        }

                        errorDiv.textContent = customMessage;
                    }
                }
            }

            document.getElementById('createModal').addEventListener('hidden.bs.modal', () => clearValidationErrors(
                createForm));
            document.getElementById('editModal').addEventListener('hidden.bs.modal', () => clearValidationErrors(
                editForm));

            // Sidebar toggle
            hamburgerBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !hamburgerBtn.contains(e.target)) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                }
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });

            // Popup close function
            window.closePopup = function(popupId) {
                document.getElementById(popupId).classList.remove('show');
                popupOverlay.classList.remove('show');
            };

            function showSuccessPopup(message, duration = 3000, closeModal = false, reload = true) {
                successMessage.textContent = message;
                successPopup.classList.add('show');
                popupOverlay.classList.add('show');
                if (closeModal) {
                    createModal.hide();
                }
                setTimeout(() => {
                    successPopup.classList.remove('show');
                    popupOverlay.classList.remove('show');
                    if (reload) {
                        window.location.reload();
                    }
                }, duration);
            }

            // Create form submission
            createForm.addEventListener('submit', function(e) {
                e.preventDefault();
                clearValidationErrors(createForm);
                $.ajax({
                    url: createForm.action,
                    method: 'POST',
                    data: $(createForm).serialize(),
                    success: function(response) {
                        showSuccessPopup('Portal successfully created!', 3000, true, true);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            displayValidationErrors(xhr.responseJSON.errors, createForm);
                        } else {
                            alert(
                                'Error creating portal. Please check the console for details.'
                            );
                            console.error(xhr);
                        }
                    }
                });
            });

            // Edit form submission
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                clearValidationErrors(editForm);
                $.ajax({
                    url: editForm.action,
                    method: 'POST',
                    data: $(editForm).serialize(),
                    success: function(response) {
                        showSuccessPopup('Portal successfully updated!', 3000, false,
                            true);
                        editModal.hide();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            displayValidationErrors(xhr.responseJSON.errors, editForm);
                        } else {
                            alert(
                                'Error updating portal. Please check the console for details.'
                            );
                            console.error(xhr);
                        }
                    }
                });
            });

            // Edit modal trigger
            portalList.addEventListener('click', function(e) {
                if (e.target.classList.contains('portal-link')) {
                    return;
                }
                const card = e.target.closest('.portal-card');
                if (card) {
                    const id = card.dataset.id;
                    const nama = card.dataset.nama;
                    const keterangan = card.dataset.keterangan;
                    const link = card.dataset.link;

                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-nama').value = nama;
                    document.getElementById('edit-keterangan').value = keterangan;
                    document.getElementById('edit-link').value = link;
                    editForm.action = `{{ url('admin/portal-admin') }}/${id}`;
                    visitBtn.onclick = () => window.open(link, '_blank');
                    deleteBtn.onclick = () => {
                        deleteConfirmPopup.classList.add('show');
                        popupOverlay.classList.add('show');

                        confirmDeleteBtn.onclick = () => {
                            $.ajax({
                                url: `{{ url('admin/portal-admin') }}/${id}`,
                                type: 'POST',
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    '_method': 'DELETE'
                                },
                                success: function(response) {
                                    editModal.hide();
                                    deleteConfirmPopup.classList.remove('show');
                                    popupOverlay.classList.remove('show');
                                    showSuccessPopup('Portal successfully deleted!',
                                        2000, false, true);
                                },
                                error: function(xhr) {
                                    alert('Error deleting portal. Please try again.');
                                    deleteConfirmPopup.classList.remove('show');
                                    popupOverlay.classList.remove('show');
                                }
                            });
                        };
                    };
                    editModal.show();
                }
            });

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
