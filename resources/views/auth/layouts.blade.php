<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Event Trail Run')</title>
    <style>
        :root {
            --bg: #f4f7f3;
            --panel: #ffffff;
            --panel-soft: #edf7ee;
            --primary: #166534;
            --primary-deep: #0f3d21;
            --primary-soft: #dcfce7;
            --text: #1f2937;
            --muted: #6b7280;
            --line: #dfe7df;
            --warning: #b91c1c;
            --shadow: 0 18px 40px rgba(15, 61, 33, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(34, 197, 94, 0.12), transparent 24%),
                linear-gradient(180deg, #f8faf8 0%, var(--bg) 100%);
        }

        a { color: inherit; }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(15, 61, 33, 0.94);
            backdrop-filter: blur(12px);
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .topbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #86efac, #22c55e);
            color: var(--primary-deep);
            display: grid;
            place-items: center;
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(34, 197, 94, 0.3);
        }

        .brand {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 999px;
            transition: 0.2s ease;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.9);
        }

        .user-pill {
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .logout-button,
        .primary-button,
        .secondary-button,
        .ghost-button,
        .danger-button {
            border: none;
            border-radius: 10px;
            padding: 11px 18px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-button,
        .primary-button,
        .secondary-button {
            background: linear-gradient(135deg, var(--primary), #22c55e);
            color: white;
            box-shadow: 0 12px 20px rgba(22, 101, 52, 0.18);
        }

        .ghost-button {
            background: white;
            color: var(--primary-deep);
            border: 1px solid var(--line);
        }

        .danger-button {
            background: #ef4444;
            color: white;
        }

        .primary-button:hover,
        .secondary-button:hover,
        .ghost-button:hover,
        .danger-button:hover,
        .logout-button:hover {
            transform: translateY(-1px);
        }

        .page-shell {
            max-width: 1200px;
            margin: 28px auto 48px;
            padding: 0 24px;
        }

        .message,
        .flash-message {
            margin-bottom: 20px;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid rgba(22, 101, 52, 0.12);
            background: var(--primary-soft);
            color: var(--primary-deep);
            font-weight: 600;
        }

        .card,
        .panel,
        .form-panel {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .card {
            max-width: 520px;
            margin: 32px auto;
            padding: 32px 28px;
        }

        .card h1,
        .page-header h1,
        .section-title h2 {
            margin: 0 0 10px;
            color: var(--primary-deep);
        }

        .card p,
        .page-header p,
        .section-note {
            color: var(--muted);
            line-height: 1.6;
        }

        .auth-form,
        .event-form {
            margin-top: 24px;
        }

        .field-group {
            margin-bottom: 18px;
        }

        .field-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: var(--text);
        }

        .field-group input,
        .field-group select,
        .field-group textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 0.96rem;
            background: #fff;
            color: var(--text);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field-group input:focus,
        .field-group select:focus,
        .field-group textarea:focus {
            outline: none;
            border-color: rgba(22, 101, 52, 0.7);
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.12);
        }

        .error {
            margin-top: 6px;
            color: var(--warning);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .auth-meta {
            margin-top: 18px;
            text-align: center;
            color: var(--muted);
            font-size: 0.96rem;
        }

        .auth-meta a,
        .inline-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
            padding: 6px 4px;
        }

        .eyebrow {
            margin: 0 0 8px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
            font-size: 0.72rem;
            color: var(--primary);
        }

        .header-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: linear-gradient(180deg, #ffffff 0%, #f2faf5 100%);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 18px 16px;
            box-shadow: 0 10px 20px rgba(15, 61, 33, 0.06);
        }

        .stat-label {
            color: var(--muted);
            font-size: 0.8rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value {
            font-size: clamp(1.5rem, 2vw, 2rem);
            font-weight: 800;
            color: var(--primary-deep);
        }

        .panel {
            padding: 22px;
        }

        .toolbar {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1.5fr auto auto;
            gap: 12px;
            align-items: end;
            width: 100%;
        }

        .filter-form .field-group {
            margin-bottom: 0;
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f8faf8;
            color: var(--primary-deep);
            font-size: 0.8rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        tbody tr:hover {
            background: #f8fbf9;
        }

        .table-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .mini-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 9px;
            text-decoration: none;
            border: 1px solid transparent;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .mini-button.edit {
            background: #ecfdf5;
            color: var(--primary);
            border-color: rgba(22, 101, 52, 0.15);
        }

        .mini-button.delete {
            background: #fef2f2;
            color: #b91c1c;
            border-color: rgba(185, 28, 28, 0.12);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            min-height: 36px;
            padding: 0 10px;
            border-radius: 9px;
            text-decoration: none;
            border: 1px solid var(--line);
            color: var(--text);
            background: white;
        }

        .pagination .active {
            background: var(--primary-soft);
            border-color: rgba(22, 101, 52, 0.2);
            color: var(--primary-deep);
            font-weight: 700;
        }

        .search-panel {
            max-width: 860px;
            margin: 0 auto;
        }

        .search-form {
            display: flex;
            gap: 12px;
            align-items: end;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .search-form .field-group {
            flex: 1 1 280px;
            margin-bottom: 0;
        }

        .empty-state {
            text-align: center;
            color: var(--muted);
            padding: 18px;
        }

        @media (max-width: 840px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .page-header {
                display: block;
            }

            .header-actions {
                margin-top: 18px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .topbar-inner {
                flex-wrap: wrap;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 22px 18px;
            }
        }
    </style>
</head>
<body>
    <nav class="topbar">
        <div class="topbar-inner">
            <div class="brand-wrap">
                <div class="brand-mark">TR</div>
                <a href="{{ route('home') }}" class="brand">Trail Run</a>
            </div>

            <div class="nav-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('event.index') }}" class="nav-link">Data Event</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                @endguest
            </div>

            @auth
                <div class="user-menu">
                    <span class="user-pill">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="page-shell">
        @if (session('status'))
            <div class="message">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
