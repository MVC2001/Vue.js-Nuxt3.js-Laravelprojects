<template>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          <h4>All students</h4>
          <NuxtLink to="/students/create" class="btn btn-primary">Add student</NuxtLink>
        </div>
  
        <div class="card-body">
          <div v-if="isLoading">
            <Loading title="Loading......"/>
          </div>
          <div v-else>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Created AT</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(student, index) in students" :key="index">
                  <td>{{ student.id }}</td>
                  <td>{{ student.name }}</td>
                  <td>{{ student.course }}</td>
                  <td>{{ student.email }}</td>
                  <td>{{ student.phone }}</td>
                  <td>{{ student.created_at }}</td>
                  <td>
                    <NuxtLink :to="`/students/${student.id}`" class="btn btn-success btn-sm mx-2">Edit</NuxtLink>
                    <button type="button" @click="deleteStudent($event, student.id)" class="btn btn-danger btn-sm mx-2">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    name: "student",
    setup() {
      const students = ref({});
      const isLoading = ref(true);
  
      const getStudents = () => {
        isLoading.value = true;
        axios.get(`http://127.0.0.1:8000/api/students`)
          .then(res => {
            isLoading.value = false;
            students.value = res.data;
          })
          .catch(error => {
            console.error('Error fetching students:', error);
            isLoading.value = false;
          });
      };
  
      const deleteStudent = (event, studentId) => {
        if (confirm('Are you sure, you want to delete this data?')) {
          event.target.innerText = 'Deleting';
          axios.delete(`http://127.0.0.1:8000/api/students/${studentId}`)
            .then(() => {
              event.target.innerText = 'Delete';
              getStudents();
            })
            .catch(error => {
              console.error('Error deleting student:', error);
              event.target.innerText = 'Delete';
            });
        }
      };
  
      getStudents();
  
      return {
        students,
        isLoading,
        deleteStudent
      };
    }
  };
  </script>
  
  <style scoped>
  /* Add your scoped styles here */
  </style>
  