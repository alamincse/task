<template>
    <Head title="Add Task" />

    <div class="min-h-screen bg-gray-100">

        <!--  Load sidebar-->
        <Sidebar />

        <div class="flex flex-1 flex-col lg:pl-72">
            <TopMenu />

            <main class="flex-1 pb-8">
                <div class="mt-8">
                    <div class="mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white min-w-full overflow-hidden overflow-x-auto align-middle shadow rounded-md">
                            <div class="sm:flex sm:items-right space-y-5 sm:space-y-5 bg-white px-3">
                                <div class="sm:flex-auto mt-4">
                                    <h3 class="text-lg font-bold leading-6 text-gray-900">Add Task</h3>
                                </div>

                                <div class="sm:mt-0 sm:ml-16 sm:flex-none flex justify-end">
                                    <Link :href="route('backend.tasks.index')" class="mt-2 ml-3 inline-flex items-center justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto">Back</Link>
                                </div>
                            </div>

                            <div class="min-w-full overflow-hidden overflow-x-auto align-middle px-4">
                                <form  @submit.prevent="submit">
                                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>

                                            <div class="mt-1">
                                                <input type="text" id="title" v-model="form.title" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                                                <span v-if="form.errors.title" class="text-red-600">{{ form.errors.title }}</span>
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-6 mt-3">
                                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>

                                            <div class="mt-1">
                                                <textarea id="description" v-model="form.description" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                                <span v-if="form.errors.description" class="text-red-600">{{ form.errors.description }}</span>
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-6 mt-3">
                                            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>

                                            <div class="mt-1">
                                                <input type="datetime-local" id="deadline" v-model="form.deadline" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                                <span v-if="form.errors.deadline" class="text-red-600">{{ form.errors.deadline }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-4">
                                        <div class="flex justify-end">
                                            <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import {useToast} from "vue-toastification";

    const toast = useToast();

    const form = useForm({
        title: '',
        description: '',
        deadline: '',
    });

    const submit = () => {
        form.post(route('backend.tasks.store'), {
            onSuccess: (success) => {
                toast('Data has been added successfully.');
            },
            onError: (error) => {
                toast.error('Something went wrong. Please try again.');
            }
        });
    };
</script>
