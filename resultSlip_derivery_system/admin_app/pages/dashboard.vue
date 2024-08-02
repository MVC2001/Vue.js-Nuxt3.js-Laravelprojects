<template>
  <div class="flex h-screen">
    <aside class="fixed inset-y-0 left-0 w-64 px-4 py-8 overflow-y-auto bg-teal-800 lg:static lg:block" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-white">{{ userEmail }}</h2>
        <button @click="toggleSidebar" class="text-white lg:hidden">
          <span v-if="sidebarVisible">✖</span>
          <span v-else>☰</span>
        </button>
      </div>
      <nav v-show="sidebarVisible" class="mt-8 space-y-2 lg:space-y-0 lg:mt-0" style="margin-top:40px">
        <router-link to="/dashboard" class="block px-4 py-2 mt-2 text-sm font-semibold text-white bg-gray-700 rounded-lg hover:bg-gray-600">Dashboard</router-link>
        <router-link to="/applcants" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">Applications</router-link>
        <router-link to="/students" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">Users</router-link>
        <router-link to="/sleeps" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">Slips</router-link>
        <router-link to="/histories" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">History</router-link>
      </nav>
    </aside>

    <div class="flex flex-col flex-1 ml-64 lg:ml-0">
      <header class="flex items-center justify-between p-4 text-white bg-teal-800" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
        <h1 class="text-2xl">ONLINE RESULT SLIP DERIVERY SYSTEM</h1>
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
        <div class="container mx-auto">
          <div class="flex flex-wrap -mx-2">
            <div class="w-full px-2 mb-4 md:w-1/4">
              <div class="shadow-sm card">
                <div class="p-4 card-body" style="height: 130px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                  <h5 class="text-lg font-bold text-center text-teal-800 card-title">Students</h5>
                  <a href="#" class="block text-lg font-bold text-center text-teal-800 btn btn-primary">6533692</a>
                </div>
              </div>
            </div>
            <div class="w-full px-2 mb-4 md:w-1/4">
              <div class="shadow-sm card">
                <div class="p-4 card-body" style="height: 130px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                  <h5 class="text-lg font-bold text-center text-teal-800 card-title">Slips</h5>
                  <a href="#" class="block text-lg font-bold text-center text-teal-800 btn btn-primary">6692</a>
                </div>
              </div>
            </div>
            <div class="w-full px-2 mb-4 md:w-1/4">
              <div class="shadow-sm card">
                <div class="p-4 card-body" style="height: 130px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                  <h5 class="text-lg font-bold text-center text-teal-800 card-title">Applications</h5>
                  <a href="#" class="block text-lg font-bold text-center text-teal-800 btn btn-primary">612</a>
                </div>
              </div>
            </div>
            <div class="w-full px-2 mb-4 md:w-1/4">
              <div class="shadow-sm card">
                <div class="p-4 card-body" style="height: 130px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                  <h5 class="text-lg font-bold text-center text-teal-800 card-title">Histories</h5>
                  <a href="#" class="block text-lg font-bold text-center text-teal-800 btn btn-primary">7712</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

// Set the base URL for Axios
axios.defaults.baseURL = 'http://127.0.0.1:8000';

const userEmail = ref('');
const dropdownVisible = ref(false);
const sidebarVisible = ref(true);
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
    console.error('Logout failed:', error.response.data.message);
  }
};

onMounted(() => {
  fetchUserEmail();
});
</script>

<style scoped>
</style>
