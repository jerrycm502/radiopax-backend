@extends('layouts.admin')

@section('title', $item->exists ? 'Editar Aviso' : 'Nuevo Aviso')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center space-x-3 border-b border-slate-200 pb-4">
        <a href="{{ route('admin.news.index') }}" class="p-2 hover:bg-slate-100 rounded-lg text-slate-500 hover:text-slate-700 transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-serif font-bold text-navyDeep">{{ $item->exists ? 'Editar Aviso' : 'Crear Nuevo Aviso' }}</h1>
            <p class="text-slate-500 text-sm mt-0.5">{{ $item->exists ? 'Modifica los datos del comunicado existente.' : 'Agrega un comunicado oficial para mostrar en la aplicación móvil.' }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ $item->exists ? route('admin.news.update', $item->id) : route('admin.news.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Form parameters -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="sm:col-span-2">
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Título del Aviso</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. Campaña de Oración Permanente">
                    @error('title')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Categoría</label>
                    <select name="category" id="category" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white">
                        <option value="Parroquial" {{ old('category', $item->category) === 'Parroquial' ? 'selected' : '' }}>Parroquial</option>
                        <option value="Radio" {{ old('category', $item->category) === 'Radio' ? 'selected' : '' }}>Radio</option>
                        <option value="Comunidad" {{ old('category', $item->category) === 'Comunidad' ? 'selected' : '' }}>Comunidad</option>
                    </select>
                    @error('category')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Published At Date -->
                <div>
                    <label for="published_at" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Fecha y Hora de Publicación</label>
                    <input type="datetime-local" name="published_at" id="published_at" 
                        value="{{ old('published_at', $item->published_at ? $item->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white">
                    @error('published_at')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image URL -->
                <div class="sm:col-span-2">
                    <label for="image_url" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">URL de Imagen Ilustrativa (Opcional)</label>
                    <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $item->image_url) }}"
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. https://miservidor.com/imagenes/evento.jpg">
                    <span class="text-slate-400 text-[10px] mt-1 block">Deja en blanco para usar la carátula predeterminada en la aplicación móvil.</span>
                    @error('image_url')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Content Details -->
            <div>
                <label for="content" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Detalles / Contenido del Aviso</label>
                <textarea name="content" id="content" rows="6" required
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                    placeholder="Escribe aquí los detalles completos del comunicado... (Se admiten varios párrafos)">{{ old('content', $item->content) }}</textarea>
                @error('content')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Checkbox: Is Important / Destacado -->
            <div class="flex items-center">
                <input type="checkbox" name="is_important" id="is_important" value="1" class="w-4 h-4 text-navyDeep border-slate-300 rounded focus:ring-navyPetrol" 
                    {{ old('is_important', $item->is_important) ? 'checked' : '' }}>
                <label for="is_important" class="ml-2 text-sm text-slate-600 font-semibold cursor-pointer">Destacar aviso (Mostrar con color especial e icono de estrella en la App)</label>
            </div>

            <!-- Action buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-semibold transition">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white rounded-xl text-sm font-semibold shadow-md transition duration-200 flex items-center space-x-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>{{ $item->exists ? 'Actualizar Aviso' : 'Publicar Aviso' }}</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
