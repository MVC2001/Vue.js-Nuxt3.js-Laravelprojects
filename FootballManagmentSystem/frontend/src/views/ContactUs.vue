
<template>
  <!-- Modal -->
  <div class="contact">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <!-- Background Overlay -->
      

      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
        role="dialog"
        aria-labelledby="modal-title"
        aria-describedby="modal-description"
      >
        <!-- Modal Header -->
        <div class="bg-teal-500 px-4 py-3 sm:px-6">
          <h3 class="text-lg font-medium leading-6 text-white" id="modal-title">
            Contact Us
          </h3>
        </div>

        <!-- Modal Body -->
        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <!-- Form -->
          <form>
            <div class="mb-4">
              <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
              <input type="text" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your name">
            </div>
            <div class="mb-4">
              <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
              <input type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your email">
            </div>
            <div class="mb-6">
              <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
              <textarea id="message" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your message"></textarea>
            </div>
            <div class="flex justify-end">
              <button
                type="button"
                class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-500 text-base font-medium text-white hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:w-auto sm:text-sm"
                @click="submitForm"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
    </div>
   

   <div class="footer bg-gray-800 text-white p-4">
  <!-- Grid Container -->
  <div class="grid grid-cols-12 gap-4">

    <!-- Email Address -->
    <div class="col-span-4">
      <div class="flex items-center">
        <i class="fas fa-envelope mr-2"></i>
        <span>MvcSofts@example.com</span>
      </div>
    </div>

    <!-- Contact Information -->
    <div class="col-span-4">
      <div class="flex items-center">
        <i class="fas fa-phone-alt mr-2"></i>
        Contact: <span>+123456789,+2555474747,+078557373</span>
      </div>
    </div>

    <!-- Social Media Icons -->
    <div class="col-span-4 flex justify-center">
      <a href="#" class="text-white hover:text-gray-300 mr-4">
        <i class="fab fa-facebook"></i>
        Fb:MvcSofts
      </a>
      <a href="#" class="text-white hover:text-gray-300 mr-4">
        <i class="fab fa-instagram"></i>
        Ig:MvcSofts
      </a>
      <!-- Add more social media icons as needed -->
    </div>

  </div>
</div>

        <!-- Modal Footer -->
      </div>
    </div>
  
   
</template>

<script>
export default {
  data() {
    return {
      showModal: false,
    };
  },
  methods: {
    toggleModal() {
      this.showModal = !this.showModal;
    },
    submitForm() {
      // Handle form submission here
      console.log("Form submitted");
    },
  },
};
</script>

<style>
/* Add any custom styles here */
.footer{
    width:100%;
    height:300px;
    background-color: teal;
    color: white;
}
</style>
