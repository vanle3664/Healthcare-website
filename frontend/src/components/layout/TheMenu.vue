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
        async getAllCategory(){
            let response = await fetch("http://127.0.0.1:8000/api/categories")
                .then(res=>res.clone().json())
            for (const element of response){
                this.categories.push(element)
            }    
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/menu.css');
</style>