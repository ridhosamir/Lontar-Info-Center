<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Poster - PLN Indonesia Power</title>

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

        .main-content::-webkit-scrollbar {
            width: 8px;
        }

        .main-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .main-content::-webkit-scrollbar-thumb {
            background-color: transparent;
            border-radius: 10px;
        }

        .main-content:hover::-webkit-scrollbar-thumb {
            background-color: #c1c1c1;
        }

        .main-content::-webkit-scrollbar-thumb:active {
            background-color: #a8a8a8;
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

        .poster-list-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .poster-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #e6e9ff, #fff);
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid #e0e0e0;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .poster-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .poster-card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            object-position: top;
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

        .btn-delete {
            background-color: #e53935;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-delete:hover {
            background-color: #c62828;
        }

        .btn-select {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
        }

        .btn-select:hover {
            background-color: #0b5ed7;
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

        #image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-height: 120px;
            background-color: #f8f9fa;
        }

        .preview-image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100%;
            cursor: pointer;
        }

        .preview-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
            border: 2px solid transparent;
            transition: border-color 0.2s;
        }

        .preview-image.selected {
            border-color: #e53935;
            box-shadow: 0 0 10px rgba(229, 57, 53, 0.5);
        }

        /* Styles for the new Delete Modal */
        #delete-poster-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            max-height: 50vh;
            overflow-y: auto;
            padding: 10px;
            background-color: #f0f2f5;
            border-radius: 5px;
        }

        .delete-poster-item {
            position: relative;
            cursor: pointer;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: border-color 0.2s ease-in-out;
        }

        .delete-poster-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            display: block;
        }

        .delete-poster-item.selected {
            border-color: #e53935;
        }

        .delete-poster-item.selected::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 30px;
            color: white;
            background-color: #e53935;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
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
                height: 100vh;
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

            .poster-list-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .poster-list-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            #delete-poster-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
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
                <li class="sidebar-item active">
                    <a href="{{ route('admins.manage-poster') }}" class="sidebar-link">
                        <i class="fas fa-image"></i>
                        <span>Manage Poster</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <h1 class="dashboard-title text-center">Manage Poster</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button class="btn-create" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i> Add New Poster
                    </button>
                </div>
                <div>
                    <button class="btn-delete" id="open-delete-modal-btn">
                        <i class="fas fa-trash"></i> Delete Posters
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Poster List</div>
                <div class="card-body">
                    <div class="poster-list-container" id="poster-list">
                        @foreach ($posters as $poster)
                            <div class="poster-card" data-poster-id="{{ $poster->id_poster }}"
                                data-image-url="{{ asset('images/posters/' . $poster->gambar) }}">
                                <img src="{{ asset('images/posters/' . $poster->gambar) }}" alt="Poster Image">
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-container mt-3">
                        {{ $posters->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Poster</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" action="{{ route('admins.manage-poster.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-gambar" class="form-label">Poster Images</label>
                            <input type="file" class="form-control" id="create-gambar" name="gambar[]" multiple
                                required>
                        </div>
                        <div id="image-preview-container"></div>
                        <div class="d-flex justify-content-end gap-2 mt-2">
                            <button type="button" class="btn btn-sm btn-warning" id="delete-selected-preview"
                                style="display: none;">Delete Selected</button>
                            <button type="button" class="btn btn-sm btn-danger" id="delete-all-preview"
                                style="display: none;">Delete All</button>
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

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Poster</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="view-image" src="" alt="Poster Image" class="img-fluid mb-3"
                        style="max-height: 60vh;">
                    <input type="hidden" id="view-poster-id">
                    <input type="file" id="edit-image-input" name="gambar" class="d-none" accept="image/*">
                </div>
                <div class="modal-footer">
                    <div class="w-100 d-flex justify-content-between">
                        <div id="view-modal-initial-buttons">
                            <button type="button" class="btn-select" id="edit-image-btn" style="width: 110px;">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn-delete" id="delete-image-btn" style="width: 110px;">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                        <div id="view-modal-edit-buttons">
                            <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn-save" id="save-changes-btn">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Posters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Select the posters you want to delete.</p>
                    <div id="delete-poster-grid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-select" id="select-all-delete-btn">Select All</button>
                    <button type="button" class="btn-delete" id="confirm-delete-btn">Delete Selected</button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" action="{{ route('admins.poster.destroyMultiple') }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
        <div id="delete-ids-container"></div>
    </form>

    <div class="popup" id="success-popup">
        <i class="fas fa-check-circle popup-icon success"></i>
        <div class="popup-message" id="success-message"></div>
    </div>

    <div class="popup" id="alert-popup">
        <i class="fas fa-exclamation-circle popup-icon alert"></i>
        <div class="popup-message" id="alert-message"></div>
        <div class="popup-buttons">
            <button class="btn-popup btn-popup-confirm" onclick="closePopup('alert-popup')">OK</button>
        </div>
    </div>

    <div class="popup" id="delete-confirm-popup">
        <i class="fas fa-exclamation-circle popup-icon alert"></i>
        <div class="popup-message">Are you sure you want to delete the selected poster(s)?</div>
        <div class="popup-buttons">
            <button class="btn-popup btn-popup-cancel" onclick="closePopup('delete-confirm-popup')">Cancel</button>
            <button class="btn-popup btn-popup-delete" id="final-delete-btn">Delete</button>
        </div>
    </div>

    <div class="popup" id="delete-single-confirm-popup">
        <i class="fas fa-exclamation-circle popup-icon alert"></i>
        <div class="popup-message">Are you sure you want to delete this poster?</div>
        <div class="popup-buttons">
            <button class="btn-popup btn-popup-cancel"
                onclick="closePopup('delete-single-confirm-popup')">Cancel</button>
            <button class="btn-popup btn-popup-delete" id="final-single-delete-btn">Delete</button>
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
            const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const popupOverlay = document.getElementById('popup-overlay');

            // Hamburger menu logic
            hamburgerBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            const createFileInput = document.getElementById('create-gambar');
            const previewContainer = document.getElementById('image-preview-container');
            const deleteSelectedBtn = document.getElementById('delete-selected-preview');
            const deleteAllBtn = document.getElementById('delete-all-preview');
            let fileObjects = [];

            createFileInput.addEventListener('change', event => {
                const newFiles = Array.from(event.target.files);
                const combinedFiles = [...fileObjects, ...newFiles];
                const uniqueFiles = combinedFiles.filter(
                    (file, index, self) => index === self.findIndex(f => f.name === file.name && f
                        .size === file.size)
                );
                fileObjects = uniqueFiles;
                updateFileInput();
                renderPreviews();
            });

            function renderPreviews() {
                previewContainer.innerHTML = '';
                deleteAllBtn.style.display = fileObjects.length > 0 ? 'inline-block' : 'none';
                fileObjects.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const wrapper = document.createElement('div');
                        wrapper.classList.add('preview-image-wrapper');
                        wrapper.dataset.index = index;
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-image');
                        img.dataset.name = file.name;
                        img.addEventListener('click', () => {
                            img.classList.toggle('selected');
                            updatePreviewDeleteButtons();
                        });
                        wrapper.appendChild(img);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
                updatePreviewDeleteButtons();
            }

            function updatePreviewDeleteButtons() {
                const anySelected = previewContainer.querySelector('.preview-image.selected');
                deleteSelectedBtn.style.display = anySelected ? 'inline-block' : 'none';
            }

            deleteSelectedBtn.addEventListener('click', () => {
                const selectedImages = previewContainer.querySelectorAll('.preview-image.selected');
                const namesToRemove = new Set(Array.from(selectedImages).map(img => img.dataset.name));
                fileObjects = fileObjects.filter(file => !namesToRemove.has(file.name));
                updateFileInput();
                renderPreviews();
            });

            deleteAllBtn.addEventListener('click', () => {
                fileObjects = [];
                updateFileInput();
                renderPreviews();
            });

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                fileObjects.forEach(file => dataTransfer.items.add(file));
                createFileInput.files = dataTransfer.files;
            }

            const viewImage = document.getElementById('view-image');
            const viewPosterIdInput = document.getElementById('view-poster-id');
            const editImageInput = document.getElementById('edit-image-input');
            const editImageBtn = document.getElementById('edit-image-btn');
            const deleteImageBtn = document.getElementById('delete-image-btn');
            const saveChangesBtn = document.getElementById('save-changes-btn');
            const finalSingleDeleteBtn = document.getElementById('final-single-delete-btn');
            const initialButtons = document.getElementById('view-modal-initial-buttons');
            const editButtons = document.getElementById('view-modal-edit-buttons');

            let originalImageUrl = '';

            function resetViewModalState() {
                viewImage.src = originalImageUrl;
                editImageInput.value = '';
                initialButtons.style.display = 'block';
                editButtons.style.display = 'none';
            }

            document.querySelectorAll('.poster-card').forEach(card => {
                card.addEventListener('click', function() {
                    originalImageUrl = this.dataset.imageUrl;
                    const posterId = this.dataset.posterId;
                    viewPosterIdInput.value = posterId;
                    resetViewModalState();
                    viewModal.show();
                });
            });

            document.getElementById('viewModal').addEventListener('hidden.bs.modal', resetViewModalState);

            editImageBtn.addEventListener('click', () => {
                editImageInput.click();
            });

            editImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        viewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                    initialButtons.style.display = 'none';
                    editButtons.style.display = 'block';
                }
            });

            saveChangesBtn.addEventListener('click', async () => {
                const posterId = viewPosterIdInput.value;
                const file = editImageInput.files[0];
                if (!file) {
                    showAlertPopup('Please select a new image first.');
                    return;
                }

                saveChangesBtn.disabled = true;
                saveChangesBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

                const formData = new FormData();
                formData.append('gambar', file);
                formData.append('_method', 'PUT');

                try {
                    const response = await fetch(`/admin/poster/${posterId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok) {
                        viewModal.hide();
                        showSuccessPopup(result.success ||
                            'Poster updated successfully.');
                    } else {
                        showAlertPopup(result.message || 'An error occurred.');
                    }
                } catch (error) {
                    console.error('Update error:', error);
                    showAlertPopup('An error occurred while updating the poster.');
                } finally {
                    saveChangesBtn.disabled = false;
                    saveChangesBtn.innerHTML = 'Save Changes';
                }
            });

            deleteImageBtn.addEventListener('click', () => {
                showPopup('delete-single-confirm-popup');
            });

            finalSingleDeleteBtn.addEventListener('click', async () => {
                const posterId = viewPosterIdInput.value;
                finalSingleDeleteBtn.disabled = true;

                try {
                    const response = await fetch(`/admin/poster/${posterId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        }
                    });

                    const result = await response.json();
                    closePopup('delete-single-confirm-popup');

                    if (response.ok) {
                        viewModal.hide();
                        showSuccessPopup(result.success ||
                            'Poster deleted successfully.');
                    } else {
                        showAlertPopup(result.message || 'An error occurred.');
                    }

                } catch (error) {
                    console.error('Delete error:', error);
                    showAlertPopup('An error occurred while deleting the poster.');
                } finally {
                    finalSingleDeleteBtn.disabled = false;
                }
            });

            const openDeleteModalBtn = document.getElementById('open-delete-modal-btn');
            const deletePosterGrid = document.getElementById('delete-poster-grid');
            const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
            const deleteIdsContainer = document.getElementById('delete-ids-container');
            const deleteForm = document.getElementById('deleteForm');
            const finalDeleteBtn = document.getElementById('final-delete-btn');
            const selectAllDeleteBtn = document.getElementById('select-all-delete-btn');
            let selectedForDelete = new Set();

            openDeleteModalBtn.addEventListener('click', async () => {
                deletePosterGrid.innerHTML =
                    '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
                deleteModal.show();
                try {
                    const response = await fetch("{{ route('admins.posters.all') }}");
                    const posters = await response.json();
                    deletePosterGrid.innerHTML = '';
                    posters.forEach(poster => {
                        const item = document.createElement('div');
                        item.classList.add('delete-poster-item');
                        item.dataset.id = poster.id_poster;
                        const img = document.createElement('img');
                        img.src = `{{ asset('images/posters') }}/${poster.gambar}`;
                        img.alt = 'Poster Image';
                        item.appendChild(img);
                        deletePosterGrid.appendChild(item);
                        item.addEventListener('click', () => {
                            const id = item.dataset.id;
                            item.classList.toggle('selected');
                            if (selectedForDelete.has(id)) {
                                selectedForDelete.delete(id);
                            } else {
                                selectedForDelete.add(id);
                            }
                        });
                    });
                } catch (error) {
                    deletePosterGrid.innerHTML =
                        '<p class="text-danger">Failed to load posters. Please try again.</p>';
                    console.error('Error fetching posters:', error);
                }
            });

            selectAllDeleteBtn.addEventListener('click', () => {
                const allItems = deletePosterGrid.querySelectorAll('.delete-poster-item');
                const areAllSelected = allItems.length > 0 && Array.from(allItems).every(item => item
                    .classList.contains('selected'));

                allItems.forEach(item => {
                    const id = item.dataset.id;
                    if (areAllSelected) {
                        item.classList.remove('selected');
                        selectedForDelete.delete(id);
                    } else {
                        item.classList.add('selected');
                        selectedForDelete.add(id);
                    }
                });

                selectAllDeleteBtn.textContent = areAllSelected ? 'Select All' : 'Deselect All';
            });

            confirmDeleteBtn.addEventListener('click', () => {
                if (selectedForDelete.size === 0) {
                    showAlertPopup('You must select at least one poster to delete!');
                    return;
                }
                showPopup('delete-confirm-popup');
            });

            finalDeleteBtn.addEventListener('click', () => {
                deleteIdsContainer.innerHTML = '';
                selectedForDelete.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = id;
                    deleteIdsContainer.appendChild(input);
                });
                deleteForm.submit();
            });

            document.getElementById('deleteModal').addEventListener('hidden.bs.modal', () => {
                selectedForDelete.clear();
                deletePosterGrid.innerHTML = '';
            });

            window.showPopup = function(popupId) {
                document.getElementById(popupId).classList.add('show');
                popupOverlay.classList.add('show');
            }

            window.closePopup = function(popupId) {
                document.getElementById(popupId).classList.remove('show');
                if (!document.querySelector('.popup.show')) {
                    popupOverlay.classList.remove('show');
                }
            };

            window.showAlertPopup = function(message) {
                document.getElementById('alert-message').textContent = message;
                showPopup('alert-popup');
            }

            window.showSuccessPopup = function(message) {
                document.getElementById('success-message').textContent = message;
                showPopup('success-popup');
                setTimeout(() => {
                    closePopup('success-popup');
                    window.location.reload();
                }, 2000);
            }

            @if (session('success'))
                showSuccessPopup("{{ session('success') }}");
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
