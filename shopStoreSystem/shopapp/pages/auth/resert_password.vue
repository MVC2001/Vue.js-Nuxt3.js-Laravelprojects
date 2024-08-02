<template>
    <div class="dashboard">
      <!-- Navbar -->
      <nav class="navbar navbar-dark bg-dark fixed-top">
        <button class="navbar-toggler" type="button" @click="toggleSidebar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <span class="navbar-brand mb-0 h1">{{ userEmail }} | <a href="#" @click="logout">Logout</a></span>
      </nav>
  
      <!-- Sidebar -->
      <div class="container-fluid" style="margin-top: 70px;height:400px">
        <div class="row">
          <nav :class="['col-md-2', { 'd-none': !sidebarOpen }, 'bg-dark', 'sidebar']" style="height:700px">
            <div class="sidebar-sticky">
              <h5>Sidebar</h5>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="/auth/dashboard"><div class="card">
                    DASHBOARD
                  </div></a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link" href="" style="color:white;font-size:20px">Reset Password</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users" style="color:white;font-size:20px">Users</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="/products" style="color:white;font-size:20px">Products</a>
                </li>
              </ul>
            </div>
          </nav>
  
          <!-- Main content -->
          <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Change your password here</h1>
            </div>
            <div class="row">
              <!-- First card -->
              <div class="col-lg-12 mb-4">
                <div class="card">
                  <div class="card-body">
                    <!-- Alert for error messages -->
                    <div v-if="showErrorAlert" class="alert alert-danger" role="alert">
                      {{ errorMessage }}
                    </div>
                    <div v-if="showSuccessAlert" class="alert alert-success mt-3" role="alert">
                        Password updated successfully!
                      </div>
                    <form @submit.prevent="handleSubmit">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control" id="email" v-model="email" required :class="{ 'is-invalid': !isEmailValid }">
                          <div class="invalid-feedback" v-if="!isEmailValid">
                            Please enter a valid email address.
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="oldPassword">Current Password</label>
                          <input type="password" class="form-control" id="oldPassword" v-model="oldPassword" required :class="{ 'is-invalid': !isOldPasswordValid }">
                          <div class="invalid-feedback" v-if="!isOldPasswordValid">
                            Password must be at least 8 characters long.
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="newPassword">New Password</label>
                          <input type="password" class="form-control" id="newPassword" v-model="newPassword" required :class="{ 'is-invalid': !isNewPasswordValid }">
                          <div class="invalid-feedback" v-if="!isNewPasswordValid">
                            Password must be at least 8 characters long.
                          </div>
                        </div>
                       <div class="py-5">
                        <button type="submit" class="btn btn-secondary">Update Password</button>
                       </div>
                        
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  const isSidebarOpen = ref(false);
  const showSuccessAlert = ref(false);
  const showErrorAlert = ref(false);
  const errorMessage = ref('');

  // Data properties for form inputs
  const email = ref('');
  const oldPassword = ref('');
  const newPassword = ref('');

  // Data properties for input validation
  const isEmailValid = ref(true);
  const isOldPasswordValid = ref(true);
  const isNewPasswordValid = ref(true);
  
  // Access the router instance
  const isLogged = ref(false);
  const userEmail = ref('');
  const sidebarOpen = ref(true);
  
  // Define a function to toggle the sidebar
  function toggleSidebar() {
    sidebarOpen.value = !sidebarOpen.value;
  }
  
  
  // get login user
  onMounted(() => {
    isLogged.value = process.client && localStorage.getItem('token') !== null;
    if (isLogged.value) {
      axios.get('http://127.0.0.1:8000/api/user/nameV1', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}` // Send token in the Authorization header
        }
      })
      .then(response => {
        userEmail.value = response.data.email;
      })
      .catch(error => {
        console.error('Error fetching user email:', error);
      });
    }
  });
  


  // Define a logout function
  function logout() {
    const token = localStorage.getItem('token'); // Retrieve the token from local storage
    if (!token) {
      console.error('Token not found in local storage');
      return;
    }
  
    axios.post('http://127.0.0.1:8000/api/logoutV1', {}, {
      headers: {
        'Authorization': `Bearer ${token}` // Send token in the Authorization header
      }
    })
    .then(response => {
      // Handle successful logout
      console.log(response.data.message); // Assuming the response contains a 'message' field
  
      // Clear token from local storage
      localStorage.removeItem('token');
  
      // Navigate to the home page (/)
      router.push('/');
  
      // Optionally, perform any other actions after logout
    })
    .catch(error => {
      // Handle error
      console.error('Logout failed:', error);
      // Optionally, perform fallback actions (e.g., show an error message)
    });
  }


  
  // Function to reset password
  function resetPassword(email, oldPassword, newPassword) {
    const token = localStorage.getItem('token');
    if (!token) {
      console.error('Token not found in local storage');
      return;
    }
  
    axios.post('http://127.0.0.1:8000/api/update-passwordV1', {
      email: email,
      current_password: oldPassword,
      new_password: newPassword
    }, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    })
    .then(response => {
      console.log(response.data.message);
      // Show success alert
      showSuccessAlert.value = true;
    })
    .catch(error => {
      console.error('Password reset failed:', error);
      showErrorAlert.value = true;
      errorMessage.value = error.response.data.message; // Assuming the error response contains a 'message' field
    });
  }

  // Function to handle form submission
  function handleSubmit() {
    // Validate form inputs
    isEmailValid.value = validateEmail(email.value);
    isOldPasswordValid.value = validatePassword(oldPassword.value);
    isNewPasswordValid.value = validatePassword(newPassword.value);
  
    // If all inputs are valid, proceed with password reset
    if (isEmailValid.value && isOldPasswordValid.value && isNewPasswordValid.value) {
      resetPassword(email.value, oldPassword.value, newPassword.value);
    }
  }
  
  // Simple email validation function
  function validateEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }
  
  // Simple password validation function
  function validatePassword(password) {
    return password.length >= 8;
  }
  </script>
  
  
  <style scoped>
  /* Add scoped styles here if needed */
  </style>
  