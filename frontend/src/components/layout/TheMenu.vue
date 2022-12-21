<template lang="">
    <div class="menu">
        <div v-for="(cate, index) in categories" :key="index">
            <!-- <div class="cat-icon">
                <img :src="cate.cat_icon" />
            </div> -->
            {{cate.cat_name}}
        </div>
    </div>
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
        async getAllCategory(){
            let response = await fetch("http://127.0.0.1:8000/api/categories")
                .then(res=>res.clone().json())
            for (let i = 0; i < response.length; i++){
                this.categories.push(response[i].cat_parent)
            }    
            // console.log(response.length)
            // console.log(response[0])
            // console.log(this.categories[3])
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/menu.css');
</style>