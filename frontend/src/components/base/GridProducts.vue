<template>
    <div class="grid-products">
        <div class="product-card" v-for="(product, index) in products" :key="index">
            <div class="product-img">
                <img :src="getImgUrl(product.img)">
            </div>
            
            <div class="product-name">{{product.name}}</div>
            <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
        </div>
    </div>
</template>
<script>
    export default{
        data() {
            return {
                products: [
                    {
                        img: 'default-drug',
                        name: 'Vitamin1',
                        price: '230.000',
                    },
                    {
                        img: 'default-drug',
                        name: 'Vitamin2',
                        price: '230.000',
                    },
                    {
                        img: 'default-drug',
                        name: 'Vitamin3',
                        price: '230.000',
                    },
                    {
                        img: 'default-drug',
                        name: 'Vitamin4',
                        price: '230.000',
                    },
                    {
                        img: 'default-drug',
                        name: 'Vitamin5',
                        price: '230.000',
                    }
                ],
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