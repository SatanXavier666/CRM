<template>
    <div class="fixed bottom-0 left-0 right-0 z-50">
        <div class="bg-slate-900/95 backdrop-blur-md border-t border-slate-800">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    <!-- Status Info -->
                    <div class="flex items-center space-x-4">
                        <!-- Status Indicator -->
                        <div class="flex items-center space-x-2">
                            <div class="relative">
                                <div
                                    v-if="status === 'operational'"
                                    class="w-3 h-3 bg-green-500 rounded-full animate-pulse shadow-lg shadow-green-500/50"
                                ></div>
                                <div
                                    v-else-if="status === 'degraded'"
                                    class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse shadow-lg shadow-yellow-500/50"
                                ></div>
                                <div
                                    v-else
                                    class="w-3 h-3 bg-red-500 rounded-full animate-pulse shadow-lg shadow-red-500/50"
                                ></div>
                            </div>
                            <span
                                class="text-sm font-semibold"
                                :class="{
                                    'text-green-400': status === 'operational',
                                    'text-yellow-400': status === 'degraded',
                                    'text-red-400': status === 'outage'
                                }"
                            >
                                {{ statusText }}
                            </span>
                        </div>

                        <!-- Detailed Status (Desktop) -->
                        <div class="hidden md:flex items-center space-x-3 text-xs">
                            <!-- Database -->
                            <div class="flex items-center space-x-1">
                                <div
                                    class="w-2 h-2 rounded-full"
                                    :class="{
                                        'bg-green-500': checks.database?.status === 'operational',
                                        'bg-yellow-500': checks.database?.status === 'degraded',
                                        'bg-red-500': checks.database?.status === 'outage',
                                        'bg-slate-600': !checks.database
                                    }"
                                ></div>
                                <span class="text-slate-400">Database</span>
                            </div>

                            <!-- Cache -->
                            <div class="flex items-center space-x-1">
                                <div
                                    class="w-2 h-2 rounded-full"
                                    :class="{
                                        'bg-green-500': checks.cache?.status === 'operational',
                                        'bg-yellow-500': checks.cache?.status === 'degraded',
                                        'bg-red-500': checks.cache?.status === 'outage',
                                        'bg-slate-600': !checks.cache
                                    }"
                                ></div>
                                <span class="text-slate-400">Cache</span>
                            </div>

                            <!-- Storage -->
                            <div class="flex items-center space-x-1">
                                <div
                                    class="w-2 h-2 rounded-full"
                                    :class="{
                                        'bg-green-500': checks.storage?.status === 'operational',
                                        'bg-yellow-500': checks.storage?.status === 'degraded',
                                        'bg-red-500': checks.storage?.status === 'outage',
                                        'bg-slate-600': !checks.storage
                                    }"
                                ></div>
                                <span class="text-slate-400">Storage</span>
                            </div>
                        </div>

                        <!-- Last Updated -->
                        <div class="hidden lg:block text-xs text-slate-500">
                            Updated {{ lastUpdated }}
                        </div>
                    </div>

                    <!-- Right Side Info -->
                    <div class="flex items-center space-x-4">
                        <!-- Uptime (Desktop) -->
                        <div class="hidden md:flex items-center space-x-2 text-xs">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-slate-400">Uptime: 99.9%</span>
                        </div>

                        <!-- Server Location -->
                        <div class="hidden lg:flex items-center space-x-2 text-xs">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                            <span class="text-slate-400">Hostinger • srv602</span>
                        </div>

                        <!-- Refresh Button -->
                        <button
                            @click="refreshStatus"
                            class="p-1.5 rounded-lg hover:bg-slate-800 transition-colors"
                            :class="{ 'animate-spin': loading }"
                        >
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

const status = ref('operational');
const checks = ref({});
const lastChecked = ref(new Date());
const loading = ref(false);

const statusText = computed(() => {
    if (status.value === 'operational') return 'All Systems Operational';
    if (status.value === 'degraded') return 'Partial System Outage';
    return 'System Outage';
});

const lastUpdated = computed(() => {
    const seconds = Math.floor((Date.now() - lastChecked.value.getTime()) / 1000);
    if (seconds < 60) return `${seconds}s ago`;
    const minutes = Math.floor(seconds / 60);
    if (minutes < 60) return `${minutes}m ago`;
    return `${Math.floor(minutes / 60)}h ago`;
});

let intervalId = null;

const fetchStatus = async () => {
    try {
        loading.value = true;
        const response = await fetch('/health');
        const data = await response.json();

        status.value = data.status;
        checks.value = data.checks || {};
        lastChecked.value = new Date();
    } catch (error) {
        console.error('Health check failed:', error);
        status.value = 'outage';
        checks.value = {};
    } finally {
        loading.value = false;
    }
};

const refreshStatus = () => {
    fetchStatus();
};

onMounted(() => {
    // Initial fetch
    fetchStatus();

    // Auto-refresh every 30 seconds
    intervalId = setInterval(fetchStatus, 30000);
});

onUnmounted(() => {
    if (intervalId) {
        clearInterval(intervalId);
    }
});
</script>

<style scoped>
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
