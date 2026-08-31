<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - E-SIMAKSI BKSDA Sulteng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body {
            background-color: #f0fdf4;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-card {
            background: white;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border: 1px solid #d1fae5;
            overflow: hidden;
        }
        .login-header {
            background-color: #065f46;
            color: white;
            padding: 25px 20px;
            text-align: center;
            border-bottom: 4px solid #f59e0b;
        }
        .login-header .logo-box {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }
        .login-header .header-logo {
            max-height: 65px;
            width: auto;
            display: block;
        }
        .login-header h2 { font-size: 16px; font-weight: 700; text-transform: uppercase; }
        .login-header p { font-size: 11px; color: #a7f3d0; margin-top: 2px; }
        
        .login-body { padding: 25px 20px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .input-group { position: relative; }
        .input-group i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 14px; }
        .form-control {
            width: 100%;
            padding: 10px 12px 10px 38px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            outline: none;
            transition: all 0.2s;
        }
        .form-control:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2); }
        
        .alert-error {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
            padding: 10px;
            font-size: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .btn-login {
            width: 100%;
            background-color: #047857;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover { background-color: #065f46; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="logo-box">
                <img src="{{ asset('images/logo-bksda.png') }}" alt="Logo BKSDA Sulteng" class="header-logo">
            </div>
            <h2>LOGIN ADMIN BKSDA</h2>
            <p>SIPAKAR (Sistem Perizinan Akses & Masuk Kawasan Konservasi)</p>
        </div>

        <div class="login-body">
            @if(session('error'))
                <div class="alert-error">
                    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Admin</label>
                    <div class="input-group">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="admin@bksdasulteng.go.id" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk
                </button>
            </form>
        </div>
    </div>

</body>
</html>