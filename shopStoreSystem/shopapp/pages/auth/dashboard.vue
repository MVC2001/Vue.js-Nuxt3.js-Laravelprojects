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
                <a class="nav-link" href="#"><div class="card">
                  DASHBOARD
                </div></a>
              </li>
              <hr>
              <li class="nav-item">
                  <a class="nav-link" href="resert_password" style="color:white;font-size:20px">Reset Password</a>
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
            <h1 class="h2">Shop management</h1>
          </div>
          <div class="row">
            <!-- First card for total users -->
            <div class="col-lg-6 mb-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Total users</h5>
                  <p class="card-text">{{ totalUsers }}</p>
                </div>
              </div>
            </div>
            <!-- Second card for total products -->
            <div class="col-lg-6 mb-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Total Products</h5>
                  <p class="card-text">{{ totalProducts }}</p>
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
import axios from 'axios'; // Import Axios for making HTTP requests
import { useRouter } from 'vue-router'; // Import useRouter to access the router instance

const router = useRouter(); // Access the router instance
const isSidebarOpen = ref(false);
const isLogged = ref(false);
const userEmail = ref(''); 
const sidebarOpen = ref(true);
const totalUsers = ref(0); // Reference for total users count
const totalProducts = ref(0); // Reference for total products count

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

// Define a function to fetch total users count
async function fetchTotalUsers() {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/users/count');
    totalUsers.value = response.data.user_count;
  } catch (error) {
    console.error('Error fetching total users count:', error);
  }
}

// Define a function to fetch total products count
async function fetchTotalProducts() {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/product/count');
    totalProducts.value = response.data.product_count;
  } catch (error) {
    console.error('Error fetching total products count:', error);
  }
}

// Call fetch functions on component mount
onMounted(() => {
  fetchTotalUsers();
  fetchTotalProducts();
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
</script>

<style scoped>
/* Add scoped styles here if needed */
</style>
