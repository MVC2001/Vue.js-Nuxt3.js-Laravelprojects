<script setup lang="ts">
import { useSidebarStore } from '@/stores/sidebar'
import DarkModeSwitcher from './DarkModeSwitcher.vue'
import DropdownUser from './DropdownUser.vue'

const { isSidebarOpen, toggleSidebar } = useSidebarStore()
</script>

<template>
  <header
    class="sticky top-0 flex w-full bg-white z-999 drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none"
  >
    <div class="flex items-center justify-between flex-grow px-4 py-4 shadow-2 md:px-6 2xl:px-11">
      <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
        <!-- Hamburger Toggle BTN -->
        <button
          class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden"
          @click="
            () => {
              console.log('Toggling Sidebar')
              toggleSidebar()
            }
          "
        >
          <span class="relative block h-5.5 w-5.5 cursor-pointer">
            <span class="absolute right-0 w-full h-full du-block">
              <span
                class="relative top-0 left-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                :class="{ '!w-full delay-300': !isSidebarOpen }"
              ></span>
              <span
                class="relative top-0 left-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
                :class="{ '!w-full delay-400': !isSidebarOpen }"
              ></span>
              <span
                class="relative top-0 left-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
                :class="{ '!w-full delay-500': !isSidebarOpen }"
              ></span>
            </span>
            <span class="absolute right-0 w-full h-full rotate-45 du-block">
              <span
                class="absolute left-2.5 top-0 block h-full w-0.5 rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white"
                :class="{ '!h-0 delay-[0]': !isSidebarOpen }"
              ></span>
              <span
                class="delay-400 absolute left-0 top-2.5 block h-0.5 w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white"
                :class="{ '!h-0 dealy-200': !isSidebarOpen }"
              ></span>
            </span>
          </span>
        </button>
        <!-- Hamburger Toggle BTN -->
        <router-link class="flex-shrink-0 block lg:hidden" to="/">
          <img src="@/assets/images/logo/logo-icon.svg" alt="Logo" />
        </router-link>
      </div>
      <div class="hidden sm:block">
      </div>

   
    </div>
  </header>
</template>
