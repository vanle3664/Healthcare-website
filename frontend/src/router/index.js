import {createRouter, createWebHistory} from 'vue-router'
import HomePage from '../views/HomePage.vue'
import CartPage from '../views/CartPage.vue'
import SuccessOrderPage from '../views/SuccessOrder.vue'
import SearchPage from '../views/SearchPage.vue'
import ProductDetail from '../views/ProductDetail.vue'
import CategoryPage from '../views/CategoryPage.vue'
import pinia from '@/store/index'
import { useCartStore } from '@/store/cart'

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
        path: '/products/:productId',
        name: 'products',
        component: ProductDetail,
    },
    {
        path: '/search',
        name: 'search',
        component: SearchPage,
        props: route => ({keyword: route.query.q })
    },
    {
        path: '/:catId',
        name: 'category',
        component: CategoryPage,
    },
    {
        path: '/category/:catName/:catId',
        name: 'category',
        component: CategoryPage
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach(()=>{
    useCartStore(pinia)
})

export default router