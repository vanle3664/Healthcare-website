<template>
    <div class="product-card">
        <div class="product-img">
            <img src="../../assets/product_img.webp">
        </div>
        
        <div class="product-name">{{name}}</div>
        <div class="product-price"><span>{{price}}VND</span>/Sản phẩm</div>
    </div>
</template>
<script>
export default{
    name:'MProduct',
    props: ['imageUrl', 'name', 'price']
}
</script>
<style scoped>
    @import url('../../styles/base/product.css');
</style>