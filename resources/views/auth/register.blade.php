<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
        }
        .min-vh-100-custom {
            min-height: 100vh;
        }
        /* Sisi Kiri: Menggunakan foto latar-pisang.jpg dengan Overlay Hijau Premium */
        .auth-sidebar {
            background: linear-gradient(135deg, rgba(15, 81, 50, 0.9) 0%, rgba(28, 116, 48, 0.85) 100%), 
                        url("{{ asset('images/latar-pisang.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }
        .sidebar-content {
            z-index: 2;
            max-width: 480px;
        }
        /* Sisi Kanan: Form Styling */
        .form-container {
            max-width: 440px;
            width: 100%;
        }
        .input-group-text-custom {
            background-color: #f8fafc;
            border-right: none;
            color: #94a3b8;
            border-radius: 12px 0 0 12px;
            padding-left: 1.2rem;
            padding-right: 1rem;
            border-color: #e2e8f0;
        }
        .form-control-custom {
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 0.75rem 1.2rem 0.75rem 0;
            border-color: #e2e8f0;
            font-size: 0.95rem;
            background-color: #f8fafc;
            color: #334155;
        }
        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: #e2e8f0;
            box-shadow: none;
        }
        .input-group-custom:focus-within .input-group-text-custom,
        .input-group-custom:focus-within .form-control-custom {
            border-color: #198754;
            background-color: #ffffff;
        }
        .input-group-custom:focus-within .input-group-text-custom {
            color: #198754;
        }
        .btn-premium {
            background: linear-gradient(90deg, #198754 0%, #157347 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.3);
            color: #ffffff;
            background: linear-gradient(90deg, #157347 0%, #115e59 100%);
        }
        .text-success-custom {
            color: #198754;
            font-weight: 600;
        }
        .text-success-custom:hover {
            color: #115e59;
            text-decoration: underline !important;
        }
        .alert-custom {
            border-radius: 12px;
            border: none;
        }
    </style>
</head>
<body>

    <div class="container-fluid p-0 overflow-hidden">
        <div class="row g-0 min-vh-100-custom">
            
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center auth-sidebar p-5 text-white">
                <div class="sidebar-content text-center text-lg-start">
                    <span class="badge bg-white bg-opacity-20 text-white mb-3 px-3 py-2 rounded-pill fw-semibold tracking-wide" style="font-size: 0.85rem;">REGISTRASI PENGGUNA</span>
                    <h1 class="display-5 fw-extrabold mb-3 text-white" style="font-weight: 800; line-height: 1.2;">Mulai Menguji <br>Kualitas <span style="color: #a3e635;">Secara Digital</span></h1>
                    <p class="lead text-white opacity-75 mb-0" style="font-size: 1.1rem; font-weight: 400;">
                        Daftarkan akun Anda hari ini untuk mengakses modul pengujian kriteria bibit pisang raja.
                    </p>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-sm-5 bg-white">
                <div class="form-container">
                    
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-2">Buat Akun Baru</h3>
                        <p class="text-muted small">Lengkapi data di bawah ini untuk pendaftaran.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-custom small shadow-sm p-3 mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2 fw-bold text-danger">
                                <i class="fa-solid fa-circle-xmark fs-5"></i>
                                <span>Gagal Mendaftar:</span>
                            </div>
                            <ul class="mb-0 ps-3 text-muted">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Nama Lengkap</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom"><i class="fa-regular fa-user"></i></span>
                                <input type="text" name="name" class="form-control form-control-custom" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Email Address</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control form-control-custom" value="{{ old('email') }}" placeholder="nama@email.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Password</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control form-control-custom" placeholder="Minimal 6 karakter" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary mb-1">Konfirmasi Password</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-shield-halved"></i></span>
                                <input type="password" name="password_confirmation" class="form-control form-control-custom" placeholder="Ulangi password Anda" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-premium w-100 mb-3">Daftar Sekarang</button>
                    </form>
                    
                    <div class="text-center pt-2">
                        <p class="small text-muted mb-0">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-decoration-none text-success-custom">Silakan Login</a></p>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>
</html>