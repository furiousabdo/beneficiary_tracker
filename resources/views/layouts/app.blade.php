<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beneficiary Tracker')</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #174bbd;
            --secondary: #f1f5f9;
            --secondary-dark: #e0e7ef;
            --danger: #f53003;
            --danger-bg: #fff0f0;
            --success: #22c55e;
            --bg: #f8fafc;
            --card-bg: #fff;
            --border: #e5e7eb;
            --shadow: 0 4px 24px #0001;
            --radius: 14px;
            --transition: 0.18s cubic-bezier(.4,0,.2,1);
        }
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Inter', 'Instrument Sans', Arial, sans-serif;
            background: var(--bg);
            color: #23272f;
            margin: 0;
            min-height: 100vh;
        }
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: var(--card-bg);
            min-width: 230px;
            max-width: 260px;
            padding: 2.5rem 1.2rem 2rem 2rem;
            box-shadow: 2px 0 12px #0001;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 10;
        }
        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 2.5rem;
            letter-spacing: 1px;
            text-align: left;
        }
        .nav {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }
        .nav a {
            color: #23272f;
            font-weight: 500;
            text-decoration: none;
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            font-size: 1.08rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: background var(--transition), color var(--transition), box-shadow var(--transition);
        }
        .nav a.active, .nav a:hover {
            background: var(--secondary);
            color: var(--primary);
            box-shadow: 0 2px 8px #2563eb11;
        }
        .topbar {
            width: 100%;
            background: var(--card-bg);
            box-shadow: 0 2px 8px #0001;
            padding: 1.2rem 2.5rem 1.2rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            position: sticky;
            top: 0;
            z-index: 9;
        }
        .main-content {
            flex: 1;
            background: var(--bg);
            min-width: 0;
            padding: 2.5rem 2.5rem 2.5rem 0;
            display: flex;
            flex-direction: column;
        }
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2.2rem 2rem;
            margin-bottom: 2.5rem;
        }
        .footer {
            text-align: center;
            margin-top: 2rem;
            color: #888;
            font-size: 0.98rem;
        }
        /* BUTTONS */
        .btn {
            display: inline-block;
            padding: 0.65rem 1.5rem;
            font-size: 1.06rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            margin: 0 0.2rem 0.2rem 0;
            text-decoration: none;
            cursor: pointer;
            transition: background var(--transition), color var(--transition), box-shadow var(--transition), transform var(--transition);
            box-shadow: 0 1px 4px #2563eb11;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px) scale(1.03);
        }
        .btn-secondary {
            background: var(--secondary);
            color: var(--primary);
        }
        .btn-secondary:hover, .btn-secondary:focus {
            background: var(--secondary-dark);
            color: var(--primary-dark);
            transform: translateY(-1px) scale(1.03);
        }
        .btn-light {
            background: #fff;
            color: var(--primary);
            border: 1.5px solid var(--border);
        }
        .btn-light:hover, .btn-light:focus {
            background: var(--secondary);
            color: var(--primary-dark);
            border-color: #2563eb33;
            transform: translateY(-1px) scale(1.03);
        }
        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1.5px solid #f5300333;
        }
        .btn-danger:hover, .btn-danger:focus {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
            transform: translateY(-1px) scale(1.03);
        }
        .btn-back {
            background: var(--secondary);
            color: var(--primary);
            border: none;
            font-weight: 500;
            padding-left: 1.5rem;
            position: relative;
        }
        .btn-back:hover, .btn-back:focus {
            background: var(--secondary-dark);
            color: var(--primary-dark);
        }
        /* FORMS */
        .form-card {
            max-width: 520px;
            margin: 2.5rem auto;
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2.2rem 1.5rem;
        }
        .form-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.7rem;
        }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
        .req { color: var(--danger); font-size: 1.1em; }
        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 0.7rem;
            border: 1.5px solid var(--border);
            border-radius: 7px;
            font-size: 1.08rem;
            transition: border var(--transition);
        }
        input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus, select:focus {
            border-color: var(--primary);
            outline: none;
        }
        .form-error { color: var(--danger); font-size: 0.98rem; margin-top: 0.3rem; }
        .form-actions { display: flex; gap: 1rem; justify-content: center; align-items: center; margin-top: 2rem; }
        /* TABLES */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }
        table th, table td {
            padding: 0.7rem 0.5rem;
            text-align: left;
        }
        table th {
            background: var(--secondary);
            font-weight: 600;
        }
        table tr {
            border-bottom: 1px solid var(--border);
        }
        table tr:last-child {
            border-bottom: none;
        }
        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .sidebar { display: none; }
            .main-content { padding: 2rem 0.5rem; }
            .topbar { padding: 1.2rem 1rem; }
        }
        @media (max-width: 600px) {
            .main-content { padding: 0.5rem 0.1rem; }
            .form-card { padding: 1.5rem 0.5rem; }
            .form-title { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="logo">Beneficiary Tracker</div>
            <nav class="nav">
                <a href="/" class="@if(request()->is('/')) active @endif">Home</a>
                <a href="{{ route('families.index') }}" class="@if(request()->is('families*')) active @endif">Families</a>
                <a href="{{ route('beneficiaries.index') }}" class="@if(request()->is('beneficiaries*')) active @endif">Beneficiaries</a>
                <a href="{{ route('associations.index') }}" class="@if(request()->is('associations*')) active @endif">Associations</a>
                <a href="{{ route('aid_records.index') }}" class="@if(request()->is('aid_records*')) active @endif">Aid Records</a>
                <a href="{{ route('priority.index') }}" class="@if(request()->is('priority')) active @endif">Priority List</a>
            </nav>
        </aside>
        <div style="flex:1;display:flex;flex-direction:column;min-width:0;">
            <div class="topbar"></div>
            <main class="main-content">
                @yield('content')
                <div class="footer">
                    &copy; {{ date('Y') }} Beneficiary Tracker. Powered by Laravel.
                </div>
            </main>
        </div>
    </div>
</body>
</html> 