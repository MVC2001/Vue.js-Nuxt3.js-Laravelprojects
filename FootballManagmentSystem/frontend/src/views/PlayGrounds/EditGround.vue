<template>
    <div class="dashboard">
      <div class="flex mt-16">
        <!-- Sidebar -->
        <div class="w-1/2 md:w-1/4 lg:w-1/5 min-h-screen text-white bg-gray-800 text-white p-4 fixed" style="background-color:teal;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
          <!-- Sidebar content here... -->
          <div class="mb-4">
            <p class="text-2xl font-bold">DASHBOARD</p>
          </div>
          <ul class="space-y-2">
            <hr>
            <li>
              <a href="#" class="flex items-center block px-2 py-1 rounded transition duration-200 hover:bg-gray-700">
                <i class="fas fa-user mr-2"></i><i class="fa fa-reply" style="font-size:36px"></i>
              </a>
            </li>
            <!-- Add other list items as needed -->
          </ul>
        </div>
  
        <!-- Main Section -->
        <div class="w-1/2 md:w-3/4 lg:w-4/5 p-4 ml-auto relative" style="background-color:white">
          <!-- Add New Detail button -->
  
          <!-- Main section content here... -->
          <main>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
             <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
             <form class="w-full max-w-sm">
            
              <!-- Input Fields on the Same Row -->
              <div class="flex items-center space-x-2 mb-3">
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
          
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
          
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
              </div>

               <!-- Input Fields on the Same Row -->
               <div class="flex items-center  py-5 space-x-2 mb-3">
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
          
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
          
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
              </div>

               <!-- Input Fields on the Same Row -->
               <div class="flex items-center py-5 space-x-2 mb-3">
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
          
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
          
                <div class="flex items-center border-b border-teal-500 py-2">
                  <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name"  style="width: 300px;">
                </div>
              </div>

               <!-- Input Fields on the Same Row -->
               <div class="flex items-center space-x-2 mb-3">
                <div class="flex items-center border-b border-teal-500 py-2">
                  <textarea class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none resize-none" placeholder="Enter your text" aria-label="Full name" style="width: 970px; height: 80px;"></textarea>
                </div>
              </div>

              <!-- Buttons -->
              <div class="flex justify-end space-x-2" style="margin-left: 800px;">
                  <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="button" style="margin-top: 40px;">
                    Sign Up
                  </button>
                  <button class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" type="button" style="background-color: teal; height: 40px; margin-top: 42px;">
                    Cancel
                  </button>
                </div>
            </form>
            </div>
          </main>
        </div>
      </div>
    </div>
  </template>


  
  <style>
  .dashboard {
    background-color: white;
  }
  
  body {
    background-color: white;
  }
  </style>
  
 