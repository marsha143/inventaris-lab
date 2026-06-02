<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inventaris Lab')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #ec4899;
            --primary-dark: #db2777;
            --secondary: #f9a8d4;
            --sidebar: #ffffff;
            --background: #fff5fa;
            --text: #374151;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--background);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text);
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 270px;
            background: white;
            border-right: 1px solid #f3d4e6;
            padding: 25px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            margin: auto;
            border-radius: 20px;
            background: linear-gradient(135deg, #ec4899, #db2777);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 30px;
            box-shadow: 0 10px 25px rgba(236, 72, 153, .3);
        }

        .logo h4 {
            margin-top: 15px;
            font-weight: 700;
        }

        .logo small {
            color: #9ca3af;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: #4b5563;
            padding: 14px 18px;
            border-radius: 15px;
            font-weight: 600;
            transition: .3s;
        }

        .sidebar-menu a:hover {
            background: #fce7f3;
            color: #db2777;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
            box-shadow: 0 10px 20px rgba(236, 72, 153, .25);
        }

        .sidebar-menu i {
            margin-right: 10px;
        }

        .main {
            margin-left: 270px;
            width: 100%;
            padding: 30px;
        }

        .topbar {
            background: white;
            border-radius: 25px;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .topbar h3 {
            margin: 0;
            font-weight: 700;
        }

        .topbar p {
            margin: 0;
            color: #9ca3af;
        }

        .user-box {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: none;
        }

        .content-wrapper {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .card {
            border: none;
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(236, 72, 153, .08);
        }

        .btn-primary {
            border: none;
            background: linear-gradient(135deg, #ec4899, #db2777);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #db2777, #be185d);
        }

        .form-control,
        .form-select {
            border-radius: 15px;
            min-height: 50px;
            border: 1px solid #fbcfe8;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 .25rem rgba(236, 72, 153, .15);
        }

        .table {
            border-collapse: collapse;
        }

        .table thead th {
            background: #f9fafb !important;
            color: #374151 !important;
            border: 1px solid #e5e7eb;
            font-weight: 600;
        }

        .table tbody td {
            border: 1px solid #e5e7eb;
        }

        .table tbody tr:hover {
            background: #fafafa;
        }

        .badge.bg-secondary {
            background: #6b7280 !important;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #9ca3af;
        }

        @media(max-width:991px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .layout {
                flex-direction: column;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="layout">

        <aside class="sidebar">

            <div class="logo">
                <div class="logo-circle">
                    <i class="bi bi-box-seam"></i>
                </div>

                <h4>Inventaris Lab</h4>
                <small>Management System</small>
            </div>

            <div class="sidebar-menu">

                <a href="{{ route('inventaris.index') }}"
                    class="{{ request()->routeIs('inventaris.*') ? 'active' : '' }}">
                    <i class="bi bi-box"></i>
                    Inventaris
                </a>

                <a href="{{ route('kategori.index') }}"
                    class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    Kategori
                </a>

                <a href="{{ route('kondisi.index') }}"
                    class="{{ request()->routeIs('kondisi.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check"></i>
                    Kondisi
                </a>

            </div>

        </aside>

        <main class="main">

            <div class="topbar">

                <div>
                    <h3>@yield('title')</h3>
                    <p>Sistem Inventaris Laboratorium</p>
                </div>

                <div class="dropdown">

                    <button
                        class="user-box"
                        type="button"
                        data-bs-toggle="dropdown">

                        <i class="bi bi-person-fill"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        @auth
                            <li>
                                <span class="dropdown-item-text fw-bold">
                                    {{ auth()->user()->name }}
                                </span>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="{{ route('logout') }}"
                                    method="POST">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item text-danger">

                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout

                                    </button>
                                </form>
                            </li>
                        @endauth

                        @guest
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('login') }}">
                                    Login
                                </a>
                            </li>
                        @endguest

                    </ul>

                </div>

            </div>

<div class="content-wrapper">

    <div class="alert alert-warning">
        Auth Check : {{ Auth::check() ? 'YA' : 'TIDAK' }} <br>
        User : {{ auth()->user()?->name }}
    </div>

    @yield('content')

</div>

            <div class="footer">
                © 2026 Inventaris Lab • Politeknik Takumi
            </div>

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>