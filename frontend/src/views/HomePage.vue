<template lang="">
    <div class="homepage">
        <div class="search">
            <div class="text-search">
                <InputItem
                    label="Tìm kiếm theo tên thuốc"
                    :searchInput="true"
                    v-model="searchText"
                />
            </div>
            <div class="img-search">
                <i class="fa-solid fa-camera"></i>
            </div>
            <div class="hot-search scrollable-invisible">
                <div class="hot-item" v-for="(item, index) in hotItems" :key="index" v-on:click="searchRecOnClick($event)">{{item}}</div>
            </div>
        </div>
        <div class="product-category">
            <label>Thực phẩm chức năng</label>
            <router-link to='/products'>Xem thêm</router-link>
            <div class="product-list scrollable-invisible" ref="productList">
                <div class="prev-btn slide-btn" v-on:click="prevBtnOnClick">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="product-card" v-for="(product, index) in products" :key="index">
                    <div class="product-img">
                        <img :src="getImgUrl(product.img)">
                    </div>
                    
                    <div class="product-name">{{product.name}}</div>
                    <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
                </div>
                <div class="next-btn slide-btn" v-on:click="nextBtnOnClick">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="chat-bot">
            <div class="chat-icon" @click="handleClickChat()">
                <i class="fa-solid fa-comments"></i>
            </div> 
            <div v-if="isClickBot" class="chat-screen">
                <div class="chat-title">Chat cùng HEALTHCARE</div>
                <!-- <div class="dialog">
                    <div class="answer">
                        <div class="avatar">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div class="mess">Answer</div>
                    </div>
                    <div class="ask">
                        <div class="avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="mess">Ask ask ask ask ask ask ask ask</div>
                    </div>
                </div> -->
                <div class="msgs scrollable" ref="msgs">
                    <div class="wrap-msg" v-for="(msg, index) in msgs" :key="index" :class="getClass(msg)">
                        <div class="msg" :class="getClass(msg)">
                            {{msg.content}}
                        </div>
                    </div>
                </div>
                <div class="send-msg">
                    <input>
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import InputItem from '../components/common/InputItem.vue';
export default {
    name: 'HomePage',
    props:{
    },
    components: {
        InputItem,
    },
    created(){
        this.msgs=[
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys djfk akfj alfjk alfj alfkjd djf '
                },
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys djfk akfj alfjk alfj alfkjd djf '
                },
                
                
            ]
    },
    data(){
        return{
            searchText: '',
            hotItems: [
                'Thuốc', 'Vitamin', 'Thực phẩm chức năng'
            ],
            products: [
                {
                    img: 'default-drug',
                    name: 'Vitamin1',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin2',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin3',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin4',
                    price: '230.000',
                },
                {
                    img: 'default-drug',
                    name: 'Vitamin5',
                    price: '230.000',
                }
            ],
            isClickBot: false,
            myId: '1',
            msgs: [],
        }
    },
    methods: {
        getImgUrl(drug) {
            return require('../assets/images/' + drug +'.jpg');
        },
        nextBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width
            this.$refs.productList.scrollLeft += productWidth
            // console.log(this.$refs.productList.scrollLeft)
            // console.log(this.$refs.productList.parentElement.getBoundingClientRect().width - 40)
            // console.log(this.$refs.productList.getBoundingClientRect().width)
        },
        prevBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width;
            this.$refs.productList.scrollLeft -= productWidth
            
        },
        searchRecOnClick(event){
            console.log(event.target.innerHTML)
            this.searchText = event.target.innerHTML
        },
        handleClickChat(){
            console.log(!this.isClickBot)
            this.isClickBot = !this.isClickBot
        },
        getClass(msg){
            return {
                'float-right' : msg.senderId == this.myId
            }
        },
        exitBtnOnClick(){
            this.$emit('hideChatWindow')
        },
        autoScroll(){
            var element = this.$refs.msgs
            element.scrollTop = element.scrollHeight;
        }
    },
    watch: {
        searchText: function(){
            console.log(this.searchText)
        },
        msgs(){
            this.autoScroll()
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
</style>