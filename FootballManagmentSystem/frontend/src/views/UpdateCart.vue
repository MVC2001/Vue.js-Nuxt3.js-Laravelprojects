<template>
    <div class="max-w-2xl mx-auto mt-6">
      <form @submit.prevent="updateCart">
        <div class="mb-4">
          <label for="item" class="block text-sm font-medium text-gray-700">Item</label>
          <input v-model="form.item" type="text" id="item" name="item" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <div class="mb-4">
          <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
          <input v-model="form.category" type="text" id="category" name="category" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <div class="mb-4">
          <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
          <input v-model="form.price" type="number" id="price" name="price" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <input v-model="form.description" type="text" id="description" name="description" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <div class="mb-4">
          <label for="accountno" class="block text-sm font-medium text-gray-700">Account Number</label>
          <input v-model="form.accountno" type="number" id="accountno" name="accountno" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <div class="mb-4">
          <label for="paymethod" class="block text-sm font-medium text-gray-700">Payment Method</label>
          <input v-model="form.paymethod" type="text" id="paymethod" name="paymethod" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <div class="mb-4">
          <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
          <input v-model="form.amount" type="number" id="amount" name="amount" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <div class="mb-4">
          <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
          <input v-model="form.total" type="number" id="total" name="total" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">Update</button>
      </form>
    </div>
  </template>
  
 <script>
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      form: {
        item: '',
        category: '',
        price: 0,
        description: '',
        accountno: 0,
        paymethod: '',
        amount: 0,
        total: 0
      }
    };
  },
  mounted() {
    this.getCartById();
  },
  methods: {
    async getCartById() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/addToCartApi');
        const cartData = response.data;
        // Assuming the API response is an object with cart data
        this.form = { ...cartData };
      } catch (error) {
        console.error('Error fetching cart data:', error);
      }
    },
    async updateCart() {
      try {
        const response = await axios.put('http://127.0.0.1:8000/api/addToCartApi', this.form);
        console.log('Cart updated:', response.data);
        // Assuming you have a route named 'yourcartv1' and you want to navigate to it with the ID parameter
        const router = useRouter();
        router.push({ name: 'yourcartv1', params: { id: this.form.id } });
      } catch (error) {
        console.error('Error updating cart:', error);
        // You might want to handle errors here, like showing an error message to the user
      }
    }
  }
};
</script>
  