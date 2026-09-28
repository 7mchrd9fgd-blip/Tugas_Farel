<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - SPK Pisang Raja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f8fafc; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
        }
        /* Sidebar Styling */
        .sidebar { 
            min-height: 100vh; 
            background: linear-gradient(180deg, #0f5132 0%, #157347 100%); 
            color: white; 
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .user-profile-box {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
        }
        .sidebar-menu-container {
            padding: 0 1rem;
        }
        .sidebar a { 
            color: rgba(255, 255, 255, 0.75); 
            text-decoration: none; 
            padding: 14px 18px; 
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 10px;
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .sidebar a:hover { 
            background-color: rgba(255, 255, 255, 0.08); 
            color: white; 
        }
        .sidebar a.active { 
            background-color: #ffffff; 
            color: #157347; 
            font-weight: 600; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        /* Button Sign Out Custom */
        .btn-logout-custom {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            font-weight: 600;
            border-radius: 10px;
            padding: 10px;
            transition: all 0.2s ease;
        }
        .btn-logout-custom:hover {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }
        /* Main Content Card */
        .main-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            background-color: #ffffff;
            padding: 2.5rem !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 p-0 sidebar shadow-sm d-flex flex-column justify-content-between">
                <div>
                    <div class="p-4 mb-3">
                        <div class="p-3 text-center user-profile-box border border-white border-opacity-10">
                            <div class="mb-2">
                                <i class="fa-solid fa-circle-user fs-2 text-white-50"></i>
                            </div>
                            <h6 class="m-0 fw-bold text-white tracking-wide" style="font-size: 0.95rem;">Dashboard User</h6>
                            <small class="text-white opacity-75 fw-medium d-block mt-1">{{ Auth::user()->name }}</small>
                        </div>
                    </div>
                    
                    <div class="sidebar-menu-container">
                        <a href="{{ route('user.dashboard') }}" class="{{ Request::is('user/dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-list-check fs-5"></i> Langkah Penggunaan
                        </a>
                        <a href="{{ route('user.input_matriks') }}" class="{{ Request::is('user/input-matriks') ? 'active' : '' }}">
                            <i class="fa-solid fa-square-poll-horizontal fs-5"></i> Input Kriteria Bibit Pisang Raja
                        </a>
                        <a href="{{ route('user.history') }}" class="{{ Request::is('user/history') ? 'active' : '' }}">
                            <i class="fa-solid fa-clock-rotate-left fs-5"></i> History Keputusan
                        </a>
                    </div>
                </div>

                <div class="p-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-logout-custom btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out / Keluar
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-9 col-lg-10 p-4 p-md-5">
                <div class="card main-card">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>