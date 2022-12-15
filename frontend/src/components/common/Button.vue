<template>
    <button :style="{backgroundColor: color}">
        {{text}}
    </button>
</template>
<script>
export default{
    name: 'TheButton',
    props: ['text', 'color'], 
}
</script>
