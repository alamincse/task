<template>
    <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
        <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
            <div class="relative flex flex-1"></div>
            <div class="flex items-center gap-x-4 lg:gap-x-6">
                <Menu as="div" class="relative">
                    <MenuButton class="-m-1.5 flex items-center p-1.5">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full bg-gray-50" :src="adminImage" alt="" />

                        <span class="hidden lg:flex lg:items-center">
                            <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                                {{ $page.props.auth.user.name }}
                            </span>

                            <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                        </span>
                    </MenuButton>

                    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                        <MenuItems class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                            <DropdownLink :href="route('logout')" method="post" as="button" class="block px-3 py-1 text-sm leading-6 text-gray-900">
                                Log Out
                            </DropdownLink>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </div>
    </div>
</template>

<script setup>
    import DropdownLink from '@/Components/DropdownLink.vue';
    import {
        Menu,
        MenuButton,
        MenuItems,
    } from '@headlessui/vue'

    import { ChevronDownIcon } from '@heroicons/vue/20/solid'

    let baseUrl = window.location.origin;
    const adminImage = baseUrl  + '/images/male.png';
</script>
