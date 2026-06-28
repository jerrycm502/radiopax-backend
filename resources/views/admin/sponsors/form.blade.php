@extends('layouts.admin')

@section('title', $item->exists ? 'Editar Patrocinador' : 'Nuevo Patrocinador')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center space-x-3 border-b border-slate-200 pb-4">
        <a href="{{ route('admin.sponsors.index') }}" class="p-2 hover:bg-slate-100 rounded-lg text-slate-500 hover:text-slate-700 transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-serif font-bold text-navyDeep">{{ $item->exists ? 'Editar Patrocinador' : 'Crear Nuevo Patrocinador' }}</h1>
            <p class="text-slate-500 text-sm mt-0.5">{{ $item->exists ? 'Modifica los datos del patrocinador existente.' : 'Registra un patrocinador para mostrar en el pie de página de la web pública.' }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ $item->exists ? route('admin.sponsors.update', $item->id) : route('admin.sponsors.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="sm:col-span-2">
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Nombre del Patrocinador / Marca</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. Distribuidora El Milagro">
                    @error('name')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Logo URL -->
                <div class="sm:col-span-2">
                    <label for="logo_url" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">URL del Logotipo / Banner Publicitario</label>
                    <input type="url" name="logo_url" id="logo_url" value="{{ old('logo_url', $item->logo_url) }}"
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. https://mi-web.com/imagenes/logos/el-milagro.png">
                    <span class="text-slate-450 text-[10px] mt-1 block">Inserta la dirección URL pública de la imagen del logotipo. Si es posible, utiliza imágenes con fondo transparente (PNG/WebP).</span>
                    @error('logo_url')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Link URL -->
                <div class="sm:col-span-2">
                    <label for="link_url" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Enlace de Redirección (Opcional)</label>
                    <input type="url" name="link_url" id="link_url" value="{{ old('link_url', $item->link_url) }}"
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none bg-slate-50 focus:bg-white"
                        placeholder="Ej. https://facebook.com/distribuidoraelmilagro">
                    <span class="text-slate-450 text-[10px] mt-1 block">Enlace al cual se redirigirá al oyente cuando haga clic en el logo del patrocinador.</span>
                    @error('link_url')
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Checkbox: Is Active -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4 text-navyDeep border-slate-300 rounded focus:ring-navyPetrol" 
                    {{ old('is_active', $item->exists ? $item->is_active : true) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 text-sm text-slate-600 font-semibold cursor-pointer">Patrocinador Activo (Mostrar en el sitio web)</label>
            </div>

            <!-- Action buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.sponsors.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-semibold transition">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 bg-navyDeep hover:bg-navyPetrol text-white rounded-xl text-sm font-semibold shadow-md transition duration-200 flex items-center space-x-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>{{ $item->exists ? 'Actualizar Patrocinador' : 'Guardar Patrocinador' }}</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
