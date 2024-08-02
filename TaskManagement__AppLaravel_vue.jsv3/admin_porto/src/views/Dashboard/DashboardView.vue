<template>
  <DefaultLayout v-if="isLoggedIn">
    <!-- Navbar with card and dropdown -->
    <nav class="bg-white shadow-lg">
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <!-- Logo -->
          <!-- Navigation links -->
          <div class="flex">
            <div class="hidden sm:-my-px sm:ml-6 sm:flex">
              <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 transition duration-150 ease-in-out border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">Dashboard</a>
              <!-- Add more links here -->
            </div>
          </div>
          <!-- Dropdown card -->
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <div class="relative ml-3">
              <div>
                <button @click="dropdownOpen = !dropdownOpen" type="button" class="inline-flex items-center justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-lg bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700" id="options-menu" aria-haspopup="true" aria-expanded="true" style="background-color:  #162834;">
                  {{ userEmail }}
                  <!-- Heroicon name: solid/chevron-down -->
                  <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                </button>
              </div>
              <!-- Dropdown card -->
              <div v-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 w-48 mt-2 origin-top-right rounded-md shadow-lg">
                <div class="py-1 bg-white rounded-md shadow-xs">
                  <a @click="logout" href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- End of Navbar -->

    <!-- Main content -->
    <div class="grid grid-cols-1 py-5 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
      <!-- DataStatsOne component -->
      <DataStatsOne />
    </div>
    <!-- End of Main content -->
  </DefaultLayout>
  <div v-else>
    <p style="padding:0px 40px 30px;height:50px;width:100%;background:#B64027;color:white" class="shadow-lg">Wrong!!. you cannot access this dashboard without log in. Please provide valide cridental then log in to access the dashboard.</p>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import DataStatsOne from '@/components/DataStats/DataStatsOne.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import { useRouter } from 'vue-router';

// Data variable for controlling dropdown visibility
const dropdownOpen = ref(false)
const router = useRouter();

// Variable to hold the logged-in user's email
const userEmail = ref('');
// Variable to track login status
const isLoggedIn = ref(false);

// Method to handle logout
const logout = async () => {
  try {
    // Get the token from localStorage
    const token = localStorage.getItem('token');

    const response = await fetch('http://127.0.0.1:8000/api/logoutv2', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        // Add authorization header with token
        'Authorization': `Bearer ${token}`
      },
    });

    // Check if logout was successful
    if (response.ok) {
      // Invalidate token on the client side
      localStorage.removeItem('token');
      
      // Redirect to sign-in page after successful logout
      router.push('/');
      console.log('Logout successful');
    } else {
      // Handle logout failure
      console.error('Logout failed', response.status, response.statusText);
    }
  } catch (error) {
    // Handle network errors
    console.error('Network error:', error);
  }
};

// Fetch the logged-in user's email on component mount
onMounted(async () => {
  try {
    // Get the token from localStorage
    const token = localStorage.getItem('token');

    const response = await fetch('http://127.0.0.1:8000/api/user/name', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        // Add authorization header with token
        'Authorization': `Bearer ${token}`
      },
    });

    if (response.ok) {
      const data = await response.json();
      userEmail.value = data.email; // Assuming the API response has the user's email under the key 'name'
      isLoggedIn.value = true;
    } else {
      console.error('Failed to fetch user email:', response.status, response.statusText);
    }
  } catch (error) {
    console.error('Network error:', error);
  }
});
</script>
