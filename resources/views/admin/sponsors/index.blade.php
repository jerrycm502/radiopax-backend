@extends('layouts.admin')

@section('title', 'Administrar Patrocinadores')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-serif font-bold text-navyDeep">Patrocinadores y Alianzas</h1>
            <p class="text-slate-500 text-sm mt-0.5">Administra las marcas, negocios y patrocinadores oficiales que aparecen en la web del oyente.</p>
        </div>
        <a href="{{ route('admin.sponsors.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Nuevo Patrocinador</span>
        </a>
    </div>

    <!-- Sponsors Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if ($sponsors->isEmpty())
            <div class="p-12 text-center text-slate-500 space-y-3">
                <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full">
                    <i data-lucide="info" class="w-8 h-8"></i>
                </div>
                <p class="font-medium text-lg">No hay patrocinadores registrados</p>
                <p class="text-sm">Agrega un patrocinador presionando el botón "Nuevo Patrocinador" para mostrarlo en el pie de página de la web pública.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Logotipo</th>
                            <th class="px-6 py-4">Nombre</th>
                            <th class="px-6 py-4">Enlace Web</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($sponsors as $item)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    @if ($item->logo_url)
                                        <img src="{{ $item->logo_url }}" alt="{{ $item->name }}" class="h-10 w-24 object-contain rounded border border-slate-100 bg-slate-50 p-1">
                                    @else
                                        <div class="h-10 w-24 rounded border border-slate-200 border-dashed bg-slate-50 flex items-center justify-center text-slate-400 text-xxs font-bold">
                                            Sin Logo
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800">{{ $item->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    @if ($item->link_url)
                                        <a href="{{ $item->link_url }}" target="_blank" class="inline-flex items-center text-navyPetrol hover:underline">
                                            <span>Visitar enlace</span>
                                            <i data-lucide="external-link" class="w-3.5 h-3.5 ml-1"></i>
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-650 border border-slate-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1.5"></span> Pausado
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Edit button -->
                                        <a href="{{ route('admin.sponsors.edit', $item->id) }}" class="p-2 hover:bg-navyPetrol/10 text-slate-600 hover:text-navyPetrol rounded-lg transition duration-200" title="Editar">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('admin.sponsors.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este patrocinador?')">
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
                {{ $sponsors->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
