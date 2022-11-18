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
                <!-- <div class="dialog">
                    <div class="answer">
                        <div class="avatar">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div class="mess">Answer</div>
                    </div>
                    <div class="ask">
                        <div class="avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="mess">Ask ask ask ask ask ask ask ask</div>
                    </div>
                </div> -->
                <div class="msgs scrollable" ref="msgs">
                    <div class="wrap-msg" v-for="(msg, index) in msgs" :key="index" :class="getClass(msg)">
                        <div class="msg" :class="getClass(msg)">
                            {{msg.content}}
                        </div>
                    </div>
                </div>
                <div class="send-msg">
                    <input>
                    <i class="fa-solid fa-paper-plane"></i>
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
            isClickBot: false,
            myId: '1',
            msgs: [],
        }
    },
    props:{
    },
    components: {
        InputItem,
    },
    created(){
        this.msgs=[
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys djfk akfj alfjk alfj alfkjd djf '
                },
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '2',
                    receiverId: '1',
                    content: 'Do you know BTS ?'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys'
                },
                {
                    senderId: '1',
                    receiverId: '2',
                    content: 'International playboys djfk akfj alfjk alfj alfkjd djf '
                },
                
                
            ]
    },
    methods:{
        handleClickChat(){
            console.log(!this.isClickBot)
            this.isClickBot = !this.isClickBot
        },
        getClass(msg){
            return {
                'float-right' : msg.senderId == this.myId
            }
        },
        exitBtnOnClick(){
            this.$emit('hideChatWindow')
        },
        autoScroll(){
            var element = this.$refs.msgs
            element.scrollTop = element.scrollHeight;
        }
    },
    watch:{
        msgs(){
            this.autoScroll()
        }
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
</style>