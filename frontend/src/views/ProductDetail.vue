<template>
    <div class="product-detail" v-if="product!=null">
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
                    <div class="price"><span>{{ product.price }}</span>VND/sản phẩm</div>
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
                    <NumberAdjust/>
                    <Button
                        text="Thêm vào giỏ hàng"
                        btnClass="orange-btn"
                    />
                    <Button
                        text="Mua ngay"
                        btnClass="blue-btn"
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
            <GridProducts/>
        </div>
    </div>
</template>
<script>
import SlideShow from '@/components/common/SlideShow.vue';
import NumberAdjust from '@/components/common/NumberAdjust.vue';
import Button from '@/components/common/Button.vue';
import GridProducts from '@/components/base/GridProducts.vue';

// import axios from 'axios';
export default{
    components: {
        SlideShow, NumberAdjust, Button, GridProducts
    } , 
    data(){
        return{
            product: null,
            images: [],
        }
    },
    created() {
        this.getProductDetail()

    }, 
    methods: {
        async getProductDetail(){
            const productId = String(this.$route.params.productId)
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
                };

            await fetch(`http://127.0.0.1:8000/api/products/${productId}`, requestOptions)
            .then(response => response.json())
            .then(res=>{
                this.product=res[0]
                console.log(this.product)
                this.images.push(this.product.product_image)
                this.getProductDescription()
            })
            .catch(error => console.log('error', error));
        },
        getProductDescription(){
            this.$nextTick(()=>{
                console.log(this.$refs)
            this.$refs.productDetail.insertAdjacentHTML('afterbegin', this.product.description)
            })
            
        }
    }                                                                                                 
}
</script>
<style scoped lang="scss">
    @import '../styles/scss/main.scss'
</style>

