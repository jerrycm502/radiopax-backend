@extends('layouts.admin')

@section('title', 'Consola de Cabina')

@section('content')
<div class="space-y-8 animate-fade-in">
    
    <!-- Hero / Welcome Header -->
    <div class="bg-gradient-to-r from-navyDeep to-navyPetrol text-white rounded-2xl p-6 sm:p-8 shadow-lg border border-navyDeep flex flex-col md:flex-row items-start md:items-center justify-between space-y-4 md:space-y-0">
        <div>
            <h1 class="text-3xl font-serif font-bold">Consola de Cabina</h1>
            <p class="text-white/70 text-sm mt-1">Controla la emisión en vivo, los avisos parroquiales y la lectura litúrgica diaria de Radio Pax.</p>
        </div>
        <div class="px-4 py-2 bg-white/10 border border-white/20 rounded-xl flex items-center space-x-2 text-sm font-medium">
            <span class="w-2.5 h-2.5 rounded-full {{ $cabin->mode === 'manual' ? 'bg-amber-400 animate-pulse' : 'bg-emerald-400 animate-pulse' }}"></span>
            <span>Estado: {{ $cabin->mode === 'manual' ? 'Modo Cabina (Manual)' : 'Transmisión Automática' }}</span>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat card 1: News -->
        <a href="{{ route('admin.news.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between group">
            <div class="space-y-1">
                <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Avisos y Noticias</span>
                <span class="block text-3xl font-bold text-navyDeep">{{ $newsCount }}</span>
            </div>
            <div class="p-4 bg-navyDeep/5 text-navyDeep rounded-xl group-hover:bg-accentGold/10 group-hover:text-accentGold transition duration-200">
                <i data-lucide="megaphone" class="w-6 h-6"></i>
            </div>
        </a>

        <!-- Stat card 2: Gospel -->
        <a href="{{ route('admin.gospels.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between group">
            <div class="space-y-1">
                <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Lecturas del Evangelio</span>
                <span class="block text-3xl font-bold text-navyDeep">{{ $gospelCount }}</span>
            </div>
            <div class="p-4 bg-navyDeep/5 text-navyDeep rounded-xl group-hover:bg-accentGold/10 group-hover:text-accentGold transition duration-200">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>
        </a>

        <!-- Stat card 3: Weekly Schedule -->
        <a href="{{ route('admin.schedules.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between group">
            <div class="space-y-1">
                <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Programas Semanales</span>
                <span class="block text-3xl font-bold text-navyDeep">{{ $scheduleCount }}</span>
            </div>
            <div class="p-4 bg-navyDeep/5 text-navyDeep rounded-xl group-hover:bg-accentGold/10 group-hover:text-accentGold transition duration-200">
                <i data-lucide="calendar" class="w-6 h-6"></i>
            </div>
        </a>

        <!-- Stat card 4: Sponsors -->
        <a href="{{ route('admin.sponsors.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between group">
            <div class="space-y-1">
                <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Patrocinadores</span>
                <span class="block text-3xl font-bold text-navyDeep">{{ $sponsorCount }}</span>
            </div>
            <div class="p-4 bg-navyDeep/5 text-navyDeep rounded-xl group-hover:bg-accentGold/10 group-hover:text-accentGold transition duration-200">
                <i data-lucide="handshake" class="w-6 h-6"></i>
            </div>
        </a>
    </div>

    <!-- Cabin Controller & Live Stream Controls -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Interactive Controls (Left / 2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center space-x-2 border-b border-slate-100 pb-4">
                <i data-lucide="sliders-horizontal" class="w-5 h-5 text-navyDeep"></i>
                <h2 class="text-xl font-serif font-bold text-navyDeep">Control de Transmisión</h2>
            </div>

            <form action="{{ route('admin.cabin.update') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Mode Selection -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Modo de Operación</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Auto Option -->
                        <label class="relative flex p-4 rounded-xl border cursor-pointer select-none focus:outline-none transition {{ $cabin->mode === 'auto' ? 'border-navyPetrol bg-navyPetrol/5 text-navyDeep font-semibold' : 'border-slate-200 hover:bg-slate-50' }}">
                            <input type="radio" name="mode" value="auto" class="sr-only" {{ $cabin->mode === 'auto' ? 'checked' : '' }} onchange="toggleCabinInputs(false)">
                            <div class="flex items-start space-x-3">
                                <div class="mt-1 flex items-center justify-center w-4 h-4 rounded-full border border-slate-300 {{ $cabin->mode === 'auto' ? 'border-navyPetrol bg-navyPetrol' : '' }}">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white {{ $cabin->mode === 'auto' ? 'block' : 'hidden' }}"></div>
                                </div>
                                <div>
                                    <span class="block text-sm">Transmisión Automática</span>
                                    <span class="block text-xs text-slate-500 font-normal mt-0.5">Calcula el programa según los horarios configurados.</span>
                                </div>
                            </div>
                        </label>

                        <!-- Manual Option -->
                        <label class="relative flex p-4 rounded-xl border cursor-pointer select-none focus:outline-none transition {{ $cabin->mode === 'manual' ? 'border-navyPetrol bg-navyPetrol/5 text-navyDeep font-semibold' : 'border-slate-200 hover:bg-slate-50' }}">
                            <input type="radio" name="mode" value="manual" class="sr-only" {{ $cabin->mode === 'manual' ? 'checked' : '' }} onchange="toggleCabinInputs(true)">
                            <div class="flex items-start space-x-3">
                                <div class="mt-1 flex items-center justify-center w-4 h-4 rounded-full border border-slate-300 {{ $cabin->mode === 'manual' ? 'border-navyPetrol bg-navyPetrol' : '' }}">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white {{ $cabin->mode === 'manual' ? 'block' : 'hidden' }}"></div>
                                </div>
                                <div>
                                    <span class="block text-sm">Modo Cabina (Manual)</span>
                                    <span class="block text-xs text-slate-500 font-normal mt-0.5">Sobrescribe los horarios con los datos ingresados abajo.</span>
                                </div>
                            </div>
                        </label>

                    </div>
                </div>

                <!-- Manual Fields Group -->
                <div id="manual-fields-container" class="space-y-4 p-5 bg-slate-50 rounded-xl border border-slate-100 transition duration-300">
                    <h3 class="text-sm font-semibold text-slate-600 mb-2 flex items-center space-x-1.5">
                        <i data-lucide="radio-receiver" class="w-4 h-4 text-slate-500"></i>
                        <span>Datos de Cabina en Vivo</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Current Program -->
                        <div>
                            <label for="current_program" class="block text-xs font-semibold text-slate-500 mb-1.5">Nombre del Programa</label>
                            <input type="text" name="current_program" id="current_program" value="{{ old('current_program', $cabin->current_program) }}"
                                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none"
                                placeholder="Ej. Rosario de Alabanza">
                        </div>

                        <!-- Current Host -->
                        <div>
                            <label for="current_host" class="block text-xs font-semibold text-slate-500 mb-1.5">Locutor en Cabina</label>
                            <input type="text" name="current_host" id="current_host" value="{{ old('current_host', $cabin->current_host) }}"
                                class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none"
                                placeholder="Ej. P. Alejandro">
                        </div>
                    </div>

                    <!-- Streaming Toggle -->
                    <div class="flex items-center mt-2">
                        <input type="checkbox" name="is_streaming" id="is_streaming" value="1" class="w-4 h-4 text-navyDeep border-slate-300 rounded focus:ring-navyPetrol" {{ $cabin->is_streaming ? 'checked' : '' }}>
                        <label for="is_streaming" class="ml-2 text-sm text-slate-600 font-medium cursor-pointer">El locutor está hablando al aire (Señal Activa)</label>
                    </div>
                </div>

                <!-- Banner Ticker Message -->
                <div>
                    <label for="banner_message" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1.5">Cinta de Mensaje Dinámico (Ticker de Inicio)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <i data-lucide="info" class="w-4 h-4"></i>
                        </span>
                        <input type="text" name="banner_message" id="banner_message" value="{{ old('banner_message', $cabin->banner_message) }}"
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-1 focus:ring-navyPetrol focus:outline-none"
                            placeholder="Ej. Sintoniza hoy a las 6 PM el Rosario con nuestro Obispo">
                    </div>
                    <span class="text-slate-400 text-[10px] mt-1 block">Este mensaje aparecerá deslizándose o destacado en la cabecera principal de la aplicación móvil.</span>
                </div>

                <!-- Action Button -->
                <div class="flex justify-end pt-4 border-t border-slate-100">
                    <button type="submit" class="px-6 py-3 bg-navyDeep hover:bg-navyPetrol text-white rounded-xl text-sm font-semibold tracking-wide shadow-md transition duration-200 flex items-center space-x-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Guardar Configuración</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- System Information (Right Sidebar) -->
        <div class="space-y-6">
            
            <!-- Quick Info Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                <div class="flex items-center space-x-2 border-b border-slate-100 pb-3">
                    <i data-lucide="circle-help" class="w-4 h-4 text-navyDeep"></i>
                    <h3 class="font-serif font-bold text-navyDeep">¿Cómo funciona?</h3>
                </div>
                <div class="space-y-3 text-xs leading-relaxed text-slate-600">
                    <p>
                        <strong class="text-navyDeep">Modo Automático:</strong> El sistema calculará en tiempo real qué programa se transmite de acuerdo con los horarios agregados en la pestaña <a href="{{ route('admin.schedules.index') }}" class="underline text-navyPetrol font-semibold">Programación</a>. Si no coincide ninguna hora, pondrá "Programación Musical Ininterrumpida".
                    </p>
                    <p>
                        <strong class="text-navyDeep">Modo Cabina (Manual):</strong> Sirve cuando hay transmisiones extraordinarias, invitados sorpresa, eventos de recaudación o emergencias. Al activarse, ignora todo horario automático y proyecta lo que se escriba en los campos.
                    </p>
                    <p>
                        <strong class="text-navyDeep">Señal Activa:</strong> Indica en la pantalla del reproductor móvil que hay una persona activa al aire, encendiendo un indicador visual llamativo.
                    </p>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="bg-navyDeep text-white rounded-2xl shadow-md p-6 space-y-4 relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 opacity-5">
                    <i data-lucide="radio" class="w-32 h-32"></i>
                </div>
                <h4 class="text-xs uppercase tracking-widest text-accentGold font-semibold">Simulador de Pantalla Móvil</h4>
                <div class="border border-white/10 rounded-xl p-4 bg-white/5 space-y-3">
                    <div class="flex items-center space-x-2 text-[10px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
                        <span class="text-white/60 tracking-wider">EN VIVO</span>
                    </div>
                    <div class="space-y-1">
                        <span id="preview-program-name" class="block font-serif font-bold text-sm">Cargando...</span>
                        <span id="preview-host-name" class="block text-xs text-accentGold">Con: Locutor de turno</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Interactive Client-side Script -->
<script>
    function toggleCabinInputs(isManual) {
        const container = document.getElementById('manual-fields-container');
        const cards = document.querySelectorAll('input[name="mode"]');
        
        // Visual updates to form labels
        cards.forEach(card => {
            const parent = card.closest('label');
            if (card.checked) {
                parent.classList.add('border-navyPetrol', 'bg-navyPetrol/5', 'font-semibold');
                parent.classList.remove('border-slate-200');
            } else {
                parent.classList.remove('border-navyPetrol', 'bg-navyPetrol/5', 'font-semibold');
                parent.classList.add('border-slate-200');
            }
        });

        if (isManual) {
            container.classList.remove('opacity-50', 'pointer-events-none');
        } else {
            container.classList.add('opacity-50', 'pointer-events-none');
        }
        updatePreview();
    }

    function updatePreview() {
        const isManual = document.querySelector('input[name="mode"]:checked').value === 'manual';
        const progInput = document.getElementById('current_program').value;
        const hostInput = document.getElementById('current_host').value;

        const pName = document.getElementById('preview-program-name');
        const pHost = document.getElementById('preview-host-name');

        if (isManual) {
            pName.textContent = progInput || 'Transmisión Especial';
            pHost.textContent = 'Con: ' + (hostInput || 'Locutor de turno');
        } else {
            pName.textContent = '[Programa según Horario]';
            pHost.textContent = 'Con: [Locutor automático]';
        }
    }

    // Set initial state
    document.addEventListener('DOMContentLoaded', () => {
        const mode = document.querySelector('input[name="mode"]:checked').value;
        toggleCabinInputs(mode === 'manual');
        
        // Listeners for inputs to update preview dynamically
        document.getElementById('current_program').addEventListener('input', updatePreview);
        document.getElementById('current_host').addEventListener('input', updatePreview);
        updatePreview();
    });
</script>
@endsection
