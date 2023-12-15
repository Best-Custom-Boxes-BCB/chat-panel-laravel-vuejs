<template>
    <div class="main_logo">
        <h4><strong><i>Chat Panel</i></strong></h4>
        <br><hr>
    </div>
    <ul class="p-0">
        <li><router-link to="/admin/visitor">Visitor</router-link></li>
        <li><router-link to="/admin/history">History</router-link></li>
        <!-- <li>Live Visitor</li> -->
    </ul>
</template>

<script>
export default {
    name: 'SIDEBAR'
}
</script>

<style scoped>
li{

    list-style-type:none;
    padding: 20px;
}
li a{
    color: black;
    text-decoration: none;
    font-family: monospace;
}
li:hover{
    background-color: rgb(172, 171, 171);
}
li a:hover{
    color: white;
}
.main_logo{
    margin: 20px 0px 0px 0px;
    padding: 21px;
}
</style>
