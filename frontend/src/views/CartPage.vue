
<template lang="">
    <div class="cart_page">
        <div class="breaker_horizontal" @click="handleBack"> 
            <i class="fa-solid fa-circle-arrow-left"></i>
            Quay lại mua hàng
        </div>
        <div class="all_content">
            <div class="left_content">
                <div class="products" v-for="(product, index) in productList" v-bind:key="product.name">
                    <div class="prod_img">
                        <img src="../assets/product_img.webp">
                    </div>
                    <div class="products_info">
                        <div class="top_info">
                            <div class="product_name">{{product.name}}</div>
                            <div class="product_num">
                                <span class="minus" @click="handleMinus({index})"> - </span>
                                <span class="num">{{product.num}}</span>
                                <span class="add" @click="handleAdd({index})"> + </span>
                            </div>
                        </div>
                        <div class="product_totalPrice">Đơn giá: {{product.num}} x {{product.price}} = {{product.num*product.price}}</div>
                    </div>
                </div>
                <div class="delivery_info">
                    <div class="delivery_title">Nhập thông tin người nhận: </div>
                    <div class="customer_info">
                        <input  v-model="text" size="20" placeholder="Nhập họ tên" name="Họ và tên người nhận"/>
                        <input  v-model="text" size="20" placeholder="Nhập số điện thoại" name="Số điện thoại người nhận"/>
                    </div>
                    <div class="customer_address">
                        <input placeholder="Nhập tỉnh/thành phố"/>
                        <input placeholder="Nhập quận/huyện"/>
                        <input placeholder="Nhập phường/xã"/>
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
                        <div class="price_value">{{cartTotal()}}</div>
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
                    <div class="btnPay">Đặt hàng ngay</div>
                </div>
            </div>        
        </div>
    </div>


    
</template>
<script>
//import { library } from "@fortawesome/fontawesome-svg-core";
//import { faPhone } from "@fortawesome/free-solid-svg-icons";
//import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
export default {
    name: 'TheCart',
    components: {
    },
    props: {
    },
    data() {
        return {
            productList : [
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 1, price: 30000},
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
                {name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", num: 10, price: 10000}, 
            ],
        
        }
    },
    computed : {
    },
    methods: {
        handleAdd(index){
            this.productList[index["index"]]["num"]++;
        },
        handleMinus(index){
            let num_product = this.productList[index["index"]]["num"];
            if (num_product > 1) 
                this.productList[index["index"]]["num"]--;
            
        },
        handleBack(){
            this.$router.push('/')
        },
        cartTotal(){
            let a = this.productList.reduce( (acc, item) => {
                return acc + item.num*item.price
            }, 0)
            a = a.toLocaleString({style : 'currency', currency : 'VND'});
            return a
        },
        shippingFee(){
            let b = 10000
            return b.toLocaleString({style : 'currency', currency : 'VND'})
        },
        orderTotal(){
            let a = this.productList.reduce( (acc, item) => {
                return acc + item.num*item.price
            }, 0)
            let b = 10000
            return (a + b).toLocaleString({style : 'currency', currency : 'VND'})
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/cartpage.css');
</style>