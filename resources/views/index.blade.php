<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <title>Radio Pax 91.9 FM | Anunciando la alegría del Evangelio</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="Radio Pax 91.9 FM - Emisora oficial de la Diócesis de Zacapa, Guatemala. Llevando la palabra de Dios, reflexiones del Evangelio y música que eleva tu espíritu las 24 horas del día."/>
    <meta name="keywords" content="Radio Pax, Radio Catolica, Diócesis de Zacapa, Zacapa, Evangelio del Dia, Iglesia Catolica, Radio en vivo, Guatemala"/>
    <meta name="author" content="Diócesis de Zacapa"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/radiopax-icon.png') }}"/>

    <!-- Tailwind CSS (via CDN matching admin panel) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        slate: {
                            850: '#151f32',
                            950: '#020617',
                        }
                    },
                    fontSize: {
                        'xxs': '0.65rem',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js (for reactive UI components) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom inline styles for visuals/animations -->
    <style>
        /* Visualizer animation keyframes */
        @keyframes bounce-1 {
            0%, 100% { height: 15%; }
            50% { height: 75%; }
        }
        @keyframes bounce-2 {
            0%, 100% { height: 25%; }
            50% { height: 100%; }
        }
        @keyframes bounce-3 {
            0%, 100% { height: 20%; }
            50% { height: 85%; }
        }
        @keyframes bounce-4 {
            0%, 100% { height: 10%; }
            50% { height: 60%; }
        }

        .animate-vis-1 { animation: bounce-1 0.7s ease-in-out infinite; }
        .animate-vis-2 { animation: bounce-2 0.85s ease-in-out infinite; }
        .animate-vis-3 { animation: bounce-3 0.6s ease-in-out infinite; }
        .animate-vis-4 { animation: bounce-4 0.75s ease-in-out infinite; }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #020617; /* bg-slate-950 */
        }
        ::-webkit-scrollbar-thumb {
            background: #1e293b; /* bg-slate-800 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #d97706; /* bg-amber-600 */
        }

        /* Sponsors infinite loop scroll animation */
        @keyframes infinite-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-infinite-scroll {
            display: flex;
            width: max-content;
            animation: infinite-scroll 55s linear infinite;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased selection:bg-amber-500 selection:text-slate-950" 
      x-data="playerState()">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 w-full border-b border-slate-900 bg-slate-950/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/radiopax-logo.png') }}" alt="Radio Pax Logo" class="h-12 w-auto object-contain">
                <div class="hidden sm:block">
                    <span class="text-lg font-black tracking-wider uppercase bg-gradient-to-r from-amber-400 to-yellow-200 bg-clip-text text-transparent">Radio Pax</span>
                    <span class="block text-xxs font-semibold uppercase text-slate-500 tracking-widest mt-px">Diócesis de Zacapa</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="#inicio" class="text-slate-300 hover:text-amber-500 transition-colors">Inicio</a>
                <a href="#evangelio" class="text-slate-300 hover:text-amber-500 transition-colors">Evangelio de Hoy</a>
                <a href="#programacion" class="text-slate-300 hover:text-amber-500 transition-colors">Programación</a>
                <a href="#noticias" class="text-slate-300 hover:text-amber-500 transition-colors">Noticias</a>
                <a href="#contacto" class="text-slate-300 hover:text-amber-500 transition-colors">Contacto</a>
            </nav>

            <!-- Admin Access Link Hidden -->
        </div>
    </header>

    <!-- Main Hero / Live Section -->
    <section id="inicio" class="relative overflow-hidden pt-8 pb-16 lg:py-24 border-b border-slate-900 bg-gradient-to-b from-slate-950 via-slate-950 to-slate-900">
        <!-- Background Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Message -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase tracking-widest">
                        91.9 FM • En Vivo en Internet
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-100 tracking-tight leading-none">
                        Anunciando la alegría del <br>
                        <span class="bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-300 bg-clip-text text-transparent">Evangelio</span>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Sintoniza nuestra transmisión en vivo y acompáñanos en oración, alabanza y reflexión. Radio Pax te acompaña las 24 horas del día con contenido que reconforta tu alma e ilumina tu camino.
                    </p>
                    
                    <div class="pt-4 flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="#evangelio" class="bg-slate-900 hover:bg-slate-855 border border-slate-800 text-slate-200 px-6 py-3 rounded-full text-sm font-bold shadow-md hover:border-slate-700 transition-all duration-200">
                            Evangelio de Hoy
                        </a>
                        <a href="#programacion" class="bg-slate-900/40 hover:bg-slate-900 border border-slate-800/80 text-slate-300 px-6 py-3 rounded-full text-sm font-bold hover:border-slate-700 transition-all duration-200">
                            Programación
                        </a>
                    </div>
                </div>

                <!-- Interactive Streaming Audio Player -->
                <div class="lg:col-span-5 w-full">
                    <div class="max-w-md mx-auto lg:ml-auto bg-slate-900/40 backdrop-blur-md border border-slate-800/80 rounded-3xl p-6 md:p-8 flex flex-col gap-6 shadow-2xl relative overflow-hidden">
                        <!-- Background Glow Elements -->
                        <div class="absolute -right-24 -bottom-24 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="absolute -left-24 -top-24 w-48 h-48 bg-red-500/10 rounded-full blur-3xl pointer-events-none"></div>

                        <!-- Audio Stream Element -->
                        <audio id="audio-stream" src="https://stream.zeno.fm/sdeifnlmzbuvv" preload="none"></audio>

                        <div class="flex items-center gap-5">
                            <!-- Logo Wrapper with Visualizer Overlay -->
                            <div class="relative w-20 h-20 rounded-2xl bg-slate-950 overflow-hidden border border-slate-850 shrink-0 shadow-lg group">
                                <img src="{{ asset('assets/images/radiopax-icon.png') }}" alt="Radio Pax Icon" class="w-full h-full object-cover transition-transform duration-500" :class="playing ? 'scale-105' : ''">
                                <div class="absolute inset-0 bg-slate-950/50 flex items-center justify-center transition-opacity duration-300" :class="playing ? 'opacity-100' : 'opacity-0 group-hover:opacity-100'">
                                    <div class="flex items-end gap-0.5 h-6">
                                        <div class="w-1 bg-amber-500 rounded-t-sm" :class="playing ? 'animate-vis-1' : 'h-1'"></div>
                                        <div class="w-1 bg-amber-500 rounded-t-sm" :class="playing ? 'animate-vis-2' : 'h-2'"></div>
                                        <div class="w-1 bg-amber-500 rounded-t-sm" :class="playing ? 'animate-vis-3' : 'h-3.5'"></div>
                                        <div class="w-1 bg-amber-500 rounded-t-sm" :class="playing ? 'animate-vis-4' : 'h-1.5'"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xxs font-bold uppercase tracking-wider" 
                                          :class="liveStatus.isLive ? 'bg-red-500/15 text-red-400 border border-red-500/20' : 'bg-slate-800 text-slate-400 border border-slate-700'">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1 animate-ping" x-show="liveStatus.isLive"></span>
                                        <span x-text="liveStatus.isLive ? 'En Vivo' : 'Diferido'">En Vivo</span>
                                    </span>
                                    <span class="text-xxs font-semibold text-slate-500 uppercase tracking-wider">91.9 FM</span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-100 truncate" x-text="liveStatus.name || 'Programación Musical'">Cargando...</h3>
                                <p class="text-xs text-slate-400 truncate mt-0.5" x-text="liveStatus.host ? 'Con: ' + liveStatus.host : 'Radio Pax FM'"></p>
                            </div>
                        </div>

                        <!-- Banner Message Info (if set in cabin status) -->
                        <div class="text-xxs text-amber-500 font-medium bg-amber-500/5 px-3 py-1.5 rounded-xl border border-amber-500/10 flex items-center gap-2" x-show="liveStatus.bannerMessage">
                            <svg class="w-3.5 h-3.5 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                            <span class="truncate" x-text="liveStatus.bannerMessage"></span>
                        </div>

                        <!-- Player Controls -->
                        <div class="flex items-center justify-between border-t border-slate-800/80 pt-5">
                            <!-- Play button -->
                            <button @click="togglePlay" class="w-14 h-14 rounded-full bg-gradient-to-r from-amber-500 to-yellow-400 hover:from-amber-600 hover:to-yellow-500 text-slate-950 flex items-center justify-center shadow-lg shadow-amber-500/10 active:scale-95 transition-all duration-150 shrink-0 cursor-pointer">
                                <svg class="w-6 h-6 ml-0.5 text-slate-950" x-show="!playing" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                <svg class="w-6 h-6 text-slate-950" x-show="playing" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                </svg>
                            </button>

                            <!-- Volume slider -->
                            <div class="flex items-center gap-2 text-slate-400 shrink-0 w-32 sm:w-36">
                                <button @click="toggleMute" class="hover:text-slate-200 transition-colors shrink-0">
                                    <!-- High volume -->
                                    <svg class="w-5 h-5" x-show="volume > 0.5 && !muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                    </svg>
                                    <!-- Low volume -->
                                    <svg class="w-5 h-5" x-show="volume <= 0.5 && volume > 0 && !muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                    </svg>
                                    <!-- Muted -->
                                    <svg class="w-5 h-5 text-red-500/80" x-show="volume == 0 || muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15zm10.707-9.293a1 1 0 010 1.414L13.414 10l2.879 2.879a1 1 0 11-1.414 1.414L12 11.414l-2.879 2.879a1 1 0 01-1.414-1.414L10.586 10 7.707 7.121a1 1 0 111.414-1.414L12 8.586l2.879-2.879a1 1 0 011.414 0z" />
                                    </svg>
                                </button>
                                <input type="range" min="0" max="1" step="0.05" x-model.number="volume" @input="updateVolume" class="w-full h-1 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-amber-500">
                            </div>
                        </div>

                        <!-- Next Program Info -->
                        <div class="border-t border-slate-800/80 pt-4 flex flex-col" x-show="liveStatus.nextProgram">
                            <span class="text-xxs font-bold text-slate-500 uppercase tracking-wider">Próximo Programa</span>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-xs font-semibold text-slate-300 truncate max-w-[70%]" x-text="liveStatus.nextProgram?.name"></span>
                                <span class="text-xxs font-bold text-amber-500 shrink-0" x-text="liveStatus.nextProgram ? 'Inicia: ' + formatTime(liveStatus.nextProgram.startTime) : ''"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Daily Gospel Section -->
    <section id="evangelio" class="py-16 md:py-24 border-b border-slate-900 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-100">Evangelio del Día</h2>
                <div class="w-12 h-1 bg-amber-500 mx-auto mt-3 rounded-full"></div>
                <p class="text-sm text-slate-400 mt-3 leading-relaxed">
                    Dedica un momento de tu día a leer y meditar las sagradas escrituras. Acompaña la lectura con la reflexión pastoral de hoy.
                </p>
            </div>

            @if($gospel)
                <div class="max-w-3xl mx-auto bg-slate-900/30 border border-slate-850 rounded-3xl p-6 md:p-10 shadow-xl relative">
                    <div class="absolute -right-8 -top-8 w-24 h-24 bg-amber-500/5 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-850 pb-5 mb-6 gap-3">
                        <div>
                            <span class="text-xxs font-bold text-amber-500 uppercase tracking-widest">Lectura del Santo Evangelio</span>
                            <h3 class="text-xl md:text-2xl font-black text-slate-100 mt-1">{{ $gospel->title }}</h3>
                        </div>
                        <div class="shrink-0 self-start sm:self-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                {{ \Carbon\Carbon::parse($gospel->date)->translatedFormat('d \d\e F, Y') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="bg-amber-500/5 border-l-4 border-amber-500 p-4 mb-6 rounded-r-xl">
                        <p class="text-xxs font-bold text-amber-500 uppercase tracking-wider">Pasaje Bíblico</p>
                        <p class="text-slate-200 font-serif italic text-lg mt-0.5">{{ $gospel->passage }}</p>
                    </div>

                    <!-- Gospel Content -->
                    <div class="font-serif text-lg leading-relaxed text-slate-300 space-y-4 prose prose-invert max-w-none">
                        {!! nl2br(e($gospel->content)) !!}
                    </div>

                    @if($gospel->reflection)
                        <div class="mt-8 border-t border-slate-850 pt-6">
                            <h4 class="text-sm font-bold text-amber-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Reflexión Pastoral
                            </h4>
                            <div class="text-slate-350 italic bg-slate-950/50 p-5 rounded-2xl border border-slate-900 leading-relaxed font-serif">
                                {!! nl2br(e($gospel->reflection)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-12 text-slate-500 max-w-sm mx-auto">
                    <svg class="mx-auto h-12 w-12 text-slate-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-md font-medium">No se ha registrado el Evangelio de hoy.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Weekly Schedule Section -->
    <section id="programacion" class="py-16 md:py-24 border-b border-slate-900 bg-gradient-to-b from-slate-950 to-slate-900" 
             x-data="{ activeTabDay: {{ \Carbon\Carbon::now()->dayOfWeekIso }} }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-100">Programación Semanal</h2>
                <div class="w-12 h-1 bg-amber-500 mx-auto mt-3 rounded-full"></div>
                <p class="text-sm text-slate-400 mt-3 leading-relaxed">
                    Explora nuestra variada oferta radial organizada por día de la semana. No te pierdas tus programas preferidos de evangelización y música.
                </p>
            </div>

            <!-- Days of Week Selector Tabs -->
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

            <div class="flex justify-start md:justify-center overflow-x-auto pb-4 mb-8 -mx-4 px-4 sm:mx-0 sm:px-0">
                <div class="flex gap-2 p-1 bg-slate-900/80 backdrop-blur border border-slate-800 rounded-full shrink-0">
                    @foreach($daysMap as $dayNum => $dayName)
                        <button @click="activeTabDay = {{ $dayNum }}" 
                                class="px-4 py-2 text-xs md:text-sm font-bold rounded-full transition-all duration-200 cursor-pointer whitespace-nowrap"
                                :class="activeTabDay == {{ $dayNum }} ? 'bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-950 shadow-md' : 'text-slate-400 hover:text-slate-200'">
                            {{ $dayName }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Tab Content (Programs per day) -->
            @foreach($daysMap as $dayNum => $dayName)
                <div x-show="activeTabDay == {{ $dayNum }}" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="space-y-4">
                    @php
                        $daySchedules = $schedules->filter(function($item) use ($dayNum) {
                            return is_array($item->days_of_week) && in_array($dayNum, $item->days_of_week);
                        })->sortBy('start_time');
                    @endphp
                    
                    @if($daySchedules->isEmpty())
                        <div class="text-center py-12 text-slate-500 bg-slate-900/10 border border-dashed border-slate-850 rounded-2xl max-w-md mx-auto">
                            <svg class="mx-auto h-12 w-12 text-slate-650 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="font-medium">Música católica y reflexiones breves sin interrupción.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
                            @foreach($daySchedules as $program)
                                <div class="bg-slate-900/40 border border-slate-850 hover:border-amber-500/30 rounded-2xl p-5 flex gap-4 hover:shadow-lg hover:shadow-amber-500/2 transition-all duration-300">
                                    @if($program->image_url)
                                        <img src="{{ $program->image_url }}" alt="{{ $program->name }}" class="w-16 h-16 md:w-20 md:h-20 rounded-xl object-cover shrink-0 border border-slate-800">
                                    @else
                                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-500 flex items-center justify-center shrink-0">
                                            <svg class="w-8 h-8 md:w-10 md:h-10 text-amber-500/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="min-w-0 flex-1">
                                        <span class="inline-flex items-center text-xxs font-bold text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded border border-amber-500/15 uppercase tracking-wide">
                                            {{ \Carbon\Carbon::parse($program->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($program->end_time)->format('h:i A') }}
                                        </span>
                                        <h4 class="font-extrabold text-slate-100 text-base md:text-lg mt-1.5 truncate">{{ $program->name }}</h4>
                                        <p class="text-xs md:text-sm text-slate-400 mt-0.5 truncate">Con: <span class="text-slate-300 font-semibold">{{ $program->host }}</span></p>
                                        @if($program->description)
                                            <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">{{ $program->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <!-- News & Blog Publications Section -->
    <section id="noticias" class="py-16 md:py-24 border-b border-slate-900 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-100">Noticias y Novedades</h2>
                <div class="w-12 h-1 bg-amber-500 mx-auto mt-3 rounded-full"></div>
                <p class="text-sm text-slate-400 mt-3 leading-relaxed">
                    Mantente informado de las últimas noticias, anuncios parroquiales y eventos importantes organizados por nuestra comunidad diocesana.
                </p>
            </div>

            @if($news->isEmpty())
                <div class="text-center py-12 text-slate-500">
                    <svg class="mx-auto h-12 w-12 text-slate-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2m2 2a2 2 0 03-2 2m2-2V9m-4 12H9m3 0h3m-3 0a1 1 0 010-2h3a1 1 0 010 2zm-3 0a1 1 0 010-2m3 0a1 1 0 000-2m-3 0a1 1 0 000 2m-3 0a1 1 0 000-2m-3 0a1 1 0 000 2" />
                    </svg>
                    <p class="font-medium">No se han publicado noticias recientes.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($news as $item)
                        <div class="bg-slate-900/30 border border-slate-850 hover:border-amber-500/30 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-amber-500/2 transition-all duration-300 flex flex-col group">
                            <!-- News Image -->
                            @if($item->image_url)
                                <div class="h-48 overflow-hidden relative shrink-0">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @if($item->is_important)
                                        <span class="absolute top-3 left-3 bg-red-600 text-white font-black text-xxs uppercase tracking-wider px-2 py-0.5 rounded shadow-md animate-pulse">
                                            Importante
                                        </span>
                                    @endif
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-slate-900 to-slate-950 flex items-center justify-center shrink-0 border-b border-slate-850 relative">
                                    <svg class="w-12 h-12 text-slate-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2m2 2a2 2 0 03-2 2m2-2V9m-4 12H9m3 0h3m-3 0a1 1 0 010-2h3a1 1 0 010 2zm-3 0a1 1 0 010-2m3 0a1 1 0 000-2m-3 0a1 1 0 000 2m-3 0a1 1 0 000-2m-3 0a1 1 0 000 2" />
                                    </svg>
                                    @if($item->is_important)
                                        <span class="absolute top-3 left-3 bg-red-600 text-white font-black text-xxs uppercase tracking-wider px-2 py-0.5 rounded shadow-md">
                                            Importante
                                        </span>
                                    @endif
                                </div>
                            @endif
                            
                            <!-- News Content Card -->
                            <div class="p-5 flex flex-col flex-grow">
                                <div class="flex items-center gap-2.5 mb-2">
                                    <span class="px-2.5 py-0.5 rounded text-xxs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase tracking-wide">
                                        {{ $item->category }}
                                    </span>
                                    <span class="text-xxs text-slate-500 font-semibold uppercase">
                                        {{ $item->published_at->translatedFormat('d \d\e F, Y') }}
                                    </span>
                                </div>
                                
                                <h4 class="font-extrabold text-base md:text-lg text-slate-200 line-clamp-2 group-hover:text-amber-500 transition-colors cursor-pointer" 
                                    @click="openModalNews({{ json_encode([
                                        'title' => $item->title,
                                        'content' => nl2br(e($item->content)),
                                        'image_url' => $item->image_url,
                                        'category' => $item->category,
                                        'date' => $item->published_at->translatedFormat('d \d\e F, Y'),
                                    ]) }})">
                                    {{ $item->title }}
                                </h4>
                                
                                <p class="text-xs md:text-sm text-slate-400 mt-2 line-clamp-3 flex-grow leading-relaxed">
                                    {{ strip_tags($item->content) }}
                                </p>
                                
                                <button class="mt-4 text-xxs font-bold text-amber-500 uppercase tracking-widest flex items-center gap-1 hover:text-amber-400 transition-colors self-start cursor-pointer"
                                    @click="openModalNews({{ json_encode([
                                        'title' => $item->title,
                                        'content' => nl2br(e($item->content)),
                                        'image_url' => $item->image_url,
                                        'category' => $item->category,
                                        'date' => $item->published_at->translatedFormat('d \d\e F, Y'),
                                    ]) }})">
                                    Leer más
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- News Details Dialog Modal -->
    <div x-show="openModal" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-250"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-sm" @click="closeModalNews"></div>
        
        <div class="flex items-center justify-center min-h-screen p-4 md:p-6 relative z-10">
            <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden max-w-2xl w-full shadow-2xl relative"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="scale-95 translate-y-4"
                 x-transition:enter-end="scale-100 translate-y-0">
                
                <!-- Close Button -->
                <button @click="closeModalNews" class="absolute top-4 right-4 z-20 bg-slate-950/60 hover:bg-slate-950 text-slate-400 hover:text-slate-100 w-8 h-8 rounded-full flex items-center justify-center border border-slate-800/80 transition-colors cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Modal image preview -->
                <div class="h-64 relative shrink-0" x-show="activeNews.image_url">
                    <img :src="activeNews.image_url" alt="" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                </div>
                
                <div class="p-6 md:p-8 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded text-xxs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase tracking-wide" x-text="activeNews.category"></span>
                        <span class="text-xxs text-slate-500 font-semibold uppercase" x-text="activeNews.date"></span>
                    </div>

                    <h3 class="text-2xl font-black text-slate-100 tracking-tight" x-text="activeNews.title"></h3>
                    
                    <div class="text-sm md:text-base text-slate-300 leading-relaxed space-y-4 overflow-y-auto max-h-[250px] pr-2 scrollbar-style" x-html="activeNews.content"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- App Downloads Promotion Banner -->
    <section class="py-16 md:py-24 border-b border-slate-900 bg-gradient-to-b from-slate-900 to-slate-950 relative overflow-hidden">
        <div class="absolute -right-32 -top-32 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-slate-900/30 border border-slate-850 rounded-3xl p-6 md:p-12 lg:p-16 flex flex-col-reverse lg:flex-row items-center gap-10 lg:gap-16">
                <!-- Promo copy -->
                <div class="flex-1 space-y-6 text-center lg:text-left">
                    <span class="text-xxs font-bold text-amber-500 uppercase tracking-widest">Nuestra Aplicación Oficial</span>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-100 tracking-tight leading-none">
                        Lleva a Radio Pax <br class="hidden sm:inline">
                        <span class="bg-gradient-to-r from-amber-400 to-yellow-200 bg-clip-text text-transparent">siempre contigo</span>
                    </h3>
                    <p class="text-sm md:text-base text-slate-450 leading-relaxed max-w-md mx-auto lg:mx-0">
                        Descarga nuestra aplicación móvil oficial y escucha la transmisión en vivo, consulta el Evangelio de hoy y lee las últimas noticias de forma rápida y sencilla desde tu smartphone.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start pt-2">
                        <!-- Play store app download -->
                        <a href="https://play.google.com/store/apps/details?id=com.radiopax.gt" target="_blank" class="hover:scale-103 transition-transform duration-200 shrink-0">
                            <img src="{{ asset('assets/images/app_btn1.png') }}" alt="Descárgala en Google Play" class="h-11 w-auto">
                        </a>
                        <!-- App store app download -->
                        <a href="#" target="_blank" class="hover:scale-103 transition-transform duration-200 shrink-0">
                            <img src="{{ asset('assets/images/app_btn2.png') }}" alt="Consíguela en el App Store" class="h-11 w-auto">
                        </a>
                    </div>
                </div>

                <!-- Promo Device Preview Mockup -->
                <div class="w-full lg:w-1/3 max-w-[280px] shrink-0">
                    <img src="{{ asset('assets/images/iphone-radio.png') }}" alt="Aplicación Radio Pax en iPhone" class="w-full h-auto drop-shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsors Section -->
    <section class="py-16 bg-slate-950 border-b border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-10">
                <h3 class="text-xs font-bold text-amber-500 uppercase tracking-widest">Nuestros Patrocinadores</h3>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-100 mt-2">Apoyo que Hace Posible la Misión</h2>
                <div class="w-10 h-0.5 bg-amber-500 mx-auto mt-3 rounded-full"></div>
            </div>

            @if($sponsors->isEmpty())
                <p class="text-center text-slate-500 text-sm">Espacio disponible para patrocinadores oficiales. Contáctanos para anunciar tu marca.</p>
            @else
                <!-- Gradient edge-fade mask layout -->
                <div class="relative w-full overflow-hidden [mask-image:linear-gradient(to_right,transparent,white_15%,white_85%,transparent)] py-4">
                    <!-- Scrolling track, pauses on hover -->
                    <div class="animate-infinite-scroll hover:[animation-play-state:paused] flex items-center gap-20 md:gap-32">
                        
                        <!-- First instance of sponsors -->
                        @foreach($sponsors as $sponsor)
                            <div class="shrink-0 max-w-[340px] md:max-w-[420px]">
                                @if($sponsor->link_url)
                                    <a href="{{ $sponsor->link_url }}" target="_blank" class="block group relative" title="{{ $sponsor->name }}">
                                        @if($sponsor->logo_url)
                                            <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-32 md:h-44 w-auto object-contain opacity-90 hover:opacity-100 transition-all duration-300 transform group-hover:scale-105 group-hover:-translate-y-1 filter hover:drop-shadow-[0_0_20px_rgba(217,119,6,0.2)]">
                                        @else
                                            <span class="text-xs font-bold text-slate-500 group-hover:text-amber-500 transition-colors uppercase tracking-wider block text-center py-4 px-8 border border-slate-900 rounded-2xl bg-slate-900/40 transform group-hover:scale-105 group-hover:-translate-y-0.5">{{ $sponsor->name }}</span>
                                        @endif
                                    </a>
                                @else
                                    <div class="relative group" title="{{ $sponsor->name }}">
                                        @if($sponsor->logo_url)
                                            <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-32 md:h-44 w-auto object-contain opacity-95 transition-all duration-350">
                                        @else
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block text-center py-4 px-8 border border-slate-900 rounded-2xl bg-slate-900/40">{{ $sponsor->name }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <!-- Second duplicated instance of sponsors for seamless infinite looping -->
                        @foreach($sponsors as $sponsor)
                            <div class="shrink-0 max-w-[340px] md:max-w-[420px]">
                                @if($sponsor->link_url)
                                    <a href="{{ $sponsor->link_url }}" target="_blank" class="block group relative" title="{{ $sponsor->name }}">
                                        @if($sponsor->logo_url)
                                            <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-32 md:h-44 w-auto object-contain opacity-90 hover:opacity-100 transition-all duration-300 transform group-hover:scale-105 group-hover:-translate-y-1 filter hover:drop-shadow-[0_0_20px_rgba(217,119,6,0.2)]">
                                        @else
                                            <span class="text-xs font-bold text-slate-500 group-hover:text-amber-500 transition-colors uppercase tracking-wider block text-center py-4 px-8 border border-slate-900 rounded-2xl bg-slate-900/40 transform group-hover:scale-105 group-hover:-translate-y-0.5">{{ $sponsor->name }}</span>
                                        @endif
                                    </a>
                                @else
                                    <div class="relative group" title="{{ $sponsor->name }}">
                                        @if($sponsor->logo_url)
                                            <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-32 md:h-44 w-auto object-contain opacity-95 transition-all duration-350">
                                        @else
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block text-center py-4 px-8 border border-slate-900 rounded-2xl bg-slate-900/40">{{ $sponsor->name }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact & Footer Section -->
    <footer id="contacto" class="bg-slate-950 py-16 border-t border-slate-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 pb-12 border-b border-slate-900">
                <!-- Brand logo and coordinates -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/radiopax-icon.png') }}" alt="Radio Pax Icon" class="h-10 w-auto">
                        <span class="text-xl font-bold tracking-wider uppercase bg-gradient-to-r from-amber-400 to-yellow-200 bg-clip-text text-transparent">Radio Pax</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-sm">
                        Radio Pax 91.9 FM es una obra de comunicación católica de la Diócesis de Zacapa, dedicada a la evangelización, difusión de valores y formación cristiana.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <img src="{{ asset('assets/images/diocesis-logo.jpeg') }}" alt="Diócesis de Zacapa Logo" class="h-10 w-10 rounded-full border border-slate-800 bg-white p-0.5">
                        <div>
                            <span class="block text-xxs font-bold text-slate-450 uppercase tracking-widest">Diócesis de Zacapa</span>
                            <span class="block text-[10px] text-slate-650 uppercase">Obispado de Zacapa, Guatemala</span>
                        </div>
                    </div>
                </div>

                <!-- Fast Links -->
                <div class="md:col-span-3 space-y-4">
                    <h4 class="text-xxs font-bold text-amber-500 uppercase tracking-widest">Secciones</h4>
                    <ul class="space-y-2 text-xs font-semibold text-slate-450">
                        <li><a href="#inicio" class="hover:text-slate-200 transition-colors">Inicio</a></li>
                        <li><a href="#evangelio" class="hover:text-slate-200 transition-colors">Evangelio del Día</a></li>
                        <li><a href="#programacion" class="hover:text-slate-200 transition-colors">Programación</a></li>
                        <li><a href="#noticias" class="hover:text-slate-200 transition-colors">Noticias</a></li>
                    </ul>
                </div>

                <!-- Contact & Socials -->
                <div class="md:col-span-4 space-y-4">
                    <h4 class="text-xxs font-bold text-amber-500 uppercase tracking-widest">Contacto y Redes</h4>
                    <ul class="space-y-2.5 text-xs text-slate-450">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Zacapa, Guatemala</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+502 7941 1234</span>
                        </li>
                    </ul>

                    <!-- Social Media Badges -->
                    <div class="flex items-center gap-3 pt-2">
                        <!-- Facebook Link -->
                        <a href="https://facebook.com/radiopax" target="_blank" class="w-8 h-8 rounded-full border border-slate-850 flex items-center justify-center text-slate-450 hover:text-amber-500 hover:border-amber-500/30 transition-colors">
                            <svg class="w-4 h-4 fill-currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/>
                            </svg>
                        </a>
                        <!-- WhatsApp Link -->
                        <a href="https://wa.me/50279411234" target="_blank" class="w-8 h-8 rounded-full border border-slate-850 flex items-center justify-center text-slate-450 hover:text-amber-500 hover:border-amber-500/30 transition-colors">
                            <svg class="w-4 h-4 fill-currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.725 1.45 5.556 0 10.082-4.522 10.086-10.076.002-2.69-1.04-5.216-2.93-7.11-1.89-1.893-4.407-2.936-7.097-2.937-5.564 0-10.091 4.522-10.095 10.076-.002 1.81.474 3.578 1.38 5.128l-.949 3.467 3.557-.933zM18.2 14.86c-.33-.164-1.953-.964-2.251-1.07-.298-.11-.515-.165-.73.164-.215.33-.834 1.07-1.022 1.29-.19.215-.376.242-.705.078-1.023-.515-1.74-.94-2.42-2.105-.18-.315-.18-.58-.02-.74.15-.145.33-.377.5-.567.167-.19.222-.315.33-.53.11-.215.056-.405-.03-.568-.084-.164-.73-1.76-.999-2.417-.266-.64-.535-.554-.73-.564-.19-.01-.407-.01-.624-.01-.216 0-.57.08-0.868.404-.298.33-1.14 1.116-1.14 2.72 0 1.605 1.169 3.159 1.329 3.376.162.215 2.3 3.51 5.572 4.92.778.336 1.386.537 1.859.688.78.248 1.49.213 2.052.129.627-.094 1.953-.799 2.228-1.57.275-.77.275-1.43.193-1.57-.083-.14-.303-.223-.633-.388z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xxs text-slate-650 font-bold uppercase tracking-wider">
                <p>© {{ date('Y') }} Radio Pax 91.9 FM. Todos los derechos reservados.</p>
                <p>Diseñado y Desarrollado con mucho cariño por Jerry Cordero</p>
            </div>
        </div>
    </footer>

    <!-- JS State Logic (Alpine.js structure) -->
    <script>
        function playerState() {
            return {
                playing: false,
                volume: 0.8,
                muted: false,
                audio: null,
                streamUrl: 'https://stream.zeno.fm/sdeifnlmzbuvv',
                liveStatus: {
                    isLive: true,
                    name: 'Cargando programación...',
                    host: '',
                    bannerMessage: '',
                    nextProgram: null
                },
                openModal: false,
                activeNews: {
                    title: '',
                    content: '',
                    image_url: '',
                    category: '',
                    date: ''
                },
                pollingInterval: null,

                init() {
                    this.audio = document.getElementById('audio-stream');
                    
                    // Fetch live cabin status details on load
                    this.fetchLiveStatus();

                    // Poll the live status API every 30 seconds
                    this.pollingInterval = setInterval(() => {
                        this.fetchLiveStatus();
                    }, 30000);

                    // Sync state if audio ends or breaks
                    this.audio.addEventListener('pause', () => {
                        this.playing = false;
                    });
                    this.audio.addEventListener('play', () => {
                        this.playing = true;
                    });
                },

                fetchLiveStatus() {
                    fetch('/api/schedule/current')
                        .then(res => res.json())
                        .then(data => {
                            this.liveStatus.isLive = data.isLive;
                            this.liveStatus.name = data.name;
                            this.liveStatus.host = data.host;
                            this.liveStatus.bannerMessage = data.bannerMessage;
                            this.liveStatus.nextProgram = data.nextProgram;
                        })
                        .catch(err => console.error('Error fetching live status:', err));
                },

                togglePlay() {
                    if (this.playing) {
                        this.audio.pause();
                        // Clear media source to stop downloading data stream when paused
                        this.audio.src = '';
                    } else {
                        // Reload stream source to resume live feed
                        this.audio.src = this.streamUrl;
                        this.audio.load();
                        this.audio.volume = this.muted ? 0 : this.volume;
                        this.audio.play().catch(err => {
                            console.error('Audio playback failed:', err);
                            this.playing = false;
                        });
                    }
                },

                toggleMute() {
                    this.muted = !this.muted;
                    this.audio.volume = this.muted ? 0 : this.volume;
                },

                updateVolume() {
                    this.muted = false;
                    this.audio.volume = this.volume;
                },

                formatTime(timeStr) {
                    if (!timeStr) return '';
                    // Converts 24h string (14:30:00) to 12h format (02:30 PM)
                    const parts = timeStr.split(':');
                    let hrs = parseInt(parts[0]);
                    const mins = parts[1];
                    const ampm = hrs >= 12 ? 'PM' : 'AM';
                    hrs = hrs % 12;
                    hrs = hrs ? hrs : 12; // 0 should be 12
                    const formattedHrs = hrs < 10 ? '0' + hrs : hrs;
                    return `${formattedHrs}:${mins} ${ampm}`;
                },

                openModalNews(newsItem) {
                    this.activeNews = newsItem;
                    this.openModal = true;
                    // Prevent page scroll when modal is open
                    document.body.classList.add('overflow-hidden');
                },

                closeModalNews() {
                    this.openModal = false;
                    // Restore page scroll
                    document.body.classList.remove('overflow-hidden');
                }
            }
        }
    </script>
</body>
</html>
