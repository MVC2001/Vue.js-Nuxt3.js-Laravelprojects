<template>
  <div class="relative" ref="target">
    <router-link
      class="flex items-center gap-4"
      to="#"
      @click.prevent="dropdownOpen = !dropdownOpen"
    >
      <span class="hidden text-right lg:block">
        <span class="block text-sm font-medium text-black dark:text-white">{{ userEmail }}</span>
      </span>

      <span class="h-12 w-12 rounded-full">
        <img src="@/assets/images/user/user-01.png" alt="User" />
      </span>

      <svg
        :class="dropdownOpen && 'rotate-180'"
        class="hidden fill-current sm:block"
        width="12"
        height="8"
        viewBox="0 0 12 8"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
          fill=""
        />
      </svg>
    </router-link>

    <!-- Dropdown Start -->
    <div
      v-show="dropdownOpen"
      class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
    >
      <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-7.5 dark:border-strokedark">
        <li>
          <button
            @click="logout"
            class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base"
          >
            <svg
              class="fill-current"
              width="22"
              height="22"
              viewBox="0 0 22 22"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <!-- Logout icon -->
            </svg>
            Log Out
          </button>
        </li>
      </ul>
      <!-- Account settings dropdown options -->
    </div>
    <!-- Dropdown End -->
  </div>
</template>

<script setup lang="ts">
import { onClickOutside } from '@vueuse/core'
import { ref, onMounted } from 'vue'
import axios from 'axios'

const target = ref(null)
const dropdownOpen = ref(false)
const userEmail = ref('')

onClickOutside(target, () => {
  dropdownOpen.value = false
})

const logout = async () => {
  try {
    await axios.post('http://127.0.0.1:8000/api/logoutv1')
    // handle success or redirect
  } catch (error) {
    // handle error
  }
}

const getUserEmail = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/user/name')
    userEmail.value = response.data.email
    // handle user email
  } catch (error) {
    // handle error
  }
}

onMounted(getUserEmail)
</script>
