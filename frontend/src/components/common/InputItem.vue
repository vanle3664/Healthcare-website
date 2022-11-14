<template lang="">
    <div class="input-item">
        <label>{{label}}</label>
        <br>
        <input :class="{'input-search':searchInput}">
        <div class="search-icon" v-if="searchInput">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
</template>
<script>
export default {
    name: 'InputItem',
    props: {
        label:{
            type: String,
            default: null
        },
        searchInput: {
            type: Boolean,
            default: false
        }
    }
}
</script>
<style lang="">
    
</style>