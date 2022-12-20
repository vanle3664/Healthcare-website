<template>
    <button :class="btnClass">
        {{text}}
    </button>
</template>
<script>
export default{
    name: 'TheButton',
    props: ['text', 'btnClass'], 
}
</script>
<style lang="scss">
 @import '../../styles/scss/main.scss';
</style>
