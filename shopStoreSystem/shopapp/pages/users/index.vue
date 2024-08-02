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
      <div class="container-fluid" style="margin-top: 80px;height:400px">
        <div class="row">
          <nav :class="['col-md-2', { 'd-none': !sidebarOpen }, 'bg-dark', 'sidebar']" style="height:700px;margin-top:60px">
            <div class="sidebar-sticky">
             <br>
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
      <main class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark fixed-top">
          <button class="navbar-toggler" type="button" @click="toggleSidebar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <span class="navbar-brand mb-0 h1 text-success">All users</span>
        </nav>
  
        <!-- Search input -->
        <div class="shadow-sm">
        <div class="search-input btn btn-block btn-secondary">
            <input type="text" v-model="searchQuery" @input="filterUsers" placeholder="Search users...">
        </div>
  
        <!-- Data table -->
        
        <div class="table-container">
          <div class="card shadow-sm">
            <table class="table table-bordered">
              <!-- Table headers -->
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Created at</th>
                </tr>
              </thead>
              <!-- Table body -->
              <tbody>
                <!-- Iterate over filtered products -->
                <tr v-for="user in users" :key="user.id">
                  <!-- Display product details -->
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role }}</td>
                  <td>{{ user.created_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </main>
      </div>
      </div>
    </div>
  
  </template>
  
  
  <script setup>
  import { ref, onMounted } from "vue";
  import axios from 'axios';

  const searchQuery = ref(''); // Ref to store search query entered by user
  const users = ref([]); // Ref to store all users
  const filteredUsers = ref([]); // Ref to store filtered users
  const sidebarOpen = ref(true);


  // Function to fetch users from API
  const fetchUsers = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/users');
      users.value = response.data.users; // Set users array
      filteredUsers.value = response.data.users; // Initially set filtered users same as all users
    } catch (error) {
      console.error('Error fetching users:', error);
    }
  };

  
  // Lifecycle hook: Fetch users when component is mounted
  onMounted(fetchUsers);

  // Function to toggle sidebar visibility
  function toggleSidebar() {
    sidebarOpen.value = !sidebarOpen.value;
  }
</script>



  
  <style scoped>
  .dashboard {
    display: flex;
  }
  
  .sidebar {
    width: 200px; /* Adjust sidebar width as needed */
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #343a40; /* Sidebar background color */
    color: #ffffff; /* Sidebar text color */
    overflow-y: auto; /* Enable scrolling if content exceeds sidebar height */
  }
  
  .main-content {
    margin-left: 200px; /* Adjust margin to match sidebar width */
    width: calc(100% - 200px); /* Adjust main content width */
  }
  
  .d-none {
    display: none !important;
  }
  
  .search-input {
    margin-top: 70px; /* Adjust top margin to make space for the fixed navbar */
  }
  
  .table-container {
    margin: 20px auto; /* Center the table */
  }
  
  .card.shadow-sm {
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }
  </style>
  