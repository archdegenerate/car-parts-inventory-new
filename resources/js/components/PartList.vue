<template>
    <div>
        <h1>Part List</h1>

        <form @submit.prevent="isEditing ? updatePart() : addPart()">
            <input v-model="partForm.name" placeholder="Part Name" required />
            <input v-model="partForm.serialnumber" placeholder="Serial Number" required />
            <select v-model="partForm.car_id">
                <option disabled value="">Select Car</option>
                <option v-for="car in cars" :key="car.id" :value="car.id">
                    {{ car.name }}
                </option>
            </select>
            <button type="submit">{{ isEditing ? 'Update Part' : 'Add Part' }}</button>
            <button v-if="isEditing" @click="cancelEdit" type="button">Cancel</button>
        </form>

        <ul>
            <li v-for="part in parts" :key="part.id">
                {{ part.name }} - {{ part.serialnumber }} (Car: {{ part.car.name }})
                <button @click="editPart(part)">Edit</button>
                <button @click="deletePart(part.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            parts: [],
            cars: [],
            partForm: {id: null, name: '', serialnumber: '', car_id: ''},
            isEditing: false,
        };
    },
    mounted() {
        this.fetchParts();
        this.fetchCars();
    },
    methods: {
        async fetchParts() {
            const response = await axios.get('/api/parts');
            this.parts = response.data;
        },
        async fetchCars() {
            const response = await axios.get('/api/cars');
            this.cars = response.data;
        },
        async addPart() {
            await axios.post('/api/parts', this.partForm);
            this.resetForm();
            this.fetchParts();
        },
        editPart(part) {
            this.partForm = {...part};
            this.isEditing = true;
        },
        async updatePart() {
            await axios.put(`/api/parts/${this.partForm.id}`, this.partForm);
            this.resetForm();
            this.fetchParts();
        },
        cancelEdit() {
            this.resetForm();
        },
        async deletePart(id) {
            await axios.delete(`/api/parts/${id}`);
            this.fetchParts();
        },
        resetForm() {
            this.partForm = {id: null, name: '', serialnumber: '', car_id: ''};
            this.isEditing = false;
        },
    }
};
</script>
