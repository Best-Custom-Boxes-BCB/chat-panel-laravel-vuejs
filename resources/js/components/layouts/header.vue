<template>
<section class="header__area shadow">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <p>Test Name</p>
                    <img id="profile-logo" src="../../../../public/admin-asset/images/profile-logo.png" alt="profile-logo">
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
    name: 'HEADER'
}
</script>

<style>
.header__area {
    background-color: rgb(255, 255, 255);
    padding: 10px;
    margin: 20px 32px;
}
#profile-logo{
    width: 40px;
    border-radius: 50%;
}
.header__area .row {
    justify-content: end;
}
.header__area .row p{
    padding-right: 10px;
    margin-top: 8px;
}
</style>
