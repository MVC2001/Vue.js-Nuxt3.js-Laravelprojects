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
                                Sign in to your account
                                <p v-if="loginError" class="text-red-500 mt-4" style="color: red;">
                                    {{ loginError }}
                                  </p>
                            </h1>
                            <form class="space-y-4 md:space-y-6" action="#"  @submit.prevent="login">
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                    <input type="email"  v-model="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password"  v-model="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Cofirm-Password</label>
                                    <input type="password"  v-model="passwordConfirmation" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-start">
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Login <i style="font-size:24px" class="fa">&#xf090;</i></button>
                                    </div>
                                    <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                                </div>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    Don’t have an account yet? <a href="register" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
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

axios.defaults.baseURL = 'http://localhost:8000'; // Update with your Laravel server URL

export default {
  data() {
    return {
      email: '',
      password: '',
      passwordConfirmation: '',
      loginError: null,
    };
  },
  methods: {
    async login() {
      // Check if password and confirmation match
      if (this.password !== this.passwordConfirmation) {
        this.loginError = 'Password and confirmation do not match.';
        return;
      }

      try {
        const response = await axios.post('/api/login', {
          email: this.email,
          password: this.password,
        });

        console.log(response.data);

        // Handle success
        this.storeToken(response.data.token);
        this.$router.push('/dashboard');
      } catch (error) {
        console.error('Login error:', error.response ? error.response.data : error.message);

        // Set loginError to display the error message
        this.loginError = error.response ? error.response.data.message : 'Invalid credentials. Please check your email and password.';
      }
    },
    storeToken(token) {
      // Store the token in localStorage
      localStorage.setItem('token', token);
      console.log('Token stored:', token);
    },
  },
};
</script>


<style>

.login{
    background-color: white;
}
</style>