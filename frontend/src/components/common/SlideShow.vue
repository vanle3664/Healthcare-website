<template>
    <div class="slideshow">
        <div class="image-container" v-for="(image, index) in images" :key="index">
            <img :src='image'>
        </div>
        <a class="prev" @click="plusSlides(-1)">❮</a>
        <a class="next" @click="plusSlides(1)">❯</a>
        <div class="dots">
            <div class="dot" v-for="(image, index) in images" :key="index" @click="showSlide(index)"></div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            slideIndex:0,
            
        }
    },
    props: [
        'images'
    ],
    methods: {
        plusSlides(i){
            this.slideIndex += i
            
            if(this.slideIndex >= this.images.length){
                this.slideIndex = 0
            }else if(this.slideIndex < 0){
                this.slideIndex = this.images.length - 1
            }
            console.log(this.slideIndex)
            this.showSlide(this.slideIndex)
        },
        showSlide(i){
            let slides = document.querySelectorAll('.image-container')
            slides.forEach(slide => {
                slide.style.display = "none"
            });
            slides[i].style.display = "flex"
            
            let dots = document.querySelectorAll('.dot')
            dots.forEach(dot => {
                dot.classList.remove('active')
            });
            dots[i].classList.add('active')

            
        }
    },
    mounted() {
        this.showSlide(0)
        
    }
}
</script>
<style lang="scss" scoped>
    @import '../../styles/scss/main.scss';
</style>