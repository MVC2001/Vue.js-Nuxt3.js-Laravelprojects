<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 text-gray-100 bg-gray-800 lg:block" style="height:700px">
      <!-- Sidebar content -->
      <div class="flex flex-col justify-between h-full">
        <!-- Sidebar content -->
        <nav class="py-5 p-7" style="margin-top: 90px;">
          <ul class="py-4">
            <li>
              <nuxt-link to="/dashboard" class="block px-6 py-2 shadow-md hover:bg-gray-700">AdminDashboard</nuxt-link>
            </li>
            <br>
            <li>
              <nuxt-link to="/reset_password" class="block px-6 py-2 hover:bg-gray-700">Reset-Password</nuxt-link>
            </li>
          </ul>
        </nav>
        <!-- End of sidebar content -->
      </div>
    </aside>

    <!-- Mobile Sidebar -->
    <aside class="fixed top-0 left-0 z-50 w-64 h-screen text-gray-100 bg-gray-800" :class="{ 'block': isSidebarOpen, 'hidden': !isSidebarOpen }">
      <div class="flex flex-col justify-between h-full">
        <!-- Sidebar content -->
        <nav class="py-5 p-7" style="margin-top: 60px;">
          <ul class="py-4">
            <li>
              <nuxt-link to="" class="block px-6 py-2 hover:bg-gray-700">Reset-Password</nuxt-link>
            </li>
            <li>
              <nuxt-link to="/dashboard" class="block px-6 py-2 shadow-md hover:bg-gray-700">AdminDashboard</nuxt-link>
            </li>
          </ul>
        </nav>
        <!-- End of sidebar content -->
      </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-4 overflow-auto shadow-sm">
      <!-- Top navigation -->
      <header class="flex items-center justify-between p-4 bg-white border-b border-gray-200">
        <div>
          <!-- Cancel button when sidebar is open -->
          <button v-if="isSidebarOpen" @click="toggleSidebar" class="block text-gray-600 lg:hidden hover:text-gray-800 focus:outline-none">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
          <!-- Navigation button when sidebar is closed -->
          <button v-else @click="toggleSidebar" class="block text-gray-600 lg:hidden hover:text-gray-800 focus:outline-none">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path :class="{ 'hidden': isSidebarOpen, 'block': !isSidebarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              <path :class="{ 'hidden': !isSidebarOpen, 'block': isSidebarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
          <h1 class="text-xl font-bold">All Facilities</h1>
        </div>
      </header>
      <!-- End of top navigation -->

      <!-- Page content -->
      <div class="flex justify-center p-4">
        <!-- Search form -->
        <div class="w-full max-w-lg mb-4 bg-gray-800 shadow-sm sm:mb-0">
          <input type="text" v-model="searchQuery" @input="searchFacilities" placeholder="Search by category or place" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
      </div>

      <div>
        <nuxt-link to="/facilities/create" class="block px-6 py-2 shadow-md hover:bg-gray-700"><button
  type="button"
  class="inline-block rounded-full bg-gray-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-dark-3 transition duration-150 ease-in-out hover:bg-neutral-700 hover:shadow-dark-2 focus:bg-neutral-700 focus:shadow-dark-2 focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-dark-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" style="width: 250px;">
  Add-new-facility
</button></nuxt-link>
      </div>

      <!-- Table -->
      <div class="flex items-center justify-center py-3" >
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-6">
            <div class="overflow-hidden">
              <table class="min-w-full text-sm text-center font-success text-surface dark:text-white">
                <!-- Table headers -->
                <thead class="font-medium text-white bg-gray-800 border-b border-neutral-100 dark:border-white/10">
                  <tr>
                    <th scope="col" class="px-6 py-4 ">Place</th>
                    <th scope="col" class="px-6 py-4 ">HealthCenter</th>
                    <th scope="col" class="px-6 py-4 ">Service</th>
                    <th scope="col" class="px-6 py-4 ">Contact</th>
                    <th scope="col" class="px-6 py-4 ">Description</th>
                    <th scope="col" class="px-6 py-4 ">WebLink</th>
                    <th scope="col" class="px-6 py-4 ">Photo</th>
                    <th scope="col" class="px-6 py-4 ">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Table rows -->
                  <tr v-for="facility in filteredFacilities" :key="facility.id" class="border-b border-neutral-200 dark:border-white/10">
                    <td class="px-6 py-4 whitespace-nowrap ">{{ facility.place }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ facility.category }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ facility.service }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ facility.contact }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ facility.description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ facility.websiteLink }}</td>
                    <td class="px-6 py-4 whitespace-nowrap"><img :src="getImageUrl(facility.image)" alt="Facility Image" style="max-width: 100px; max-height: 100px;" /></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <!-- Action buttons -->
                      <NuxtLink :to="`/facilities/${facility.id}`" class="px-3 py-1 text-white bg-green-500 rounded-md hover:bg-green-600">Edit</NuxtLink>
                      <button type="button" @click="deleteFacility(facility.id)" class="px-3 py-1 ml-2 text-white bg-red-500 rounded-md hover:bg-red-600">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      
    </main>
      <!-- End of Table -->

      <!-- Nuxt component -->
      <nuxt/>
    </div>
    <!-- End of Page content -->
  
  <!-- End of Main content -->
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';

const searchQuery = ref('');
const facilities = ref([]);
const filteredFacilities = ref([]);
const isSidebarOpen = ref(false);

// Fetch facilities
const fetchFacilities = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/facilities');
    facilities.value = response.data;
    filteredFacilities.value = response.data;
  } catch (error) {
    console.error('Error fetching facilities:', error);
  }
};

// Watch for changes in searchQuery and filter facilities accordingly
watch(searchQuery, (newValue, oldValue) => {
  filterFacilities(newValue);
});

// Filter facilities based on searchQuery
const filterFacilities = (query) => {
  if (!query) {
    filteredFacilities.value = facilities.value;
  } else {
    const filtered = facilities.value.filter((facility) => {
      return (
        facility.category.toLowerCase().includes(query.toLowerCase()) ||
        facility.place.toLowerCase().includes(query.toLowerCase())
      );
    });
    filteredFacilities.value = filtered;
  }
};

// Delete facility
const deleteFacility = async (id) => {
  try {
    await axios.delete(`http://127.0.0.1:8000/api/facilities/${id}`);
    await fetchFacilities();
  } catch (error) {
    console.error('Error deleting facility:', error);
  }
};

// Get image URL
const getImageUrl = (image) => {
  return `http://127.0.0.1:8000/images/${image}`;
};

// Toggle Sidebar
function toggleSidebar() {
  isSidebarOpen.value = !isSidebarOpen.value;
}

fetchFacilities();
</script>

<style>
/* Your custom styles here */
</style>
