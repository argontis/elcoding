<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Elcoding Academy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #2563EB 0%, #7C3AED 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .login-left h1 {
            font-size: 36px;
            font-weight: 800;
            margin: 0 0 15px 0;
            position: relative;
            z-index: 1;
        }

        .login-left p {
            font-size: 16px;
            line-height: 1.6;
            color: #e0e7ff;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .login-right {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: #1F2937;
            margin: 0 0 10px 0;
        }

        .login-header p {
            color: #64748b;
            margin: 0;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px 15px 45px;
            font-size: 15px;
            font-family: inherit;
            color: #1F2937;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            outline: none;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .input-icon-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: #2563EB;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background-color: #2563EB;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #1E40AF;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #2563EB;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 450px;
            }
            .login-left {
                padding: 40px;
                text-align: center;
            }
            .login-right {
                padding: 40px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Left Side: Branding -->
        <div class="login-left">
            <h1>Elcoding.id</h1>
            <p>Selamat datang di Portal Admin Elcoding Academy. Silakan masuk untuk mengelola program kursus, artikel, dan data peserta.</p>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2>Admin Login</h2>
                <p>Masukkan username dan password Anda.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <!-- Username Field -->
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <div class="input-icon-wrapper">
                        <input type="text" id="username" name="username" class="form-control" placeholder="username" required value="{{ old('username') }}">
                        <i class="far fa-user input-icon"></i>
                    </div>
                    @error('username')
                        <p style="color: #ef4444; font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-icon-wrapper">
                        <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">Masuk ke Dashboard</button>
            </form>

            <a href="{{ url('/') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
