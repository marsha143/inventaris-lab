<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Inventaris Lab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg,#fdf2f8,#fce7f3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            border: none;
            border-radius: 25px;
            padding: 35px;
            background: white;
            box-shadow: 0 15px 40px rgba(236,72,153,.15);
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: auto;
            border-radius: 20px;
            background: linear-gradient(135deg,#ec4899,#db2777);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .title {
            text-align: center;
            font-weight: 700;
            color: #1f2937;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 15px;
            min-height: 50px;
        }

        .btn-login {
            width: 100%;
            border: none;
            border-radius: 15px;
            padding: 12px;
            color: white;
            font-weight: 600;
            background: linear-gradient(135deg,#ec4899,#db2777);
        }

        .btn-login:hover {
            opacity: .9;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="logo">
        📦
    </div>

    <h2 class="title">Inventaris Lab</h2>

    <p class="subtitle">
        Silakan login untuk melanjutkan
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                placeholder="admin@gmail.com"
                required>
        </div>

        @error('email')
            <div class="alert alert-danger py-2">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="********"
                required>
        </div>

        @error('password')
            <div class="alert alert-danger py-2">
                {{ $message }}
            </div>
        @enderror

        <div class="form-check mb-3">
            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                value="1">

            <label class="form-check-label">
                Ingat saya
            </label>
        </div>

        <button type="submit" class="btn-login">
            Login
        </button>

    </form>

</div>

</body>
</html>