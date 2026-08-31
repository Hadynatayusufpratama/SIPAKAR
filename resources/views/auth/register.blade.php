<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun SIPAKAR - BKSDA Sulawesi Tengah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #064e3b;          /* Hijau Tua Utama (Deep Emerald) */
            --primary-dark: #022c22;     /* Hijau Sangat Gelap */
            --primary-light: #f0fdf4;    /* Hijau Muda Lembut */
            --accent: #d97706;           /* Aksen Emas/Kuning */
            --text-main: #0f172a;        /* Teks Utama */
            --text-muted: #475569;       /* Teks Sekunder */
            --border-color: #cbd5e1;     /* Garis Pembatas */
            --bg-body: #f1f5f9;          /* Background Modern */
        }

        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }

        body { 
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
            padding: 20px; 
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }

        .auth-card { 
            background: white; 
            width: 100%; 
            max-width: 440px; 
            padding: 40px 36px; 
            border-radius: 20px; 
            border: 1px solid #e2e8f0; 
            box-shadow: 0 20px 40px -15px rgba(2, 44, 34, 0.1); 
        }

        .auth-header { 
            text-align: center; 
            margin-bottom: 28px; 
        }

        .logo-bksda {
            max-width: 220px;
            width: 100%;
            height: auto;
            margin-bottom: 16px;
            object-fit: contain;
        }

        .auth-header h2 { 
            font-size: 20px; 
            color: var(--primary); 
            margin-top: 5px; 
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .auth-header p { 
            font-size: 13px; 
            color: var(--text-muted); 
            margin-top: 6px; 
            font-weight: 500;
        }

        .form-group { 
            margin-bottom: 18px; 
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label { 
            display: block; 
            font-size: 13px; 
            font-weight: 600; 
            color: var(--text-main); 
        }

        .form-control { 
            width: 100%; 
            padding: 12px 16px; 
            border: 1px solid var(--border-color); 
            border-radius: 12px; 
            font-size: 14px; 
            outline: none; 
            background-color: #f8fafc;
            color: var(--text-main);
            transition: all 0.25s ease;
        }

        .form-control:focus { 
            border-color: var(--primary); 
            background-color: white;
            box-shadow: 0 0 0 4px rgba(6, 78, 59, 0.12); 
        }

        .btn-submit { 
            width: 100%; 
            background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
            color: white; 
            border: none; 
            padding: 14px; 
            border-radius: 12px; 
            font-weight: 600; 
            font-size: 15px; 
            cursor: pointer; 
            margin-top: 10px; 
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(6, 78, 59, 0.25);
            transition: all 0.25s ease;
        }

        .btn-submit:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 78, 59, 0.35);
            background: linear-gradient(135deg, #04392c 0%, #011b15 100%);
        }

        .auth-footer { 
            text-align: center; 
            margin-top: 25px; 
            font-size: 13px; 
            color: var(--text-muted); 
        }

        .auth-footer a { 
            color: var(--primary); 
            text-decoration: none; 
            font-weight: 700; 
            transition: color 0.2s;
        }

        .auth-footer a:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        .error-msg { 
            color: #b91c1c; 
            font-size: 12px; 
            margin-top: 4px; 
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <!-- Menampilkan Logo BKSDA Sulteng -->
            <img src="{{ asset('images/logo_bksda.png') }}" alt="Logo BKSDA Sulteng" class="logo-bksda">
            <h2>Daftar Akun SIPAKAR</h2>
            <p>Buat akun untuk mengelola permohonan SIPAKAR Anda</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Nama Lengkap">
                @error('name') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="contoh@email.com">
                @error('email') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" class="form-control" required placeholder="Minimal 8 karakter">
                @error('password') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi Kata Sandi">
            </div>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-user-plus"></i> Daftar Sekarang
            </button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</body>
</html>