<template>
    <div class="dashboard">
      <div class="flex mt-16">
        <!-- Sidebar -->
        <div class="w-1/2 md:w-1/4 lg:w-1/5 min-h-screen text-white bg-gray-800 text-white p-4 fixed" style="background-color:teal;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
          <!-- Sidebar content here... -->
          <div class="mb-4">
            <p class="text-2xl font-bold">ON-TRENDING</p>
          </div>
          <ul class="space-y-2">
            <hr>
            <li>
              <a href="/dashboard" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
                <i class="fa fa-reply" style="font-size:36px"></i>
              </a>
            </li>
            <!-- Add other list items as needed -->
          </ul>
        </div>
  
        <!-- Main Section -->
        <div class="w-1/2 md:w-3/4 lg:w-4/5 p-4 ml-auto relative" style="background-color:white">
          <!-- Add New Detail button -->
  
          <!-- Main section content here... -->
          <main>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <RouterLink to="/addnewdetail"><button class="bg-teal-500 text-white px-4 py-2 rounded-full absolute  right-4" style="background-color: teal;">Add New Detail</button></RouterLink>
                <br>
                <div class="relative mb-4 flex w-full flex-wrap items-stretch" style="margin-top: 50px">
                  <input
                    type="search"
                    class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="button-addon1" />
              
                  <!--Search button-->
                  <button
                    class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                    type="submit" placeholder="Search"
                    data-te-ripple-init
                    data-te-ripple-color="light" style="background-color: teal;color:white;">
                    Search
                  </button>
                </div>
              <!-- Table content here... -->
              <table class="w-full text-sm text-left rtl:text-right  text-gray-500 dark:text-gray-400" style="margin-top: 5px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Category
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
            </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Price
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
            </svg></a>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3">
                          <div class="flex items-center">
                              Description
                              <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
          </svg></a>
                          </div>
                      </th>
                      
                      <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Photo
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
        </svg></a>
                        </div>
                    </th>
            
             <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Actions
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
            </svg></a>
                            </div>
                        </th>
                
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ground in groundshop" :key="ground.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                          {{ ground.name }}
                        </th>
                        <td class="px-6 py-4">
                          {{ ground.category }}
                        </td>
                        <td class="px-6 py-4">
                          {{ ground.price }}/Tshs
                        </td>
                        <td class="px-6 py-4">
                          {{ ground.description }}
                        </td>

                        <td class="px-6 py-4">
                          <img :src="getImageUrl(ground.image)" :alt="ground.name + ' Image'" class="max-w-full h-auto" style="width: 150px;height:110px;border-radius:95%;">
                        </td>

                        <td class="px-6 py-4 text-right">
                            <button @click="deleteGround(ground.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline" style="background-color: teal;">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
          </main>
        </div>
      </div>
    </div>
  </template>
  

  <script>
  import axios from 'axios';
  import { RouterLink } from 'vue-router'; // Import correct component
  
  axios.defaults.baseURL = 'http://localhost:8000';
  
  export default {
    components: {
      RouterLink, // Register the RouterLink component
    },
    data() {
      return {
        groundshop: [],
      };
    },
    methods: {

      // Fetch grounds data
      async fetchGrounds() {
  try {
    const response = await axios.get('/api/groundshop');
    console.log('API Response:', response.data);
    this.groundshop = response.data;
  } catch (error) {
    console.error(error);
  }
},
      // Delete ground
      async deleteGround(id) {
        if (confirm('Are you sure you want to delete this ground?')) {
          try {
            await axios.delete(`/api/groundshop/${id}`);
            // Refresh the grounds list after successful deletion
            this.fetchGrounds();
          } catch (error) {
            console.error(error);
          }
        }
      },
   
      getImageUrl(imagePath) {
      return `http://localhost:8000/images/${imagePath}`;
    },


    },
    created() {
      this.fetchGrounds();
    },
  };
  </script>

  <style>
  .dashboard {
    background-color: white;
  }
  
  body {
    background-color: white;
  }
  </style>
  
 