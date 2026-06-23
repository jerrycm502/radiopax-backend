@extends('layouts.admin')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex p-3 bg-navyDeep/10 rounded-full border border-navyDeep/20 text-navyDeep mb-4">
                <i data-lucide="lock" class="w-6 h-6"></i>
            </div>
            <h2 class="text-2xl font-serif font-bold text-navyDeep">Ingreso Administrativo</h2>
            <p class="text-slate-500 text-sm mt-1">Ingresa tus credenciales para administrar Radio Pax</p>
        </div>

        <!-- Form -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Correo Electrónico</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-navyPetrol focus:border-transparent transition text-sm bg-slate-50 focus:bg-white"
                        placeholder="ejemplo@radiopax.com">
                </div>
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i data-lucide="key-round" class="w-4 h-4"></i>
                    </span>
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-navyPetrol focus:border-transparent transition text-sm bg-slate-50 focus:bg-white"
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-navyDeep border-slate-300 rounded focus:ring-navyPetrol">
                <label for="remember" class="ml-2 text-sm text-slate-600 cursor-pointer select-none">Recordar mi sesión</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                class="w-full py-3 bg-navyDeep hover:bg-navyPetrol text-white rounded-xl text-sm font-semibold tracking-wide shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center space-x-2">
                <span>Ingresar al Sistema</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

    </div>
</div>
@endsection
