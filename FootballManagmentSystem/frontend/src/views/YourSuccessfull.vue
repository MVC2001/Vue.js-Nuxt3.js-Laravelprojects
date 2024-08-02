<template>
    <!-- Modal -->
    <div
      class="fixed z-10 inset-0 overflow-y-auto"
      aria-labelledby="modal-title"
      role="dialog"
      aria-modal="true"
      x-show="showModal"
    >
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background Overlay -->
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          aria-hidden="true"
          @click="toggleModal"
        ></div>
  
        <!-- Modal Content -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
  
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
          role="dialog"
          aria-labelledby="modal-title"
          aria-describedby="modal-description"
        >
          <!-- Modal Header -->
          <div class="bg-teal-500 px-4 py-3 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-white" id="modal-title">
              Success Message
            </h3>
          </div>
  
          <!-- Modal Body -->
          <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <!-- Card Content -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
              <div class="p-4">
                <!-- Card Content Goes Here -->
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Big up,Your Successfully Placing order, Swaiba Please Welcome again and Again</h4>
                <p class="text-gray-600">Contact with this number for derivery +22579684847,+0628474734,</p>
              </div>
            </div>
          </div>
  
          <!-- Modal Footer -->
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-500 text-base font-medium text-white hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm"
              @click="toggleModal"
            >
              <a href="/">Close</a>
            </button>
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
  </style>
  