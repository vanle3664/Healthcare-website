<template lang="">
    <div class="menu">
        <div class="parent-cat" v-for="(cate, index) in categories" :key="index" >
            <!-- <div class="cat-icon">
                <img :src="cate.cat_icon" />
            </div> -->
            <div v-on:click="routeToCat(cate.cat_name, cate.cat_id)">{{cate.cat_name}}</div>
        </div>
    </div>
    <!-- <div class="child-cat">

    </div> -->
</template>
<script>

export default {
    name: "TheMenu",
    data(){
        return{
            categories: [
                {
                    "cat_id": "Q2F0ZWdvcnk6NDAw",
                    "cat_name": "Thực phẩm chức năng"
                },
                {
                    "cat_id": "Q2F0ZWdvcnk6Mzc5",
                    "cat_name": "Chăm sóc cá nhân",
                    
                },
                {
                    "cat_id": "Q2F0ZWdvcnk6MzI1",
                    "cat_name": "Chăm sóc sức khỏe",
                },
                {
                    "cat_id": "Q2F0ZWdvcnk6NDAx",
                    "cat_name": "Mẹ và Bé",
                },
                {
                    "cat_id": "Q2F0ZWdvcnk6Mzk5",
                    "cat_name": "Sản phẩm tiện lợi",
                },
                {
                    "cat_id": "Q2F0ZWdvcnk6Mjg2",
                    "cat_name": "Dược phẩm",
                },
                {
                    "cat_id": "Q2F0ZWdvcnk6NTU1",
                    "cat_name": "Chăm sóc sắc đẹp",
                }
            ],
            mainCat: [],
        }
    }, 
    created(){
        // this.getAllCategory()
    },
    methods: {
        // async getAllCategory(){
        //     let response = await fetch("http://127.0.0.1:8000/api/categories")
        //         .then(res=>res.clone().json())
        //     for (let i = 0; i < response.length; i++){
        //         this.categories.push(response[i].cat_parent)
        //     }    
        //     // console.log(response.length)
        //     // console.log(response[0])
        //     // console.log(this.categories[3])
        // }
        getAllCategory(){
            fetch('http://127.0.0.1:8000/api/categories')
                .then(res=> {
                    return res.json()
                }).then(data=>{
                    this.categories = data
                    console.log(this.categories[0].cat_name)
                    // console.log(data[0])
                })
        },
        routeToCat(name, id){
            this.$router.push(`/category/${name}/${id}`)
            console.log(`/category/${name}/${id}`)
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/menu.css');
</style>