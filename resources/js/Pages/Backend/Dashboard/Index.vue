<template>
    <Head title="Dashboard" />
        <div>
            <Sidebar/>

            <div class="lg:pl-72">
                <TopMenu />

                <main class="py-10">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="mt-2 flex flex-col">
                            <div class="sm:flex sm:items-right space-y-5 sm:space-y-5 bg-white px-3 shadow rounded-t-md pb-4">
                                <div class="sm:flex-auto mt-4">
                                    <h3 class="text-lg font-bold leading-6 text-gray-900">My Latest Five Task</h3>
                                </div>
                            </div>

                            <div class="flex flex-col min-w-full overflow-hidden overflow-x-auto align-middle shadow rounded-b-md">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Title</th>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Description</th>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Dead Line</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="(item, index) in tasks" :key="index">
                                            <td class="px-6 py-4 text-sm">
                                                {{ item.title }}
                                            </td>

                                            <td class="px-6 py-4 text-sm">
                                                {{ item.description }}
                                            </td>

                                            <td class="px-6 py-4 text-sm">
                                                {{ item.date }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
</template>

<script setup>
    import Sidebar from "@/Components/Common/Sidebar.vue";
    import TopMenu from "@/Components/Common/Topbar.vue";
    import { Head } from '@inertiajs/vue3';

    const props = defineProps({
        tasks: Object,
    })
</script>
