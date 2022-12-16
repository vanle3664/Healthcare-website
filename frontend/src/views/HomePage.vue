<template lang="">
    <div class="homepage">
        <div class="search">
            <div class="text-search">
                <InputItem
                    label="Tìm kiếm theo tên thuốc"
                    :searchInput="true"
                    v-model="searchText"
                    @inputOnEnter="setSearchValue"
                />
            </div>
            <div class="img-search">
                <i class="fa-solid fa-camera" @click="handleSearchByImage()"></i>
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
                <!-- <div class="product-card" v-for="(product, index) in products" :key="index">
                    <div class="product-img">
                        <img :src="getImgUrl(product.img)">
                    </div>
                    
                    <div class="product-name">{{product.name}}</div>
                    <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
                </div> -->
                <Product v-for="(product, index) in products" :key="index" 
                    :name="product.name"
                    :price="product.price">
                </Product>
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
        <div class="model-ocr-popup hide">
            <div class="popup-inner">
                <div class="popup-header">
                    <div>Tìm kiếm bằng hình ảnh</div>
                    <i class="fas fa-times" @click="handleCloseSearchByImage()"></i>
                </div>
                <div class="popup-content">
                    <p>Upload ảnh ở đây</p>
                    <input class="image-input" ref="imageInput" type="file" @input="pickFile()">
                    <div class="image-preview-wrapper" :style="{ 'background-image': `url(${previewImage})` }" @click="selectImage()"></div>
                </div>
                <div class="popup-footer">
                    <button>Tìm kiếm</button>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>
import InputItem from '../components/common/InputItem.vue';
import Product from '@/components/base/Product.vue';

export default {
    name: 'HomePage',
    props:{
        resultSearch: []
    },
    components: {
        InputItem, Product
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
            previewImage: null,
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
        },
        handleSearchByImage(){
            let modal = document.querySelector(".model-ocr-popup")
            modal.classList.toggle("hide")
        },
        handleCloseSearchByImage(){
            let modal = document.querySelector(".model-ocr-popup")
            modal.classList.toggle("hide")
        },
        pickFile(){
            let input = this.$refs.imageInput
            console.log(input)
            let file = input.files
            console.log(file)
            if (file && file[0]) {
                let reader = new FileReader 
                reader.onload = e => {
                    this.previewImage = e.target.result
                }
                reader.readAsDataURL(file[0])
                this.$emit('input', file[0])
            }
        },
        selectImage(){
            this.$refs.imageInput.click()
        },
        setSearchValue(){
            console.log(`Search key word is: ${this.searchText}`)
            
            this.$router.push(`/search?keyword=${this.searchText}`)
        }
    },
    watch: {
        msgs(){
            this.autoScroll()
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
</style>