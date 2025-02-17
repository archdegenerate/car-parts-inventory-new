import { createRouter, createWebHistory } from 'vue-router';
import CarList from './components/CarList.vue';
import PartList from './components/PartList.vue';

const routes = [
    { path: '/cars', component: CarList },
    { path: '/parts', component: PartList },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
