<template>
  <div>
   <div class="flex h-screen bg-gray-100" style="height: 1300px;">
     <!-- Desktop Sidebar -->
     <aside class="hidden w-64 text-gray-100 bg-gray-800 lg:block">
       <!-- Sidebar content -->
       <nav class="py-5 p-7" style="margin-top: 90px;">
         <ul class="py-4">
           <li>
             <nuxt-link to="/dashboard" class="block px-6 py-2 shadow-md hover:bg-gray-700">Admin-Dashboard</nuxt-link>
           </li>
           <br>
         </ul>
       </nav>
       <!-- End of sidebar content -->
     </aside>
 
     <!-- Mobile Sidebar -->
     <aside class="fixed top-0 left-0 z-50 w-64 h-screen text-gray-100 bg-gray-800" :class="{ 'block': isSidebarOpen, 'hidden': !isSidebarOpen }">
       <!-- Sidebar content -->
       <nav class="py-5 p-7" style="margin-top: 60px;">
         <ul class="py-4">
           <li>
             <nuxt-link to="/reset_password" class="block px-6 py-2 hover:bg-gray-700">Reset-Password</nuxt-link>
           </li>
           <li>
             <nuxt-link to="/facilities" class="block px-6 py-2 hover:bg-gray-700">Facilities</nuxt-link>
           </li>
         </ul>
       </nav>
       <!-- End of sidebar content -->
     </aside>
 
     <!-- Main content -->
     <main class="flex-1">
       <!-- Top navigation -->
       <header class="flex items-center justify-between p-4 bg-white border-b border-gray-200">
         <div>
           <!-- Cancel button when sidebar is open -->
           <button v-if="isSidebarOpen" @click="toggleSidebar" class="block text-gray-600 lg:hidden hover:text-gray-800 focus:outline-none">
             <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
             </svg>
           </button>
           <!-- Navigation button when sidebar is closed -->
           <button v-else @click="toggleSidebar" class="block text-gray-600 lg:hidden hover:text-gray-800 focus:outline-none">
             <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path :class="{ 'hidden': isSidebarOpen, 'block': !isSidebarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
               <path :class="{ 'hidden': !isSidebarOpen, 'block': isSidebarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
             </svg>
           </button>
           <h1 class="text-xl font-bold text-bg-teal-900">Edit facility</h1>
         </div>
         <!-- Logout button -->
         <NuxtLink to="/facilities" class="px-4 py-2 text-white bg-teal-500 rounded hover:bg-red-600">Back home</NuxtLink>
       </header>
       <!-- End of top navigation -->
 
       <!-- Page content -->
       <div class="p-4">
         <!-- Check if user is logged in and authenticated -->
         <div >
           <!-- Your page content goes here -->
           <div class="py-5 shadow-lg">
            <form @submit.prevent="editFunction">
              <!-- Your form content -->
              <div class="py-5 shadow-sm p-7" style="margin-top: 30px;background-color:white">

                
                <div class="flex flex-wrap py-5 -mx-3">
                  
                  <div class="w-full px-3 mb-6 sm:w-1/2">
                    <label for="place" class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Place</label>
                    <input type="text" id="place" v-model="facility.place" class="bg-green-50 border border-green-500 text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-green-100 dark:border-green-400" placeholder="">
                  </div>
                  
                  <div class="w-full px-3 mb-6 sm:w-1/2">
                      <label for="brand" class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Category</label>
                      <input type="text" id="brand" v-model="facility.category" class="bg-green-50 border border-green-500 text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-green-100 dark:border-green-400" placeholder="">
                    </div>
                    
                </div>
                <div class="flex flex-wrap -mx-3">
              
                  <div class="w-full px-3 mb-6 sm:w-1/2">
                      <label for="route" class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Service</label>
                      <input type="text" id="route" v-model="facility.service" class="bg-green-50 border border-green-500 text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-green-100 dark:border-green-400" placeholder="">
                    </div>
                    
                    <div class="w-full px-3 mb-6 sm:w-1/2">
                      <label for="price" class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Contact</label>
                      <input type="text" id="price" v-model="facility.contact" class="bg-green-50 border border-green-500 text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-green-100 dark:border-green-400" placeholder="">
                    </div>
                
                </div>


                <div class="flex flex-wrap -mx-3">
              
                  <div class="w-full px-3 mb-6 sm:w-1/2">
                      <label for="route" class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Description</label>
                      <input type="text" id="route" v-model="facility.description" class="bg-green-50 border border-green-500 text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-green-100 dark:border-green-400" placeholder="">
                    </div>
                    
                    <div class="w-full px-3 mb-6 sm:w-1/2">
                      <label for="price" class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">WebLink</label>
                      <input type="text" id="price" v-model="facility.websiteLink" class="bg-green-50 border border-green-500 text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-green-100 dark:border-green-400" placeholder="">
                    </div>
                
                </div>
                
  
                
                <div class="py-3">
                  <button type="submit" class="flex justify-center h-10 p-5 px-4 py-3 text-sm font-medium text-white transition duration-150 ease-in-out bg-teal-500 border border-transparent rounded-md w-600 hover:bg-blue-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">
                    Edit
                  </button>
                </div>
              </div>
            </form>
           </div>
           <nuxt/>
         </div>
         <!-- If user is not logged in, display alert message -->
         
       </div>
       <!-- End of page content -->
     </main>
     <!-- End of main content -->
   </div>
   </div>
  
 </template>

 <script>
 import axios from 'axios';
 import { ref, onMounted } from 'vue';
 import { useRouter } from 'vue-router';
 
 export default {
   name: 'edit facility panel',
   setup() {
     const facilityId = ref('');
     const facility = ref({});
     const isSidebarOpen = ref(false);
     const router = useRouter(); // Access the router object
 
     function toggleSidebar() {
       isSidebarOpen.value = !isSidebarOpen.value;
     }
 
     const getFacilityById = async (id) => {
       try {
         const res = await axios.get(`http://127.0.0.1:8000/api/facilities/${id}`);
         facility.value = res.data;
       } catch (error) {
         console.error('Error fetching facility ById:', error);
       }
     };
 
     const editFunction = async () => {
       try {
         // Exclude the image field from the facility data
         const { image, ...facilityData } = facility.value;
 
         const res = await axios.put(`http://127.0.0.1:8000/api/facilities/${facilityId.value}`, facilityData);
         alert(res.data.message);
 
         // Navigate to facilities page after successful update
         router.push('/facilities');
       } catch (error) {
         console.error('Error updating facility:', error);
       }
     };
 
     // Fetch facility data when component is mounted
     onMounted(() => {
       facilityId.value = router.currentRoute.value.params.id;
       getFacilityById(facilityId.value);
     });
 
     return { facilityId, facility, isSidebarOpen, toggleSidebar, editFunction };
   }
 };
 </script>

 
 

<style scoped>

</style>