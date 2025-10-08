<template>
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-950 via-purple-950 to-slate-900 flex items-center justify-center py-12 px-4">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>

        <!-- Animated Orbs -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

        <!-- Main Content -->
        <div class="relative z-10 max-w-7xl w-full">
            <!-- Back to Home Link -->
            <div class="mb-8">
                <a href="/" class="inline-flex items-center text-cyan-400 hover:text-cyan-300 transition-colors group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Home
                </a>
            </div>

            <!-- Header -->
            <div class="text-center mb-12 animate-fade-in-down">
                <div class="inline-flex items-center space-x-3 mb-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-lg blur-lg opacity-75 animate-pulse"></div>
                        <div class="relative bg-slate-900/90 backdrop-blur-xl px-6 py-3 rounded-lg border border-cyan-500/30">
                            <span class="text-3xl font-black bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                                AstraCare Portal
                            </span>
                        </div>
                    </div>
                </div>
                <p class="text-xl text-slate-300">
                    Multi-Tenant SaaS Platform <span class="text-cyan-400">•</span> Demo Login
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <!-- Login Form Card -->
                <div class="group relative animate-fade-in-left">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000"></div>
                    <div class="relative bg-slate-900/90 backdrop-blur-xl rounded-2xl border border-cyan-500/30 p-8 lg:p-10">
                        <h2 class="text-3xl font-bold mb-8">
                            <span class="bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                                Sign In
                            </span>
                        </h2>

                        <form @submit.prevent="handleLogin" class="space-y-6">
                            <!-- Email Input -->
                            <div class="group/input">
                                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 rounded-xl blur opacity-0 group-hover/input:opacity-100 transition-opacity"></div>
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        required
                                        class="relative w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 transition-all"
                                        placeholder="Enter your email"
                                    />
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="group/input">
                                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 rounded-xl blur opacity-0 group-hover/input:opacity-100 transition-opacity"></div>
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        required
                                        class="relative w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/30 transition-all"
                                        placeholder="Enter your password"
                                    />
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input
                                        id="remember"
                                        v-model="form.remember"
                                        type="checkbox"
                                        class="h-4 w-4 text-cyan-500 focus:ring-cyan-500 border-slate-600 rounded bg-slate-800"
                                    />
                                    <label for="remember" class="ml-2 block text-sm text-slate-300">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">
                                    Forgot password?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                class="group/btn relative w-full px-6 py-3 rounded-xl font-bold text-lg overflow-hidden transform transition-all duration-300 hover:scale-[1.02]"
                            >
                                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 animate-gradient-shift"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 blur-lg opacity-75 group-hover/btn:opacity-100 transition-opacity"></div>
                                <span class="relative text-white flex items-center justify-center space-x-2">
                                    <span>Sign In</span>
                                    <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </button>
                        </form>

                        <!-- Note -->
                        <div class="mt-8 p-4 bg-slate-800/50 border border-slate-700 rounded-xl">
                            <p class="text-sm text-slate-400">
                                <span class="text-yellow-400 font-semibold">ℹ️ Note:</span>
                                Authentication system ready. Install Laravel Breeze to enable login.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Demo Credentials Card -->
                <div class="group relative animate-fade-in-right">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000"></div>
                    <div class="relative bg-slate-900/90 backdrop-blur-xl rounded-2xl border border-purple-500/30 p-8 lg:p-10">
                        <h2 class="text-3xl font-bold mb-8">
                            <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                                📧 Demo Credentials
                            </span>
                        </h2>

                        <div class="space-y-4">
                            <!-- Super Admin -->
                            <div class="group/card relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl blur opacity-20 group-hover/card:opacity-60 transition duration-500"></div>
                                <div class="relative bg-gradient-to-br from-red-900/20 to-orange-900/20 border-l-4 border-red-500 p-4 rounded-xl backdrop-blur-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-bold text-red-400 flex items-center space-x-2">
                                            <span class="text-xl">🔑</span>
                                            <span>Super Admin</span>
                                        </h3>
                                        <button
                                            @click="fillCredentials('admin@astracareportal.com', 'admin123')"
                                            class="px-4 py-1.5 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold rounded-lg hover:from-red-600 hover:to-orange-600 transition-all transform hover:scale-105"
                                        >
                                            Use This
                                        </button>
                                    </div>
                                    <div class="space-y-1 text-sm text-slate-300">
                                        <p><span class="text-slate-400">Email:</span> <span class="text-red-300 font-mono">admin@astracareportal.com</span></p>
                                        <p><span class="text-slate-400">Password:</span> <span class="text-red-300 font-mono">admin123</span></p>
                                        <p class="text-xs text-red-400 mt-2">⚡ Full system access</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Admin User -->
                            <div class="group/card relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl blur opacity-20 group-hover/card:opacity-60 transition duration-500"></div>
                                <div class="relative bg-gradient-to-br from-blue-900/20 to-cyan-900/20 border-l-4 border-blue-500 p-4 rounded-xl backdrop-blur-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-bold text-blue-400 flex items-center space-x-2">
                                            <span class="text-xl">👨‍💼</span>
                                            <span>Admin User</span>
                                        </h3>
                                        <button
                                            @click="fillCredentials('john.admin@astracareportal.com', 'admin123')"
                                            class="px-4 py-1.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-xs font-bold rounded-lg hover:from-blue-600 hover:to-cyan-600 transition-all transform hover:scale-105"
                                        >
                                            Use This
                                        </button>
                                    </div>
                                    <div class="space-y-1 text-sm text-slate-300">
                                        <p><span class="text-slate-400">Email:</span> <span class="text-blue-300 font-mono">john.admin@astracareportal.com</span></p>
                                        <p><span class="text-slate-400">Password:</span> <span class="text-blue-300 font-mono">admin123</span></p>
                                        <p class="text-xs text-blue-400 mt-2">⚡ Administrator role</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Manager -->
                            <div class="group/card relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl blur opacity-20 group-hover/card:opacity-60 transition duration-500"></div>
                                <div class="relative bg-gradient-to-br from-green-900/20 to-emerald-900/20 border-l-4 border-green-500 p-4 rounded-xl backdrop-blur-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-bold text-green-400 flex items-center space-x-2">
                                            <span class="text-xl">👩‍💼</span>
                                            <span>Manager</span>
                                        </h3>
                                        <button
                                            @click="fillCredentials('sarah.manager@astracareportal.com', 'manager123')"
                                            class="px-4 py-1.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-bold rounded-lg hover:from-green-600 hover:to-emerald-600 transition-all transform hover:scale-105"
                                        >
                                            Use This
                                        </button>
                                    </div>
                                    <div class="space-y-1 text-sm text-slate-300">
                                        <p><span class="text-slate-400">Email:</span> <span class="text-green-300 font-mono">sarah.manager@astracareportal.com</span></p>
                                        <p><span class="text-slate-400">Password:</span> <span class="text-green-300 font-mono">manager123</span></p>
                                        <p class="text-xs text-green-400 mt-2">⚡ Manager role</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Regular User -->
                            <div class="group/card relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl blur opacity-20 group-hover/card:opacity-60 transition duration-500"></div>
                                <div class="relative bg-gradient-to-br from-purple-900/20 to-pink-900/20 border-l-4 border-purple-500 p-4 rounded-xl backdrop-blur-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-bold text-purple-400 flex items-center space-x-2">
                                            <span class="text-xl">👤</span>
                                            <span>Regular User</span>
                                        </h3>
                                        <button
                                            @click="fillCredentials('mike.user@astracareportal.com', 'user123')"
                                            class="px-4 py-1.5 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-bold rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all transform hover:scale-105"
                                        >
                                            Use This
                                        </button>
                                    </div>
                                    <div class="space-y-1 text-sm text-slate-300">
                                        <p><span class="text-slate-400">Email:</span> <span class="text-purple-300 font-mono">mike.user@astracareportal.com</span></p>
                                        <p><span class="text-slate-400">Password:</span> <span class="text-purple-300 font-mono">user123</span></p>
                                        <p class="text-xs text-purple-400 mt-2">⚡ User role</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Installation Note -->
                        <div class="mt-6 relative">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl blur opacity-20"></div>
                            <div class="relative p-4 bg-gradient-to-br from-yellow-900/20 to-orange-900/20 border border-yellow-500/30 rounded-xl">
                                <p class="text-sm text-slate-300 mb-3">
                                    <strong class="text-yellow-400">💡 To enable login:</strong>
                                </p>
                                <code class="block text-xs bg-slate-950/80 text-cyan-300 p-3 rounded-lg font-mono overflow-x-auto">
                                    <span class="text-purple-400">composer</span> require laravel/breeze<br/>
                                    <span class="text-purple-400">php</span> artisan breeze:install vue<br/>
                                    <span class="text-purple-400">npm</span> run build
                                </code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Server Status Bar -->
        <ServerStatus />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import ServerStatus from '../Components/ServerStatus.vue';

const form = ref({
    email: '',
    password: '',
    remember: false,
});

const fillCredentials = (email, password) => {
    form.value.email = email;
    form.value.password = password;
};

const handleLogin = () => {
    alert('Authentication system needs to be installed with Laravel Breeze.\n\nRun:\ncomposer require laravel/breeze\nphp artisan breeze:install vue\nnpm run build');
};
</script>

<style scoped>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-left {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fade-in-right {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.animate-gradient-shift {
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
}

.animate-fade-in-down {
    animation: fade-in-down 0.6s ease-out;
}

.animate-fade-in-left {
    animation: fade-in-left 0.8s ease-out;
}

.animate-fade-in-right {
    animation: fade-in-right 0.8s ease-out 0.2s backwards;
}

.bg-grid-pattern {
    background-image:
        linear-gradient(rgba(168, 85, 247, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(168, 85, 247, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
}
</style>
