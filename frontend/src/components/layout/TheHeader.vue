<template lang="">
    <div class="header">
        <div class="page-logo" @click="handleClickName"></div>
        <div class="page-name" @click="handleClickName">HEALTH<br>CARE</div>
        <div class="account" @click="handlePopUp(`.login-signup-modal`)" @mouseover="isOpenAccountOption=true">
            <i class="fa-solid fa-user"></i>
            <div class="account-name">{{has_signin?this.account.name:"Login"}}</div>
        </div>
        <div class="cart" @click="handleClickCart">
            <div class="cart-logo"></div>
            <div class="cart-number">{{cartStore.cart.length}}</div>
            <div class="cart-text">Giỏ hàng</div>
        </div>
    </div>
    <div v-if="!has_signin" class="login-signup-modal hide">
        <div class="login-signup-inner">
            <div class="login-signup-header">
                <div>{{create_account?"Signup":"Login"}}</div>
                <i class="fas fa-times" @click="handlePopUp(`.login-signup-modal`)"></i>
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
                    <div class="note">One number is used for one account only</div>
                </div> 
                <div class="password">
                    <InputItem 
                        label="Password"
                        :blindInput="true"
                        v-model="account.password"
                    /> 
                    <div class="note">min 6 characters</div>
                </div> 
                

            </div>
            <div class="login-signup-footer">
                <div v-if="signin_error&&!create_account" class="note">Email or password is wrong! Check & submit again</div>
                <div v-if="create_account">
                    <ul v-for="(error, index) in errors" :key="index" class="note">({{index + 1}}) {{error}}</ul>
                </div>
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
    <div class="congrats-modal hide">
        <div class="congrats-inner">
            <div class="congrats-header">
                <i class="fas fa-times" @click="handlePopUp(`.congrats-modal`)"></i>
            </div>
            <div class="congrats-content">
                <img src="https://img.icons8.com/bubbles/200/000000/trophy.png">
                <div class="sentence">Huray! You've created your account successfully!</div>
            </div>
            <div class="congrats-footer">
                <button @click="handlePopUp(`.congrats-modal`)">Explore now</button>
            </div> 
        </div>
    </div>
    <div v-if="isOpenAccountOption&&has_signin" class="account-option" @mouseleave="isOpenAccountOption=false"> 
        <div class="orders">
            <i class="fa-solid fa-scroll"></i>
            Your orders
        </div>
        <div class="log-out" @click="logout()">
            <i class="fa-solid fa-right-from-bracket"></i>
            Log out
        </div>
    </div>
</template>
<script>
import InputItem from "../common/InputItem.vue"
import pinia from "@/store";
import { mapStores } from "pinia";
import { useCartStore } from "@/store/cart";

export default {
    name: 'TheHeader',
    created(){
        useCartStore(pinia)
    },
    data() {
        return {
            account: {
                name: "",
                email: "van@gmail.com",
                phone_number: "0123456789",
                // password: "123456",
                password: "",
                token: null,
            },
            create_account: false,
            signin_error: false,
            signup_error: false,
            has_signin: false,
            isOpenAccountOption: false,
            cartfromheader: [], 
            errors: []
        };   
    },
    components: {
        InputItem,
    },
    computed: {
        ...mapStores(useCartStore)
    },
    methods: { 
        handleClickCart(){
            console.log("click cart")
            this.$router.push('/my-cart')
        },
        handleClickName(){
            this.$router.push('/')
        },
        handlePopUp(m){
            let modal = document.querySelector(m)
            modal.classList.toggle("hide")
        },
        switch_signup_login(){
            this.create_account = !this.create_account
        },
        handleResponse(response, formname) {
            return response.text().then(text => {
                const data = text && JSON.parse(text);
                console.log("resp: " + data)
                if (!response.ok) {
                    console.log("data's msg: ", data.errors)
                    this.errors = data.errors
                    const error = (data && data.msg) || response.statusText;
                    if (formname == "signup")
                        this.signup_error = true
                    else
                        this.signin_error = true
                    console.log("error nè")
                    console.log(error)
                    return Promise.reject(error);
                }
                else{
                    this.has_signin = true
                    this.account.name = data.user.name
                    this.account.token = data.token
                    console.log(data)
                }
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
            return fetch(`http://127.0.0.1:8000/api/users/login`, requestOptions)
                    .then(this.handleResponse, "signin")
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
                    .then(this.handleResponse, "signup")
        },
        handleSubmit(){
            // const delay = ms => new Promise(res => setTimeout(res, ms))
            if (this.create_account){
                this.signup().then(res => {
                    if (res.token){
                        console.log("res token" , res.token)
                        // console.log("no error").then(() => {
                        //     this.handlePopUp(".login-signup-modal")
                        //     this.handlePopUp(".congrats-modal")
                        // })
                        this.handlePopUp(".congrats-modal")
                    }
                    else {
                        console.log("error")
                        this.signup_error = true;
                    }
                });
            }
            else {
                this.signin().then(res => {
                    console.log(res.token)
                    if (res.token){
                        this.handlePopUp(".login-signup-modal")
                    }
                    else {
                        console.log("error")
                        this.signin_error = true
                    }
                });
            }
            
        },
        async logout(){
            const myHeaders = new Headers();
            myHeaders.append("Authorization", "Bearer " + this.account.token);

            const requestOptions = {
            method: 'POST',
            headers: myHeaders,
            redirect: 'follow'
            };

            fetch("http://127.0.0.1:8000/api/users/logout", requestOptions)
            .then(response => response.text())
            .then(() => {
                // console.log('success', result)
                this.has_signin = false
            })
            .catch(error => console.log('error', error));      
        }
        
    },
    watch: {
        searchText: function(){
            // console.log(this.searchText)   
        },
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/header.css');
</style>