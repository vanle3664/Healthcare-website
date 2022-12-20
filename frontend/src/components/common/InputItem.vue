<template lang="">
    <div class="input-item">
        <label>{{label}}</label>
        <br>
        <input
            :class="{'input-search':searchInput}"
            :type=modelType
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
            modelType: "text"
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
        // modelType: {
        //     type: String,
        //     default: "text"
        // }
    },
    // data(){
    //     return{
    //         input: ''
    //     }
    // },
    created(){
        this.setModelType()
    },
    methods: {
        handleClickSearch(){
            this.isClickSearch = true
            this.$router.push("/search")
        }, 
        handleClickEye(){
            this.showPass = !this.showPass
            this.modelType = (this.showPass)?"text":"password"
            console.log("change model type")
            // this.modelType = (this.modelType == "text") ? "password" : "text"
            // if (this.modelType == "text")
            //     this.$emit('update:modelType', "password")
        },
        setModelType(){
            if (this.blindInput)
                this.modelType = "password"
            else 
                this.modelType = "text"
            console.log(this.modelType)
        },
        setSearchValue(){
            this.$emit('inputOnEnter')
        }
    },
    watch:{
       
    }
}
</script>
<style scoped>
    @import url('../../styles/common/inputItem.css');
</style>