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

          <!-- Error message for image size limit -->
          <div v-if="imageSizeExceedsLimit" class="text-red-500 text-sm mb-4">
            The image field must not be greater than 2048 kilobytes.
          </div>

          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
            <form class="w-full max-w-sm" @submit.prevent="addGround">

              <!-- Input Fields on the Same Row -->
              <div class="flex items-center space-x-2 mb-3">
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Enter ground name" aria-label="Name" v-model="ground.name" style="width: 300px;">
                </div>

                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Enter Ground Category" aria-label="Category" v-model="ground.category" style="width: 300px;">
                </div>

                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" placeholder="Price or Amount" aria-label="Amount" v-model="ground.price" style="width: 300px;">
                </div>
              </div>

              <!-- Input Fields on the Same Row -->
              <div class="flex items-center space-x-2 mb-3">
                <div class="flex items-center border-b border-teal-500 py-2">
                  <textarea class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none resize-none" placeholder="Enter more detail" v-model="ground.description" aria-label="Ground Detail" style="width: 970px; height: 80px;"></textarea>
                </div>
              </div>

              <!-- Input Fields on the Same Row -->
              <div class="flex items-center  py-5 space-x-2 mb-3">
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" placeholder="Upload photo" type="file" ref="image" id="image" aria-label="Ground Photo" style="width: 300px;" @change="handleFileUpload">
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
      ground: {
        name: '',
        category: '',
        price: 0,
        description: '',
        image: null,
      },
      imageSizeExceedsLimit: false, // Variable to track image size limit error
      validationError: '', // Variable to store validation error message
    };
  },
  methods: {
    // Handle file upload
    handleFileUpload(event) {
      this.ground.image = event.target.files[0];
      // Check if image size exceeds limit
      this.imageSizeExceedsLimit = event.target.files[0].size > 2048 * 1024; // 2048 KB
    },
    // Add new ground
    async addGround() {
      // Check if any required field is empty
      if (!this.ground.name.trim() || !this.ground.category.trim() || !this.ground.price || !this.ground.description.trim() || !this.ground.image) {
        // Display error message for required fields
        this.validationError = 'Please fill in all the required fields.';
        return;
      }

      if (this.imageSizeExceedsLimit) {
        // Don't proceed if image size exceeds limit
        return;
      }

      // Rest of your method implementation
      const formData = new FormData();
      formData.append('name', this.ground.name);
      formData.append('category', this.ground.category);
      formData.append('price', this.ground.price);
      formData.append('description', this.ground.description);
      formData.append('image', this.ground.image);

      try {
        await axios.post('/api/groundshop', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        // Redirect to the ground list after successful insertion
        this.$router.push('/shopaccount');
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
