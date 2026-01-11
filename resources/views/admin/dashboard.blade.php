{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-xl p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">👨‍💼 Panel de Administración</h1>
                    <p class="text-blue-100 text-lg">
                        ¡Hola {{ Auth::user()->name }}! - Cafetería UPDS
                    </p>
                    <p class="text-blue-100 mt-1">
                        📅 {{ now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                    </p>
                </div>
                <div class="text-8xl opacity-20">📊</div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Orders -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl text-orange-500 mr-4">📋</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Total Pedidos</h3>
                        <p class="text-3xl font-bold text-orange-600">{{ $stats['total_orders'] }}</p>
                        <p class="text-sm text-gray-500">Todos los tiempos</p>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl text-red-500 mr-4">⏳</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Pedidos Pendientes</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $stats['pending_orders'] }}</p>
                        <p class="text-sm text-gray-500">Requieren atención</p>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl text-green-500 mr-4">👥</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Estudiantes</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['total_users'] }}</p>
                        <p class="text-sm text-gray-500">Usuarios registrados</p>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl text-purple-500 mr-4">💰</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Ingresos</h3>
                        <p class="text-3xl font-bold text-purple-600">Bs. {{ number_format($stats['total_revenue'], 2) }}</p>
                        <p class="text-sm text-gray-500">Ventas confirmadas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('admin.users.index') }}" 
               class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 text-center">
                <div class="text-4xl mb-4">👥</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Gestionar Usuarios</h3>
                <p class="text-gray-600">Administrar estudiantes y personal</p>
            </a>

            <a href="{{ route('kitchen.dashboard') }}" 
               class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 text-center">
                <div class="text-4xl mb-4">👨‍🍳</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Dashboard Cocina</h3>
                <p class="text-gray-600">Ver estado de pedidos</p>
            </a>

            <a href="{{ route('menu.index') }}" 
               class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 text-center">
                <div class="text-4xl mb-4">🍽️</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Ver Menú</h3>
                <p class="text-gray-600">Gestionar productos</p>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                🕒 Pedidos Recientes
            </h3>
            
            @if($recent_orders->isEmpty())
                <div class="text-center py-8">
                    <div class="text-4xl mb-4">📝</div>
                    <p class="text-gray-500">No hay pedidos recientes</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Pedido</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Cliente</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Estado</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Total</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_orders as $order)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">
                                        <span class="font-medium">{{ $order->order_number }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $order->user->name }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                                                    ⏳ Pendiente
                                                </span>
                                                @break
                                            @case('confirmed')
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                    ✅ Confirmado
                                                </span>
                                                @break
                                            @case('preparing')
                                                <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs">
                                                    👨‍🍳 Preparando
                                                </span>
                                                @break
                                            @case('ready')
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                                    🎉 Listo
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-3 text-sm font-medium">{{ $order->formatted_total }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $order->created_at->locale('es')->isoFormat('D MMM, HH:mm') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Popular Items -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                🏆 Productos Más Populares
            </h3>
            
            @if($popular_items->isEmpty())
                <div class="text-center py-8">
                    <div class="text-4xl mb-4">🍽️</div>
                    <p class="text-gray-500">No hay datos de productos populares</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    @foreach($popular_items as $item)
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-2xl mb-2">🍽️</div>
                            <h4 class="font-medium text-gray-900 mb-1">{{ $item->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $item->order_items_count }} pedidos</p>
                            <p class="text-sm font-medium text-orange-600">{{ $item->formatted_price }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
