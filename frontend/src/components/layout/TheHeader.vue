<template lang="">
    <div class="header">
        <div class="page-logo" @click="handleClickName"></div>
        <div class="page-name" @click="handleClickName">HEALTH<br>CARE</div>
        <div class="admin-account" @click="handleClickAccount">
            <i class="fa-solid fa-user"></i>
            <div>Admin</div>
        </div>
        <div class="cart" @click="handleClickCart">
            <div class="cart-logo"></div>
            <div class="cart-number"></div>
            <div class="cart-text">Giỏ hàng</div>
        </div>
    </div>
    <div class="login-modal hide">
        <div class="login-inner">
            <div class="login-header">
                <div>Login</div>
                <i class="fas fa-times" @click="handleCloseSignIn()"></i>
            </div>
            <div class="login-content">
                <div class="email">
                    <InputItem
                        label="Email"
                        :searchInput="false"
                        v-model="searchText"
                    /> 
                </div>
                <div class="password">
                    <InputItem 
                        label="Password"
                        :searchInput="false"
                        v-model="searchText"
                    /> 
                </div>             
            </div>
            <div class="login-footer">
                <button @click="handleSignIn()">Submit</button>
            </div>
        </div>
        
    </div>
</template>
<script>
import InputItem from "../common/InputItem.vue"
export default {
    name: 'TheHeader',
    components: {
        InputItem,
    },
    methods: { 
        handleClickCart(){
            this.$router.push('/my-cart')
        },
        handleClickName(){
            this.$router.push('/')
        }, 
        handleClickAccount(){
            let modal = document.querySelector(".login-modal")
            modal.classList.toggle("hide")
        },
        handleCloseSignIn(){
            let modal = document.querySelector(".login-modal")
            modal.classList.toggle("hide")
        },
        handleSignIn(){
            let modal = document.querySelector(".login-modal")
            modal.classList.toggle("hide")
        }
    },
    watch: {
        searchText: function(){
            console.log(this.searchText)
        },
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/header.css');
</style>