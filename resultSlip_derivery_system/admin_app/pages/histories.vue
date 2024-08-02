<template>
    <div class="flex h-screen">
      <aside :class="sidebarVisible ? 'block' : 'hidden' + ' lg:block fixed inset-y-0 left-0 w-64 px-4 py-8 overflow-y-auto bg-teal-800'" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-semibold text-white">{{ userEmail }}</h2>
          <button @click="toggleSidebar" class="text-white lg:hidden">
            <span v-if="sidebarVisible">✖</span>
            <span v-else>☰</span>
          </button>
        </div>
        <nav class="mt-8 space-y-2">
          <router-link to="/dashboard" class="block px-4 py-2 mt-2 text-sm font-semibold text-white bg-gray-700 rounded-lg hover:bg-gray-600">Dashboard</router-link>
          <router-link to="/applcants" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">Applications</router-link>
          <router-link to="/sleeps" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">Slips</router-link>
        </nav>
      </aside>
  
      <div class="flex flex-col flex-1 lg:ml-64">
        <header class="flex items-center justify-between p-4 text-white bg-teal-800" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
          <button @click="toggleSidebar" class="text-white lg:hidden">
            ☰
          </button>
          <h1 class="text-2xl">ONLINE RESULT SLIP DELIVERY SYSTEM</h1>
          <div class="relative">
            <button @click="toggleDropdown" class="p-2 bg-gray-700 rounded hover:bg-gray-600">
              {{ userEmail }} ▼
            </button>
            <div v-if="dropdownVisible" class="absolute right-0 w-48 mt-2 text-black bg-white rounded shadow-lg">
              <button @click="logout" class="block w-full px-4 py-2 text-left hover:bg-gray-200">Logout</button>
            </div>
          </div>
        </header>
  
        <main class="p-4">
          <div>
            <a href="/createSleep">
              <div type="button" class="px-4 py-2 font-bold text-white bg-teal-800 border border-teal-700 rounded card hover:bg-teal-700" style="width: 100%;">
                All  result slip histories
              </div>
            </a>
          </div>
          <div class="mb-4" style="margin-top: 20px;">
            <input v-model="searchQuery" @input="filterSleeps" type="text" placeholder="Search sleeps..." class="w-full p-2 border rounded lg:w-1/3">
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full text-center bg-white border shadow-xl">
              <thead>
                <tr>
                  <th class="px-4 py-2 border-b">Name</th>
                  <th class="px-4 py-2 border-b">Index Number</th>
                  <th class="px-4 py-2 border-b">Year</th>
                  <th class="px-4 py-2 border-b">Slip-File</th>
                  <th class="px-4 py-2 border-b">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="sleep in filteredSleeps" :key="sleep.id">
                  <td class="px-4 py-2 border-b">{{ sleep.name }}</td>
                  <td class="px-4 py-2 border-b">{{ sleep.index_number }}</td>
                  <td class="px-4 py-2 border-b">{{ sleep.year }}</td>
                  <td class="px-4 py-2 border-b">
                    <a :href="`/storage/${sleep.file}`" target="_blank" class="text-blue-500 hover:text-blue-700">
                      View File
                    </a>
                  </td>
                  
                  <td class="px-4 py-2 border-b">
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-teal-800 border border-teal-700 rounded hover:bg-teal-700">{{ sleep.status }}</button>
                  </td>
               
                </tr>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  axios.defaults.baseURL = 'http://127.0.0.1:8000';
  
  const userEmail = ref('');
  const dropdownVisible = ref(false);
  const sidebarVisible = ref(false);
  const sleeps = ref([]);
  const filteredSleeps = ref([]);
  const searchQuery = ref('');
  const router = useRouter();
  
  const toggleDropdown = () => {
    dropdownVisible.value = !dropdownVisible.value;
  };
  
  const toggleSidebar = () => {
    sidebarVisible.value = !sidebarVisible.value;
  };
  
  const fetchUserEmail = async () => {
    try {
      const response = await axios.get('/api/user', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      userEmail.value = response.data.email;
    } catch (error) {
      console.error('Failed to fetch user email:', error.response.data.message);
      router.push('/');
    }
  };
  
  const fetchSleeps = async () => {
    try {
      const response = await axios.get('/api/sleepsHistory', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      sleeps.value = response.data;
      filteredSleeps.value = sleeps.value;
    } catch (error) {
      console.error('Failed to fetch sleeps:', error.response.data.message);
    }
  };
  
  const filterSleeps = () => {
    filteredSleeps.value = sleeps.value.filter(sleep =>
      sleep.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      sleep.index_number.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      sleep.year.toString().includes(searchQuery.value)
    );
  };

  
  const logout = async () => {
    try {
      await axios.post('/api/logout', {}, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      localStorage.removeItem('token');
      router.push('/');
    } catch (error) {
      console.error('Failed to logout:', error.response.data.message);
    }
  };
  
  onMounted(() => {
    fetchUserEmail();
    fetchSleeps();
  });
  </script>
  
  <style>
  /* Add your custom styles here */
  </style>
  