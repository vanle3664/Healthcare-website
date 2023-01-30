
<template lang="">
    <div class="cart_page" v-if="cartStore.cart.length > 0">
        <div class="breaker_horizontal" @click="handleBack"> 
            <i class="fa-solid fa-circle-arrow-left"></i>
            Quay lại mua hàng
        </div>
        <div class="all_content">
            <div class="left_content">
                <div class="cart_title">Bạn có {{cartStore.cart.length}} sản phẩm trong giỏ </div>
                <div class="products" v-for="(item, index) in cartStore.cart" v-bind:key="index">
                    <div class="prod_img">
                        <img :src=item.product.product_image>
                    </div>
                    <div class="products_info">
                        <div class="top_info">
                            <div class="product_name">{{item.product.product_name}}</div>
                            <!-- <div class="product_num">
                                <span class="minus" @click="() => updateQuantity(index, product.num - 1)"> - </span>
                                <span class="num">{{product.num}}</span>
                                <span class="add" @click="() => updateQuantity(index, product.num + 1)"> + </span>
                            </div> -->
                            <NumberAdjust
                                :productItem="item"
                            />
                            <div class="delete" @click="cartStore.removeFromCart(index)">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </div>
                        <div class="product_totalPrice">Đơn giá: {{item.product.price.toLocaleString({style : 'currency', currency : 'VND'})}} </div>
                    </div>
                </div>
                <div class="delivery_info">
                    <div class="delivery_title">Nhập thông tin người nhận</div>
                    <div class="customer_info">
                        <input  v-model="text" size="20" placeholder="Nhập họ tên" name="Họ và tên người nhận"/>
                        <input  v-model="text" size="20" placeholder="Nhập số điện thoại" name="Số điện thoại người nhận"/>
                    </div>
                    <div class="delivery_title">Email
                        <div class="note">HealthCare sẽ cập nhật thông tin đơn hàng thường xuyên về email</div>
                    </div>
                    <div>
                        <input placeholder="Nhập email"/>
                    </div>
                    <div class="delivery_title">Địa chỉ</div>
                    <div class="customer_address">
                        <input placeholder="Nhập số nhà"/>
                        <input placeholder="Nhập phường/xã"/>
                        <input placeholder="Nhập quận/huyện"/>
                        <input placeholder="Nhập tỉnh/thành phố"/>
                    </div>
                    <div class="delivery_title">Ghi chú</div>
                    <div>
                        <input placeholder="Ghi chú đơn hàng"/>
                    </div>
                </div>
            </div>
            <div class="breaker_vertical"></div>
            <div class="right_content">
                <div class="order_top">
                    <!-- <div class="order_icon"></div> -->
                    <i class="fa-solid fa-cart-shopping"></i>
                    <div class="order_title">THÔNG TIN ĐƠN HÀNG</div>
                </div>
                <div class="order_info">
                    <div class="price">
                        <div class="price_title">Tổng tiền:</div>
                        <div class="price_value">{{cartStore.totalBill.toLocaleString({style : 'currency', currency : 'VND'})}}</div>
                    </div>
                    <div class="price">
                        <div class="price_title">Phí giao hàng:</div>
                        <div class="price_value">{{shippingFee()}}</div>
                    </div>
                </div>
                <div class="sumup">
                    <div class="price_title">Cần thanh toán:</div>
                    <div class="price_value">{{orderTotal()}}</div>
                </div>
                <div class="order_bottom">
                    <div class="btnPay" @click="handleOrder()">Đặt hàng ngay</div>
                </div>
            </div>        
        </div>
    </div>
    <div v-else class="empty_cart">
        <div class="empty_cart_icon">
            <i class="fa-solid fa-cart-plus"></i>
            <!-- <i src="https://nhathuoclongchau.com/frontend_v3/images/cart-status-mb.png"></i> -->
        </div>
        <div class="empty_cart_title">Giỏ hàng của bạn đang trống</div>
        <div class="backBtn" @click="handleBack">TRANG CHỦ MUA SẮM</div>
    </div>
</template>
<script>
import { useCartStore } from '@/store/cart';
import { mapStores } from 'pinia';
import NumberAdjust from '@/components/common/NumberAdjust.vue';
export default {
    name: 'TheCart',
    components: {
        NumberAdjust
    },
    props: {
    },
    data() {
        return {
            // cart : [
            //     {
            //         id: 1, 
            //         img: "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/__sized__/products/P22919_1-thumbnail-255x255-70.jpg",
            //         name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", 
            //         num: 10, 
            //         price: 10000
            //     }, 
            //     {
            //         id: 2, 
            //         img: "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/__sized__/products/P23693_1-thumbnail-255x255-70.jpg",
            //         name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", 
            //         num: 3, 
            //         price: 30000},
            // ],
        
        }
    },
    created(){
        console.log(this.cartStore.cart)
    },
    computed : {
        ...mapStores(useCartStore)
    },
    methods: {
  
        handleBack(){
            this.$router.push('/')
        },
        shippingFee(){
            let b = 10000
            return b.toLocaleString({style : 'currency', currency : 'VND'})
        },
        orderTotal(){
            let a = this.cartStore.totalBill
            let b = 10000
            return (a + b).toLocaleString({style : 'currency', currency : 'VND'})
        },
        handleOrder(){
            console.log(this.cartStore.cart)
            this.$router.push("/success-order")
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/cartpage.css');
</style>