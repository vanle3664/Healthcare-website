<template lang="">
    <div class="homepage">
        <div class="search">
            <div class="text-search">
                <InputItem
                    label="Tìm kiếm theo tên thuốc"
                    :searchInput="true"
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
            <router-link to='/products'>Xem thêm</router-link>
            <div class="product-list scrollable-invisible" ref="productList">
                <div class="prev-btn slide-btn" v-on:click="prevBtnOnClick">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="product-card" v-for="(product, index) in products" :key="index">
                    <div class="product-img">
                        <img :src="getImgUrl(product.img)">
                    </div>
                    
                    <div class="product-name">{{product.name}}</div>
                    <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
                </div>
                <div class="next-btn slide-btn" v-on:click="nextBtnOnClick">
                    <i class="fa-solid fa-chevron-right"></i>
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
            ]
        }
    },
    methods: {
        getImgUrl(drug) {
            return require('../assets/images/' + drug +'.jpg');
        },
        nextBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width
            this.$refs.productList.scrollLeft += productWidth
            // console.log(this.$refs.productList.scrollLeft)
            // console.log(this.$refs.productList.parentElement.getBoundingClientRect().width - 40)
            // console.log(this.$refs.productList.getBoundingClientRect().width)
        },
        prevBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width;
            this.$refs.productList.scrollLeft -= productWidth
            
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
    
</style>