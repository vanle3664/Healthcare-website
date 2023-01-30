<template lang="">
    <div class="number-adjust">
        <div class="adjust" @click="subQuantity">-</div>
        <div class="value">{{productItem.quantity || value}}</div>
        <div class="adjust" @click="addQuantity">+</div>
    </div>
</template>
<script>
import { mapStores } from 'pinia'
import { useCartStore } from '@/store/cart'
export default {
    data(){
        return {
            value: 1,
        }
    },
    props:['productItem'],
    computed: {
        ...mapStores(useCartStore),
    },
    methods: {
        addQuantity(){
            if(this.productItem) this.cartStore.addQuantity(this.productItem.product.product_id)
            else this.value += 1
        },
        subQuantity(){
            if(this.productItem) this.cartStore.subQuantity(this.productItem.product.product_id)
            else{
                if(this.value > 1) this.value -= 1
            }
        }
    }
}
</script>
<style lang="scss">
    @import '../../styles/scss/main.scss'
</style>