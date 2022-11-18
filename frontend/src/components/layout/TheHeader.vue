<template lang="">
    <div class="header">
        <div class="page-logo"></div>
        <div class="page-name">HEALTH<br>CARE</div>
        <div class="cart" @click="handleClickCart">
            <div class="cart-logo"></div>
            <div class="cart-number"></div>
            <div class="cart-text">Giỏ hàng</div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'TheHeader',
    methods: {
        handleClickCart(){
            this.$router.push('/mycart')
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/header.css');
</style>