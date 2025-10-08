<template>
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-950 via-purple-950 to-slate-900">
        <!-- Animated Background Grid -->
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>

        <!-- Animated Gradient Orbs -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>

        <!-- Floating particles -->
        <div class="absolute inset-0">
            <div v-for="i in 20" :key="i"
                 class="absolute w-1 h-1 bg-cyan-400 rounded-full animate-float"
                 :style="{
                     left: `${Math.random() * 100}%`,
                     top: `${Math.random() * 100}%`,
                     animationDelay: `${Math.random() * 5}s`,
                     animationDuration: `${5 + Math.random() * 10}s`
                 }">
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10">
            <!-- Navbar -->
            <nav class="container mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-lg blur-md opacity-75 animate-pulse"></div>
                            <div class="relative bg-slate-900/90 backdrop-blur-xl px-4 py-2 rounded-lg border border-cyan-500/30">
                                <span class="text-2xl font-black bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                                    AstraCare
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/login"
                           class="px-6 py-2.5 rounded-lg font-semibold text-cyan-300 hover:text-cyan-200 transition-all duration-300 hover:scale-105">
                            Login
                        </a>
                        <a href="/register"
                           class="group relative px-6 py-2.5 rounded-lg font-semibold overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 animate-gradient-shift"></div>
                            <div class="absolute inset-0.5 bg-slate-900 rounded-lg"></div>
                            <span class="relative bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent group-hover:from-cyan-300 group-hover:to-pink-300 transition-all">
                                Get Started
                            </span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <section class="container mx-auto px-6 py-20 md:py-32">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-16 animate-fade-in-up">
                        <!-- Premium Badge -->
                        <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-gradient-to-r from-cyan-500/10 to-purple-500/10 border border-cyan-500/30 backdrop-blur-xl mb-8 animate-glow">
                            <span class="w-2 h-2 bg-cyan-400 rounded-full animate-ping"></span>
                            <span class="text-cyan-300 text-sm font-medium">Next-Gen Business Platform</span>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="text-6xl md:text-8xl font-black mb-6 leading-tight">
                            <span class="block bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-text">
                                Transform Your
                            </span>
                            <span class="block bg-gradient-to-r from-pink-400 via-purple-400 to-cyan-400 bg-clip-text text-transparent animate-gradient-text-reverse">
                                Business Today
                            </span>
                        </h1>

                        <p class="text-xl md:text-2xl text-slate-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                            Experience the power of AI-driven multi-tenant SaaS platform with
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400 font-semibold">CRM</span>,
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400 font-semibold">ERP</span>, and more
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                            <a href="/register"
                               class="group relative px-8 py-4 rounded-xl font-bold text-lg overflow-hidden transform transition-all duration-300 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 animate-gradient-shift"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 blur-lg opacity-75 group-hover:opacity-100 transition-opacity"></div>
                                <span class="relative text-white flex items-center space-x-2">
                                    <span>Start Free Trial</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </a>
                            <a href="#demo"
                               class="group px-8 py-4 rounded-xl font-bold text-lg bg-slate-800/50 backdrop-blur-xl border border-cyan-500/30 text-cyan-300 hover:bg-slate-800/70 hover:border-cyan-400/50 transition-all duration-300 transform hover:scale-105">
                                Watch Demo
                            </a>
                        </div>
                    </div>

                    <!-- Feature Cards -->
                    <div class="grid md:grid-cols-3 gap-8 mt-24">
                        <!-- CRM Card -->
                        <div class="group relative animate-fade-in-up animation-delay-200">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative bg-slate-900/90 backdrop-blur-xl p-8 rounded-2xl border border-cyan-500/30 hover:border-cyan-400/50 transition-all duration-300">
                                <div class="flex items-center justify-center w-16 h-16 mb-6 rounded-xl bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/30">
                                    <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-3">Advanced CRM</h3>
                                <p class="text-slate-400 leading-relaxed mb-4">
                                    Manage contacts, leads, and deals with AI-powered insights and automation
                                </p>
                                <div class="flex items-center text-cyan-400 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                                    <span>Learn more</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- ERP Card -->
                        <div class="group relative animate-fade-in-up animation-delay-400">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative bg-slate-900/90 backdrop-blur-xl p-8 rounded-2xl border border-purple-500/30 hover:border-purple-400/50 transition-all duration-300">
                                <div class="flex items-center justify-center w-16 h-16 mb-6 rounded-xl bg-gradient-to-br from-purple-500/20 to-pink-500/20 border border-purple-500/30">
                                    <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-3">Smart ERP</h3>
                                <p class="text-slate-400 leading-relaxed mb-4">
                                    Handle inventory, invoicing, and analytics with real-time reporting
                                </p>
                                <div class="flex items-center text-purple-400 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                                    <span>Learn more</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Performance Card -->
                        <div class="group relative animate-fade-in-up animation-delay-600">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-500 to-orange-500 rounded-2xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative bg-slate-900/90 backdrop-blur-xl p-8 rounded-2xl border border-pink-500/30 hover:border-pink-400/50 transition-all duration-300">
                                <div class="flex items-center justify-center w-16 h-16 mb-6 rounded-xl bg-gradient-to-br from-pink-500/20 to-orange-500/20 border border-pink-500/30">
                                    <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-3">Lightning Fast</h3>
                                <p class="text-slate-400 leading-relaxed mb-4">
                                    Redis caching, queue workers, and optimized performance at scale
                                </p>
                                <div class="flex items-center text-pink-400 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                                    <span>Learn more</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tech Stack Section -->
                    <div class="mt-32 animate-fade-in-up animation-delay-800">
                        <div class="relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 rounded-3xl blur-2xl opacity-20"></div>
                            <div class="relative bg-slate-900/80 backdrop-blur-2xl p-12 rounded-3xl border border-slate-700/50">
                                <h2 class="text-4xl font-bold text-center mb-12">
                                    <span class="bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                                        Powered By Modern Tech
                                    </span>
                                </h2>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                                    <div class="group text-center transform hover:scale-110 transition-all duration-300">
                                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-red-500/20 to-red-600/20 border border-red-500/30 flex items-center justify-center group-hover:border-red-400/50 transition-all">
                                            <span class="text-4xl">🔴</span>
                                        </div>
                                        <div class="font-bold text-white group-hover:text-red-400 transition-colors">Laravel 11</div>
                                        <div class="text-sm text-slate-400">Backend</div>
                                    </div>
                                    <div class="group text-center transform hover:scale-110 transition-all duration-300">
                                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-green-500/20 to-green-600/20 border border-green-500/30 flex items-center justify-center group-hover:border-green-400/50 transition-all">
                                            <span class="text-4xl">💚</span>
                                        </div>
                                        <div class="font-bold text-white group-hover:text-green-400 transition-colors">Vue 3</div>
                                        <div class="text-sm text-slate-400">Frontend</div>
                                    </div>
                                    <div class="group text-center transform hover:scale-110 transition-all duration-300">
                                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 border border-purple-500/30 flex items-center justify-center group-hover:border-purple-400/50 transition-all">
                                            <span class="text-4xl">⚡</span>
                                        </div>
                                        <div class="font-bold text-white group-hover:text-purple-400 transition-colors">Inertia.js</div>
                                        <div class="text-sm text-slate-400">SPA</div>
                                    </div>
                                    <div class="group text-center transform hover:scale-110 transition-all duration-300">
                                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-cyan-600/20 border border-cyan-500/30 flex items-center justify-center group-hover:border-cyan-400/50 transition-all">
                                            <span class="text-4xl">🎨</span>
                                        </div>
                                        <div class="font-bold text-white group-hover:text-cyan-400 transition-colors">Tailwind</div>
                                        <div class="text-sm text-slate-400">Styling</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="container mx-auto px-6 py-12 mt-32 border-t border-slate-800">
                <div class="text-center">
                    <p class="text-slate-400">
                        Built with
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-red-500 animate-pulse">❤️</span>
                        by
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400 font-semibold">Terragon Labs</span>
                    </p>
                    <p class="text-slate-500 text-sm mt-2">© 2025 AstraCare Portal. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<style scoped>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-100vh) translateX(20px); opacity: 0; }
}

@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes gradient-text {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes tilt {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(1deg); }
    75% { transform: rotate(-1deg); }
}

@keyframes glow {
    0%, 100% { box-shadow: 0 0 20px rgba(6, 182, 212, 0.3); }
    50% { box-shadow: 0 0 40px rgba(6, 182, 212, 0.6); }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
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

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}

.animation-delay-800 {
    animation-delay: 0.8s;
}

.animate-float {
    animation: float linear infinite;
}

.animate-gradient-shift {
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
}

.animate-gradient-text {
    background-size: 200% 200%;
    animation: gradient-text 4s ease infinite;
}

.animate-gradient-text-reverse {
    background-size: 200% 200%;
    animation: gradient-text 4s ease infinite reverse;
}

.animate-tilt {
    animation: tilt 3s ease-in-out infinite;
}

.animate-glow {
    animation: glow 2s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}

.bg-grid-pattern {
    background-image:
        linear-gradient(rgba(168, 85, 247, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(168, 85, 247, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
}
</style>
