<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Radio Pax Backend</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navyDeep: '#0C1D2A',
                        navyPetrol: '#173E5B',
                        accentGold: '#D5B47B',
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background-color: #F8FAFC;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800">

    <!-- Navigation Header -->
    <header class="bg-navyDeep text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand/Logo -->
                <div class="flex items-center space-x-3">
                    <div class="p-1.5 bg-accentGold/10 rounded-full border border-accentGold/30">
                        <i data-lucide="radio" class="w-5 h-5 text-accentGold animate-pulse"></i>
                    </div>
                    <div>
                        <span class="font-serif font-bold text-lg tracking-wide">Radio Pax 91.9 FM</span>
                        <span class="block text-[10px] text-accentGold tracking-widest uppercase font-semibold">Panel de Control</span>
                    </div>
                </div>

                <!-- Navigation Links (Desktop) -->
                @auth
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-1.5 text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'text-accentGold' : 'text-white/80 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Cabina</span>
                    </a>
                    @can('manage-news')
                    <a href="{{ route('admin.news.index') }}" class="flex items-center space-x-1.5 text-sm font-medium transition {{ request()->routeIs('admin.news.*') ? 'text-accentGold' : 'text-white/80 hover:text-white' }}">
                        <i data-lucide="megaphone" class="w-4 h-4"></i>
                        <span>Avisos</span>
                    </a>
                    @endcan
                    @can('manage-gospels')
                    <a href="{{ route('admin.gospels.index') }}" class="flex items-center space-x-1.5 text-sm font-medium transition {{ request()->routeIs('admin.gospels.*') ? 'text-accentGold' : 'text-white/80 hover:text-white' }}">
                        <i data-lucide="book-open" class="w-4 h-4"></i>
                        <span>Evangelio</span>
                    </a>
                    @endcan
                    @can('manage-all')
                    <a href="{{ route('admin.schedules.index') }}" class="flex items-center space-x-1.5 text-sm font-medium transition {{ request()->routeIs('admin.schedules.*') ? 'text-accentGold' : 'text-white/80 hover:text-white' }}">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Programación</span>
                    </a>
                    <a href="{{ route('admin.sponsors.index') }}" class="flex items-center space-x-1.5 text-sm font-medium transition {{ request()->routeIs('admin.sponsors.*') ? 'text-accentGold' : 'text-white/80 hover:text-white' }}">
                        <i data-lucide="handshake" class="w-4 h-4"></i>
                        <span>Patrocinadores</span>
                    </a>
                    @endcan
                    @can('manage-users')
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-1.5 text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'text-accentGold' : 'text-white/80 hover:text-white' }}">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Usuarios</span>
                    </a>
                    @endcan
                </nav>
                @endauth

                <!-- User Info & Logout (Desktop) -->
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="hidden sm:block text-right">
                            <span class="block text-xs text-white/60">Sesión iniciada</span>
                            <span class="block text-sm font-medium text-white/90">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 bg-white/10 hover:bg-red-500/20 text-white/80 hover:text-red-400 rounded-lg transition duration-200" title="Cerrar Sesión">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                            </button>
                        </form>
                    @else
                        <span class="text-xs text-white/60">No autenticado</span>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Subbar -->
        @auth
        <div class="md:hidden bg-navyPetrol border-t border-navyDeep/40">
            <div class="max-w-7xl mx-auto px-4 flex justify-around py-3">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center text-[10px] font-medium transition {{ request()->routeIs('admin.dashboard') ? 'text-accentGold' : 'text-white/70 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mb-0.5"></i>
                    <span>Cabina</span>
                </a>
                @can('manage-news')
                <a href="{{ route('admin.news.index') }}" class="flex flex-col items-center text-[10px] font-medium transition {{ request()->routeIs('admin.news.*') ? 'text-accentGold' : 'text-white/70 hover:text-white' }}">
                    <i data-lucide="megaphone" class="w-5 h-5 mb-0.5"></i>
                    <span>Avisos</span>
                </a>
                @endcan
                @can('manage-gospels')
                <a href="{{ route('admin.gospels.index') }}" class="flex flex-col items-center text-[10px] font-medium transition {{ request()->routeIs('admin.gospels.*') ? 'text-accentGold' : 'text-white/70 hover:text-white' }}">
                    <i data-lucide="book-open" class="w-5 h-5 mb-0.5"></i>
                    <span>Evangelio</span>
                </a>
                @endcan
                @can('manage-all')
                <a href="{{ route('admin.schedules.index') }}" class="flex flex-col items-center text-[10px] font-medium transition {{ request()->routeIs('admin.schedules.*') ? 'text-accentGold' : 'text-white/70 hover:text-white' }}">
                    <i data-lucide="calendar" class="w-5 h-5 mb-0.5"></i>
                    <span>Horarios</span>
                </a>
                <a href="{{ route('admin.sponsors.index') }}" class="flex flex-col items-center text-[10px] font-medium transition {{ request()->routeIs('admin.sponsors.*') ? 'text-accentGold' : 'text-white/70 hover:text-white' }}">
                    <i data-lucide="handshake" class="w-5 h-5 mb-0.5"></i>
                    <span>Patrocinadores</span>
                </a>
                @endcan
                @can('manage-users')
                <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center text-[10px] font-medium transition {{ request()->routeIs('admin.users.*') ? 'text-accentGold' : 'text-white/70 hover:text-white' }}">
                    <i data-lucide="users" class="w-5 h-5 mb-0.5"></i>
                    <span>Usuarios</span>
                </a>
                @endcan
            </div>
        </div>
        @endauth
    </header>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Alerts and Flash Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center space-x-3 shadow-sm animate-fade-in">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl flex items-center space-x-3 shadow-sm animate-fade-in">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-500"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')

    </main>

    <!-- Footer -->
    <footer class="mt-auto py-8 text-center text-xs text-slate-400 border-t border-slate-200 bg-white">
        <p>&copy; 2026 Radio Pax 91.9 FM. Todos los derechos reservados.</p>
        <p class="mt-1">Desarrollado por Jerry Cordero</p>
    </footer>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
