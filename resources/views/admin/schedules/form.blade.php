@extends('layouts.admin')

@section('title', $item->exists ? 'Editar Programa' : 'Nuevo Programa')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center space-x-3 border-b border-slate-200 pb-4">
        <a href="{{ route('admin.schedules.index') }}" class="p-2 hover:bg-slate-100 rounded-lg text-slate-500 hover:text-slate-700 transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-serif font-bold text-navyDeep">{{ $item->exists ? 'Editar Programa' : 'Nuevo Programa Radial' }}</h1>
            <p class="text-slate-500 text-sm mt-0.5">{{ $item->exists ? 'Modifica los parámetros de este horario semanal.' : 'Agrega un programa regular a la parrilla semanal de Radio Pax.' }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ $item->exists ? route('admin.schedules.update', $item->id) : route('admin.schedules.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Program Name -->
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Nombre del Programa</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. El Santo Rosario">
                    @error('name')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Host -->
                <div>
                    <label for="host" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Locutor / Encargado</label>
                    <input type="text" name="host" id="host" value="{{ old('host', $item->host) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. Comunidad Parroquial o P. Juan">
                    @error('host')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Hora de Inicio</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $item->start_time) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white">
                    @error('start_time')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Hora de Fin</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $item->end_time) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white">
                    @error('end_time')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Days of Week checkboxes -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Días de Transmisión Semanal</label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    @php
                        $days = [
                            1 => 'Lunes',
                            2 => 'Martes',
                            3 => 'Miércoles',
                            4 => 'Jueves',
                            5 => 'Viernes',
                            6 => 'Sábado',
                            7 => 'Domingo',
                        ];
                        $selectedDays = old('days_of_week', $item->days_of_week ?? []);
                    @endphp
                    @foreach ($days as $value => $name)
                        <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer select-none">
                            <input type="checkbox" name="days_of_week[]" value="{{ $value }}" 
                                class="w-4 h-4 text-navyDeep border-slate-300 rounded focus:ring-navyPetrol"
                                {{ in_array($value, $selectedDays) ? 'checked' : '' }}>
                            <span>{{ $name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('days_of_week')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Descripción del Programa (Opcional)</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                    placeholder="Breve resumen o sinopsis del programa... (Ej. Espacio para orar el rosario en comunidad...)">{{ old('description', $item->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image URL -->
            <div>
                <label for="image_url" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">URL de Imagen o Logo del Programa (Opcional)</label>
                <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $item->image_url) }}"
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                    placeholder="Ej. https://miservidor.com/imagenes/programa.jpg">
                @error('image_url')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.schedules.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-semibold transition">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white rounded-xl text-sm font-semibold shadow-md transition duration-200 flex items-center space-x-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>{{ $item->exists ? 'Actualizar Horario' : 'Guardar Horario' }}</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
