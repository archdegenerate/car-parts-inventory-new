<template>
    <div>
        <h1>Car List</h1>

        <form @submit.prevent="isEditing ? updateCar() : addCar()">
            <input v-model="carForm.name" placeholder="Car Name" required />
            <input v-model="carForm.registration_number" placeholder="Registration Number" />
            <label>
                <input type="checkbox" v-model="carForm.is_registered" />
                Is Registered?
            </label>
            <button type="submit">{{ isEditing ? 'Update Car' : 'Add Car' }}</button>
            <button v-if="isEditing" @click="cancelEdit" type="button">Cancel</button>
        </form>

        <ul>
            <li v-for="car in cars" :key="car.id">
                {{ car.name }} - {{ car.registration_number }} ({{ car.is_registered ? 'Registered' : 'Not Registered' }})
                <button @click="editCar(car)">Edit</button>
                <button @click="deleteCar(car.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            cars: [],
            carForm: { id: null, name: '', registration_number: '', is_registered: false },
            isEditing: false,
        };
    },
    mounted() {
        this.fetchCars();
    },
    methods: {
        async fetchCars() {
            const response = await axios.get('/api/cars');
            this.cars = response.data;
        },
        async addCar() {
            await axios.post('/api/cars', this.carForm);
            this.resetForm();
            this.fetchCars();
        },
        editCar(car) {
            this.carForm = { ...car }; 
            this.isEditing = true;
        },
        async updateCar() {
            await axios.put(`/api/cars/${this.carForm.id}`, this.carForm);
            this.resetForm();
            this.fetchCars();
        },
        cancelEdit() {
            this.resetForm();
        },
        async deleteCar(id) {
            await axios.delete(`/api/cars/${id}`);
            this.fetchCars();
        },
        resetForm() {
            this.carForm = { id: null, name: '', registration_number: '', is_registered: false };
            this.isEditing = false;
        },
    }
};
</script>
