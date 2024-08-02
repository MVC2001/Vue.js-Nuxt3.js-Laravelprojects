<template>
    <div class="login">
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
<section class="h-screen">
    <div class="h-full">
      <!-- Left column container with background-->
      <div
        class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between">
        <div
          class="shrink-1 mb-12 grow-0 basis-auto md:mb-0 md:w-9/12 md:shrink-0 lg:w-6/12 xl:w-6/12">
          <img
            src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="w-full"
            alt="Sample image" />
        </div>
  
        <!-- Right column container -->
        <div class="mb-12 md:mb-0 md:w-8/12 lg:w-5/12 xl:w-5/12">
            <section class="bg-gray-50 dark:bg-gray-900">
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                        Flowbite    
                    </a>
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Sign up to your account
                            </h1>
                            <form class="space-y-4 md:space-y-6" action="#" @submit.prevent="register">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text"   v-model="name" id="name" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                    <input type="email"  v-model="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                                    <div v-if="emailError" class="text-danger">{{ emailError }}</div>
                                </div>

                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password"  v-model="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <div v-if="passwordError" class="text-danger">{{ passwordError }}</div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-start">
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Register</button>
                                    </div>
                                </div>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    Already have an account yet? <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign in</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
              </section>
        </div>
      </div>
    </div>
  </section>
    </div>
</template>


<script>
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      emailError: '',
      passwordError: '',
    };
  },
  methods: {
    async register() {
      try {
        // Clear previous errors
        this.emailError = '';
        this.passwordError = '';

        // Validate email format
        if (!this.isValidEmail(this.email)) {
          this.emailError = 'Invalid email format';
          return;
        }

        // Validate password strength (you can customize the validation logic)
        if (this.password.length < 8) {
          this.passwordError = 'Password must be at least 8 characters';
          return;
        }

        const response = await axios.post('/api/register', {
          name: this.name,
          email: this.email,
          password: this.password,
        });

        console.log(response.data);

        // Handle success, e.g., redirect to login page
        this.$router.push('/login');
      } catch (error) {
        console.error('Registration error:', error.response ? error.response.data : error.message);
        // Handle error, e.g., display error message to the user
      }
    },
    isValidEmail(email) {
      // Simple email format validation (you can use a library for more advanced validation)
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },
  },
};
</script>

<style>

.login{
    background-color: white;
}
</style>