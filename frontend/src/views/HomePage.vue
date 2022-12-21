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
        <div class="product-category" v-for="(mainCat, index1) in mainCategories" :key="index1">
            <label>{{mainCat.cat_name}}{{setRouteToCategory(mainCat.cat_name, mainCat.cat_id)}}</label>
            <router-link :to=routeToCat[index1]>Xem thêm</router-link>
            <div class="product-list scrollable-invisible" ref="productList">
                <div class="prev-btn slide-btn" v-on:click="prevBtnOnClick()">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <!-- <div class="product-card" v-for="(product, index) in products" :key="index">
                    <div class="product-img">
                        <img :src="getImgUrl(product.img)">
                    </div>
                    
                    <div class="product-name">{{product.name}}</div>
                    <div class="product-price"><span>{{product.price}}VND</span>/Sản phẩm</div>
                </div> -->
                <Product v-for="(product, index2) in products[index1]" :key="index2"
                    :name="product.product_name"
                    :imageUrl="product.product_image"
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
        InputItem, Product,
    },
    created(){
        this.getMainCategory().then(()=> this.getProductByCatId())
        // this.mainCategories=[
        //     {
        //         cat_id: "Q2F0ZWdvcnk6NDAw",
        //         cat_name: "Thực phẩm chức năng",
        //         cat_icon: "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/P21967_1.png",
        //         cat_slug: "thuc-pham-chuc-nang"
        //     }, 
        //     {
        //         cat_id: "Q2F0ZWdvcnk6Mzc5",
        //         cat_name: "Chăm sóc cá nhân",
        //         cat_icon: "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/03_Ch%C4%83m_s%C3%B3c_c%C3%A1_nh%C3%A2n_03-Personal_Care_Cham_soc_ca_nhan.png",
        //         cat_slug: "cham-soc-ca-nhan"
        //     }
        // ],
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
            products: [[], [], [], [], [], [], []],
            isClickBot: false,
            myId: '1',
            msgs: [],
            previewImage: null,
            mainCategories: [],
            routeToCat: []
        }
    },
    methods: {
        async getMainCategory(){
            let response = await fetch("http://127.0.0.1:8000/api/categories")
                .then(res=>res.clone().json())
            console.log("get main cat response :" + response)
            for (const element of response){
                this.mainCategories.push(element)
            }     
            // console.log(response.length)
            // console.log(response[0])
            console.log(this.mainCategories[0])
        },
        async getProductByCatId(){
            console.log("here get product by id ")
            console.log(this.mainCategories[0])
            for (let i = 0; i < this.mainCategories.length; i++){
                let cat = this.mainCategories[i]
                // console.log("category: " + cat)
                // console.log("cat id: " + cat.cat_id)
                // console.log(cat.cat_children)
                let url = "http://127.0.0.1:8000/api/products/categories/" + cat.cat_id
                await fetch(url)
                    .then(res=>res.clone().json())
                    .then(response => this.products[i] = response.data.data.slice(0, 5))
                
            }
            console.log(this.products)   
        }
        ,
        getImgUrl(drug) {
            return require('../assets/images/' + drug +'.jpg');
        },
        nextBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width
            this.$refs.productList.scrollLeft += productWidth
            console.log(this.$refs.productList.scrollLeft)
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
        // autoScroll(){
        //     var element = this.$refs.msgs
        //     element.scrollTop = element.scrollHeight;
        // },
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
            // console.log(`Search key word is: ${this.searchText}`)
            this.$router.push(`/search?keyword=${this.searchText}`)
        }, 
        setRouteToCategory(name, id){
            this.routeToCat.push("/category/" + name + "/" + id)
        }
    },
    // watch: {
    //     msgs(){
    //         this.autoScroll()
    //     }
    // }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
</style>