
<template lang="">
    <div class="cart_page" v-if="cart.length > 0">
        <div class="breaker_horizontal" @click="handleBack"> 
            <i class="fa-solid fa-circle-arrow-left"></i>
            Quay lại mua hàng
        </div>
        <div class="all_content">
            <div class="left_content">
                <div class="cart_title">Bạn có {{this.cart.length}} sản phẩm trong giỏ </div>
                <div class="products" v-for="(product, index) in cart" v-bind:key="product.name">
                    <div class="prod_img">
                        <img :src=product.img>
                    </div>
                    <div class="products_info">
                        <div class="top_info">
                            <div class="product_name">{{product.name}}</div>
                            <div class="product_num">
                                <span class="minus" @click="() => updateQuantity(index, product.num - 1)"> - </span>
                                <span class="num">{{product.num}}</span>
                                <span class="add" @click="() => updateQuantity(index, product.num + 1)"> + </span>
                            </div>
                            <div class="delete" @click="handleDelete({index})">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </div>
                        <div class="product_totalPrice">Đơn giá: {{product.num}} x {{product.price}} = {{product.num*product.price}}</div>
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
export default {
    name: 'TheCart',
    components: {
    },
    props: {
    },
    data() {
        return {
            cart : [
                {
                    id: 1, 
                    img: "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/__sized__/products/P22919_1-thumbnail-255x255-70.jpg",
                    name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", 
                    num: 10, 
                    price: 10000
                }, 
                {
                    id: 2, 
                    img: "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/__sized__/products/P23693_1-thumbnail-255x255-70.jpg",
                    name: "Sữa Bột Abbott Glucerna Dinh Dưỡng Đặc Biệt Cho Người Đái Tháo Đường", 
                    num: 3, 
                    price: 30000},
            ],
        
        }
    },
    computed : {
    },
    methods: {
        handleAdd(index){
            this.cart[index["index"]]["num"]++;
        },
        handleMinus(index){
            let num_product = this.cart[index["index"]]["num"];
            if (num_product > 1) 
                this.cart[index["index"]]["num"]--;
            
        },
        updateQuantity(index, quantity){
            this.cart[index]["num"] = quantity
        },
        handleBack(){
            this.$router.push('/')
        },
        handleDelete(index){
            console.log(this.cart.length)
            if (this.cart.length == 1 ){
                this.cart = []
            }
            else 
                this.cart = this.cart.splice(index["index"] - 1, 1)
        },
        cartTotal(){
            let a = this.cart.reduce( (acc, item) => {
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
            let a = this.cart.reduce( (acc, item) => {
                return acc + item.num*item.price
            }, 0)
            let b = 10000
            return (a + b).toLocaleString({style : 'currency', currency : 'VND'})
        },
        handleOrder(){
            this.$router.push("/success-order")
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/cartpage.css');
</style>