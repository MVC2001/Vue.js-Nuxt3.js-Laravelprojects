<template>
    <DefaultLayout>
      <!-- Breadcrumb Start -->
      <BreadcrumbDefault :pageTitle="pageTitle" />
      <!-- Breadcrumb End -->
  
      <!-- ====== Form Elements Section Start -->
      <div class="grid w-full grid-cols-1 gap-9 sm:grid-cols-1">
        <div class="flex flex-col gap-9">
          <form @submit.prevent="updateTaskCategory" class="flex flex-col w-full p-5 bg-white rounded-md shadow-lg md:p-10">
           
            <label for="category" class="mb-5">
              <span>Category</span>
              <input v-model="formData.category" type="text" name="category" id="category" class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800" placeholder="" required/>
           </label>


            <label for="supervisor" class="mb-5">
              <span>Supervisor</span>
              <input v-model="formData.supervisor" type="text" name="supervisor" id="supervisor" class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800" placeholder="" required/>
            </label>
  
            <label for="description" class="mb-5">
              <span>Description</span>
              <textarea v-model="formData.description" type="text" name="description" id="description" class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800" placeholder="" required></textarea>
            </label>
  
            <div class="flex justify-center mt-4">
              <button type="submit" class="px-6 py-2 text-white rounded-lg bg-pale-dark w-50 hover:bg-dark" style="background-color: #162834;">Edit</button>
  
              <router-link :to="'/categories'">
                <button class="px-6 py-2 text-white rounded-lg bg-pale-dark w-50 hover:bg-dark" style="background-color:#FA2A55;">Cancel</button>
              </router-link>
            </div>
          </form>
        </div>
      </div>
      <!-- ====== Form Elements Section End -->
    </DefaultLayout>
  </template>
  
  <script setup lang="ts">
  import DefaultLayout from '@/layouts/DefaultLayout.vue';
  import { ref } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';

  axios.defaults.baseURL = 'http://localhost:8000';
  
  const pageTitle = ref('Edit Sale');
  
  const router = useRouter();
  
  // Define the formData object to store form data
  const formData = ref({
    category: '',
    supervisor:'',
    description: ''
  });
  
  
  // Function to fetch data based on ID
  const fetchCategoryDataById = async () => {
    const categoryId = router.currentRoute.value.params.id;
    try {
      const response = await axios.get(`/api/categories/${categoryId}`);
      const categoryData = response.data;
      // Populate the formData object with fetched data
      formData.value = { ...categoryData };
    } catch (error) {
      console.error('Error fetching  data:', error);
    }
  };

  // Fetch task data when component is mounted
  fetchCategoryDataById();
  


  // Function to update data
  const updateTaskCategory = async () => {
    const categoryId = router.currentRoute.value.params.id;
    try {
      await axios.put(`http://127.0.0.1:8000/api/categories/${categoryId}`, formData.value);
      // Redirect to sales page after successful update
      router.push('/categories');
    } catch (error) {
      console.error('Error updating category:', error);
    }
  };
  </script>
  