
<template>
    <div class="dashboard">
        <!-- index.html or your Vue/React/Angular template file -->

<div class="flex" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
    <!-- Sidebar -->
    <div class="w-1/2 md:w-1/4 lg:w-1/5 min-h-screen text-white bg-gray-800 text-white p-4 fixed" style="margin-top:60px;background-color:teal;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
      <!-- Sidebar content here... -->
      <div class="mb-4">
        <p class="text-2xl font-bold"><i class="fa fa-dashboard" style="font-size:36px"></i></p>
      </div>
      <ul class="space-y-2" style="margin-top:10px">
          <hr>
          <li>
            <a href="/playgroundaccount" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
              <i class="fa fa-reorder" style="font-size:24px"></i>ShopAccount-1
            </a>
          </li>
          <li>
            <a href="/shopaccount" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
              <i class="fa fa-reorder" style="font-size:24px"></i>ShopAccount-2
            </a>
        </li>
        <li>
          <a href="/orders" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
            <i class="fa fa-reorder" style="font-size:24px"></i>Orders-Account
          </a>
      </li>
      <li>
        <a href="/view-sales" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
          <i class="fa fa-reorder" style="font-size:24px"></i>Sales-Account
        </a>
      </li>
      <li>
        <a href="#" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
          <i class="fa fa-reorder" style="font-size:24px"></i>StockAccount
        </a>
      </li>
      <li>
        <a href="#" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
          <i class="fa fa-reorder" style="font-size:24px"></i>VendorsAccount
        </a>
      </li>
      <li>
        <a href="/shopaccount" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
          <i class="fa fa-reorder" style="font-size:24px"></i>ExpensesAccount
        </a>
    </li>
          <li>
            <a href="#" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
              <i class="fa fa-reorder" style="font-size:24px"></i>ServiceMan-Account
            </a>
          </li>
      </ul>
    </div>
  
    <!-- Main Section -->
    <div class="w-full ml-0 md:ml-1/4 lg:ml-1/5 p-4" style="background-color:white">
      <!-- Main section content here... -->
      <main>
         <div style="margin-left: 900px;">
              <a href="#" class="text-success"><i class="fa fa-wrench" style="font-size:20px"></i></a>
              <a href="" class="text-success" style="margin-left: 50px;"  @click="logout"><i style="font-size:24px" class="fa">&#xf08b;</i></a>
            </div>
      </main>
      
    </div>
  </div>
  

     <!------------------for displayed cards -->
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4  gap-4" style="margin-top:90px;height:160px">
        <!-- Displayed Cards -->
        <div class="">
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <!-- Card 2 content -->
          NNNNNNNNNNNNNNNNN
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <!-- Card 3 content -->
          NBBBBBBBBBBBBBBB
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <!-- Card 4 content -->
          BBBBBBBBBBB
        </div>
      </div>
  
    </div>
</template>

<script>
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000'; // Update with your Laravel server URL

export default {
  data() {
    return {
      user: null,
    };
  },
  methods: {

    logout() {
      this.$router.push('/login');
    },

  },
};
</script>

<style>
.dashboard{
    background-color: white;
}
body{
    background-color: white;
}
</style>
