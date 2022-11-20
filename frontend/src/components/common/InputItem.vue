<template lang="">
    <div class="input-item">
        <label>{{label}}</label>
        <br>
        <input
            :class="{'input-search':searchInput}"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
        >
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
        },
        value: {
            type: [String, Number],
            default: ''
        },
        modelValue: {
            type: String
        }
    },
    // data(){
    //     return{
    //         input: ''
    //     }
    // },
    watch:{
       
    }
}
</script>
<style lang="">
    
</style>