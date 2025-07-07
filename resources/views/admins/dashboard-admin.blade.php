<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PLN Indonesia Power</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
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

        .sidebar-item.active .sidebar-link {
            color: #13097C;
            font-weight: bold;
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

        .welcome-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #f8e1e1, #fff);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #13097C;
            animation: slideIn 0.3s ease-in-out forwards;
        }

        @keyframes slideIn {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .bg-primary-soft {
            background-color: rgba(19, 9, 124, 0.2);
            color: #13097C;
        }

        .bg-success-soft {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .bg-warning-soft {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .bg-danger-soft {
            background-color: rgba(229, 57, 53, 0.2);
            color: #e53935;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }

        .quick-actions-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .quick-action-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: transform 0.2s;
        }

        .quick-action-card:hover {
            transform: translateY(-5px);
        }

        .quick-action-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 15px;
        }

        .quick-action-icon.icon-reminder {
            background-color: rgba(229, 57, 53, 0.2);
            color: #e53935;
        }

        .quick-action-icon.icon-portal-admin {
            background-color: rgba(19, 9, 124, 0.2);
            color: #13097C;
        }

        .quick-action-icon.icon-portal-utama {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .quick-action-icon.icon-poster {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .quick-action-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .quick-action-label {
            color: #6c757d;
            font-size: 14px;
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

        /* Improved Portal Admin List Styling */
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

        .search-container {
            margin-bottom: 20px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-size: 14px;
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

        /* Sidebar overlay for mobile */
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

        .btn-custom-primary {
            background-color: #13097C;
            border-color: #13097C;
            color: #fff;
        }

        .btn-custom-primary:hover {
            background-color: #0f0766;
            color: #fff;
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

            /* Adjust portal cards for mobile */
            .portal-list-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .portal-card {
                height: 180px;
                /* Slightly smaller on mobile */
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

            .search-container {
                flex-direction: column;
            }

            .search-input,
            .btn-create {
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

    <!-- Sidebar overlay for mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-logo-container">
                <img src="{{ asset('storage/images/ip-logo.png') }}" alt="PLN Logo" class="logo-img">
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-item active">
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
                <li class="sidebar-item">
                    <a href="{{ route('admins.manage-poster') }}" class="sidebar-link">
                        <i class="fas fa-image"></i>
                        <span>Manage Poster</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <h1 class="dashboard-title">Dashboard</h1>

            <!-- Welcome Card -->
            <div class="welcome-card">
                <h2>Selamat Datang, Admin</h2>
                <p>Kelola akses dan konten untuk <strong>Portal Admin</strong> dan <strong>Portal Utama</strong>, atur
                    <strong>Reminder</strong>, serta publikasikan <strong>Poster</strong> terbaru secara terpusat dari
                    satu tempat.
                </p>
                <p style="color: #f39c12;">* Sistem yang hebat dimulai dari pengelolaan yang rapi</p>
            </div>

            <!-- Stats Overview -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon bg-primary-soft">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="stat-value">{{ App\Models\PortalAdmin::count() }}</div>
                    <div class="stat-label">Total Portal Admin</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-success-soft">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value">{{ App\Models\PortalUtama::count() }}</div>
                    <div class="stat-label">Total Portal Utama</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-warning-soft">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="stat-value">{{ App\Models\Poster::count() }}</div>
                    <div class="stat-label">Total Poster</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card" style="margin-bottom: 20px;">
                <div class="card-header">Quick Actions</div>
                <div class="card-body">
                    <div class="quick-actions-container">
                        <a href="{{ route('admins.manage-reminder') }}#editModal" class="quick-action-card">
                            <div class="quick-action-icon icon-reminder">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="quick-action-title">Manage Reminder</div>
                            <div class="quick-action-label">Set or edit reminders</div>
                        </a>

                        <a href="{{ route('admins.portal-admin') }}#createModal" class="quick-action-card">
                            <div class="quick-action-icon icon-portal-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="quick-action-title">Portal Admin</div>
                            <div class="quick-action-label">Manage admin portals</div>
                        </a>

                        <a href="{{ route('admins.portal-utama') }}#createModal" class="quick-action-card">
                            <div class="quick-action-icon icon-portal-utama">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="quick-action-title">Portal Utama</div>
                            <div class="quick-action-label">Manage main portals</div>
                        </a>

                        <a href="{{ route('admins.manage-poster') }}#createModal" class="quick-action-card">
                            <div class="quick-action-icon icon-poster">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="quick-action-title">Poster</div>
                            <div class="quick-action-label">Manage posters</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Portal Admin List -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Portal Admin List</span>
                    <form action="{{ route('admins.dashboard-admin') }}" method="GET" class="d-flex gap-2"
                        style="max-width: 400px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari portal..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-custom-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
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

    <!-- Bootstrap & jQuery JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const searchInput = document.getElementById('search-input');
            const portalListContainer = document.querySelector('.portal-list-container');

            // Toggle sidebar when hamburger button is clicked
            hamburgerBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            // Close sidebar when overlay is clicked
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !hamburgerBtn.contains(e.target)) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });

            // Search functionality
            if (searchInput && portalListContainer) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.trim().toLowerCase();
                    const portalCards = portalListContainer.getElementsByClassName('portal-card');

                    Array.from(portalCards).forEach(card => {
                        const nama = card.dataset.nama.toLowerCase();
                        const keterangan = card.dataset.keterangan.toLowerCase();
                        const link = card.dataset.link.toLowerCase();

                        // Check if any field matches the search term
                        if (nama.includes(searchTerm) || keterangan.includes(searchTerm) || link
                            .includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Optional: Show a message if no results are found
                    const noResultsMessage = portalListContainer.querySelector('.no-results');
                    if (Array.from(portalCards).every(card => card.style.display === 'none')) {
                        if (!noResultsMessage) {
                            const message = document.createElement('div');
                            message.className = 'no-results';
                            message.textContent = 'No results found.';
                            message.style.textAlign = 'center';
                            message.style.padding = '20px';
                            message.style.color = '#6c757d';
                            portalListContainer.appendChild(message);
                        }
                    } else {
                        if (noResultsMessage) {
                            noResultsMessage.remove();
                        }
                    }
                });
            }

            // Portal card click handler
            if (portalListContainer) {
                portalListContainer.addEventListener('click', function(e) {
                    const card = e.target.closest('.portal-card');
                    if (card) {
                        const link = card.dataset.link;
                        if (link) {
                            window.open(link, '_blank');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
