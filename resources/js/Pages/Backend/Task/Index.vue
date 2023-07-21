<template>
    <Head title="Task List"/>
    <div class="min-h-screen bg-gray-100">
        <!--  Load sidebar-->
        <Sidebar/>

        <div class="flex flex-1 flex-col lg:pl-72">
            <TopMenu />

            <main class="flex-1 pb-8">
                <div class="mt-8">
                    <div class="mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="mt-2 flex flex-col">
                            <div class="sm:flex sm:items-right space-y-5 sm:space-y-5 bg-white px-3 shadow rounded-t-md pb-4">
                                <div class="sm:flex-auto mt-4">
                                    <h3 class="text-lg font-bold leading-6 text-gray-900">Task List ({{ items.total }})</h3>
                                </div>

                                <div class="sm:mt-0 sm:ml-16 sm:flex-none">
                                    <Link :href="route('backend.tasks.create')"
                                          class="mt-2 ml-3 inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                        Add New
                                    </Link>
                                </div>
                            </div>

                            <div class="flex flex-col min-w-full overflow-hidden overflow-x-auto align-middle shadow rounded-b-md">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Title</th>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Description</th>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Dead Line</th>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Assigned User</th>
                                            <th class="bg-gray-50 px-6 py-3 text-left text-sm font-bold text-gray-900">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody v-if="items.total !== 0" class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="(item, index) in items.data" :key="index">
                                            <td class="px-6 py-4 text-sm">
                                                {{ item.title }}
                                            </td>

                                            <td class="px-6 py-4 text-sm">
                                                {{ item.description }}
                                            </td>

                                            <td class="px-6 py-4 text-sm">
                                                {{ item.date }}
                                            </td>

                                            <td class="px-6 py-4 text-sm">
                                                <div v-if="item.users.length !== 0">
                                                    <div v-for="(item, index) in item.users" :key="index">
                                                        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                            {{ item.name }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div v-else>
                                                    N/A
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 text-sm">
                                                <Link :href="route('backend.task_assign.create', item.id)"
                                                      class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm text-white shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                                    Assign User
                                                </Link>

                                                <Link :href="route('backend.tasks.edit', item.id)"
                                                      class="ml-2 inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-3 py-2 text-sm text-white shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                                    Edit
                                                </Link>

                                                <Link :href="route('backend.tasks.delete', item.id)"
                                                      method="delete"
                                                      as="button"
                                                      @success="onDeleteSuccess"
                                                      class="ml-2 inline-flex items-center justify-center rounded-md border border-transparent bg-red-600 px-3 py-2 text-sm text-white shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                                    Delete
                                                </Link>
                                            </td>
                                        </tr>
                                    </tbody>

                                    <div v-else class="px-4 py-4">Task Not Found!</div>
                                </table>
                            </div>

                            <Pager class="py-4" :links="items.links"/>
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
    import Pager from "@/Components/Common/Pager.vue";
    import { Head, Link } from '@inertiajs/vue3';
    import {useToast} from "vue-toastification";

    const toast = useToast();

    const props = defineProps({
        items: Object,
    });

    const onDeleteSuccess = () => {
        toast.success('Data has been Deleted successfully.');
    }
</script>
