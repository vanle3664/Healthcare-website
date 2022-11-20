<template>
  <div>
    <Header/>
    <Menu/>
    <TheContent/>
  </div>
</template>

<script>
import Header from './components/layout/TheHeader.vue'
import Menu from './components/layout/TheMenu.vue'
import TheContent from './components/layout/TheContent.vue'
export default {
  name: 'App',
  components: {
    Header, Menu, TheContent
  }
}
</script>

<style scoped>
  @import url('./styles/main.css');
</style>
