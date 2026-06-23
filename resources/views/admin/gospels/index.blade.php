@extends('layouts.admin')

@section('title', 'Administrar Evangelio del Día')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-serif font-bold text-navyDeep">Evangelios Diarios</h1>
            <p class="text-slate-500 text-sm mt-0.5">Sube las lecturas del Evangelio y sus correspondientes reflexiones espirituales.</p>
        </div>
        <a href="{{ route('admin.gospels.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Nuevo Evangelio</span>
        </a>
    </div>

    <!-- Gospels Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if ($gospels->isEmpty())
            <div class="p-12 text-center text-slate-500 space-y-3">
                <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full">
                    <i data-lucide="book-open" class="w-8 h-8"></i>
                </div>
                <p class="font-medium text-lg">No hay lecturas registradas</p>
                <p class="text-sm">Agrega tu primer Evangelio diario para alimentar espiritualmente a los oyentes de Radio Pax.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4">Cita Bíblica</th>
                            <th class="px-6 py-4">Título</th>
                            <th class="px-6 py-4">Reflexión</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($gospels as $item)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 font-semibold text-navyDeep">
                                    {{ $item->date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-amber-50 text-amber-800 border border-amber-100 font-semibold rounded text-xs">
                                        {{ $item->passage }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-800 font-medium">
                                    {{ $item->title }}
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    @if ($item->reflection)
                                        <span class="line-clamp-1 max-w-xs">{{ $item->reflection }}</span>
                                    @else
                                        <span class="italic text-slate-400">Sin reflexión</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Edit button -->
                                        <a href="{{ route('admin.gospels.edit', $item->id) }}" class="p-2 hover:bg-navyPetrol/10 text-slate-600 hover:text-navyPetrol rounded-lg transition duration-200" title="Editar">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('admin.gospels.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este Evangelio?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 hover:bg-rose-500/10 text-slate-600 hover:text-rose-600 rounded-lg transition duration-200" title="Eliminar">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination footer -->
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $gospels->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
