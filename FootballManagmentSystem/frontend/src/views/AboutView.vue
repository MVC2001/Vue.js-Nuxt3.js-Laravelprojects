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
            About Us
          </h3>
        </div>

        <!-- Modal Body -->
        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <!-- Sample About Content -->
          <p class="text-gray-700">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel nisi sit amet nisi tincidunt vehicula. Proin vitae risus
            eget arcu gravida vulputate. Integer efficitur elit quis metus laoreet, sed dignissim arcu sollicitudin. Quisque vel velit
            sed justo tincidunt malesuada. Vestibulum fringilla ipsum a sapien sollicitudin, vel dictum elit lacinia. Sed sit amet odio
            non quam consequat varius. Sed vitae est tellus.
          </p>
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
  },
};
</script>

<style>
/* Add any custom styles here */
.footer {
  width: 100%;
  height: 300px;
  background-color: teal;
  color: white;
}
</style>
