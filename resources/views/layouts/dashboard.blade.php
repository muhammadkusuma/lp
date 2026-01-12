<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Tahoma, Verdana, Arial, sans-serif;
            background-color: #e5eef5;
        }

        .win-border {
            border: 2px solid #1e3a8a;
            box-shadow: inset 1px 1px #ffffff, inset -1px -1px #6b7280;
        }

        .win-header {
            background: linear-gradient(to right, #0f766e, #0891b2);
        }

        .menu-item {
            padding: 6px 10px;
            font-size: 12px;
            white-space: nowrap;
            border-right: 1px solid #1e40af;
        }

        .menu-item:hover {
            background-color: #1e40af;
            color: #fff;
        }

        table {
            font-size: 12px;
        }

        th {
            background-color: #e5e7eb;
            border-bottom: 2px solid #9ca3af;
        }

        tr:hover {
            background-color: #bfdbfe;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="win-header text-white px-4 py-3 flex justify-between items-center">
        <div>
            <strong class="text-lg">PT SOFTWARE HOUSE</strong><br>
            <span class="text-xs opacity-90">Dashboard Operasional Perusahaan</span>
        </div>

        <div class="text-sm">
            User: <strong>{{ auth()->user()->name ?? 'Admin' }}</strong> |
            Role: {{ auth()->user()->role->name ?? 'Administrator' }}
        </div>
    </div>

    {{-- TOP NAVIGATION (SESUAI DATABASE & MODUL) --}}
    <div class="bg-blue-900 text-white flex flex-wrap win-border">

        {{-- CORE --}}
        <a href="{{ route('dashboard') }}" class="menu-item">Dashboard</a>

        {{-- COMPANY --}}
        <a href="{{ route('company.profile') }}" class="menu-item">Company</a>
        <a href="{{ route('company.legal') }}" class="menu-item">Legal</a>

        {{-- USER --}}
        <a href="{{ route('users.index') }}" class="menu-item">Users</a>
        <a href="{{ route('roles.index') }}" class="menu-item">Roles</a>

        {{-- SERVICE & PROJECT --}}
        <a href="{{ route('services.index') }}" class="menu-item">Services</a>
        <a href="{{ route('clients.index') }}" class="menu-item">Clients</a>
        <a href="{{ route('projects.index') }}" class="menu-item">Projects</a>

        {{-- FINANCE --}}
        <a href="{{ route('invoices.index') }}" class="menu-item">Invoices</a>
        <a href="{{ route('payments.index') }}" class="menu-item">Payments</a>
        <a href="{{ route('reports.finance') }}" class="menu-item">Reports</a>

        {{-- CONTENT --}}
        <a href="{{ route('posts.index') }}" class="menu-item">Blog</a>
        <a href="{{ route('categories.index') }}" class="menu-item">Categories</a>
        <a href="{{ route('portfolios.index') }}" class="menu-item">Portfolio</a>
        <a href="{{ route('testimonials.index') }}" class="menu-item">Testimonials</a>

        {{-- LEAD --}}
        <a href="{{ route('leads.index') }}" class="menu-item">Leads</a>
        <a href="{{ route('contacts.index') }}" class="menu-item">Contacts</a>

        {{-- SYSTEM --}}
        <a href="{{ route('settings.index') }}" class="menu-item">Settings</a>
        <a href="{{ route('logout') }}" class="menu-item text-red-300">Logout</a>
    </div>

    {{-- CONTENT --}}
    <div class="p-4">
        <div class="bg-white win-border p-3">
            @yield('content')
        </div>
    </div>

</body>

</html>
