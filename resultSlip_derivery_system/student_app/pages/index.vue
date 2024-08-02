<template>
  <div class="auth-page">
    <div>
      <div class="h-10 text-center text-white bg-teal-800 shadow-lg card">
       <h2 style="font-weight: bold;font-size:large;">ONLNE SCHOOL RESULT SLIP DERIVERY SYSTEM</h2>
      </div>
    </div>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-full max-w-md p-8 bg-white rounded shadow">
        <h1 class="mb-6 text-2xl font-bold text-center">Student Login</h1>
        
        <!-- Validation Error Alert -->
        <div v-if="validationError" class="flex items-center p-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 10-12.728 0 9 9 0 0012.728 0zM12 12v.01M12 15h.01"></path></svg>
          <span>{{ validationError }}</span>
        </div>
  
        <form @submit.prevent="login">
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" v-model="email" required class="w-full px-3 py-2 border rounded" />
          </div>
          <div class="mb-4">
            <label for="password" class="block text-gray-700">Password:</label>
            <input type="password" v-model="password" required class="w-full px-3 py-2 border rounded" />
          </div>
          <button type="submit" class="w-full py-2 text-white bg-teal-800 rounded hover:bg-blue-600">
            <span v-if="loading" class="loader"></span>
            <span v-else>Login</span>
          </button>
          <p style="margin-top: 20px;">Do you have an account? <a href="register">Register<br></a></p>
           
          <p style="margin-top: 10px;margin-left:150px;color:navy">Reset password <a href="reset">here</a></p>
        </form>
      </div>
    </div>
  </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  // Set the base URL for Axios
  axios.defaults.baseURL = 'http://127.0.0.1:8000';
  
  const email = ref('');
  const password = ref('');
  const loading = ref(false);
  const validationError = ref('');
  const router = useRouter();
  
  const login = async () => {
    loading.value = true;
    validationError.value = '';
    try {
      const response = await axios.post('/api/student/login', {
        email: email.value,
        password: password.value,
      });
      localStorage.setItem('token', response.data.access_token);
      router.push('/dashboard');
    } catch (error) {
      validationError.value = 'Invalid email or password';
      console.error('Login failed:', error.response.data.message);
    } finally {
      loading.value = false;
    }
  };
  </script>
  
  <style scoped>
  .loader {
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    border-top: 2px solid #fff;
    width: 16px;
    height: 16px;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
  