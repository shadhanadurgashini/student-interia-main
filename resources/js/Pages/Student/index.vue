<template>
    <AppLayout>

        <template #content>
            <div class="container">
                <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">Student List</h1>
                </div>
                    <div class="col-lg-12">
                        <form @submit.prevent="studentCreate" >
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label><strong>Student Name:</strong></label>
                                <input class="form-control" name="name" v-model="student_form.name" type="text" placeholder="Enter the student's name" required>
                            </div>
                        </div>
                        <div class="row gx-5 mt-3">
                            <div class="col-lg-4">
                                <label><strong>Student Age:</strong></label>
                                <input class="form-control" name="age" v-model="student_form.age" type="text" placeholder="Enter the student's age" required>
                            </div>
                        <div class="mt-0 col-lg-4 form-group">
                            <label><strong>Student Image:</strong></label>
                            <input class="form-control" name="images" type="file" placeholder="Select the Student Image"
                                accept="image/jpg, image/jpeg, image/png">
                        </div>
                        <div class="col-lg-4 mt-4">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        </div>
                        </form>
                    </div>
                    
                    <!-- Table -->
                    <div class="col--lg-12 mt-4">
                    <div>
                        <table class="table table-light table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            <tr v-for="(student,key) in student_list">
                                <th scope="row">{{ ++key }}</th>
                                <td>{{ student.name }}</td>
                                <td>{{ student.age }}</td>
                                <td>{{ student.image }}</td>
                                <td>

                                    <span v-if="student.status == 0" class="badge bg-secondary">Inactive</span>
                                    <span v-else class="badge bg-success">Active</span>
    
                                </td>
                                <td>
                                    <!-- Delete Button -->
                                    <button type="button" @click.prevent="deleteStudent(student.id)" class="btn btn-outline-danger" style="--bs-btn-padding-y: .19rem; --bs-btn-padding-x: .25rem;">
                                        <span class="material-symbols-outlined">Delete</span>
                                    </button>

                                    <!-- Button to convert the Inactive status to Active -->
                                    <button v-if="student.status == 0" type="button" @click.prevent="activeStudent(student.id)" class="btn btn-outline-success" style="--bs-btn-padding-y: .19rem; --bs-btn-padding-x: .25rem;">
                                        <span class="material-symbols-outlined">check_circle</span>
                                    </button>
                                    <button v-if="student.status == 1" type="button" @click.prevent="activeStudent(student.id)" class="btn btn-outline-warning" style="--bs-btn-padding-y: .19rem; --bs-btn-padding-x: .25rem;">
                                        <span class="material-symbols-outlined">cancel</span>
                                    </button>

                                    <!-- Button to edit the available data -->
                                    <button type="button" @click.prevent="editStudent(student.id)" class="btn btn-outline-primary" style="--bs-btn-padding-y: .19rem; --bs-btn-padding-x: .25rem;">
                                        <span class="material-symbols-outlined">Edit</span>
                                    </button>
                                </td>   
                            </tr> 
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </template>

        <template #modals>
            <!-- Modal -->
            <div class="modal fade" id="studentEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="studentEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="studentEditLabel">Edit Student Data</h1>
                            <button type="button" class="btn-close" onclick="studentEditModal({{ $student->id }})" ></button>
                        </div>
                        <div class="modal-body" id="studentEditContent">

                            <!-- Modal Form -->
                            <form @submit.prevent="studentUpdate" >
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><strong>Student Name:</strong></label>
                                    <input class="form-control" name="name" v-model="student_update_form.name" type="text" placeholder="Enter the student's name" required>
                                </div>
                            </div>
                            <div class="row gx-5 mt-3">
                                <div class="col-lg-4">
                                    <label><strong>Student Age:</strong></label>
                                    <input class="form-control" name="age" v-model="student_update_form.age" type="text" placeholder="Enter the student's age" required>
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </template>

    </AppLayout>
</template>

<script>

import AppLayout from '@/Layouts/App.vue'
import { usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/reactivity';
import axios from 'axios';

export default {
    components: {
        AppLayout
    },

    data() {
        return {

            student_form: {
                name: '',
                age: ''
            },

            student_update_form: {
                name: '',
                age: ''
            },

            student_list: []
        }
    },

    beforeMount() {
        this.getStudents();
    },

    methods: {

        async getStudents() {
            const students = (await axios.get(route('student.list'))).data
            this.student_list = students
        },

        // Create Option
        async studentCreate() {
            await axios.post(route('student.create'), this.student_form)
            this.getStudents();

            this.student_form.name = '';
            this.student_form.age = '';
        },

        // Delete Option
        async deleteStudent(id) {
            await axios.delete(route('student.delete', id))
            this.getStudents();
        },

        // Status Option
        async activeStudent(id) {
            await axios.get(route('student.active', id))
            this.getStudents();
        },

        // Edit Option
        async editStudent(id) {
            const student = (await axios.get(route('student.get', id))).data
            this.student_update_form = student
            $('#studentEdit').modal('show')
        },

        // Update Option
        async studentUpdate() {
            await axios.post(route('student.update', this.student_update_form.id), this.student_update_form)
            this.getStudents();
            $('#studentEdit').modal('hide')
        }
    }    
}

</script>

<style lang="css" scoped>

    .page-title{
            padding-top: 10vh;
            font-size: 5rem;
            color: #216a79;
        }

</style>