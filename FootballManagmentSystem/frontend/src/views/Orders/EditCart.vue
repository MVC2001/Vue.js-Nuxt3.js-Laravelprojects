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
          <input type="text" v-model="item" id="item" autocomplete="item" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
        </div>

        <div class="mb-3">
          <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
          <input type="text" v-model="category" id="category" autocomplete="category" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
        </div>

        <div class="mb-3">
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <input type="text" v-model="description" id="description" autocomplete="description" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
        </div>

        <div class="mb-3">
          <label for="accountno" class="block text-sm font-medium text-gray-700">Account No</label>
          <input type="text" v-model="accountno" id="accountno" autocomplete="accountno" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
        </div>

        <div class="mb-3">
          <label for="paymethod" class="block text-sm font-medium text-gray-700">Pay Method</label>
          <input type="text" v-model="paymethod" id="paymethod" autocomplete="paymethod" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
        </div>

        <div class="mb-3">
          <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
          <input type="text" v-model="amount" id="amount" autocomplete="amount" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
        </div>

        <div class="mb-3">
          <label for="total" class="block text-sm font-medium text-gray-700">Quantity</label>
          <input type="text" v-model="total" id="total" autocomplete="total" class="form-input mt-1 block w-full py-2 px-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="" />
        </div>

        <div class="mb-3">
          <button type="button" @click="updateCart" class="btn btn-primary btn-sm" style="background-color: teal;width:200px;height:50px;color:white">Update</button>
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
      item: '',
      category: '',
      description: '',
      accountno: '',
      paymethod: '',
      amount: '',
      total: '',
      loading: true
    };
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/addToCartApi/${this.id}`);
        const cartItem = response.data;
        this.item = cartItem.item;
        this.category = cartItem.category;
        this.description = cartItem.description;
        this.accountno = cartItem.accountno;
        this.paymethod = cartItem.paymethod;
        this.amount = cartItem.amount;
        this.total = cartItem.total;
        this.loading = false; // Set loading to false after data is fetched
      } catch (error) {
        console.error('Error fetching data:', error.response ? error.response.data : error.message);
      }
    },
    
    async updateCart() {
      try {
        const updatedCart = {
          item: this.item,
          category: this.category,
          description: this.description,
          accountno: this.accountno,
          paymethod: this.paymethod,
          amount: this.amount,
          total: this.total,
        };

        await axios.put(`http://127.0.0.1:8000/api/addToCartApi/${this.id}`, updatedCart);
        alert('Cart item updated successfully.');

        this.$router.push('/orders');
      } catch (error) {
        console.error('Error updating cart item:', error.response ? error.response.data : error.message);
      }
    },
  },
  mounted() {
    this.id = this.$route.params.id;
    this.fetchData();
  },
};
</script>
