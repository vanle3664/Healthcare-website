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
            images: [
                "https://i.pinimg.com/originals/00/c3/7e/00c37e2f8aa1921e27db9217eb6ad7a1.png" ,
                "https://lh3.googleusercontent.com/qaYPh3R81NxoIaOIsRaHah9MSvuxomiEDg5ytloUeFKc-s1ZwHBlr0SYXF62uCo3ReNBY_dkg-jeLOcLIK4GoIhsPdxZ8vlg=w960-rj-nu-e365",
                "https://i.pinimg.com/originals/00/c3/7e/00c37e2f8aa1921e27db9217eb6ad7a1.png" ,
                "https://lh3.googleusercontent.com/qaYPh3R81NxoIaOIsRaHah9MSvuxomiEDg5ytloUeFKc-s1ZwHBlr0SYXF62uCo3ReNBY_dkg-jeLOcLIK4GoIhsPdxZ8vlg=w960-rj-nu-e365"
            ],
            
        }
    },
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