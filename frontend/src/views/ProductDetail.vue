<template>
    <div class="product-detail" v-if="product!=null && display" ref="reload">
        <div class="product-images-info">
            <div class="slideshow-container">
                <SlideShow
                    :images="images"
                />
            </div>
            <div class="product-info">
                <div class="product-desc-1">
                    <div class="title">
                        {{ product.product_name }}
                    </div>
                    <div class="price"><span>{{ product.price.toLocaleString({style : 'currency', currency : 'VND'}) }}</span>VND/sản phẩm</div>
                    <div>
                        <i class="fa-regular fa-copyright"></i>
                        {{ product.brand }}
                    </div>
                    <div>
                        <i class="fa-solid fa-check"></i>
                        {{ product.quantity_available }} sản phẩm có sẵn
                    </div>
                    <div>
                        <i class="fa-solid fa-check"></i>
                        Cam kết sản phẩm chính hãng
                    </div>
                </div>
                <div class="product-options">
                    <NumberAdjust 
                        productItem=""
                        ref="quantity"
                    />
                    <Button
                        text="Thêm vào giỏ hàng"
                        btnClass="orange-btn"
                        @click="addProductToCart"
                    />
                    <Button
                        text="Mua ngay"
                        btnClass="blue-btn"
                        @click="buyNow"
                    />
                </div>
                
            </div>
        </div>
        <div class="product-desc-2 scrollable">
            <div class="title">Mô tả sản phẩm</div>
            <div ref="productDetail"></div>
        </div>
        <div class="products-grid-container">
            <div class="title">Sản phẩm tương tự</div>
            <div class="product-list scrollable-invisible" ref="productList">
                <div class="prev-btn slide-btn" v-on:click="prevBtnOnClick()">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <Product v-for="(rproduct, index2) in relatedProducts" :key="index2"
                    :product="rproduct">
                </Product>
                <div class="next-btn slide-btn" v-on:click="nextBtnOnClick">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import SlideShow from '@/components/common/SlideShow.vue';
import NumberAdjust from '@/components/common/NumberAdjust.vue';
import Button from '@/components/common/Button.vue';
// import GridProducts from '@/components/base/GridProducts.vue';
import Product from '@/components/base/Product.vue';
import { mapStores } from 'pinia'
import { useCartStore } from '../store/cart';
// import { mapState } from 'pinia';

// import axios from 'axios';
export default{
    components: {
        SlideShow, NumberAdjust, Button, Product
    } , 
    data(){
        return{
            product: null,
            productId: null,
            quantity: 1,
            images: [],
            relatedProducts: [],
            display: false,
        }
    },
    created() {
        this.getProductDetail()
    }, 
    computed: {
        ...mapStores(useCartStore)
    },
    watch: {
        $route(){
            this.getProductDetail()
            this.$refs.quantity.value = 1
            this.$refs.reload.scrollIntoView({ behavior: 'smooth' })
            // console.log(this.$refs.reload.scrollHeight)
        }
    },
    methods: {
        async getProductDetail(){
            this.display = false
            this.productId = String(this.$route.params.productId)
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
                };

            await fetch(`http://127.0.0.1:8000/api/products/${this.productId}`, requestOptions)
            .then(response => response.json())
            .then(res=>{
                this.product=res[0]
                this.images=[]
                this.images.push(this.product.product_image)
                console.log(this.product)
                this.display = true
                this.getProductDescription()
            })
            .catch(error => console.log('error', error));
            this.getRelatedProduct();
        },
        async getRelatedProduct(){
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            await fetch(`http://127.0.0.1:8000/api/products/categories/${this.product.productType_id}`, requestOptions)
            .then(response => response.json())
            .then(res=>{
                this.relatedProducts=res.data.data
                console.log("related products")
            })
            .catch(error => console.log('error', error));
        },
        getProductDescription(){
            this.$nextTick(()=>{
                this.$refs.productDetail.insertAdjacentHTML('afterbegin', this.product.description || "<p>Chúng tôi đang cập nhật mô tả cụ thể cho sản phẩm này</p>")
            })
            
        },
        addProductToCart(){
            this.quantity = this.$refs.quantity.value
            console.log(this.quantity)
            this.cartStore.addToCart(this.product, this.quantity)
            console.log(this.cartStore.cart)
        },
        buyNow(){
            this.addProductToCart()
            this.$router.push({name: 'cart-page'})
        },
        nextBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width
            this.$refs.productList.scrollLeft += productWidth

        },
        prevBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width;
            this.$refs.productList.scrollLeft -= productWidth
            
        },
    }                                                                                                 
}
</script>
<style scoped lang="scss">
    @import '../styles/scss/main.scss'
</style>

