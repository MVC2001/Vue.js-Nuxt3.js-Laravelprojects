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
          <router-link to="/histories" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">History</router-link>
        </nav>
      </aside>
  
      <div class="flex flex-col flex-1 lg:ml-64">
        <header class="flex items-center justify-between p-4 text-white bg-teal-800" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
          <button @click="toggleSidebar" class="text-white lg:hidden">
            ☰
          </button>
          <h1 class="text-2xl">ALL STUDENTS</h1>
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
          <div class="mb-4">
            <input v-model="searchQuery" @input="filterStudents" type="text" placeholder="Search students..." class="w-full p-2 border rounded lg:w-1/3">
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full text-center bg-white border shadow-xl">
              <thead>
                <tr>
                  <th class="px-4 py-2 border-b">Name</th>
                  <th class="px-4 py-2 border-b">Email</th>
                  <th class="px-4 py-2 border-b">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in filteredStudents" :key="student.id">
                  <td class="px-4 py-2 border-b">{{ student.name }}</td>
                  <td class="px-4 py-2 border-b">{{ student.email }}</td>
                  <td class="px-4 py-2 border-b">
                    <button @click="editStudent(student.id)" class="text-blue-500 hover:text-blue-700">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0l-10 10V15h2.414l10-10a2 2 0 000-2.828zM15 5l-9 9H5v-1l9-9h1v1zM7 14H6v1h1v-1zM4 15h1v-1H4v1zM5 16h1v-1H5v1z" />
                      </svg>
                    </button>
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
  
  // Set the base URL for Axios
  axios.defaults.baseURL = 'http://127.0.0.1:8000';
  
  const userEmail = ref('');
  const dropdownVisible = ref(false);
  const sidebarVisible = ref(false);
  const students = ref([]);
  const filteredStudents = ref([]);
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
  
  const fetchStudents = async () => {
    try {
      const response = await axios.get('/api/students', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      students.value = response.data;
      filteredStudents.value = students.value;
    } catch (error) {
      console.error('Failed to fetch students:', error.response.data.message);
    }
  };
  
  const filterStudents = () => {
    filteredStudents.value = students.value.filter(student =>
      student.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      student.email.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  };
  
  const editStudent = (id) => {
    router.push(`/students/${id}/edit`);
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
    fetchStudents();
  });
  </script>
  
  <style scoped>
  /* Add custom styles here if needed */
  </style>
  