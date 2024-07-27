<template>
  <!-- Breadcrumb End -->

<div>
     <!-- Display success and error messages -->
      <!-- Display success and error messages -->
      <div class="relative mt-4" v-if="successMessage || errorMessage">
        <div v-if="successMessage" class="px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
          <strong class="font-bold">Success!</strong>
          <span class="block sm:inline">{{ successMessage }}</span>
        </div>
        <div v-if="errorMessage" class="px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert" style="background-color: #EB5406;color:white">
          <strong class="font-bold">Error!</strong>
          <span class="block sm:inline">{{ errorMessage }}</span>
        </div>
      </div>
     <!-- Your existing code -->

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="flex flex-col items-center justify-center px-6 mx-auto md:h-screen lg:py-0">
          <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
              <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                  <!-- Your form -->
                  <form @submit.prevent="registerUser" class="space-y-4 md:space-y-6">
                    <div>
                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                      <input type="text" name="name" id="name" v-model="name" placeholder="Your name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input type="email" name="email" id="email" v-model="email" placeholder="name@company.com" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" v-model="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <div>
                      <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                      <input type="password" name="confirm-password" id="confirm-password" v-model="confirmPassword" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                     
                      <!-- Loading spinner -->
                      <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 relative" style="background-color:#2F539B;">
                          <span v-if="!isLoading">Create an account</span>
                          <span v-else>
                              <svg class="animate-spin h-5 w-5 absolute top-1/2 left-1/2 -mt-2.5 -ml-2.5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A8.001 8.001 0 014.707 4.706l-.707.707A9.956 9.956 0 004 12h4v-.291zm6.585-1.414l.707-.707A7.96 7.96 0 0012 4.01V4c4.411 0 8 3.589 8 8h-4v-.001l-.002.001-2.002.002-.002 2.002h-.002A7.96 7.96 0 0012 20v-4c.01-1.122.448-2.176 1.226-2.973z"></path>
                              </svg>
                          </span>
                      </button>
                      <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Arleady have an Account?  <router-link to="/" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign in here</router-link>
                      </p>

                      <!-- Your form footer -->
                  </form>
              </div>
          </div>
      </div>
    </section>

  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';


axios.defaults.baseURL = 'http://localhost:8000';

const name = ref('');
const email = ref('');
const password = ref('');
const confirmPassword = ref('');
const successMessage = ref('');
const errorMessage = ref('');
const isLoading = ref(false); // Loading state


const registerUser = async () => {
  isLoading.value = true; // Set loading state to true
  if (password.value !== confirmPassword.value) {
    errorMessage.value = "Passwords don't match";
    isLoading.value = false; // Reset loading state
    return;
  }

  try {
    const response = await axios.post('/api/registerv2', {
      name: name.value,
      email: email.value,
      password: password.value
    });

    // Assuming the response contains user data
    const { user } = response.data;

    // Reset form fields
    name.value = '';
    email.value = '';
    password.value = '';
    confirmPassword.value = '';

    // Display success message
    successMessage.value = 'Registration successful';
    
    // Handle success, e.g., redirect user
    console.log('Account created successful', user);
  } catch (err) {
    // Handle registration error
    errorMessage.value = err.response.data.message || 'Wrong! Registration failed';
  } finally {
    isLoading.value = false; // Reset loading state
  }
};
</script>
