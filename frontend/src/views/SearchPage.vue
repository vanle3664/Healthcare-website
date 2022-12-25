<template>
    <div class="search-page">
        <div class="search-title">Có {{this.data.total}} kết quả phù hợp với từ khóa "{{this.$route.query.keyword}}"</div>
        <div class="filter">
            <div class="price-order">
                <div class="price-order-title">Sắp xếp theo giá</div>
                <i class="fa-solid fa-arrow-up" ref="up" @click="handleFilterPrice(`asc`)"></i>
                <i class="fa-solid fa-arrow-down" @click="handleFilterPrice(`desc`)"></i>
            </div>
            <div class="brand-filter" >
                <input placeholder="Lọc theo hãng" :value=this.brandFilterValue @click="isClickBrandFilter=!isClickBrandFilter"/>
                <div class="all-brand-wrapper" v-if="isClickBrandFilter" >
                    <div class="brands" v-for="(brand,index) in allBrands" :key="index">
                        <div class="brandChoice" @click="handleBrandChoosen(brand)">
                            <div>{{brand}}</div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="search-content">
            <!-- <div class="product-result">
                <div class="product-card" v-for="(product, index) in products" :key="index">
                    <div class="product-img">
                        <img :src=product.product_image>
                    </div>
                    <div class="product-name">{{product.product_name}}</div>
                    <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
                    <div class="purchase-btn" @click="addToCart(product)">Mua hàng</div>
                </div>
            </div> -->
            <GridProducts :products-list="products"></GridProducts>
            <div class="btn">
                <div class="back-next-btn" @click="handleChangePage(`back`)">
                    Back 
                    <i class="fa-solid fa-arrow-left" ></i>         
                </div>
                <div>page {{current_page}}</div>
                <div class="back-next-btn" @click="handleChangePage(`next`)">
                    Next 
                    <i class="fa-solid fa-arrow-right" ></i>          
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import InputItem from '../components/common/InputItem.vue';
import GridProducts from '../components/base/GridProducts.vue';
export default {
    name: 'SearchPage',
    components: {
        //InputItem,
        GridProducts,
    },
    data(){
        return {
            data:[],
            products: [],
            allBrands: [],
            isClickBrandFilter: false,
            brandFilterValue: null,
            current_page: 1,
            last_page: null,
            price_arrange: "asc"
        }
        
    },
    // beforeCreate(){
    //     this.current_page = 1;
    // },
    created(){
        this.getSearchData();
    },
    methods: {
        async getSearchData(){
            let page = this.current_page
            let arrange = this.price_arrange
            let kwd = this.$route.query.keyword
            let url = "http://127.0.0.1:8000/api/products?" + "page=" + page + "&arange=" + arrange + "&search=" + kwd
            console.log(url)
            if (this.brandFilterValue != null)
                url = url + "&brand=" + this.brandFilterValue
            // const response = this.$http.get(url);
            // this.searchProduct = response.data
            // console.log(this.current_page)
            try {
                let response = await fetch(url).then(res=>res.clone().json());
                this.data = response.data;
                this.last_page = response.data.last_page
                // console.log("last page: " + this.last_page)
                this.products = response.data.data;
                console.log(this.data)
                    // console.log(this.products.length)
                if (this.allBrands.length == 0){
                    let brands = []
                    let c = 0
                    for (c >= 0; c < this.products.length; c++){
                        // console.log(i)
                        brands.push(this.products[c]["brand"])
                        // console.log(this.products[i]["brand"])
                    }
                    this.allBrands = brands.filter((v,i,a)=>a.indexOf(v)==i)
                }
                // console.log(this.allBrands[1])
                // console.log(Array.prototype.map(response.data))
                // console.log(this.products.brands)
            } catch (error) {
                console.log(error);
            }

        },
        handleChangePage(a){
            if (a == "back"){
                if (this.current_page > 1)
                    this.current_page = this.current_page - 1
            }
            else{
                if (this.current_page < this.last_page)
                    this.current_page = this.current_page + 1 
            }
            if (this.curent_page != 0)
                this.getSearchData()
        },
        // getImgUrl(drug) {
        //     return require('../assets/images/' + drug +'.jpg');
        // },
        handleClickBrandFilter(){
            this.isClickBrandFilter = !this.isClickBrandFilter
        },
        handleBrandChoosen(brand){
            // console.log("here")
            // console.log("before: "+ this.brandFilterValue)
            this.brandFilterValue = brand;
            this.isClickBrandFilter = !this.isClickBrandFilter
            // console.log("after: "+ this.brandFilterValue)
            this.getSearchData()
        },
        handleFilterPrice(a){
            this.price_arrange = a
            console.log("price arrange: " + this.price_arrange)
            this.getSearchData()
        },
        addToCart(product){
            console.log(product)
            this.$emit('addToCart', product)
            // this.$emit('update-cart', product)
        }
    }
}
</script>

<style scoped>
    @import url('../styles/view/searchpage.css');
</style>