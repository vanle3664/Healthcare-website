<template lang="">
    <div class="menu">
        <div v-for="(cate, index) in categories" :key="index">{{cate}}</div>
    </div>
</template>
<script>
export default {
    name: "TheMenu",
    data(){
        return{
            categories: [
                'Thuốc Abc acb ade', 'Thuốc A', 'Thuốc A', 'Thuốc A'
            ]
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/menu.css');
</style>