<template>
    <div class="grid-products">
        <Product v-for="(product, index) in productsList" :key="index" 
            :product="product">
        </Product>
    </div>
</template>
<script>
import Product from './Product.vue';
    export default{
        name: "GridProducts",
        components:{
            Product,
        },
        props: ['productsList'],
        data() {
            return {
               
            }
        },
        methods: {
            getImgUrl(drug) {
                return require('../../assets/images/' + drug +'.jpg');
            },
        }
    }
</script>
<style scoped>
    @import url('../../styles/base/grid-products.css');
</style>
