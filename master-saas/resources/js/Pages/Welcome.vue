<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-16">
                    <h1 class="text-5xl font-bold text-gray-900 mb-4">
                        🚀 AstraCare Portal
                    </h1>
                    <p class="text-xl text-gray-600">
                        Multi-Tenant SaaS Platform for Business Solutions
                    </p>
                </div>

                <!-- Feature Cards -->
                <div class="grid md:grid-cols-3 gap-8 mb-16">
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                        <div class="text-4xl mb-4">🏢</div>
                        <h3 class="text-xl font-semibold mb-2">CRM Module</h3>
                        <p class="text-gray-600">
                            Manage contacts, leads, and deals efficiently
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                        <div class="text-4xl mb-4">📊</div>
                        <h3 class="text-xl font-semibold mb-2">ERP Module</h3>
                        <p class="text-gray-600">
                            Handle inventory, invoicing, and reports
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                        <div class="text-4xl mb-4">⚡</div>
                        <h3 class="text-xl font-semibold mb-2">High Performance</h3>
                        <p class="text-gray-600">
                            Redis caching, queues, and optimization
                        </p>
                    </div>
                </div>

                <!-- Tech Stack -->
                <div class="bg-white rounded-lg shadow-lg p-8 mb-16">
                    <h2 class="text-2xl font-bold mb-6 text-center">Built With</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div class="p-4">
                            <div class="text-3xl mb-2">🔴</div>
                            <div class="font-semibold">Laravel 11</div>
                        </div>
                        <div class="p-4">
                            <div class="text-3xl mb-2">💚</div>
                            <div class="font-semibold">Vue 3</div>
                        </div>
                        <div class="p-4">
                            <div class="text-3xl mb-2">⚡</div>
                            <div class="font-semibold">Inertia.js</div>
                        </div>
                        <div class="p-4">
                            <div class="text-3xl mb-2">🎨</div>
                            <div class="font-semibold">Tailwind CSS</div>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="text-center space-x-4">
                    <a
                        href="/login"
                        class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition"
                    >
                        Login
                    </a>
                    <a
                        href="/register"
                        class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold border-2 border-indigo-600 hover:bg-indigo-50 transition"
                    >
                        Sign Up
                    </a>
                </div>

                <!-- Footer -->
                <div class="mt-16 text-center text-gray-600">
                    <p>Built with ❤️ by Terragon Labs</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
</script>
