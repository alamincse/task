<template>
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-indigo-600 px-6 pb-4">
            <div class="flex h-16 shrink-0 items-center">
                <h1 class="text-white">Task Management System</h1>
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li>
                                <Link :href="route('backend.dashboard')" class="text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold hover:text-white hover:bg-indigo-700">
                                    <component :is="HomeIcon" class="text-indigo-200 group-hover:text-white h-6 w-6 shrink-0" aria-hidden="true" />
                                    Dashboard
                                </Link>
                            </li>

                            <li>
                                <Link :href="route('backend.users.index')" class="text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold hover:text-white hover:bg-indigo-700">
                                    <component :is="UsersIcon" class="text-indigo-200 group-hover:text-white h-6 w-6 shrink-0" aria-hidden="true" />
                                    User List
                                </Link>
                            </li>

                            <li>
                                <Link :href="route('backend.tasks.index')" class="text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold hover:text-white hover:bg-indigo-700">
                                    <component :is="FolderIcon" class="text-indigo-200 group-hover:text-white h-6 w-6 shrink-0" aria-hidden="true" />
                                    Task List
                                </Link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
    import {
        FolderIcon,
        HomeIcon,
        UsersIcon,
    } from '@heroicons/vue/24/outline'

    import { Link } from '@inertiajs/vue3';
</script>
