<!-- resources/views/admin/dashboard-admin.blade.php -->
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
            height: 25px;
            background-color: #ffff0c;
        }

        .flag-red {
            width: 15px;
            height: 32px;
            background-color: #e53935;
        }

        /* Header */
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

        /* Sidebar and Main Content */
        .dashboard-container {
            display: flex;
            height: calc(100vh - 67px);
            /* Adjust based on header height */
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding: 20px 0;
            overflow-y: auto;
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

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #eaeaea;
            padding: 15px 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
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
    </style>
</head>

<body>
    <!-- Container untuk topbar dan bendera -->
    <div class="top-container">
        <div class="flag-container">
            <div class="flag-blue"></div>
            <div class="flag-yellow"></div>
            <div class="flag-red"></div>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <div class="logo-container">
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

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li class="sidebar-item active">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-bolt"></i>
                        <span>Power Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-chart-line"></i>
                        <span>Monitoring</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-file-alt"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="dashboard-title">Dashboard</h1>

            <!-- Stats Overview -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon bg-primary-soft">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="stat-value">2,345 MW</div>
                    <div class="stat-label">Current Power Output</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-success-soft">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value">98.7%</div>
                    <div class="stat-label">System Uptime</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-warning-soft">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Active Alerts</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-danger-soft">
                        <i class="fas fa-battery-quarter"></i>
                    </div>
                    <div class="stat-value">75%</div>
                    <div class="stat-label">Resource Utilization</div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">Recent Activity</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Event</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Today, 10:30 AM</td>
                                <td>System Maintenance</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                            <tr>
                                <td>Today, 09:15 AM</td>
                                <td>Power Output Increase</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                            <tr>
                                <td>Today, 08:45 AM</td>
                                <td>Alert: Generator #3</td>
                                <td><span class="badge bg-warning">In Progress</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                            <tr>
                                <td>Yesterday, 18:20 PM</td>
                                <td>Daily Backup</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                            <tr>
                                <td>Yesterday, 14:30 PM</td>
                                <td>System Update</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
