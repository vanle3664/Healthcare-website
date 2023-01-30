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
        <div class="product-category" v-for="(mainCat, index1) in completeCategories" :key="index1">
            <label>{{mainCat.cat_name}}{{setRouteToCategory(mainCat.cat_name, mainCat.cat_id)}}</label>
            <router-link :to=routeToCat[index1]>Xem thêm</router-link>
            <div class="product-list scrollable-invisible" ref="productList">
                <div class="prev-btn slide-btn" v-on:click="prevBtnOnClick()">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <Product v-for="(product, index2) in products[index1]" :key="index2"
                    :product="product">
                </Product>
                <div class="next-btn slide-btn" v-on:click="nextBtnOnClick">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
        <LoadingBar v-if="showLoading"/>
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
                    <input v-model="mess" @keyup.enter="getMess">
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
                    <button @click="searchByImage">Tìm kiếm</button>
                </div>
            </div>
            
        </div>
        
    </div>
</template>
<script>
import InputItem from '../components/common/InputItem.vue';
import Product from '@/components/base/Product.vue';
import LoadingBar from '@/components/common/LoadingBar.vue';

export default {
    name: 'HomePage',
    props:{
        resultSearch: []
    },
    components: {
        InputItem, Product, LoadingBar
    },
    created(){
        this.getMess()
        this.getMainCategory().then(()=> this.getProductByCatId())
        // this.getProductByCatId()
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
        
    },
    data(){
        return{
            searchText: '',
            hotItems: [
                'Thuốc', 'Vitamin', 'Thực phẩm chức năng'
            ],
            products: [],
            isClickBot: false,
            myId: '2',
            msgs: [
                {
                    senderId: '1',
                    content: 'Welcome to HealthCare doctorbot! Please enter your symtoms below'
                },
                {
                    senderId: '2',
                    content: 'My symtoms are'
                },
            ],
            previewImage: null,
            mainCategories: [],
            routeToCat: [],
            showLoading: true,
        }
    },
    methods: {
        async getMainCategory(){
            try {
                const response = await fetch("http://127.0.0.1:8000/api/categories")
                if(!response.ok){
                    throw Error('Can not load categories api')
                }
                const data = await response.json()
                this.mainCategories = data
            } catch (error) {
                console.log(error)
            }
        },
        async getProductByCatId(){
            console.log("here get product by id ")
            for (let i = 0; i < this.mainCategories.length; i++){
                let cat = this.mainCategories[i]
                console.log("category: " + cat)
                console.log("cat id: " + cat.cat_id)
                let url = "http://127.0.0.1:8000/api/products/categories/" + cat.cat_id
                await fetch(url)
                    .then(res=>res.json())
                    .then(res=>res.data.data)
                    .then(res=>this.products.push(res))
                
            }
            this.showLoading = false   
        },
        getImgUrl(drug) {
            return require('../assets/images/' + drug +'.jpg');
        },
        nextBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width
            this.$refs.productList.scrollLeft += productWidth
            console.log(this.$refs.productList.scrollLeft)

        },
        prevBtnOnClick(){
            var productCard = document.querySelector('.product-card')
            var productWidth = productCard.getBoundingClientRect().width;
            this.$refs.productList.scrollLeft -= productWidth
            console.log(this.$refs.productList)
            
        },
        searchRecOnClick(event){
            console.log(event.target.innerHTML)
            this.searchText = event.target.innerHTML
        },
        handleClickChat(){
            console.log(!this.isClickBot)
            this.isClickBot = !this.isClickBot
        },
        async getMess(){
            this.mess = event.target.value
            // console.log(this.mess)
            this.msgs.push({senderid: "2", content: `${this.mess}`})

            let myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");

            let raw = JSON.stringify({
            "senderid": "m1",
            "message": this.mess
            });

            console.log(raw)

            let requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
            };

            fetch("http://localhost:5005/webhooks/rest/webhook", requestOptions)
            .then(response => response.text())
            .then(result => console.log(result))
            .catch(error => console.log('error', error));

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
        },
        searchByImage(){
            let myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            // myHeaders.append('Access-Control-Allow-Origin', 'http://192.168.1.105:8080');
            // myHeaders.append('Access-Control-Allow-Methods', 'GET, POST, PUT')
            // myHeaders.append('Access-Control-Allow-Headers', 'Content-Type')

            // myHeaders.append('mode', 'no-cors');

            let requestOptions = {
            method: 'POST',
            headers: myHeaders,
            redirect: 'follow'
            };

            fetch("http://localhost:8000/test", requestOptions)
            .then(response => response.text())
            .then(result => console.log(result))
            .catch(error => console.log('error', error));
        }
    },
    computed: {
        completeCategories(){
            var result = []
            this.products.forEach((productsOfCat, index) => {
                if(productsOfCat.length > 0){
                    result.push(this.mainCategories[index])
                }
            });
            return result  
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
</style>