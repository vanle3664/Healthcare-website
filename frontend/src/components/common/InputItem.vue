<template lang="">
    <div class="input-item">
        <label>{{label}}</label>
        <br>
        <input
            :class="{'input-search':searchInput}"
            :type="modelType"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
            @keyup.enter="setSearchValue"
            
        >
        <div class="search-icon" v-if="searchInput" @click="handleClickSearch">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="blind-icon" v-if="blindInput" @click="handleClickEye">
            <i v-if="showPass" class="fa-solid fa-eye"></i>
            <i v-else class="fa-solid fa-eye-slash"></i>
        </div>
    </div>
</template>
<script>
export default {
    name: 'InputItem',
    data(){
        return {
            isClickSearch: false,
            showPass: false,
        }
    },
    props: {
        label:{
            type: String,
            default: null
        },
        searchInput: {
            type: Boolean,
            default: false
        },
        blindInput: {
            type: Boolean,
            default: false
        },
        value: {
            type: [String, Number],
            default: ''
        },
        modelValue: {
            type: String
        },
        modelType: {
            type: String,
            default: "text"
        }
    },
    // data(){
    //     return{
    //         input: ''
    //     }
    // },
    methods: {
        handleClickSearch(){
            this.isClickSearch = true
            this.$router.push("/search")
        }, 
        handleClickEye(){
            this.showPass = !this.showPass
            // this.modelType = (this.modelType == "text") ? "password" : "text"
            // if (this.modelType == "text")
            //     this.$emit('update:modelType', "password")
        },
        setSearchValue(){
            this.$emit('inputOnEnter')
        }
    },
    watch:{
       
    }
}
</script>
<style lang="">
    
</style>