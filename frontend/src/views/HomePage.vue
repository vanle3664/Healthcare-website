<template lang="">
    <div class="homepage">
        <div class="search">
            <div class="text-search">
                <InputItem
                    label="Tìm kiếm theo tên thuốc"
                    searchInput="True"
                />
            </div>
            <div class="img-search">
                <i class="fa-solid fa-camera"></i>
            </div>
            <div class="hot-search scrollable-invisible">
                <div class="hot-item" v-for="(item, index) in hotItems" :key="index">{{item}}</div>
            </div>
        </div>
        <div class="product-category">
            <label>Thực phẩm chức năng</label>
            <div class="product-list scrollable-invisible">
                <div class="product-card" v-for="(product, index) in products" :key="index">
                    <div class="product-img">
                        <img :src="getImgUrl(product.img)">
                    </div>
                    
                    <div class="product-name">{{product.name}}</div>
                    <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import InputItem from '../components/common/InputItem.vue';
export default {
    name: 'HomePage',
    components: {
        InputItem,
    },
    data(){
        return{
            hotItems: [
                'Thuốc', 'Vitamin', 'Thực phẩm chức năng','Thuốc', 'Vitamin', 'Thực phẩm chức năng','Thuốc', 'Vitamin', 'Thực phẩm chức năng','Thuốc', 'Vitamin', 'Thực phẩm chức năng',
            ],
            products: [
                {
                    img: 'default-drug',
                    name: 'Vitamin',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin',
                    price: '230.000',
                }
            ]
        }
    },
    methods: {
        getImgUrl(drug) {
            return require('../assets/images/' + drug +'.jpg');
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
    
</style>