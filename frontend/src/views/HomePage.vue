<template lang="">
    <div class="homepage">
        <div class="search">
            <div class="text-search">
                <InputItem
                    label="Tìm kiếm theo tên thuốc"
                    searchInput="True"
                />
            </div>
            <div class="img-search">
                <i class="fa-solid fa-camera"></i>
            </div>
        </div>
        <div class="chat-bot">
            <div class="chat-icon" @click="handleClickChat()">
                <i class="fa-solid fa-comments"></i>
            </div> 
            <div v-if="isClickBot" class="chat-screen">
                <div class="chat-title">Chat cùng HEALTHCARE</div>
                <div class="dialog">
                    <div class="answer">
                        <div class="avatar">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div class="mess">Answer</div>
                    </div>
                    <div class="ask">
                        <!-- <div class="avatar">
                            <i class="fa-solid fa-user"></i>
                        </div> -->
                        <div class="mess">Ask ask ask ask ask ask ask ask</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>
<script>
import InputItem from '../components/common/InputItem.vue';
export default {
    name: 'HomePage',
    data() {
        return {
            isClickBot: false
        }
    },
    props:{
    },
    components: {
        InputItem,
    },
    methods:{
        handleClickChat(){
            console.log(!this.isClickBot)
            this.isClickBot = !this.isClickBot
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
</style>