<template>

  <div class="ourground">
   <!------search card------>
   <div class="card" style="width: 100%;margin-top:50px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;height:90px">
    <div class="mb-3">
      <div class="relative mb-4 flex w-full flex-wrap items-stretch" style="width: 900px;margin-left:70px">
        <input
          type="search"
          class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
          placeholder="Search"
          aria-label="Search"
          aria-describedby="button-addon3" style="margin-top: 17px;" />
  
        <!--Search button-->
        <button
          class="relative z-[2] rounded-r border-2 border-primary px-6 py-2 text-xs font-medium uppercase text-primary transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
          type="button"
          id="button-addon3"
          data-te-ripple-init  style="margin-top: 17px;">
          <i class="fa fa-search" style="font-size:24px"></i>
        </button>
             <span style="margin-left: 10px;margin-top:20px"><i class="fa fa-cart-arrow-down" style="font-size:36px"></i></span>
      </div>
    </div>
  </div>

    <div class="flex flex-wrap justify-center">
      <div v-for="ground in groundshop" :key="ground.id" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-4">
        <a :href="'/ground/' + ground.id">
          <img :src="getImageUrl(ground.image)" :alt="ground.name + ' Image'" class="max-w-full h-auto" style="width: 100%;height:190px;border-radius:6%;">
        </a><hr><br>
        <div class="px-5 pb-5">
          <a :href="'/ground/' + ground.id">
         <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"> Name: {{ ground.name }}</h5>
          </a><br>
          <p style="color: teal;">  Description: {{ ground.description }}</p><br>
          <div class="flex items-center mt-2.5 mb-5">
            <div class="flex items-center space-x-1 rtl:space-x-reverse">
              <svg v-for="star in 5" :key="star" class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
              </svg>
            </div>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">Category: {{ ground.category }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ ground.price }}/Tshs</span>
            <router-link :to="'/cart/' + ground.id + '/added-to-yourcartv1'"><button  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to <i class="fa fa-cart-plus" style="font-size:20px"></i></button></router-link>
          </div>
        </div>
      </div>
    </div>

  </div>
  </template>

  
  <script>
  import axios from 'axios';
  
  axios.defaults.baseURL = 'http://localhost:8000';
  
  export default {
    data() {
      return {
        groundshop: [],
      };
    },
    methods: {
      async fetchGrounds() {
        try {
          const response = await axios.get('/api/groundshop');
          this.groundshop = response.data;
        } catch (error) {
          console.error(error);
        }
      },
      getImageUrl(imagePath) {
        return `http://localhost:8000/images/${imagePath}`;
      },
      addToCart(ground) {
        // Add your logic to add the ground to the cart here
        console.log('Adding ground to cart:', ground);
      },
    },
    created() {
      this.fetchGrounds();
    },
  };
  </script>
  