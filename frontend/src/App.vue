<template>
  <Header/>
  <Menu/>
  <Content/>
</template>

<script>
import Header from './components/layout/TheHeader.vue'
import Menu from './components/layout/TheMenu.vue'
import Content from './components/layout/TheContent.vue'
export default {
  name: 'App',
  components: {
    Header, Menu, Content
  }
}
</script>

<style scoped>
  @import url('./styles/main.css');
</style>
