<template>
    <div class="dashboard">
      <div class="flex mt-16">
        <!-- Sidebar -->
        <div class="w-1/2 md:w-1/4 lg:w-1/5 min-h-screen text-white bg-gray-800 text-white p-4 fixed" style="margin-bottom:170px;background-color:teal;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
          <!-- Sidebar content here... -->
          <div class="mb-4">
            <p class="text-2xl font-bold">YOUR-CART</p>
          </div>
        </div>
  
        <!-- Main Section -->
        <div class="w-1/2 md:w-3/4 lg:w-4/5 p-4 ml-auto relative" style="background-color:white;">
          <!-- Main section content here... -->
          <main>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <form class="w-full max-w-sm" @submit.prevent="submitForm">
                <!-- Input Fields on the Same Row -->
                <div class="flex items-center space-x-2 mb-3">
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="item"  type="text" placeholder="Enter item name" aria-label="Item name"  style="width: 300px;">
                  </div>
  
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="category" type="text" placeholder="Enter Category" aria-label="Category" style="width: 300px;">
                  </div>
  
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="price" type="number" placeholder="Price" aria-label="Amount"  style="width: 300px;">
                  </div>
                </div>
  
                <!-- Input Fields on the Same Row -->
                <div class="flex items-center space-x-2 mb-3">
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="description"  type="text" placeholder="Enter item description" aria-label="Item description"  style="width: 300px;">
                  </div>
                </div>
  
                <br>
                <p style="font-size:30px;color:teal">Fill Payments details here:</p><br>
  
                <!-- Payment Details -->
                <div class="flex items-center space-x-2 mb-3">
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="accountno" type="number" placeholder="Account Number or Phone number" required aria-label="Account Number/Phone Number"  style="width: 300px;">
                  </div>
  
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <select typeof="text" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="paymethod" aria-label="payment-method" required style="width: 300px;">
                      <option value="Null">Select payment method</option>
                      <option value="card-number">Tembo-Card</option>
                      <option value="Visa">Visa</option>
                      <option value="M-Pesa">M-Pesa</option>
                      <option value="Tigo-Pesa">Tigo-Pesa</option>
                      <option value="AirTel-Money">AirTel-Money</option>
                      <option value="Halo-Pesa">Halo-Pesa</option>
                      <option value="Lipa-Number">Lipa-Number</option>
                      <!-- Add more options as needed -->
                    </select>
                  </div>
  
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="amount" type="text" required placeholder="Enter amount" aria-label="amount" style="width: 300px;">
                  </div>
                </div>
  
                <!-- Input Fields on the Same Row -->
                <div class="flex items-center space-x-2 mb-3">
                  <div class="flex items-center border-b border-teal-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="total"  type="number" required placeholder="Enter total orders" aria-label="Total Order"  style="width: 300px;">
                  </div>
                </div>
  
                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                  <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" style="margin-top: 40px;">
                    Place Order
                  </button>
                  <a href="/ourshop">
                    <button class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" type="button" style="background-color: teal; height: 40px; margin-top: 42px;">
                      Cancel
                    </button>
                  </a>
                </div>
  
                <!-- Display message if payment details are not filled -->
                <p v-if="!paymentDetailsFilled" class="text-red-500 mt-2">Please fill in payment details.</p>
              </form>
            </div>
          </main>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'addToCart',
    data() {
      return {
        item: '',
        category: '',
        price: 0,
        description: '',
        accountno: '',
        paymethod: '',
        amount: '',
        total: '',
      };
    },
    computed: {
      paymentDetailsFilled() {
        return this.accountno && this.paymethod && this.amount && this.total;
      }
    },
    methods: {

        async fetchData() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/ourshop/${this.id}`);
        const shop = response.data; // Assuming that the response data is an object with student information
        this.item = shop.item;
        this.category = shop.category;
        this.price = shop.price;
        this.description = shop.description;
      } catch (error) {
        console.error('Error fetching shop data:', error.response ? error.response.data : error.message);
      }
    },

      async submitForm() {
        if (this.paymentDetailsFilled) {
          this.addToCart();
        } else {
          alert('Please fill in payment details.');
        }
      },
      async addToCart() {
        try {
          const addToCartData = {
            item: this.item,
            category: this.category,
            price: this.price,
            description: this.description,
            accountno: this.accountno,
            paymethod: this.paymethod,
            amount: this.amount,
            total: this.total,
          };
  
          await axios.post('http://127.0.0.1:8000/api/addToCartApi', addToCartData);
  
          alert('Order placed successfully.');
  
          // Navigate to '/successmessage' route after successful order placement
          this.$router.push('/successmessage');
        } catch (error) {
          console.error('Error placing order:', error.response ? error.response.data : error.message);
        }
      },
    },
  };
  </script>
  
  <style>
  /* Your styles here */
  </style>
  