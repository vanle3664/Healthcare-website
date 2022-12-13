<template>
    <div class="search-page">
        <div class="search-title">Có {{num_result}} kết quả phù hợp với từ khóa "{{keyword}}"</div>
        <div class="filter">
            <div class="price-order">
                <div class="price-order-title">Sắp xếp theo giá</div>
                <i class="fa-solid fa-arrow-up" ref="up" @click="handleFilterPriceASC()"></i>
                <i class="fa-solid fa-arrow-down" @click="handleFilterPriceDESC()"></i>
            </div>
            <div class="brand-filter">
                <input :placeholder=this.brandFilterValue @click="handleClickBrandFilter"/>
                <div class="all-brand-wrapper" v-if="isClickBrandFilter" >
                    <div class="brands" v-for="(brand,index) in allBrands" :key="index">
                        <div class="brandChoice" @click="handleBrandChoosen(brand)">
                            <div>{{brand.brandName}}</div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="product-result">
            <div class="product-card" v-for="(product, index) in products" :key="index">
                <div class="product-img">
                    <img :src="getImgUrl(product.img)">
                </div>
                <div class="product-name">{{product.name}}</div>
                <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
                <div class="purchase-btn">Mua hàng</div>
            </div>
        </div>
    </div>
</template>

<script>
// import InputItem from '../components/common/InputItem.vue';
export default {
    name: 'SearchPage',
    components: {
        //InputItem,
    },
    data(){
        return {
            num_result: 20,
            keyword: "keyword",
            brands: [
                "A",
                "B", 
                "C", 
                "D"
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
            ],
            allBrands: [
                {
                    index: 1,
                    brandName: "a"
                },
                {
                    index: 2,
                    brandName: "b"
                },
                {
                    index: 3,
                    brandName: "c"
                },
                {
                    index: 4,
                    brandName: "d"
                },
                {
                    index: 5,
                    brandName: "e"
                },
                
            ],
            isClickBrandFilter: false,
            brandFilterValue: "Lọc theo hãng",
        }
        
    },
    methods: {
        getImgUrl(drug) {
            return require('../assets/images/' + drug +'.jpg');
        },
        handleClickBrandFilter(){
            console.log("before: " + this.isClickBrandFilter)
            this.isClickBrandFilter = !this.isClickBrandFilter
            console.log("after: " + this.isClickBrandFilter)
        },
        handleBrandChoosen(brand){
            this.brandFilterValue = brand.brandName;
            this.isClickBrandFilter = !this.isClickBrandFilter
        }
    }
}
</script>

<style scoped>
    @import url('../styles/view/searchpage.css');
</style>