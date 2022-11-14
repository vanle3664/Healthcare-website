<!-- <template>
  <Header/>
  <Menu/>
  <Content/>
</template>

<script>
import Header from './components/layout/TheHeader.vue'
import Menu from './components/layout/TheMenu.vue'
// import Content from './components/layout/TheContent.vue'
import Cart from './components/layout/TheCart.vue'
export default {
  name: 'App',
  components: {
    Header, Menu, Content
  }
}
</script>

<style scoped>
  @import url('./styles/main.css');
</style> -->

<template>
  <Header/>
  <Cart/>
</template>

<script>
import Header from './components/layout/TheHeader.vue'
import Cart from './components/layout/TheCart.vue'
export default {
  name: 'App',
  components: {
    Header, Cart
  }
}
</script>

<style scoped>
  @import url('./styles/main.css');
</style>
