


<template>
  <DefaultLayout>
    <!-- Breadcrumb Start -->
    <BreadcrumbDefault :pageTitle="pageTitle" />
    <!-- Breadcrumb End -->

    <!-- ====== Form Elements Section Start -->
    <div class="grid w-full grid-cols-1 gap-9 sm:grid-cols-1"> <!-- Changed grid-cols-2 to grid-cols-1 for small screens -->
      <div class="flex flex-col gap-9">
        <!-- Input Fields Start -->
      
        <div v-if="successMessage" class="text-green-900" style="color: white;padding:30px 30px 20px;height:5px;background-color:#2C3539">{{ successMessage }}</div>
        <div v-if="errorMessage" class="text-red-500" style="color: white;padding:30px 30px 20px;height:5px;background-color:#C34A2C">{{ errorMessage }}</div>
        
          <form action="" method="post"  @submit.prevent="submitForm" 
          class="flex flex-col w-full p-5 bg-white rounded-md shadow-lg md:p-10 "  style="width: 900px;">
          <label for="customer_id" class="mb-5">
            <span>Member name</span>
            <input
            type="text"
            name="name"
            v-model="formData.name"
            id="name"
            class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800"
            placeholder="Enter member fullName"
            required
          />          
          </label>
         
          <label for="category" class="mb-5">
            <span>Task category</span>
            <input
              type="text"
              name="category" v-model="formData.category"
              id="category"
              class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800"
              placeholder=" Enter task type/category eg. cleaning toilet"
              required
            />
          </label>


          <label for="from" class="mb-5">
            <span>Start From</span>
            <input
              type="date"   v-model="formData.from"
              name="from" 
              id="from"
              class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800"
              placeholder="Enter Task started at"
              required
            />
          </label>

          <label for="from" class="mb-5">
            <span>Finished At</span>
            <input
              type="date"   v-model="formData.to"
              name="to" 
              id="to"
              class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800"
              placeholder="Enter Task finished at"
              required
            />
          </label>

          <label for="from" class="mb-5">
            <span>Supervisor</span>
            <input
              type="text"   v-model="formData.supervisor"
              name="supervisor" 
              id="supervisor"
              class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800"
              placeholder="Enter supervisor of a task"
              required
            />
          </label>


          <label for="amount" class="mb-5">
            <span>Task Description</span>
            <textarea
              type="text"
              name="description" v-model="formData.description"
              id="description"
              class="w-full p-3 mt-2 border border-gray-300 rounded shadow outline-none appearance-none bg-inherit shadow-gray-100 text-neutral-800"
              placeholder="Task task description "
              required></textarea>
          
          </label>

          <div class="flex justify-center mt-4"> <!-- Added flex and justify-center classes to center the button -->
            <button type="submit" class="px-6 py-2 text-white rounded-lg bg-pale-dark w-50 hover:bg-dark"
              style="background-color: #162834;">Add</button>

            <router-link :to="'/stasks'">
              <button class="px-6 py-2 text-white rounded-lg bg-pale-dark w-50 hover:bg-dark"
                style="background-color:#FA2A55;">Cancel</button>
            </router-link>
          </div>
        </form>
        
        <!-- Input Fields End -->

        <!-- Add other form elements here -->

      </div>

    </div>
    <!-- ====== Form Elements Section End -->
  </DefaultLayout>
</template>


<script setup lang="ts">
import MultiSelect from '@/components/Forms/MultiSelect.vue'
import SelectGroupOne from '@/components/Forms/SelectGroup/SelectGroupOne.vue'
import DatePickerTwo from '@/components/Forms/DatePicker/DatePickerTwo.vue'
import DefaultCard from '@/components/Forms/DefaultCard.vue'
import SwitchFour from '@/components/Forms/Switchers/SwitchFour.vue'
import SwitchOne from '@/components/Forms/Switchers/SwitchOne.vue'
import SwitchThree from '@/components/Forms/Switchers/SwitchThree.vue'
import SwitchTwo from '@/components/Forms/Switchers/SwitchTwo.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'


axios.defaults.baseURL = 'http://localhost:8000';

import { ref } from 'vue'
import axios from 'axios'

const pageTitle = ref('Form Elements')

const formData = ref<{
  name: string;
  category: string;
  from: string;
  to: string;
  supervisor: string;
  description: string;
}>({
  name: '',
  category: '',
  from: '',
  to: '',
  supervisor: '',
  description: ''
});

const successMessage = ref('')
const errorMessage = ref('')

const submitForm = async () => {
  try {
    const response = await axios.post('/api/tasks', formData.value)
    successMessage.value = response.data.message
    // Clear form data after successful submission
    Object.keys(formData.value).forEach(key => {
      formData.value[key] = ''
    })
  } catch (error) {
    errorMessage.value = error.response.data.error
  }
}
</script>
