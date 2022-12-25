<template>
    <div class="product-detail">
        <div class="product-images-info">
            <div class="slideshow-container">
                <SlideShow/>
            </div>
            <div class="product-info">
                <div class="product-desc-1 scrollable">
                    <div class="title">
                        {{ product.product_name }}
                    </div>
                    <p>{{product.description}}</p>
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
            <p>{{ product.description }}</p>
        </div>
        <div class="products-grid-container">
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
            // const url = `http://127.0.0.1:8000/api/products/${productId}`
            // fetch(url, requestOptions)
            //     .then(res=>res.json())
            //     .then(res=>{
            //         this.product = res[0]
                    
            //     })
                fetch(`http://127.0.0.1:8000/api/products/${productId}`, requestOptions)
                .then(response => response.json())
                .then(res=>this.product=res[0])
                .then(result => console.log(result))
                .catch(error => console.log('error', error));
        }
    }                                                                                                 
}
</script>
<style scoped lang="scss">
    @import '../styles/scss/main.scss'
</style>

