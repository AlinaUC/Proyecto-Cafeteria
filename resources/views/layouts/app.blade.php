{{-- resources/views/layouts/app.blade.php - ACTUALIZADO con roles --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>☕ Cafetería UPDS - @yield('title', 'Tu cafetería universitaria')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-orange-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-gradient-to-r from-orange-600 to-red-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('menu.index') }}" class="text-white font-bold text-xl">
                                ☕ Cafetería UPDS
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('menu.index') }}" 
                               class="text-white hover:text-orange-200 px-3 py-2 text-sm font-medium transition duration-150">
                                🍽️ Menú
                            </a>
                            
                            @auth
                                @if(Auth::user()->isStudent())
                                    <a href="{{ route('orders.index') }}" 
                                       class="text-white hover:text-orange-200 px-3 py-2 text-sm font-medium transition duration-150">
                                        📋 Mis Pedidos
                                    </a>
                                    <a href="{{ route('dashboard') }}" 
                                       class="text-white hover:text-orange-200 px-3 py-2 text-sm font-medium transition duration-150">
                                        🏠 Mi Dashboard
                                    </a>
                                @endif

                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="text-white hover:text-orange-200 px-3 py-2 text-sm font-medium transition duration-150">
                                        👨‍💼 Admin Panel
                                    </a>
                                    <a href="{{ route('admin.users.index') }}" 
                                       class="text-white hover:text-orange-200 px-3 py-2 text-sm font-medium transition duration-150">
                                        👥 Usuarios
                                    </a>
                                @endif

                                @if(Auth::user()->isKitchen() || Auth::user()->isAdmin())
                                    <a href="{{ route('kitchen.dashboard') }}" 
                                       class="text-white hover:text-orange-200 px-3 py-2 text-sm font-medium transition duration-150">
                                        👨‍🍳 Cocina
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @auth
                            <!-- Cart Icon - Solo para estudiantes -->
                            @if(Auth::user()->isStudent())
                                @php
                                    $cartCount = session('cart') ? array_sum(session('cart')) : 0;
                                @endphp
                                @if($cartCount > 0)
                                    <a href="{{ route('orders.create') }}" 
                                       class="relative text-white hover:text-orange-200 mr-4 transition duration-150">
                                        🛒 <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                                    </a>
                                @endif
                            @endif

                            <!-- User Info and Role -->
                            <div class="ml-3 relative">
                                <div class="flex items-center space-x-4">
                                    <div class="text-right">
                                        <div class="text-white text-sm font-medium">
                                            {{ Auth::user()->getDisplayName() }}
                                        </div>
                                        <div class="text-orange-200 text-xs">
                                            {{ Auth::user()->getMainRole()->display_name ?? 'Usuario' }}
                                        </div>
                                    </div>
                                    
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" 
                                             class="h-8 w-8 rounded-full border-2 border-orange-200">
                                    @else
                                        <div class="h-8 w-8 bg-orange-200 rounded-full flex items-center justify-center">
                                            <span class="text-orange-800 text-sm font-bold">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    
                                    <!-- Logout Button -->
                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-white hover:text-orange-200 text-sm transition duration-150">
                                            🚪 Salir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Guest Links -->
                            <div class="flex space-x-4">
                                <a href="{{ route('login') }}" class="text-white hover:text-orange-200 px-3 py-2 text-sm font-medium transition duration-150">
                                    🔑 Iniciar Sesión
                                </a>
                                <a href="{{ route('register') }}" class="bg-white text-orange-600 hover:bg-orange-100 px-4 py-2 rounded-md text-sm font-medium transition duration-150">
                                    📝 Registrarse
                                </a>
                            </div>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="sm:hidden flex items-center">
                        <button type="button" class="text-white hover:text-orange-200 focus:outline-none focus:text-orange-200" 
                                onclick="toggleMobileMenu()">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden sm:hidden bg-orange-700">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('menu.index') }}" 
                       class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium">
                        🍽️ Menú
                    </a>
                    
                    @auth
                        @if(Auth::user()->isStudent())
                            <a href="{{ route('orders.index') }}" 
                               class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium">
                                📋 Mis Pedidos
                            </a>
                            <a href="{{ route('dashboard') }}" 
                               class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium">
                                🏠 Dashboard
                            </a>
                        @endif

                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium">
                                👨‍💼 Admin Panel
                            </a>
                        @endif

                        @if(Auth::user()->isKitchen())
                            <a href="{{ route('kitchen.dashboard') }}" 
                               class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium">
                                👨‍🍳 Cocina
                            </a>
                        @endif

                        <!-- User info in mobile -->
                        <div class="border-t border-orange-500 pt-4 pb-3">
                            <div class="px-3">
                                <div class="text-white text-base font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-orange-200 text-sm">{{ Auth::user()->getMainRole()->display_name ?? 'Usuario' }}</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                                @csrf
                                <button type="submit" class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium w-full text-left">
                                    🚪 Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium">
                            🔑 Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" 
                           class="text-white hover:text-orange-200 block px-3 py-2 text-base font-medium">
                            📝 Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Role-based Status Bar -->
        @auth
            @if(Auth::user()->isAdmin())
                <div class="bg-blue-600 text-white text-center py-2 text-sm">
                    👨‍💼 Modo Administrador - Acceso completo al sistema
                </div>
            @elseif(Auth::user()->isKitchen())
                <div class="bg-orange-600 text-white text-center py-2 text-sm">
                    👨‍🍳 Dashboard de Cocina - Gestión de pedidos activa
                </div>
            @endif
        @endauth

        <!-- Page Content -->
        <main>
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mx-4 mt-4">
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-lg font-semibold">☕ Cafetería UPDS</p>
                    <p class="text-gray-400 mt-2">Universidad Privada Domingo Savio - La Paz, Bolivia 🇧🇴</p>
                    <p class="text-gray-400 mt-1">Horario: Lunes a Viernes 7:00 - 18:00</p>
                    <p class="text-gray-400 mt-2">📧 cafeteria@upds.edu.bo | 📞 2-2500000</p>
                    
                    <!-- Team Credits -->
                    <div class="mt-4 text-sm text-gray-500">
                        <p class="font-medium">Equipo de Desarrollo - Metodología SCRUM:</p>
                        <p>🎯 Scrum Master: Luciana Zapana | 👩‍💻 Frontend: Camila Quispe</p>
                        <p>⚙️ Backend: Josué Escobar & Leonardo | </p>
                        <p class="mt-2">
                            Hecho con ❤️ por estudiantes de Ingeniería de Sistemas - Sprint {{ date('W') }}/2024
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript for mobile menu -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Auto-hide flash messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100, .bg-yellow-100');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);

        // Update last login timestamp
        @auth
            fetch('/api/update-last-login', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            });
        @endauth
    </script>
</body>
</html>