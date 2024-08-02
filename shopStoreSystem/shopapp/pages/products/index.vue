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
        <nav :class="['col-md-2', { 'd-none': !sidebarOpen }, 'bg-dark', 'sidebar']" style="height:700px;margin-top:50px">
          <div class="sidebar-sticky">
            <h5>Sidebar</h5>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.vue"><div class="card">
                  DASHBOARD
                </div></a>
              </li>
              <hr>
              <li class="nav-item">
                <a class="nav-link" href="/auth/resert_password" style="color:white;font-size:20px">Reset Password</a>
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
            <span class="navbar-brand mb-0 h1 text-success">Shop-management</span>
          </nav>

          <!-- Search input -->
          <div class="shadow-sm" style="margin-top: 40px;">
            <div class="search-input btn btn-block btn-secondary">
              <input type="text" v-model="searchQuery" @input="filterProducts" placeholder="Search products...">
            </div>

            <!-- Data table -->
            <div class="table-container">
              <div class="card shadow-sm">
                <table class="table table-bordered">
                  <!-- Table headers -->
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Brand</th>
                      <th>Description</th>
                      <th>Created At</th> <!-- Adjusted column name -->
                      <th>Volume</th>
                      <th>Status</th> <!-- New column for product status -->
                      <th>Action</th> <!-- New column for action buttons -->
                    </tr>
                  </thead>
                  <!-- Table body -->
                  <tbody>
                    <!-- Iterate over filtered products -->
                    <tr v-for="product in filteredProducts" :key="product.id">
                      <!-- Display product details -->
                      <td>{{ product.id }}</td>
                      <td>{{ product.code }}</td>
                      <td>{{ product.category }}</td>
                      <td>{{ product.quantity }}</td>
                      <td>{{ product.brand }}</td>
                      <td>{{ product.description }}</td>
                      <td>{{ product.created_at }}</td> <!-- Adjusted value -->
                      <td>{{ product.volume }}/Litre</td>
                      <td>{{ getProductStatus(product) }}</td> <!-- Display product status -->
                      <td>
                        <template v-if="getProductStatus(product) === 'Up to Date'">
                          <button class="btn btn-success" disabled>Up to Date</button>
                        </template>
                        <template v-else-if="getProductStatus(product) === 'Expired'">
                          <button class="btn btn-danger" @click="alertExpired(product)" disabled>Expired</button>
                        </template>
                        <template v-else-if="getProductStatus(product) === 'Not Yet Available'">
                          <span>Not Yet Available</span>
                        </template>
                        <template v-else>
                          <span>Unknown Status</span>
                        </template>
                      </td>
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

const searchQuery = ref('');
const products = ref([]);
const filteredProducts = ref([]);
const sidebarOpen = ref(true);

const fetchProducts = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/products');
    products.value = response.data;
    filteredProducts.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

const filterProducts = () => {
  const query = searchQuery.value.trim().toLowerCase();
  if (!query) {
    filteredProducts.value = products.value;
  } else {
    filteredProducts.value = products.value.filter(product =>
      product.code.toLowerCase().includes(query) ||
      product.category.toLowerCase().includes(query) ||
      product.brand.toLowerCase().includes(query) ||
      product.description.toLowerCase().includes(query)
    );
  }
};

const getProductStatus = (product) => {
  const createdAt = new Date(product.created_at); // Adjusted to use created_at
  const now = new Date();
  const secondsDiff = Math.floor((now - createdAt) / 1000); // Calculate difference in seconds

  // Adjusted logic for product status
  if (secondsDiff > 15) {
    return 'Expired';
  } else if (secondsDiff > 0) {
    return 'Up to Date';
  } else {
    return 'Not Yet Available';
  }
};

onMounted(fetchProducts);

function toggleSidebar() {
  sidebarOpen.value = !sidebarOpen.value;
}

function alertExpired(product) {
  alert(`Product ${product.code} is expired!`);
}
</script>

<style scoped>
.dashboard {
  display: flex;
}

.sidebar {
  width: 200px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #343a40;
  color: #ffffff;
  overflow-y: auto;
}

.main-content {
  margin-left: 200px;
  width: calc(100% - 200px);
}

.d-none {
  display: none !important;
}

.search-input {
  margin-top: 70px;
}

.table-container {
  margin: 20px auto;
}

.card.shadow-sm {
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
</style>
