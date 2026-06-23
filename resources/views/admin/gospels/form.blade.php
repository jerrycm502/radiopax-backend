@extends('layouts.admin')

@section('title', $item->exists ? 'Editar Evangelio' : 'Nuevo Evangelio')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center space-x-3 border-b border-slate-200 pb-4">
        <a href="{{ route('admin.gospels.index') }}" class="p-2 hover:bg-slate-100 rounded-lg text-slate-500 hover:text-slate-700 transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-serif font-bold text-navyDeep">{{ $item->exists ? 'Editar Evangelio' : 'Crear Nuevo Evangelio' }}</h1>
            <p class="text-slate-500 text-sm mt-0.5">{{ $item->exists ? 'Modifica la lectura litúrgica del día.' : 'Agrega la lectura litúrgica para un día en particular en la aplicación móvil.' }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ $item->exists ? route('admin.gospels.update', $item->id) : route('admin.gospels.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Date -->
                <div>
                    <label for="date" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Fecha del Evangelio</label>
                    <input type="date" name="date" id="date" value="{{ old('date', $item->date ? $item->date->format('Y-m-d') : now()->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white">
                    @error('date')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Passage (Cita) -->
                <div>
                    <label for="passage" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Cita Bíblica</label>
                    <input type="text" name="passage" id="passage" value="{{ old('passage', $item->passage) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. Jn 3, 16-21">
                    @error('passage')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Título de Lectura</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $item->title ?? 'Lectura del Santo Evangelio') }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. Según San Mateo">
                    @error('title')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Texto del Evangelio</label>
                <textarea name="content" id="content" rows="8" required
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                    placeholder="Escribe aquí el pasaje bíblico completo de la lectura... (Se admiten varios párrafos)">{{ old('content', $item->content) }}</textarea>
                @error('content')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Reflection -->
            <div>
                <label for="reflection" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Reflexión Homilética / Espiritual (Opcional)</label>
                <textarea name="reflection" id="reflection" rows="6"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                    placeholder="Escribe una pequeña reflexión o explicación espiritual sobre el Evangelio de hoy para ayudar a comprender la lectura en el caminar diario del feligrés.">{{ old('reflection', $item->reflection) }}</textarea>
                @error('reflection')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.gospels.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-semibold transition">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white rounded-xl text-sm font-semibold shadow-md transition duration-200 flex items-center space-x-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>{{ $item->exists ? 'Actualizar Evangelio' : 'Guardar Evangelio' }}</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
