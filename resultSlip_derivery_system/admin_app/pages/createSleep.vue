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
          <router-link to="/history" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">History</router-link>
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
            <button type="button" class="px-4 py-2 font-bold text-white bg-teal-800 border border-teal-700 rounded hover:bg-teal-700" style="width: 100%">
              Fill this form below to add new slip
            </button>
          </div>
          <div v-if="message" :class="messageClass" class="px-4 py-2 mt-4 text-white bg-teal-800 rounded" role="alert">
            <span v-if="messageType === 'success'" class="mr-2">✔️</span>
            <span>{{ message }}</span>
          </div>
          <div class="mb-4" style="margin-top: 20px;">
            <form @submit.prevent="handleSubmit">
              <div class="flex items-start p-3">
                <div class="w-40 px-3 py-2">Student fullName</div>
                <div class="flex-1">
                  <input v-model="formData.name" type="text" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm"/>
                  <span class="px-2 text-xs text-red-500">* Enter student name</span>
                </div>
              </div>
              <div class="flex items-start p-3">
                <div class="w-40 px-3 py-2">Sleep file</div>
                <div class="flex-1">
                  <input @change="handleFileChange" type="file" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm"/>
                  <span class="px-2 text-xs text-red-500">* Upload result sleep here</span>
                </div>
              </div>
              <div class="flex items-start p-3">
                <div class="w-40 px-3 py-2">Student indexNumber</div>
                <div class="flex-1">
                  <input v-model="formData.index_number" type="text" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm"/>
                  <span class="px-2 text-xs text-red-500">* Enter student indexNumber</span>
                </div>
              </div>
              <div class="flex items-start p-3">
                <div class="w-40 px-3 py-2">Year do student graduate</div>
                <div class="flex-1">
                  <input v-model="formData.year" type="text" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm"/>
                  <span class="px-2 text-xs text-red-500">* Enter student year</span>
                </div>
              </div>
              <button type="submit" class="px-4 py-2 font-bold text-white bg-teal-800 border border-teal-700 rounded hover:bg-teal-700" style="width:200px;margin-left:170px">
                Submit
              </button>
            </form>
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
  const message = ref('');
  const messageType = ref('');
  const router = useRouter();
  const formData = ref({
    name: '',
    file: null,
    index_number: '',
    year: ''
  });
  
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
  
  const handleFileChange = (event) => {
    formData.value.file = event.target.files[0];
  };
  
  const handleSubmit = async () => {
    try {
      const form = new FormData();
      form.append('name', formData.value.name);
      form.append('file', formData.value.file);
      form.append('index_number', formData.value.index_number);
      form.append('year', formData.value.year);
  
      const response = await axios.post('/api/sleeps', form, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
  
      message.value = 'Slip record created successfully';
      messageType.value = 'success';
    } catch (error) {
      if (error.response && error.response.status === 409) {
        message.value = 'Sleep record with this index number already exists';
        messageType.value = 'error';
      } else {
        message.value = 'Failed to create sleep record';
        messageType.value = 'error';
      }
    }
  };
  
  onMounted(() => {
    fetchUserEmail();
  });
  </script>
  
  <style>
  /* Add your custom styles here */
  </style>
  