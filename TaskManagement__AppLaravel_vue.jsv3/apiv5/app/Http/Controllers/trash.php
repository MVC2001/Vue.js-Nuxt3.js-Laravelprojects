// User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Define relationship with tasks
    public function tasks()
    {
        return $this->hasMany(Task::class, 'name', 'name');
    }
}
model------------------------------------------




// Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_id', 'name', 'category', 'from', 'to', 'at', 'supervisor'];
}
-----------------------mode extends









// TaskController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getTasksForUser(Request $request)
    {
        $user = $request->user();
        $tasks = $user->tasks()->get();

        return response()->json(['tasks' => $tasks]);
    }
}
------------------------
TaskController



<template>
  <DefaultLayout v-if="isLoggedIn">
    <!-- Navbar with card and dropdown -->
    <nav class="bg-white shadow-lg">
      <!-- Navbar content -->
    </nav>
    <!-- End of Navbar -->

    <!-- Main content -->
    <div class="grid grid-cols-1 py-5 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
      <!-- Display tasks for the logged-in user -->
      <div v-for="task in tasks" :key="task.task_id">
        <p>{{ task.name }}</p>
        <!-- Add more task details here -->
      </div>
    </div>
    <!-- End of Main content -->
  </DefaultLayout>
  <div v-else>
    <p style="padding:0px 40px 30px;height:50px;width:100%;background:#B64027;color:white" class="shadow-lg">Wrong!!. you cannot access this dashboard without log in. Please provide valide cridental then log in to access the dashboard.</p>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import { useRouter } from 'vue-router';

// Data variable to store tasks
const tasks = ref([]);
// Variable to track login status
const isLoggedIn = ref(false);

// Fetch tasks for the logged-in user
const fetchTasks = async () => {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch('http://127.0.0.1:8000/api/tasks', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
    });

    if (response.ok) {
      const data = await response.json();
      tasks.value = data.tasks;
    } else {
      console.error('Failed to fetch tasks:', response.status, response.statusText);
    }
  } catch (error) {
    console.error('Network error:', error);
  }
};

// Fetch the logged-in user's email on component mount
onMounted(async () => {
  try {
    const token = localStorage.getItem('token');
    const response = await fetch('http://127.0.0.1:8000/api/user/name', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
    });

    if (response.ok) {
      isLoggedIn.value = true;
      await fetchTasks();
    } else {
      console.error('Failed to fetch user email:', response.status, response.statusText);
    }
  } catch (error) {
    console.error('Network error:', error);
  }
});
</script>



// routes/api.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/name', [AuthController::class, 'getLoggedUserName']);
    Route::get('/tasks', [TaskController::class, 'getTasksForUser']);
});
