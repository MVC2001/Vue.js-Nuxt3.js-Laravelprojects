<template>
    <DefaultLayout>
      <router-link :to="'/create-category'">
        <button class="flex justify-center w-full p-3 font-medium rounded text-gray hover:bg-opacity-90" style="background-color:#162834;">
          Add/Create new category info
        </button>
      </router-link><br><br>
      <div class="rounded-sm border border-stroke bg-white py-5 px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
        <div class="max-w-full overflow-x-auto">
          <table class="w-full table-auto">
            <thead>
              <tr class="text-left bg-gray-200 dark:bg-gray-700">
             
                <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                  Task Category
                </th>
                <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                  Supervisor
                </th>
                <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                  Description
                </th>
                <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                  Added-AT
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category, index) in categories" :key="category.id">
                <td class="px-4 py-5 pl-9 xl:pl-11">{{ category.category }}</td>
                <td class="px-4 py-5">{{ category.supervisor }}</td>
                <td class="px-4 py-5">{{ category.description }}</td>
                <td class="px-4 py-5">{{ category.created_at }}</td>
            
                <td class="px-4 py-5">
                  <div class="flex items-center space-x-3.5">
                    <button class="hover:text-primary" style="color: seagreen;" @click="updateCategory(category.id)">
                      <svg
                          class="fill-current"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                      >
                          <!-- Actual SVG for update action -->
                          <path d="M9.41 2.59L12.83 6H11v6h-4V6H5.17l3.42-3.41zM11 13v3h-3v-3H5l4-4 4 4h-3z" fill="currentColor"/>
                      </svg>
                  </button>
                  
                  <button class="hover:text-primary" style="color:#C04000;" @click="deleteCategory(category)">
                      <svg
                          class="fill-current"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                      >
                          <!-- Actual SVG for delete action -->
                          <path d="M12 5v10c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h4c1.1 0 2 .9 2 2zm-1 0H7v10h4V5z" fill="currentColor"/>
                      </svg>
                  </button>
                  
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </DefaultLayout>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import DefaultLayout from '@/layouts/DefaultLayout.vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
import { categories } from '@vueuse/core/metadata.cjs';
  
  axios.defaults.baseURL = 'http://localhost:8000';
  
  // Define types for the task object and the tasks array
  interface Categories {
      id: number;
      category: string;
      supervisor:string;
      description: string;
    }
  
  // Define a reactive reference to store data with the Sale type
  const categories = ref<Categories[]>([]);
  
  // Access the router instance
  const router = useRouter();
  
  // Fetch  data when the component is mounted
  onMounted(async () => {
    try {
      const response = await axios.get<Categories[]>('/api/categories');
      categories.value = response.data;
    } catch (error) {
      console.error('Error fetching  data:', error);
    }
  });
  
  // Function to delete 
  const deleteCategory = async (category: Categories) => {
    try {
      const response = await axios.delete(`/api/categories/${category.id}`);
      console.log(response.data.message); // Log success message
      // Remove the deleted  from the frontend list
      categories.value = categories.value.filter(s => s.id !== category.id);
    } catch (error) {
      console.error('Error deleting sale:', error);
    }
  };
  
  // Function to update a data
  const updateCategory = async (cId: number) => {
    try {
      // Fetch the  data by ID
      const response = await axios.get<Categories>(`/api/categories/${cId}`);
      const category= response.data;
  
      // Navigate to the EditSaleView component with the data as props
      router.push({ name: 'EditCategory', params: { id: cId }, state: { category} });
    } catch (error) {
      console.error('Error updating  task:', error);
    }
  };
  </script>
  