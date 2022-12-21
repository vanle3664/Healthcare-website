<template>
    <div class="product-detail">
        <div class="images-previewinfo">
            <div class="slideshow-container">
                <SlideShow/>
            </div>
            <div class="preview-info scrollable">

            </div>
        </div>
    </div>
</template>
<script>
import SlideShow from '@/components/common/SlideShow.vue';
export default{
    components: {
        SlideShow
    }                                                                                                       
}
</script>
<style scoped lang="scss">
    @import '../styles/scss/main.scss'
</style>
