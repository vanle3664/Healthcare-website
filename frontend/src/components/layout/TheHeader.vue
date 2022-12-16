<template lang="">
    <div class="header">
        <div class="page-logo" @click="handleClickName"></div>
        <div class="page-name" @click="handleClickName">HEALTH<br>CARE</div>
        <div class="account" @click="handlePopUp" @mouseover="isOpenAccountOption=true">
            <i class="fa-solid fa-user"></i>
            <div class="account-name">{{has_signin?this.account.name:"Login"}}</div>
        </div>
        <div class="cart" @click="handleClickCart">
            <div class="cart-logo"></div>
            <div class="cart-number"></div>
            <div class="cart-text">Giỏ hàng</div>
        </div>
    </div>
    <div class="login-signup-modal hide">
        <div class="login-signup-inner">
            <div class="login-signup-header">
                <div>{{create_account?"Signup":"Login"}}</div>
                <i class="fas fa-times" @click="handlePopUp"></i>
            </div>
            <div class="login-signup-content">
                <div v-if="create_account" class="name">
                    <InputItem
                        label="What can we call you"
                        :searchInput="false"
                        v-model="account.name"
                    /> 
                </div>
                <div class="email">
                    <InputItem
                        label="Email"
                        :searchInput="false"
                        v-model="account.email"
                    /> 
                </div>
                <div v-if="create_account" class="phone-number">
                    <InputItem 
                        label="Phone number"
                        :searchInput="false"
                        v-model="account.phone_number"
                    /> 
                </div> 
                <div class="password">
                    <InputItem 
                        label="Password"
                        :searchInput="false"
                        v-model="account.password"
                    /> 
                </div> 
                <!-- <div class="note">*min 6 characters</div> -->

            </div>
            <div class="login-signup-footer">
                <div v-if="is_error&&!create_account" class="note">Email or password is wrong! Check & submit again</div>
                <button @click="handleSubmit">Submit</button>
            </div>
            <div class="login-signup-addition" >
                <div v-if="!create_account" class="switch" >
                    <div>You haven't got accounts? </div>
                    <div class="call-for-action" @click="switch_signup_login">Sign up for free!</div>
                </div> 
                <div v-else class="switch" >
                    <div>You have already got an account? </div>
                    <div class="call-for-action" @click="switch_signup_login">Sign in now!</div>
                </div> 
            </div>
        </div>  
    </div>
    <div v-if="isOpenAccountOption" class="account-option" @mouseleave="isOpenAccountOption=false"> 
        <div class="orders">
            <i class="fa-solid fa-scroll"></i>
            Your orders
        </div>
        <div class="log-out">
            <i class="fa-solid fa-right-from-bracket"></i>
            Log out
        </div>
    </div>
</template>
<script>
import InputItem from "../common/InputItem.vue"
export default {
    name: 'TheHeader',
    data() {
        return {
            account: {
                name: "",
                email: "van@gmail.com",
                phone_number: "0123456789",
                password: "123456",
            },
            create_account: false,
            is_error: false,
            has_signin: false,
            isOpenAccountOption: false,
        };   
    },
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
        handleHoverAccount(){
            
        },
        handlePopUp(){
            let modal = document.querySelector(".login-signup-modal")
            modal.classList.toggle("hide")
        },
        switch_signup_login(){
            this.create_account = !this.create_account
        },
        handleResponse(response) {
            return response.text().then(text => {
                const data = text && JSON.parse(text);
                if (!response.ok) {
                    const error = (data && data.message) || response.statusText;
                    this.is_error = true
                    return Promise.reject(error);
                }
                this.has_signin = true
                this.account.name = "Vân"
                return data;
            });
        },
        async signin(){
            let email = this.account.email
            let password = this.account.password
            const requestOptions = {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            };
            fetch(`http://127.0.0.1:8000/api/users/login`, requestOptions)
                    .then(this.handleResponse)
            this.handlePopUp()
        },
        async signup(){
            let email = this.account.email
            let password = this.account.password
            let name = this.account.name
            let number_phone = this.account.phone_number
            let is_admin = 0
            const requestOptions = {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, email, password, number_phone, is_admin })
            };
            return fetch(`http://127.0.0.1:8000/api/users/register`, requestOptions)
                    .then(this.handleResponse)
        },
        handleSubmit(){
            if (this.create_account){
                this.signup()
            }
            else {
                this.signin()
            }
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