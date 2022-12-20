<template>
    <div class="product-card">
        <div class="product-img">
            <img :src="imageUrl">
        </div>
        
        <div class="product-name">{{name}}</div>
        <div class="product-price"><span>{{price}}VND</span>/Sản phẩm</div>
        <div class="purchase-btn">Mua hàng</div>
    </div>
</template>
<script>
export default{
    name:'MProduct',
    props:{
        imageUrl:{
            type: String,
            default: require('../../assets/images/default-drug.jpg')
        },
        name: {
            type: String,
            default: ''
        },
        price:{
            type: String,
            default: '0',
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/base/product.css');
</style>