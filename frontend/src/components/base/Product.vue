<template>
    <div class="product-card">
        <div class="product-img">
            <img :src="product.product_image">
        </div>
        
        <div class="product-name">{{product.product_name}}</div>
        <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
        <div class="purchase-btn" @click="purchaseBtnOnClick">Mua hàng</div>
    </div>
</template>
<script>
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
    methods: {
            purchaseBtnOnClick(){
                console.log(this.product.product_id)
                this.$router.push({ name: 'products', params: { productId: this.product.product_id}})
            }
        },
}
</script>
<style scoped>
    @import url('../../styles/base/product.css');
</style>