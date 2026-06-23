@extends('layouts.admin')

@section('title', 'Administrar Avisos')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-serif font-bold text-navyDeep">Avisos y Noticias</h1>
            <p class="text-slate-500 text-sm mt-0.5">Publica y edita comunicados de la parroquia, eventos diocesanos y noticias radiales.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Nuevo Aviso</span>
        </a>
    </div>

    <!-- News Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if ($news->isEmpty())
            <div class="p-12 text-center text-slate-500 space-y-3">
                <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full">
                    <i data-lucide="info" class="w-8 h-8"></i>
                </div>
                <p class="font-medium text-lg">No hay avisos registrados</p>
                <p class="text-sm">Comienza agregando un aviso parroquial o radial presionando el botón "Nuevo Aviso".</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Título</th>
                            <th class="px-6 py-4">Categoría</th>
                            <th class="px-6 py-4">Destacado</th>
                            <th class="px-6 py-4">Fecha Publicación</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($news as $item)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800 line-clamp-1">{{ $item->title }}</div>
                                    <div class="text-xs text-slate-400 line-clamp-1 mt-0.5">{{ $item->content }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $item->category === 'Parroquial' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : '' }}
                                        {{ $item->category === 'Radio' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                        {{ $item->category === 'Comunidad' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : '' }}">
                                        {{ $item->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->is_important)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                                            <i data-lucide="star" class="w-3 h-3 mr-1 fill-rose-500 text-rose-500"></i> Importante
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $item->published_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Edit button -->
                                        <a href="{{ route('admin.news.edit', $item->id) }}" class="p-2 hover:bg-navyPetrol/10 text-slate-600 hover:text-navyPetrol rounded-lg transition duration-200" title="Editar">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este aviso?')">
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
                {{ $news->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
