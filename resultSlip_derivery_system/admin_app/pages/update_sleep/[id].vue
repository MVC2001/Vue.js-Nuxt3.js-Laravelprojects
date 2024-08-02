<template>
    <div class="flex h-screen">
      <aside :class="sidebarVisible ? 'block' : 'hidden lg:block fixed inset-y-0 left-0 w-64 px-4 py-8 overflow-y-auto bg-teal-800'" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
        <!-- Sidebar content here -->
      </aside>
  
      <div class="flex flex-col flex-1 lg:ml-64">
        <header class="flex items-center justify-between p-4 text-white bg-teal-800" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
          <!-- Header content here -->
        </header>
  
        <main class="p-4">
          <form @submit.prevent="updateSleep">
            <div>
              <input v-model="name" type="text" placeholder="Name" class="w-full p-2 mb-2 border rounded" required />
              <input v-model="index_number" type="text" placeholder="Index Number" class="w-full p-2 mb-2 border rounded" required />
              <input v-model="year" type="text" placeholder="Year" class="w-full p-2 mb-2 border rounded" required />
              <input type="file" @change="handleFileUpload" class="w-full p-2 mb-4 border rounded" />
              <div>
                <label for="status" class="block mb-2">Status:</label>
                <select v-model="status" id="status" class="w-full p-2 mb-4 border rounded">
                  <option value="sent">Sent</option>
                  <option value="">Not Sent</option>
                </select>
              </div>
              <button type="submit" class="px-4 py-2 font-bold text-white bg-teal-800 border border-teal-700 rounded hover:bg-teal-700">
                Update Result Slip
              </button>
            </div>
          </form>
        </main>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter, useRoute } from 'vue-router';
  import axios from 'axios';
  
  axios.defaults.baseURL = 'http://127.0.0.1:8000';
  
  const userEmail = ref('');
  const dropdownVisible = ref(false);
  const sidebarVisible = ref(false);
  const name = ref('');
  const index_number = ref('');
  const year = ref('');
  const status = ref(''); // Initialize status as an empty string
  const file = ref(null);
  const router = useRouter();
  const route = useRoute();
  
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
  
  const fetchSleep = async () => {
    try {
      const response = await axios.get(`/api/sleeps/${route.params.id}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      const sleep = response.data;
      name.value = sleep.name;
      index_number.value = sleep.index_number;
      year.value = sleep.year;
      status.value = sleep.status; // Set status value
    } catch (error) {
      console.error('Failed to fetch sleep:', error.response.data.message);
      router.push('/sleeps');
    }
  };
  
  const handleFileUpload = (event) => {
    file.value = event.target.files[0];
  };
  
  const updateSleep = async () => {
    try {
      const formData = new FormData();
      formData.append('_method', 'PUT'); // Laravel uses _method for PUT requests
      formData.append('name', name.value);
      formData.append('index_number', index_number.value);
      formData.append('year', year.value);
      formData.append('status', status.value); // Include status
      if (file.value) {
        formData.append('file', file.value);
      }
  
      await axios.post(`/api/sleeps/${route.params.id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      router.push('/sleeps');
    } catch (error) {
      console.error('Failed to update sleep:', error.response.data.message);
    }
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
    fetchSleep();
  });
  </script>
  
  <style>
  /* Add your custom styles here */
  </style>
  