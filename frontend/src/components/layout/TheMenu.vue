<template lang="">
    <div class="menu">
        <div class="parent-cat" v-for="(cate, index) in categories" :key="index">
            <!-- <div class="cat-icon">
                <img :src="cate.cat_icon" />
            </div> -->
            {{cate.cat_name}}
        </div>
    </div>
    <!-- <div class="child-cat">

    </div> -->
</template>
<script>

export default {
    name: "TheMenu",
    data(){
        return{
            categories: [
    {
        "cat_id": "Q2F0ZWdvcnk6NDAw",
        "cat_name": "Thực phẩm chức năng",
        "cat_icon": "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/P21967_1.png",
        "cat_slug": "thuc-pham-chuc-nang",
        "num_products": 621,
        "cat_childen": [
            {
                "_id": "637a3ba2a60718fe1e45ef3f",
                "cat_id": "Q2F0ZWdvcnk6NTAw",
                "cat_name": "TPCN Nhóm Mắt/Tai/Mũi",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef47",
                "cat_id": "Q2F0ZWdvcnk6NDg5",
                "cat_name": "TPCN Giảm cân",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef54",
                "cat_id": "Q2F0ZWdvcnk6NDk3",
                "cat_name": "TPCN Chăm sóc sức khỏe nam và nữ",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef59",
                "cat_id": "Q2F0ZWdvcnk6NTEz",
                "cat_name": "TPCN Nhóm khác",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef48",
                "cat_id": "Q2F0ZWdvcnk6NDc0",
                "cat_name": "TPCN Nhóm đường huyết",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef41",
                "cat_id": "Q2F0ZWdvcnk6NDkz",
                "cat_name": "TPCN Chăm sóc sắc đẹp",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef4a",
                "cat_id": "Q2F0ZWdvcnk6NTA0",
                "cat_name": "TPCN Vitamin tổng hợp và khoáng chất",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef4b",
                "cat_id": "Q2F0ZWdvcnk6NDcx",
                "cat_name": "TPCN Nhóm tim mạch",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef4f",
                "cat_id": "Q2F0ZWdvcnk6NDY3",
                "cat_name": "TPCN Nhóm dạ dày",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef60",
                "cat_id": "Q2F0ZWdvcnk6NDc5",
                "cat_name": "TPCN Nhóm thần kinh",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef62",
                "cat_id": "Q2F0ZWdvcnk6NTEy",
                "cat_name": "TPCN Chăm sóc tóc",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef42",
                "cat_id": "Q2F0ZWdvcnk6NTE0",
                "cat_name": "TPCN cho gan",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef45",
                "cat_id": "Q2F0ZWdvcnk6NDc1",
                "cat_name": "TPCN Nhóm hô hấp",
                "parent": "Q2F0ZWdvcnk6NDAw"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef5d",
                "cat_id": "Q2F0ZWdvcnk6NDg0",
                "cat_name": "TPCN Nhóm cơ xương khớp",
                "parent": "Q2F0ZWdvcnk6NDAw"
            }
        ]
    },
    {
        "cat_id": "Q2F0ZWdvcnk6Mzc5",
        "cat_name": "Chăm sóc cá nhân",
        "cat_icon": "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/03_Ch%C4%83m_s%C3%B3c_c%C3%A1_nh%C3%A2n_03-Personal_Care_Cham_soc_ca_nhan.png",
        "cat_slug": "cham-soc-ca-nhan",
        "num_products": 1010,
        "cat_childen": [
            {
                "_id": "637a3ba2a60718fe1e45efa9",
                "cat_id": "Q2F0ZWdvcnk6Mzk3",
                "cat_name": "Chăm sóc tóc",
                "parent": "Q2F0ZWdvcnk6Mzc5"
            },
            {
                "_id": "637a3ba2a60718fe1e45efa0",
                "cat_id": "Q2F0ZWdvcnk6NjI2",
                "cat_name": "Chăm sóc cơ thể",
                "parent": "Q2F0ZWdvcnk6Mzc5"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef9f",
                "cat_id": "Q2F0ZWdvcnk6NDE5",
                "cat_name": "Chăm sóc răng miệng",
                "parent": "Q2F0ZWdvcnk6Mzc5"
            },
            {
                "_id": "637a3ba2a60718fe1e45efa2",
                "cat_id": "Q2F0ZWdvcnk6Mzgw",
                "cat_name": "Sản phẩm phòng tắm",
                "parent": "Q2F0ZWdvcnk6Mzc5"
            }
        ]
    },
    {
        "cat_id": "Q2F0ZWdvcnk6MzI1",
        "cat_name": "Chăm sóc sức khỏe",
        "cat_icon": "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/02_Ch%C4%83m_s%C3%B3c_s%E1%BB%A9c_kh%E1%BB%8Fe_02-Healthcare_Cham_soc_suc_khoe.png",
        "cat_slug": "cham-soc-suc-khoe",
        "num_products": 472,
        "cat_childen": [
            {
                "_id": "637a3ba2a60718fe1e45efd7",
                "cat_id": "Q2F0ZWdvcnk6Mzc4",
                "cat_name": "Dầu tràm, dầu xoa bóp",
                "parent": "Q2F0ZWdvcnk6MzI1"
            },
            {
                "_id": "637a3ba2a60718fe1e45efd6",
                "cat_id": "Q2F0ZWdvcnk6MzQ0",
                "cat_name": "Dụng cụ sơ cứu",
                "parent": "Q2F0ZWdvcnk6MzI1"
            },
            {
                "_id": "637a3ba2a60718fe1e45efdd",
                "cat_id": "Q2F0ZWdvcnk6MzU2",
                "cat_name": "Chăm sóc Mắt/Tai/Mũi",
                "parent": "Q2F0ZWdvcnk6MzI1"
            },
            {
                "_id": "637a3ba2a60718fe1e45efde",
                "cat_id": "Q2F0ZWdvcnk6Mzc2",
                "cat_name": " Khẩu trang y tế",
                "parent": "Q2F0ZWdvcnk6MzI1"
            },
            {
                "_id": "637a3ba2a60718fe1e45efe5",
                "cat_id": "Q2F0ZWdvcnk6MzUx",
                "cat_name": "Kế hoạch gia đình",
                "parent": "Q2F0ZWdvcnk6MzI1"
            },
            {
                "_id": "637a3ba2a60718fe1e45efdf",
                "cat_id": "Q2F0ZWdvcnk6Mzc3",
                "cat_name": "Chống muỗi",
                "parent": "Q2F0ZWdvcnk6MzI1"
            },
            {
                "_id": "637a3ba2a60718fe1e45efda",
                "cat_id": "Q2F0ZWdvcnk6MzY5",
                "cat_name": "Chăm sóc chân",
                "parent": "Q2F0ZWdvcnk6MzI1"
            }
        ]
    },
    {
        "cat_id": "Q2F0ZWdvcnk6NDAx",
        "cat_name": "Mẹ và Bé",
        "cat_icon": "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/6.12.png",
        "cat_slug": "me-va-be",
        "num_products": 459,
        "cat_childen": [
            {
                "_id": "637a3ba2a60718fe1e45ef7c",
                "cat_id": "Q2F0ZWdvcnk6NTQz",
                "cat_name": "Sản phẩm dành cho mẹ",
                "parent": "Q2F0ZWdvcnk6NDAx"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef6e",
                "cat_id": "Q2F0ZWdvcnk6NTUy",
                "cat_name": "TPCN dành cho phụ nữ mang thai",
                "parent": "Q2F0ZWdvcnk6NDAx"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef7e",
                "cat_id": "Q2F0ZWdvcnk6NTIw",
                "cat_name": "Chăm sóc em bé",
                "parent": "Q2F0ZWdvcnk6NDAx"
            },
            {
                "_id": "637a3ba2a60718fe1e45ef73",
                "cat_id": "Q2F0ZWdvcnk6NTM0",
                "cat_name": "TPCN dành cho trẻ em",
                "parent": "Q2F0ZWdvcnk6NDAx"
            }
        ]
    },
    {
        "cat_id": "Q2F0ZWdvcnk6Mzk5",
        "cat_name": "Sản phẩm tiện lợi",
        "cat_icon": "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/05_S%E1%BA%A3n_ph%E1%BA%A9m_ti%E1%BB%87n_l%E1%BB%A3i_05-CVS_San_pham_tien_loi.png",
        "cat_slug": "san-pham-tien-loi",
        "num_products": 518,
        "cat_childen": [
            {
                "_id": "637a3ba2a60718fe1e45eff2",
                "cat_id": "Q2F0ZWdvcnk6NDU0",
                "cat_name": "Hàng tổng hợp",
                "parent": "Q2F0ZWdvcnk6Mzk5"
            }
        ]
    },
    {
        "cat_id": "Q2F0ZWdvcnk6Mjg2",
        "cat_name": "Dược phẩm",
        "cat_icon": "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/01_D%C6%B0%E1%BB%A3c_ph%E1%BA%A9m_01-Medicine_Duoc_Pham.png",
        "cat_slug": "duoc-pham",
        "num_products": 4375,
        "cat_childen": [
            {
                "_id": "637a3ba2a60718fe1e45f018",
                "cat_id": "Q2F0ZWdvcnk6NTU0",
                "cat_name": "Thuốc kê đơn",
                "parent": "Q2F0ZWdvcnk6Mjg2"
            },
            {
                "_id": "637a3ba2a60718fe1e45f019",
                "cat_id": "Q2F0ZWdvcnk6Mjg3",
                "cat_name": "Thuốc không kê đơn",
                "parent": "Q2F0ZWdvcnk6Mjg2"
            }
        ]
    },
    {
        "cat_id": "Q2F0ZWdvcnk6NTU1",
        "cat_name": "Chăm sóc sắc đẹp",
        "cat_icon": "https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/04_Ch%C4%83m_s%C3%B3c_s%E1%BA%AFc_%C4%91%E1%BA%B9p_04-Beauty_Care_Cham_soc_sac_dep.png",
        "cat_slug": "cham-soc-sac-dep",
        "num_products": 938,
        "cat_childen": [
            {
                "_id": "637a3ba2a60718fe1e45efbf",
                "cat_id": "Q2F0ZWdvcnk6NjA5",
                "cat_name": "Dược - Mỹ Phẩm",
                "parent": "Q2F0ZWdvcnk6NTU1"
            },
            {
                "_id": "637a3ba2a60718fe1e45efc0",
                "cat_id": "Q2F0ZWdvcnk6NTcw",
                "cat_name": "Dụng cụ làm đẹp",
                "parent": "Q2F0ZWdvcnk6NTU1"
            }
        ]
    }
],
            mainCat: []
        }
    }, 
    created(){
        // this.getAllCategory()
    },
    methods: {
        // async getAllCategory(){
        //     let response = await fetch("http://127.0.0.1:8000/api/categories")
        //         .then(res=>res.clone().json())
        //     for (let i = 0; i < response.length; i++){
        //         this.categories.push(response[i].cat_parent)
        //     }    
        //     // console.log(response.length)
        //     // console.log(response[0])
        //     // console.log(this.categories[3])
        // }
        getAllCategory(){
            fetch('http://127.0.0.1:8000/api/categories')
                .then(res=> {
                    return res.json()
                }).then(data=>{
                    this.categories = data
                    console.log(this.categories[0].cat_name)
                    // console.log(data[0])
                })
        }
    }
}
</script>
<style scoped>
    @import url('../../styles/layout/menu.css');
</style>