<template>
  <DefaultLayout>
    <div>
      <section class="w-full" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;;background-color:white;height:400px">
        <div >
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Reset your password here
          </h1>
          <form @submit.prevent="resetPassword" style="margin-left:20px;width:95%">
            <div class="mb-4">
              <label for="Name" class="block mb-1 text-sm text-gray-600">Email</label>
              <input type="email" name="email" id="email" v-model="email" required
                class="w-full px-4 py-2 text-base border border-gray-300 rounded outline-none focus:ring-blue-500 focus:border-blue-500 focus:ring-1"
                placeholder="Enter Your email" />
              <span class="inline-flex text-sm text-red-700" style="color:red">Please Enter valid email!
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </span>
            </div>
            <div class="mb-4">
              <label for="password" class="block mb-1 text-sm text-gray-600">Current password</label>
              <input type="password" name="current-password" id="current-password" v-model="currentPassword" required
                class="w-full px-4 py-2 text-base border border-gray-300 rounded outline-none focus:ring-blue-500 focus:border-blue-500 focus:ring-1"
                placeholder=" Enter current Password" />
              <span class="inline-flex text-sm text-red-700" style="color:red">Please Enter valid current  password
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </span>
            </div>

            <div class="mb-4">
              <label for="password" class="block mb-1 text-sm text-gray-600">New password</label>
              <input type="password" name="new-password" id="new-password" v-model="newPassword" required
                class="w-full px-4 py-2 text-base border border-gray-300 rounded outline-none focus:ring-blue-500 focus:border-blue-500 focus:ring-1"
                placeholder=" Enter new Password" />
              <span class="inline-flex text-sm text-red-700" style="color:red">Please   Enter valid new password
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </span>
            </div>
            <button type="submit"
              class="w-400 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
              style="background-color:#162834;margin-left:600px;">Reset Password</button>
          </form>
         
        </div>
      </section>


    </div>
  </DefaultLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import DefaultLayout from '@/layouts/DefaultLayout.vue'

axios.defaults.baseURL = 'http://localhost:8000';

const email = ref('');
const currentPassword = ref('');
const newPassword = ref('');


const resetPassword = async () => {
  try {
    // Fetch authentication token from local storage
    const token = localStorage.getItem('token');

    // Make request to update password with authentication token included in headers
    await axios.post('/api/update-passwordv2', {
      current_password: currentPassword.value,
      new_password: newPassword.value
    }, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    // Reset form fields
    currentPassword.value = '';
    newPassword.value = '';

    // To display alerts
    alert('Password reset successful!');
  } catch (error) {
    console.error('Error resetting password:', error);
    alert('Password reset failed. Please try again.');
  }
}
</script>
