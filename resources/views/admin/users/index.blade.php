@extends('layouts.admin')

@section('title', 'Administrar Usuarios')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-serif font-bold text-navyDeep">Usuarios y Permisos</h1>
            <p class="text-slate-500 text-sm mt-0.5">Gestiona las cuentas de acceso al panel administrativo y asigna sus roles correspondientes.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Nuevo Usuario</span>
        </a>
    </div>

    <!-- Users Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if ($users->isEmpty())
            <div class="p-12 text-center text-slate-500 space-y-3">
                <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full">
                    <i data-lucide="info" class="w-8 h-8"></i>
                </div>
                <p class="font-medium text-lg">No hay usuarios registrados</p>
                <p class="text-sm">Agrega usuarios presionando el botón "Nuevo Usuario".</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Nombre</th>
                            <th class="px-6 py-4">Correo Electrónico</th>
                            <th class="px-6 py-4">Rol / Permiso</th>
                            <th class="px-6 py-4">Fecha de Registro</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($users as $item)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800 flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-navyDeep/10 text-navyDeep flex items-center justify-center font-bold text-xs uppercase">
                                            {{ substr($item->name, 0, 2) }}
                                        </div>
                                        <span>{{ $item->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-650 font-medium">
                                    {{ $item->email }}
                                </td>
                                <td class="px-6 py-4">
                                     @if ($item->role === 'admin')
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                                             <i data-lucide="shield" class="w-3.5 h-3.5 mr-1 text-rose-500"></i> Administrador
                                         </span>
                                     @elseif ($item->role === 'locutor')
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                             <i data-lucide="radio" class="w-3.5 h-3.5 mr-1 text-amber-500"></i> Cabina de Radio
                                         </span>
                                     @elseif ($item->role === 'evangelizador_avisos')
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                             <i data-lucide="layers" class="w-3.5 h-3.5 mr-1 text-indigo-500"></i> Evangelio y Avisos
                                         </span>
                                     @elseif ($item->role === 'avisos')
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-100">
                                             <i data-lucide="megaphone" class="w-3.5 h-3.5 mr-1 text-purple-500"></i> Avisos y Noticias
                                         </span>
                                     @elseif ($item->role === 'evangelizador')
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                             <i data-lucide="book-open" class="w-3.5 h-3.5 mr-1 text-emerald-500"></i> Evangelizador
                                         </span>
                                     @else
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-50 text-slate-700 border border-slate-100">
                                             {{ $item->role }}
                                         </span>
                                     @endif
                                </td>
                                <td class="px-6 py-4 text-slate-450 text-xs">
                                    {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Edit button -->
                                        <a href="{{ route('admin.users.edit', $item->id) }}" class="p-2 hover:bg-navyPetrol/10 text-slate-600 hover:text-navyPetrol rounded-lg transition duration-200" title="Editar">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        @if (auth()->id() !== $item->id)
                                            <!-- Delete button -->
                                            <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 hover:bg-rose-500/10 text-slate-600 hover:text-rose-600 rounded-lg transition duration-200" title="Eliminar">
                                                    <i data-lucide="user-minus" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="p-2 text-slate-300 cursor-not-allowed" title="No puedes eliminarte a ti mismo">
                                                <i data-lucide="lock" class="w-4 h-4"></i>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination footer -->
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
