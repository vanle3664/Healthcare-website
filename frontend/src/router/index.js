import {createRouter, createWebHistory} from 'vue-router'
import HomePage from '../views/HomePage.vue'
import CartPage from '../views/CartPage.vue'
import SuccessOrderPage from '../views/SuccessOrder.vue'
import SearchPage from '../views/SearchPage.vue'


const routes = [
    {
        path: '/',
        name: 'homepage',
        component: HomePage,
    },
    {
        path: '/my-cart',
        name: 'cart-page',
        component: CartPage,
    },
    {
        path: '/success-order',
        name: 'success-order',
        component: SuccessOrderPage,
    },
    {
        path: '/search',
        name: 'search',
        component: SearchPage,
        props: route => ({ keyword: route.query.q })
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router