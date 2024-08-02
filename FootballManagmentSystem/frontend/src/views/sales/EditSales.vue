<template>
    <div>
      <!-- Sidebar -->
      <div class="w-1/2 md:w-1/4 lg:w-1/5 min-h-screen text-white bg-gray-800 text-white p-4 fixed" style="background-color:teal;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
        <ul class="p-4">
          <li><a href="#">EDIT CART</a></li><hr><br>
          <li><a href="/orders">Back Home</a></li>
        </ul>
      </div>
  
      <div class="card-form" style="margin-left:300px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
        <div v-if="!loading" class="container mt-2" style="width: 800px;margin-left:50px">
          <div class="card">
            <br>
            <div class="card-body">
              <form>
                <div class="mb-3">
                  <label for="item" class="block text-sm font-medium text-gray-700">Item</label>
                  <input type="text" v-model="sale.item" id="item" autocomplete="item" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
                </div>
  
                <div class="mb-3">
                  <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                  <input type="text" v-model="sale.category" id="category" autocomplete="category" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
                </div>
  
                <div class="mb-3">
                  <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                  <input type="text" v-model="sale.price" id="price" autocomplete="price" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
                </div>
  
                <div class="mb-3">
                  <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                  <input type="text" v-model="sale.quantity" id="quantity" autocomplete="quantity" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
                </div>
  
                <div class="mb-3">
                  <label for="customerName" class="block text-sm font-medium text-gray-700">Customer Name</label>
                  <input type="text" v-model="sale.customerName" id="customerName" autocomplete="customerName" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
                </div>
  
                <div class="mb-3">
                  <label for="paymentMethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
                  <input type="text" v-model="sale.paymentMethod" id="paymentMethod" autocomplete="paymentMethod" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
                </div>
  
                <div class="mb-3">
                  <button type="button" @click="updateSale" class="btn btn-primary btn-sm" style="background-color: teal;width:200px;height:50px;color:white">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div v-else>
          Loading...
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'EditCart',
    data() {
      return {
        id: null,
        sale: {
          item: '',
          category: '',
          price:'',
          quantity: '',
          customerName:'',
          paymentMethod:'',
  
        },
        loading: true
      };
    },
    methods: {
      async fetchData() {
        try {
          const response = await axios.get(`http://127.0.0.1:8000/api/sales/${this.id}`);
          const sale = response.data;
          this.sale.item = sale.item;
          this.sale.category = sale.category;
          this.sale.price = sale.price; // Corrected here
          this.sale.quantity = sale.quantity;
          this.sale.customerName = sale.customerName; // Corrected here
          this.sale.paymentMethod = sale.paymentMethod;
  
          this.loading = false; // Set loading to false after data is fetched
        } catch (error) {
          console.error('Error fetching data:', error.response ? error.response.data : error.message);
        }
      },
      
      async updateSale() {
        try {
          const updatedSale = {
            item: this.sale.item,
            category: this.sale.category,
            price: this.sale.price, // Corrected here
            quantity: this.sale.quantity,
            customerName: this.sale.customerName, // Corrected here
            paymentMethod: this.sale.paymentMethod,
          };
  
          await axios.put(`http://127.0.0.1:8000/api/sales/${this.id}`, updatedSale);
          alert('Sale item updated successfully.');
  
          this.$router.push('/view-sales');
        } catch (error) {
          console.error('Error updating sale item:', error.response ? error.response.data : error.message);
        }
      },
    },
    mounted() {
      this.id = this.$route.params.id;
      this.fetchData();
    },
  };
  </script>
  