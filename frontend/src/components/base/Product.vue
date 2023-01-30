<template>
    <div class="product-card" >
        <div class="product-img" @click="handleClickOnProduct">
            <img v-if="product.product_image" :src="product.product_image">
            <img v-else :src="require('../../assets/images/default-drug.jpg')">
        </div>
        
        <div class="product-name">{{product.product_name}}</div>
        <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
        <div class="purchase-btn" @click="purchaseBtnOnClick">Thêm vào giỏ</div>
    </div>
</template>
<script>
import { useCartStore } from '../../store/cart';
import { mapStores } from 'pinia'

export default{
    name:'MProduct',
    props: ['product'],
    // props:{
    //     // imageUrl:{
    //     //     type: String,
    //     //     default: require('../../assets/images/default-drug.jpg')
    //     // },
    //     // name: {
    //     //     type: String,
    //     //     default: ''
    //     // },
    //     // price:{
    //     //     type: Number,
    //     //     default: 0,
    //     // },
    //     // productId:{
    //     //     default: '',
    //     // }
    // },
    computed: {
        ...mapStores(useCartStore)
    },
    methods: {
            handleClickOnProduct(){
                console.log(this.product.product_id)
                this.$router.push({ name: 'products', params: { productId: this.product.product_id}})
            },
            addProductToCart(){
                this.cartStore.addToCart(this.product, 1)
                console.log(this.cartStore.cart)
            },
            purchaseBtnOnClick(){
                // console.log(this.product.product_id)
                // this.$router.push({ name: 'products', params: { productId: this.product.product_id}})

                this.addProductToCart()
                this.$router.push({name: 'cart-page'})
            }
        },
}
</script>
<style scoped>
    @import url('../../styles/base/product.css');
</style>