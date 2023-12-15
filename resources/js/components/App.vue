<template lang="">
    <!-- <header />
    <sidebar /> -->
    <div class="row m-0">
        <aside class="sidebar_area shadow col-xs-2 col-sm-2 col-md-2 col-lg-2 p-0">
            <sidebar />
        </aside>
        <div class="navbar_area col-xs-10 col-sm-10 col-md-10 col-lg-10 m-0 p-0">
            <Navbar />
            <div class="main_content_area">
                <div class="card shadow">
                    <router-view />
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Navbar from './layouts/header.vue'
import sidebar from './layouts/sidebar.vue'
export default {
    name: 'APP',
    components: {
        Navbar,
        sidebar
    }
}
</script>
