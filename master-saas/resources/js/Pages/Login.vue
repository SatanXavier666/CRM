<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    🚀 AstraCare Portal
                </h1>
                <p class="text-xl text-gray-600">
                    Multi-Tenant SaaS Platform - Demo Login
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Login Form -->
                <div class="bg-white rounded-lg shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Sign In</h2>

                    <form @submit.prevent="handleLogin" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter your email"
                            />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter your password"
                            />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input
                                    id="remember"
                                    v-model="form.remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                />
                                <label for="remember" class="ml-2 block text-sm text-gray-900">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200"
                        >
                            Sign In
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Authentication system is ready to be implemented with Laravel Breeze
                        </p>
                    </div>
                </div>

                <!-- Demo Credentials -->
                <div class="bg-white rounded-lg shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📧 Demo Credentials</h2>

                    <div class="space-y-6">
                        <!-- Super Admin -->
                        <div class="border-l-4 border-red-500 pl-4 py-3 bg-red-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-red-900">🔑 Super Admin</h3>
                                <button
                                    @click="fillCredentials('admin@astracareportal.com', 'admin123')"
                                    class="text-xs bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                >
                                    Use
                                </button>
                            </div>
                            <p class="text-sm text-red-800">
                                <span class="font-semibold">Email:</span> admin@astracareportal.com<br>
                                <span class="font-semibold">Password:</span> admin123<br>
                                <span class="text-xs text-red-600">Full system access</span>
                            </p>
                        </div>

                        <!-- Admin -->
                        <div class="border-l-4 border-blue-500 pl-4 py-3 bg-blue-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-blue-900">👨‍💼 Admin User</h3>
                                <button
                                    @click="fillCredentials('john.admin@astracareportal.com', 'admin123')"
                                    class="text-xs bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                                >
                                    Use
                                </button>
                            </div>
                            <p class="text-sm text-blue-800">
                                <span class="font-semibold">Email:</span> john.admin@astracareportal.com<br>
                                <span class="font-semibold">Password:</span> admin123<br>
                                <span class="text-xs text-blue-600">Administrator role</span>
                            </p>
                        </div>

                        <!-- Manager -->
                        <div class="border-l-4 border-green-500 pl-4 py-3 bg-green-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-green-900">👩‍💼 Manager</h3>
                                <button
                                    @click="fillCredentials('sarah.manager@astracareportal.com', 'manager123')"
                                    class="text-xs bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
                                >
                                    Use
                                </button>
                            </div>
                            <p class="text-sm text-green-800">
                                <span class="font-semibold">Email:</span> sarah.manager@astracareportal.com<br>
                                <span class="font-semibold">Password:</span> manager123<br>
                                <span class="text-xs text-green-600">Manager role</span>
                            </p>
                        </div>

                        <!-- User -->
                        <div class="border-l-4 border-gray-500 pl-4 py-3 bg-gray-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-gray-900">👤 Regular User</h3>
                                <button
                                    @click="fillCredentials('mike.user@astracareportal.com', 'user123')"
                                    class="text-xs bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700"
                                >
                                    Use
                                </button>
                            </div>
                            <p class="text-sm text-gray-800">
                                <span class="font-semibold">Email:</span> mike.user@astracareportal.com<br>
                                <span class="font-semibold">Password:</span> user123<br>
                                <span class="text-xs text-gray-600">User role</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-sm text-yellow-800">
                            <strong>Note:</strong> To enable login functionality, install Laravel Breeze:
                            <code class="block mt-2 text-xs bg-gray-800 text-white p-2 rounded">
                                composer require laravel/breeze<br>
                                php artisan breeze:install vue<br>
                                npm run build
                            </code>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a
                    href="/"
                    class="inline-block text-indigo-600 hover:text-indigo-800 font-semibold"
                >
                    ← Back to Home
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

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
