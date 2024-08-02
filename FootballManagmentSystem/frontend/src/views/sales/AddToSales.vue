<template>
    <div class="dashboard">
      <div class="flex mt-16">
        <!-- Sidebar -->
        <div class="w-1/2 md:w-1/4 lg:w-1/5 min-h-screen text-white bg-gray-800 text-white p-4 fixed" style="margin-bottom:170px;background-color:teal;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
          <!-- Sidebar content here... -->
          <div class="mb-4">
            <p class="text-2xl font-bold">DASHBOARD</p>
          </div>
          <ul class="space-y-2">
            <hr>
            <li>
              <a href="/shopaccount" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
                <i class="fa fa-reply" style="font-size:36px"></i>
              </a>
            </li>
            <!-- Add other list items as needed -->
          </ul>
        </div>
  
        <!-- Main Section -->
        <div class="w-1/2 md:w-3/4 lg:w-4/5 p-4 ml-auto relative" style="background-color:white;">
          <!-- Main section content here... -->
          <main>
            <!-- Error message for validation -->
            <div v-if="validationError" class="text-red-500 text-sm mb-4">
              {{ validationError }}
            </div>
  
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <form class="w-full max-w-sm" @submit.prevent="addSale">
  
                <!-- Input Fields on the Same Row -->
                <div class="flex items-center space-x-2 mb-3">
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Enter item" aria-label="Item" v-model="sale.item" style="width: 300px;">
                  </div>
  
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Enter category" aria-label="Category" v-model="sale.category" style="width: 300px;">
                  </div>
  
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" placeholder="Enter price" aria-label="Price" v-model="sale.price" style="width: 300px;">
                  </div>
                </div>
  
                <!-- Input Fields on the Same Row -->
                <div class="flex items-center space-x-2 mb-3">
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none resize-none" placeholder="Enter quantity" v-model="sale.quantity" aria-label="Quantity" style="width: 300px;">
                  </div>
  
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none resize-none" placeholder="Enter customer name" v-model="sale.customerName" aria-label="Customer Name" style="width: 300px;">
                  </div>
                </div>
  
                <!-- Input Fields on the Same Row -->
                <div class="flex items-center py-5 space-x-2 mb-3">
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <select class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" v-model="sale.paymentMethod" style="width: 300px;">
                      <option value="">Select Payment Method</option>
                      <option value="Airtel">Airtel</option>
                      <option value="Tigo">Tigo</option>
                      <option value="M-pesa">M-pesa</option>
                    </select>
                  </div>
                </div>
  
                <!-- Buttons -->
                <div class="flex justify-end space-x-2" style="margin-left: 800px;">
                  <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" style="margin-top: 40px;">
                    Add new data
                  </button>
                  <a href="/playgroundaccount">
                    <button class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" type="button" style="background-color: teal; height: 40px; margin-top: 42px;">
                      Cancel
                    </button>
                  </a>
                </div>
              </form>
            </div>
          </main>
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
        sale: {
          item: '',
          category: '',
          price: 0,
          quantity: 0,
          customerName: '',
          paymentMethod: '',
        },
        validationError: '', // Variable to store validation error message
      };
    },
    methods: {
      // Add new sale
      async addSale() {
        // Check if any required field is empty
        if (!this.sale.item.trim() || !this.sale.category.trim() || !this.sale.price || !this.sale.quantity || !this.sale.customerName.trim() || !this.sale.paymentMethod) {
          // Display error message for required fields
          this.validationError = 'Please fill in all the required fields.';
          return;
        }
  
        // Rest of your method implementation
        const formData = new FormData();
        formData.append('item', this.sale.item);
        formData.append('category', this.sale.category);
        formData.append('price', this.sale.price);
        formData.append('quantity', this.sale.quantity);
        formData.append('customerName', this.sale.customerName);
        formData.append('paymentMethod', this.sale.paymentMethod);
  
        try {
          await axios.post('/api/sales', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });
          // Redirect to the sales list after successful insertion
          this.$router.push('/view-sales');
        } catch (error) {
          if (error.response.status === 422) {
            // Handle validation errors
            console.error('Validation errors:', error.response.data.errors);
          } else {
            // Handle other errors
            console.error(error);
          }
        }
      },
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
  