<template>
    <div>

<div class="mt-5 container">
    <div class="card">
        <div class="card-header">
      <h4>
        Edit student 
        <NuxtLink to="/students"  class="btn btn-danger float-end" style="margin-left: 400px;">Back</NuxtLink>
      </h4>
        </div>
        <div class="card-body">
                
            <div v-if="isLoading">
                <Loading :title="isLoadingTitle"/>
            </div>
          
            <div v-else>
                <form action="" @submit.prevent="updateStudent">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" v-model="student.name" class="form-control">
                    </div>
            
                    <div class="mb-3">
                        <label for="name">Course</label>
                        <input type="text"  v-model="student.course" class="form-control">
                    </div>
            
                    <div class="mb-3">
                        <label for="name">Email</label>
                        <input type="text"  v-model="student.email" class="form-control">
                    </div>
            
                    <div class="mb-3">
                        <label for="name">Phone</label>
                        <input type="text"  v-model="student.phone" class="form-control">
                    </div>
            
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                  </form>
            </div>
         
        </div>
    </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    name:'student edit',
    data(){
        return{
            studentId:'',
            student: {},
            isLoading: false,
            isLoadingTitle:'Loading',
        }
    },
    mounted() {

        this.studentId = this.$route.params.id
        this.getStudent(this.studentId);
    },
    methods: {


        getStudent(studentId) {
    axios.get(`http://127.0.0.1:8000/api/students/${studentId}`)
        .then(res => {
            this.student = res.data; // Update to assign directly to this.student
        }).catch(error => {
            console.error('Error fetching student:', error);
        });
        },


        updateStudent(){
    this.isLoading = true;
    this.isLoadingTitle = "Updating";
    
    axios.put(`http://127.0.0.1:8000/api/students/${this.studentId}`, this.student).then(res  => {
        console.log(res,'res');
        alert(res.data.message);

        this.isLoading = false;
        this.isLoadingTitle ="Loading";

    }).catch(error => {
        console.log(error,'errors');
    });
}

    },
}
</script>

<style  scoped>

</style>