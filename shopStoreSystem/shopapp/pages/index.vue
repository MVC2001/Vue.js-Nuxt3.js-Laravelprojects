<template>
  <div>
    <!-- Login 13 - Bootstrap Brain Component -->
    <section class="bg-light py-3 py-md-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border border-light-subtle rounded-3 shadow-sm">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="text-center mb-3">
                
                </div>
                <h2 class="fs-6 fw-normal text-center text-secondary mb-4" style="font-size:30px;">Login</h2>
                <div id="messageContainer" class="mb-3">
                  <!-- Bootstrap Alert Container -->
                  <div v-if="errorMessage" class="alert alert-danger" role="alert">
                    {{ errorMessage }}
                  </div>
                </div>
                <form @submit.prevent="login">
                  <div class="row gy-2 overflow-hidden">
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control" v-model="email" id="email" placeholder="name@example.com" required>
                        <label for="email" class="form-label">Email</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" v-model="password" id="password" placeholder="Password" required>
                        <label for="password" class="form-label">Password</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid my-3">
                        <button class="btn btn-secondary btn-lg" type="submit" :disabled="loading">
                          <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                          <span v-if="loading">Logging in...</span>
                          <span v-else>Log in</span>
                        </button>
                      </div>
                    </div>
                    <div class="col-12">
                      <p class="m-0 text-secondary text-center">Don't have an account? <a href="/auth/register" class="link-primary text-decoration-none">Sign up</a></p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const email = ref('');
const password = ref('');
const loading = ref(false);
const errorMessage = ref('');
const successMessage = ref('');

//login logic
const login = async () => {
  loading.value = true;
  try {
    if (password.value !== confirmPassword.value) {
      errorMessage.value = 'Password mismatch';
      return;
    }

    const response = await fetch('http://127.0.0.1:8000/api/loginV1', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        email: email.value,
        password: password.value,
      }),
    });

    if (response.ok) {
      const data = await response.json();
      localStorage.setItem('token', data.token);
      router.push('/auth/dashboard');
      successMessage.value = 'Login successful. Redirecting to dashboard...';
    } else {
      const errorData = await response.json();
      console.error('Login failed:', errorData.message);
      errorMessage.value = errorData.message;
      // Clear password field on error
      password.value = '';
    }
  } catch (error) {
    console.error('An error occurred during login:', error);
    errorMessage.value = 'An error occurred during login. Please try again later.';
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
/* Add custom styles here if needed */
</style>
