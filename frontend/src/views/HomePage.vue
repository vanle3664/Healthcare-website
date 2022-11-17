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
    </div>
</template>
<script>
import InputItem from '../components/common/InputItem.vue';
export default {
    name: 'HomePage',
    components: {
        InputItem,
    }
}
</script>
<style scoped>
    @import url('../styles/view/homepage.css');
</style>