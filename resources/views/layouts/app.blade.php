<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beneficiary Tracker')</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #e0e7ef;
            --accent: #f53003;
            --bg: #f8fafc;
            --sidebar-bg: #f1f5f9;
            --content-bg: #fff;
            --border: #e5e7eb;
            --shadow: 0 2px 16px #0001;
        }
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: var(--bg);
            color: #222;
            margin: 0;
        }
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: var(--sidebar-bg);
            min-width: 220px;
            max-width: 240px;
            padding: 2rem 1rem 2rem 1.5rem;
            box-shadow: 2px 0 8px #0001;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .logo {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 2.5rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logo-icon {
            font-size: 2rem;
            color: var(--accent);
        }
        .nav {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        .nav a {
            color: #1b1b18;
            font-weight: 500;
            text-decoration: none;
            padding: 0.7rem 1rem;
            border-radius: 6px;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            font-size: 1.08rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .nav a.active, .nav a:hover {
            background: var(--primary-light);
            color: var(--primary);
            box-shadow: 0 2px 8px #2563eb11;
        }
        .main-content {
            flex: 1;
            background: var(--content-bg);
            margin: 2.5rem 2.5rem 2.5rem 0;
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 2.5rem 2rem 2rem 2rem;
            min-width: 0;
        }
        .footer {
            text-align: center;
            margin-top: 2rem;
            color: #888;
            font-size: 0.95rem;
        }
        @media (max-width: 900px) {
            .layout { flex-direction: column; }
            .sidebar {
                flex-direction: row;
                min-width: 0;
                max-width: 100vw;
                width: 100vw;
                height: auto;
                position: static;
                box-shadow: none;
                padding: 1rem 0.5rem;
                align-items: center;
                justify-content: space-between;
            }
            .logo { margin-bottom: 0; }
            .nav { flex-direction: row; gap: 0.5rem; }
            .main-content { margin: 1.5rem 0.5rem; padding: 1.5rem 0.5rem; border-radius: 10px; }
        }
        @media (max-width: 600px) {
            .main-content { margin: 0.5rem 0.1rem; padding: 1rem 0.2rem; }
            .sidebar { padding: 0.7rem 0.2rem; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="logo">
                <span class="logo-icon">&#128101;</span>
                Beneficiary Tracker
            </div>
            <nav class="nav">
                <a href="/" class="@if(request()->is('/')) active @endif">Home</a>
                <a href="{{ route('families.index') }}" class="@if(request()->is('families*')) active @endif">Families</a>
                <a href="{{ route('beneficiaries.index') }}" class="@if(request()->is('beneficiaries*')) active @endif">Beneficiaries</a>
                <a href="{{ route('associations.index') }}" class="@if(request()->is('associations*')) active @endif">Associations</a>
                <a href="{{ route('aid_records.index') }}" class="@if(request()->is('aid_records*')) active @endif">Aid Records</a>
                <a href="{{ route('priority.index') }}" class="@if(request()->is('priority')) active @endif">Priority List</a>
            </nav>
        </aside>
        <main class="main-content">
            @yield('content')
            <div class="footer">
                &copy; {{ date('Y') }} Beneficiary Tracker. Powered by Laravel.
            </div>
        </main>
    </div>
</body>
</html> 