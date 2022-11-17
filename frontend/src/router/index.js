import {createRouter, createWebHistory} from 'vue-router'
//import HomePage from '../views/HomePage.vue'
import CartPage from '../views/CartPage.vue'


const routes = [
    // {
    //     path: '/',
    //     name: 'homepage',
    //     component: HomePage,
    // },
    {
        path: '/mycart',
        name: 'cartpage',
        component: CartPage,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router