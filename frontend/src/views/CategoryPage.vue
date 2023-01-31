<template>
    <div class="category-page">
        <div class="category-title">{{this.$route.params.catName}} </div>
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
        <LoadingBar v-if="isLoading" />
        <div v-else class="category-content">
            <GridProducts :products-list="products"></GridProducts>
            <div class="btn">
                <div ref="back" class="back-next-btn disable" @click="handleChangePage(`back`)">
                    Back 
                    <i class="fa-solid fa-arrow-left" ></i>         
                </div>
                <div>page {{current_page}}</div>
                <div ref="next" class="back-next-btn disable" @click="handleChangePage(`next`)">
                    Next 
                    <i class="fa-solid fa-arrow-right" ></i>          
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import GridProducts from '../components/base/GridProducts.vue';
import LoadingBar from '../components/common/LoadingBar.vue'
export default {
    name: 'CategoryPage',
    components: {
        GridProducts, LoadingBar
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
            price_arrange: "asc",
            isLoading: true
        }
        
    },
    // beforeCreate(){
    //     this.current_page = 1;
    // },
    created(){
        this.getcategoryData();
    },
    methods: {
        async getcategoryData(){
            let url = "http://127.0.0.1:8000/api/products/categories/" + this.$route.params.catId + "?page=" + this.current_page
            console.log(url)
            if (this.brandFilterValue != null)
                url = url + "&brand=" + this.brandFilterValue
            // const response = this.$http.get(url);
            // this.categoryProduct = response.data
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
            this.isLoading = false
        },
        handleChangePage(a){
            this.isLoading = true
            if (a == "back" && this.current_page > 1){
                this.current_page = this.current_page - 1
                this.getcategoryData()
            }
            else if (a == "next" && this.current_page < this.last_page){
                this.current_page = this.current_page + 1 
                this.getcategoryData()
            }
            else {
                let modal = document.querySelector(".back-next-btn")
                modal.classList.toggle("disable")
            }
            // if (this.curent_page != 0)
            //     this.getcategoryData()
            this.isLoading = false
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
            this.getcategoryData()
        },
        handleFilterPrice(a){
            this.price_arrange = a
            console.log("price arrange: " + this.price_arrange)
            this.getcategoryData()
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
    @import url('../styles/view/categorypage.css');
</style>