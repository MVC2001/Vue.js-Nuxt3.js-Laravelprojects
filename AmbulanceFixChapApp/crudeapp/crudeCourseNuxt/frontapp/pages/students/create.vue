<template>
    <div class="mt-5 container">
      <div class="card">
        <div class="card-header">
          <h4>
            Add student 
            <NuxtLink to="/students" class="btn btn-danger float-end" style="margin-left: 400px;">Back</NuxtLink>
          </h4>
        </div>
        <div class="card-body">
          <div v-if="isLoading">
            <Loading :title="isLoadingTitle"/>
          </div>
          <div v-else>
            <form action="" @submit.prevent="saveStudent">
              <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" v-model="student.name" class="form-control">
              </div>
              <div class="mb-3">
                <label for="name">Course</label>
                <input type="text" v-model="student.course" class="form-control">
              </div>
              <div class="mb-3">
                <label for="name">Email</label>
                <input type="text" v-model="student.email" class="form-control">
              </div>
              <div class="mb-3">
                <label for="name">Phone</label>
                <input type="text" v-model="student.phone" class="form-control">
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-success">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    name: 'student create',
    setup() {
      const student = ref({
        name: '',
        course: '',
        email: '',
        phone: ''
      });
  
      const isLoading = ref(false);
      const isLoadingTitle = ref('Loading');
  
      const saveStudent = () => {
        isLoading.value = true;
        isLoadingTitle.value = "Saving";
  
        axios.post(`http://127.0.0.1:8000/api/students`, {
          name: student.value.name,
          course: student.value.course,
          email: student.value.email,
          phone: student.value.phone
        })
        .then(res => {
          console.log(res, 'res');
          alert(res.data.message);
  
          student.value.name = '';
          student.value.course = '';
          student.value.email = '';
          student.value.phone = '';
  
          isLoading.value = false;
          isLoadingTitle.value = "Loading";
        })
        .catch(error => {
          console.log(error, 'errors');
        });
      };
  
      return {
        student,
        isLoading,
        isLoadingTitle,
        saveStudent
      };
    }
  };
  </script>
  
  <style scoped>
  /* Add your scoped styles here */
  </style>
  