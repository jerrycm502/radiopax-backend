@extends('layouts.admin')

@section('title', 'Administrar Programación')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-serif font-bold text-navyDeep">Programas y Horarios</h1>
            <p class="text-slate-500 text-sm mt-0.5">Controla la parrilla de programación automática semanal que se muestra en la aplicación.</p>
        </div>
        <a href="{{ route('admin.schedules.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Nuevo Programa</span>
        </a>
    </div>

    <!-- Schedules Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if ($schedules->isEmpty())
            <div class="p-12 text-center text-slate-500 space-y-3">
                <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full">
                    <i data-lucide="calendar" class="w-8 h-8"></i>
                </div>
                <p class="font-medium text-lg">No hay programas configurados</p>
                <p class="text-sm">Agrega el primer programa de la parrilla radial presionando el botón "Nuevo Programa".</p>
            </div>
        @else
            @php
                $daysMap = [
                    1 => 'Lunes',
                    2 => 'Martes',
                    3 => 'Miércoles',
                    4 => 'Jueves',
                    5 => 'Viernes',
                    6 => 'Sábado',
                    7 => 'Domingo',
                ];
            @endphp
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Programa / Locutor</th>
                            <th class="px-6 py-4">Horario</th>
                            <th class="px-6 py-4">Días de Transmisión</th>
                            <th class="px-6 py-4">Descripción</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($schedules as $item)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800">{{ $item->name }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">Con: {{ $item->host }}</div>
                                </td>
                                <td class="px-6 py-4 font-medium text-navyPetrol">
                                    <span class="inline-flex items-center space-x-1.5">
                                        <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                                        <span>{{ $item->start_time }} - {{ $item->end_time }}</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($item->days_of_week as $day)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200/50">
                                                {{ substr($daysMap[$day] ?? '', 0, 3) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500 max-w-xs">
                                    <span class="line-clamp-1" title="{{ $item->description }}">{{ $item->description ?: '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Edit button -->
                                        <a href="{{ route('admin.schedules.edit', $item->id) }}" class="p-2 hover:bg-navyPetrol/10 text-slate-600 hover:text-navyPetrol rounded-lg transition duration-200" title="Editar">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('admin.schedules.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este programa?')">
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
        @endif
    </div>

</div>
@endsection
