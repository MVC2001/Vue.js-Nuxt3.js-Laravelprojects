<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-full max-w-md p-8 bg-white rounded shadow">
        <h1 class="mb-6 text-2xl font-bold text-center">Reset Password</h1>
  
        <form @submit.prevent="resetPassword">
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input
              type="email"
              v-model="email"
              required
              class="w-full px-3 py-2 border rounded"
            />
          </div>
          <div class="mb-4">
            <label for="password" class="block text-gray-700">New Password:</label>
            <input
              type="password"
              v-model="password"
              required
              class="w-full px-3 py-2 border rounded"
            />
          </div>
          <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password:</label>
            <input
              type="password"
              v-model="passwordConfirmation"
              required
              class="w-full px-3 py-2 border rounded"
            />
          </div>
          <button
            type="submit"
            class="w-full py-2 text-white bg-teal-800 rounded hover:bg-teal-600"
          >
            <span v-if="loading" class="loader"></span>
            <span v-else>Update Password</span>
          </button>
          <p v-if="message" class="mt-4 text-center" :class="{ 'text-green-500': success, 'text-red-500': !success }">{{ message }}</p>
             
          <p style="margin-top: 20px;">Back <a href="/">Home</a></p>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter(); // Initialize router
  
  axios.defaults.baseURL = 'http://127.0.0.1:8000'; // Set the base URL
  
  const email = ref('');
  const password = ref('');
  const passwordConfirmation = ref('');
  const loading = ref(false);
  const message = ref('');
  const success = ref(false);
  
  const resetPassword = async () => {
    loading.value = true;
    message.value = '';
  
    if (password.value !== passwordConfirmation.value) {
      message.value = 'Passwords do not match';
      loading.value = false;
      return;
    }
  
    try {
      const response = await axios.post('/api/reset-password', {
        email: email.value,
        password: password.value,
        password_confirmation: passwordConfirmation.value,
      });
      success.value = response.data.success;
      message.value = response.data.message;
  
      if (success.value) {
        router.push('/'); // Navigate to home page on success
      }
    } catch (error) {
      console.error('Password reset failed:', error.response.data.message);
      success.value = false;
      message.value = error.response.data.message || 'An error occurred. Please try again.';
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
  