<template>
    <div class="flex">
      <!-- Sidebar -->
      <div class="w-1/2 md:w-1/4 lg:w-1/5 min-h-screen text-white bg-gray-800 text-white p-4 fixed" style="background-color:teal;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
        <ul class="p-4">
          <li><a href="#">ALL SALES</a></li><hr><br>
          <li><a href="/dashboard">Back Home</a></li>
        </ul>
      </div>
      
      <!-- Main Content -->
      <div class="w-3/4 ml-auto">
        <br>
        <h1 class="text-2xl font-bold mb-4">ALL SALES</h1>
        <br>
        <div>
          <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
          <a href="/create-sales"><button type="button"  class="btn btn-primary btn-sm" style="margin-left:400px;background-color: teal;width:200px;height:30px;color:white">Create new sale</button></a>

          <div class="mb-3" style="margin-top: 10px;">
    <div class="relative mb-4 flex w-full flex-wrap items-stretch">
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
  </div>
        </div>
        <div v-if="loading">Loading...</div>
        <div v-else>
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">Name</th>
                  <th scope="col" class="px-6 py-3">Category</th>
                  <th scope="col" class="px-6 py-3">Amount Payed</th>
                  <th scope="col" class="px-6 py-3">Quantity</th>
                   <th scope="col" class="px-6 py-3">CustomerName</th>
                   <th scope="col" class="px-6 py-3">Created AT</th>
                   <th scope="col" class="px-6 py-3">Payment Method</th>
                  <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="sale in sales" :key="sale.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4">{{ sale.item }}</td>
                  <td class="px-6 py-4">{{ sale.category }}</td>
                  <td class="px-6 py-4">{{ sale.price }}</td>
                  <td class="px-6 py-4">{{ sale.quantity }}</td>
                  <td class="px-6 py-4">{{ sale.customerName }}</td>
                  <td class="px-6 py-4">{{ sale.paymentMethod }}</td>
                  <td class="px-6 py-4">{{ sale.created_at }}</td>
                  <td class="px-6 py-4 text-right">
                    <span class="flex">
                      <button @click="deleteSale(sale.id)" class="bg-red-500 text-white px-4 py-2 mt-2">Delete</button>
                      <router-link :to="'/sales/' + sale.id + '/editSaleById'">
                        <button  class="bg-blue-500 text-white px-4 py-2 mt-2 ml-2">Edit</button>
                      </router-link>
                    </span>
                  </td>
                  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div v-if="showEditForm">
          <!-- Edit form here -->
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        loading: true,
        sales: [],
      };
    },
    async mounted() {
      await this.fetchAllSales();
    },
    methods: {
      async fetchAllSales() {
        this.loading = true;
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/sales');
          this.sales = response.data;
          this.loading = false;
        } catch (error) {
          console.error('Error fetching carts:', error);
          this.loading = false;
        }
      },
     
      async deleteSale(cartId) {
    try {
      await axios.delete(`http://127.0.0.1:8000/api/sales/${cartId}`);
      // Instead of fetching all carts after deletion, you can directly remove the deleted cart from the local carts array
      this.sales = this.sales.filter(sale => sale.id !== cartId);
    } catch (error) {
      console.error('Error deleting cart:', error);
    }
  
  
      },
    },
  };
  </script>
  