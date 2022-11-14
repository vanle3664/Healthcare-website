<template lang="">
    <div class="cart_page">
        <div class="breaker_horizontal"> > Giỏ hàng</div>
        <div class="all_content">
            <div class="left_content">
                <div class="products" v-for="(product, index) in productList" v-bind:key="product.name">
                    <div class="prod_img">
                        <img src="../../assets/product_img.webp">
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
                <div class="delivery_info">Delivery</div>
            </div>
            <div class="breaker_vertical"></div>
            <div class="right_content">
                <div class="order_info">Order</div>
            </div>        
        </div>
    </div>


    
</template>
<script>
export default {
    name: 'TheCart',
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
            ]
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
            if (num_product > 0) 
                this.productList[index["index"]]["num"]--;
            
        },
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/cart.css');
</style>