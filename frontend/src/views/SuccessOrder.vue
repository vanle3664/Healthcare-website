<template>
    <div class="success-order">
        <div class="success-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="success-text">Đặt hàng thành công</div>
        <div class="email-confirm">HealthCare đã gửi chi tiết đơn hàng về email của bạn!</div>
        <div class="backBtn" @click="handleBack()">Tiếp tục mua sắm</div>
    </div>
</template>

<script>
export default {
    name: 'SuccessOrder',
    methods: {
        handleBack(){
            this.$router.push('/')
        }
    }
}
</script>

<style scoped>
    @import url('../styles/view/successorder.css');
</style>