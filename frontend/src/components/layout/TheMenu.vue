<template lang="">
    <div class="menu">
        <div class="parent-cat" v-for="(cate, index) in categories" :key="index">
            <!-- <div class="cat-icon">
                <img :src="cate.cat_icon" />
            </div> -->
            {{cate.cat_name}}
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
            categories: [],
            mainCat: []
        }
    }, 
    created(){
        this.getAllCategory()
    },
    methods: {
<<<<<<< HEAD
        async getAllCategory(){
            let response = await fetch("http://127.0.0.1:8000/api/categories")
                .then(res=>res.clone().json())
            for (const element of response){
                this.categories.push(element)
            }    
=======
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
>>>>>>> 17a889df004c8ce2182b134566ec405ac18c7b2b
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/menu.css');
</style>