<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Learning Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .logo-container {
            position: absolute;
            left: 20px;
            height: 70px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-container img {
            height: 40px;
            width: auto;
        }

        .logo-text {
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }

        .top-bar {
            background: white;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            z-index: 1000;
        }

        .search-bar {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .search-bar input {
            border-radius: 20px;
            border: 1px solid #e0e0e0;
            padding: 8px 15px;
        }

        .user-profile-mini {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-profile-mini img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .sidebar {
            background-color: #2a2a4a;
            min-height: calc(100vh - 70px);
            width: 250px;
            position: fixed;
            left: 0;
            top: 70px;
            color: white;
            bottom: 0;
            overflow-y: auto;
            z-index: 900;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: #6c5ce7;
        }

        .main-container {
            margin-left: 250px;
            margin-right: 300px;
            margin-top: 70px;
            padding: 30px;
            height: calc(100vh - 70px);
            overflow-y: auto;
            position: relative;
        }

        .right-sidebar {
            background-color: white;
            width: 300px;
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            padding: 20px;
            overflow-y: auto;
            border-left: 1px solid #eee;
            z-index: 1001;
        }

        .user-profile-box {
            text-align: center;
            padding: 10px 0 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .user-profile-box img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #6c5ce7;
        }

        .instructor-schedule-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 4px solid #6c5ce7;
        }

        .instructor-schedule-item h6 {
            margin-bottom: 8px;
            color: #2a2a4a;
        }

        .schedule-info {
            font-size: 13px;
            color: #666;
            margin-bottom: 3px;
        }

        .course-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .course-header {
            background: #6c5ce7;
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .calendar-widget {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-top: 15px;
        }

        .calendar-day {
            text-align: center;
            padding: 8px;
            border-radius: 5px;
            font-size: 14px;
        }

        .calendar-day.active {
            background: #6c5ce7;
            color: white;
        }

        .module-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .module-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .module-card .content {
            padding: 15px;
        }

        .module-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .divider {
            height: 2px;
            background-color: rgba(255, 255, 255, 0.1);
            margin: 10px 20px;
        }

        .sidebar::-webkit-scrollbar,
        .main-container::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track,
        .main-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb,
        .main-container::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover,
        .main-container::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="logo-container">
            <img src="{{ asset('images.png') }}" alt="Logo">
            <span class="logo-text">LEARNING MANAGEMENT SYSTEM</span>
        </div>
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Search here...">
        </div>
    </div>

    <div class="sidebar">
        <nav class="nav flex-column">
            <a href="#" class="nav-link ">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            <a href="#" class="nav-link ">
                <i class="bi bi-book"></i>
                Modul
            </a>
            <a href="#" class="nav-link ">
                <i class="bi bi-people"></i>
                Peserta
            </a>
            <a href="#" class="nav-link ">
                <i class="bi bi-chat-dots"></i>
                Group Chat
            </a>
            <a href="#" class="nav-link ">
                <i class="bi bi-people"></i>
                Pemateri
            </a>
            <div class="divider"></div>

            <div class="fw-bold">PROFIL
            <a href="#" class="nav-link ">
                <i class="bi bi-gear"></i>
                Settings
            </a>
            <a href="#" class="nav-link ">
                <i class="bi bi-calendar3"></i>
                Kalender
            </a>
            </div>
            <div class="divider"></div>
            <a href="/login" class="nav-link" id="logoutBtn">
                <i class="bi bi-box-arrow-left"></i>
                Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="course-header">
            <h4>PEMROGRAMAN</h4>
            <h2>Pemrograman Frontend Modern dengan React dan Angular</h2>
            <div class="mt-3">
                <span class="me-4"><i class="bi bi-person"></i> Pemateri: By Josep</span>
                <span><i class="bi bi-calendar"></i> 14-06-2025</span>
            </div>
            <button class="btn btn-light mt-3">MULAI LEARNING</button>
        </div>

        <h5 class="mb-4">MODUL KOMPETENSI</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="module-card">
                    <img src="https://via.placeholder.com/300x150" alt="Module">
                    <div class="content">
                        <div class="module-title">PEMROGRAMAN</div>
                        <small class="text-muted d-block mb-2">MATERI KOMPETENSI</small>
                        <p class="small">Pemrograman Frontend Modern dengan React dan Angular</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="module-card">
                    <img src="https://via.placeholder.com/300x150" alt="Module">
                    <div class="content">
                        <div class="module-title">CREATIVE MARKETING</div>
                        <small class="text-muted d-block mb-2">MATERI KOMPETENSI</small>
                        <p class="small">Storytelling dalam Pemasaran</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="module-card">
                    <img src="https://via.placeholder.com/300x150" alt="Module">
                    <div class="content">
                        <div class="module-title">MANAGEMENT SDM</div>
                        <small class="text-muted d-block mb-2">MATERI KOMPETENSI</small>
                        <p class="small">Manajemen Sumber Daya Manusia</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <h5 class="mb-4">NILAI PESERTA</h5>
                <div class="table-responsive">
                    <table class="table bg-white rounded">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama</th>
                                <th>Class</th>
                                <th>MODUL</th>
                                <th>Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Farja faiza</td>
                                <td>PEMROGRAMAN</td>
                                <td>L1</td>
                                <td>1,234 Point</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="right-sidebar">
        <div class="user-profile-box">
            <img src="https://via.placeholder.com/100" alt="Profile Picture">
            <div>
                <div class="fw-bold">SELAMAT DATANG, {{ strtoupper(Auth::user()->name) }}</div>
                <small class="text-muted">LMS by Adhivasindo</small>
            </div>
            <button class="btn btn-sm btn-outline-primary">Edit Profile</button>
        </div>

        <div class="mb-4">
            <h6 class="mb-3">Kalender Pemateri</h6>
            <div class="calendar-widget">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>April 2025</span>
                    <div>
                        <button class="btn btn-sm btn-light"><i class="bi bi-chevron-left"></i></button>
                        <button class="btn btn-sm btn-light"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
                <div class="calendar-grid">
                </div>
            </div>
        </div>

        
        <div>
            <h6 class="mb-3">Jadwal Pemateri</h6>
            <div class="instructor-schedule-item">
                <h6>Pemrograman Frontend</h6>
                <div class="schedule-info">
                    <i class="bi bi-person"></i> Josep
                </div>
                <div class="schedule-info">
                    <i class="bi bi-clock"></i> 09:00 - 11:00
                </div>
                <div class="schedule-info">
                    <i class="bi bi-calendar3"></i> Senin, 20 Nov 2023
                </div>
            </div>
            <div class="instructor-schedule-item">
                <h6>React Development</h6>
                <div class="schedule-info">
                    <i class="bi bi-person"></i> David
                </div>
                <div class="schedule-info">
                    <i class="bi bi-clock"></i> 13:00 - 15:00
                </div>
                <div class="schedule-info">
                    <i class="bi bi-calendar3"></i> Selasa, 21 Nov 2023
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple logout handler
        $('#logoutBtn').on('click', function() {
            localStorage.removeItem('token'); // Hapus token dari localStorage
            window.location.href = '/login'; // Redirect ke halaman login
        });
    </script>
</body>
</html> 