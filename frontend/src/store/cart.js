import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state(){
      return {
        cart: [],
      }
    },
    getters: {
      totalBill: (state)=> {
        let total = 0
        state.cart.forEach(item => {
          total += item.product.price * item.quantity
        });
        return total
      }
    },
    actions: {
      addToCart(product, quantity) {
        let productInCart = this.cart.find(item => {
          return item.product.product_id == product.product_id
        })
        if(productInCart) {
          productInCart.quantity += quantity
        }else{
          this.cart.push({product, quantity})
        }
      },

      addQuantity(productId){
        let currentProduct = this.cart.find(item => {
          return item.product.product_id == productId
        })
        currentProduct.quantity += 1
      },

      subQuantity(productId){
        let currentProduct = this.cart.find(item => {
          return item.product.product_id == productId
        })
        if(currentProduct.quantity > 1) currentProduct.quantity -= 1
      },

      removeFromCart(index){
        this.cart.splice(index, 1)
      }
    },
  })
