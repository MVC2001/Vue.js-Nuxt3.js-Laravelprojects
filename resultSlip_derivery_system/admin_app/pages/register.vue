<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-full max-w-md p-8 bg-white rounded shadow">
        <h1 class="mb-6 text-2xl font-bold text-center">Register</h1>
        
        <!-- Success Alert -->
        <div v-if="successMessage" class="flex items-center p-2 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          <span>{{ successMessage }}</span>
        </div>
        
        <!-- Validation Error Alert -->
        <div v-if="validationError" class="flex items-center p-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 10-12.728 0 9 9 0 0012.728 0zM12 12v.01M12 15h.01"></path></svg>
          <span>{{ validationError }}</span>
        </div>
  
        <!-- Email Exists Error Alert -->
        <div v-if="emailExistsError" class="flex items-center p-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 10-12.728 0 9 9 0 0012.728 0zM12 12v.01M12 15h.01"></path></svg>
          <span>{{ emailExistsError }}</span>
        </div>
    
        <form @submit.prevent="register">
          <div class="mb-4">
            <label for="name" class="block text-gray-700">Name:</label>
            <input type="text" v-model="name" required class="w-full px-3 py-2 border rounded" />
          </div>
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
            <span v-else>Register</span>
          </button>
          <p style="margin-top: 20px;">Already have an account? <a href="/">Login</a></p>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  // Set the base URL for Axios
  axios.defaults.baseURL = 'http://127.0.0.1:8000';
  
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const loading = ref(false);
  const validationError = ref('');
  const emailExistsError = ref('');
  const successMessage = ref('');
  const router = useRouter();
  
  const validateForm = () => {
    if (!/.+@.+\..+/.test(email.value)) {
      validationError.value = 'Please enter a valid email address.';
      return false;
    }
    if (password.value.length < 8) {
      validationError.value = 'Password must be at least 8 characters long.';
      return false;
    }
    validationError.value = '';
    return true;
  };
  
  const register = async () => {
    if (!validateForm()) {
      return;
    }
    loading.value = true;
    try {
      await axios.post('/api/register', {
        name: name.value,
        email: email.value,
        password: password.value,
      });
      successMessage.value = 'Registration successful! Please check your email to confirm your account.';
      emailExistsError.value = '';
      router.push('/');
    } catch (error) {
      if (error.response && error.response.data.message && error.response.data.message.email) {
        emailExistsError.value = 'The email has already been taken.';
      } else {
        console.error('Registration failed:', error.response.data.message);
      }
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
  