<template>
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside :class="{ 'block': sidebarVisible, 'hidden': !sidebarVisible }" class="fixed inset-y-0 left-0 w-64 px-4 py-8 overflow-y-auto bg-teal-800 lg:static lg:block" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-white">{{ userEmail }}</h2>
        <button @click="toggleSidebar" class="text-white lg:hidden">
          <span v-if="sidebarVisible">✖</span>
          <span v-else>☰</span>
        </button>
      </div>
      <nav class="mt-8 space-y-2 lg:space-y-0 lg:mt-0" style="margin: 20px;">
        <router-link to="/dashboard" class="block px-4 py-2 mt-2 text-sm font-semibold text-white bg-gray-700 rounded-lg hover:bg-gray-600">Dashboard</router-link>
        <router-link to="/downloadSleep" class="block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-600">Result-slip</router-link>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex flex-col flex-1 lg:ml-0">
      <header class="flex items-center justify-between p-4 text-white bg-teal-800" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
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
        <!-- Success Alert -->
        <div v-if="showSuccess1" class="fixed top-0 right-0 flex items-center p-4 mt-4 mr-4 text-white bg-green-500 rounded shadow-lg">
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          {{ successMessage }}
        </div>

        <!-- Application Status -->
        <div class="container mx-auto">
          <div class="flex flex-wrap -mx-2">
            <div class="w-full px-2 mb-4">
              <div class="shadow-sm card">
                <div class="p-4 card-body" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                  <h5 class="text-lg font-bold text-center text-teal-800 card-title">APPLICATION-STATUS</h5>
                  <div class="block text-lg font-bold text-center text-teal-800">
                    <span  v-if="applicationStatus === 'sent'" style="color: #903827;">✔ Application Approved Successfully</span>
                    <span v-else>📤 Pending</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Application Form -->
        <div class="container">
          <h3 class="px-4 py-2 font-bold text-white bg-teal-800" style="margin-top: 30px;">Fill this form to apply for result slip</h3>
          <hr class="my-4"/>
          <form @submit.prevent="submitForm">
            <!-- Form Fields -->
            <div class="flex items-start p-3">
              <div class="w-40 px-3 py-2">Full Name</div>
              <div class="flex-1">
                <input v-model="form.name" type="text" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm" placeholder="e.g., Nyema Mudhi"/>
                <span class="px-2 text-xs text-red-500" v-if="errors.name">* Enter full name</span>
              </div>
            </div>

           <div class="flex items-start p-3">
  <div class="w-40 px-3 py-2">Index Number</div>
  <div class="flex-1">
    <input v-model="form.indexNumber" type="text" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm" placeholder="e.g., 0551-0072-2018"/>
    <span class="px-2 text-xs text-red-500" v-if="errors.index_number">* Enter index number</span>
      </div>
     </div>


            <div class="flex items-start p-3">
              <div class="w-40 px-3 py-2">Year</div>
              <div class="flex-1">
                <input v-model="form.year" type="date" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm"/>
                <span class="px-2 text-xs text-red-500" v-if="errors.year">* Enter the year you completed your studies</span>
              </div>
            </div>

            <div class="flex items-start p-3">
  <div class="w-40 px-3 py-2">Clearance Form</div>
  <div class="flex-1">
    <input ref="fileInput" type="file" class="w-full px-3 py-2 placeholder-gray-500 border rounded-md shadow-sm" @change="handleFileUpload"/>
    <span class="px-2 text-xs text-red-500" v-if="errors.clearance_form">* Upload clearance form</span>
  </div>
   </div>

            <button type="submit" class="px-4 py-2 font-bold text-white bg-teal-800 border border-teal-700 rounded hover:bg-teal-700">
              Apply
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
const sidebarVisible = ref(true);
const router = useRouter();
const form = ref({
  name: '',
  indexNumber: '',
  year: '',
  clearanceForm: null
});

const errors = ref({});
const successMessage = ref('');
const showSuccess1 = ref(false);
const applicationStatus = ref(''); // To store application status

const toggleDropdown = () => {
  dropdownVisible.value = !dropdownVisible.value;
};

const toggleSidebar = () => {
  sidebarVisible.value = !sidebarVisible.value;
};

const fetchUserEmail = async () => {
  try {
    const response = await axios.get('/api/student/user', {
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

const fetchApplicationStatus = async () => {
  try {
    const response = await axios.get('/api/application-status', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    });
    if (response.data.length > 0) {
      applicationStatus.value = response.data[0].status; // Adjust according to the API response structure
      if (applicationStatus.value === 'sent') {
        showSuccess.value = true;
        successMessage.value = 'Application Approved';
      } else {
        successMessage.value = 'Pending';
      }
    }
  } catch (error) {
    console.error('Failed to fetch application status:', error.response.data.message);
  }
};

const handleFileUpload = (event) => {
  form.value.clearanceForm = event.target.files[0];
};


const submitForm = async () => {
  try {
    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('index_number', form.value.indexNumber);
    formData.append('year', form.value.year);
    
    // Check if a file is selected before appending
    if (form.value.clearanceForm) {
      formData.append('clearance_form', form.value.clearanceForm);
    }

    const response = await axios.post('/api/student/apply', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    });

    if (response.status === 201) {
      showSuccess1.value = true;
      successMessage.value = 'Application Submitted Successfully!';
      errors.value = {}; // Clear errors on successful submission
      form.value = { name: '', indexNumber: '', year: '', clearanceForm: null };
      fetchApplicationStatus(); // Refresh status
    }
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Handle validation errors from the server
      errors.value = error.response.data.errors;
    } else {
      console.error('An error occurred during form submission:', error);
    }
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
  fetchApplicationStatus();
});
</script>

<style scoped>
/* Add your custom styles here */
</style>
