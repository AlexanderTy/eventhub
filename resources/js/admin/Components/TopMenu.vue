<template>
    <div class="z-20 w-full pl-72 text-white h-16 fixed bg-white shadow-[7px_7px_13px_rgba(167,167,167,0.25)] justify-between flex items-center">
        <Input type="search" placeholder="Search for events, artists, venues, users" :class="'w-[484px] h-9' "/>
        <MenuUser />
    </div>
</template>

<script>
import MenuNavList from "./Partials/MenuNavList.vue";
import Logout from "./Partials/Logout";
import MenuUser from "./Partials/MenuUser";
import Search from "./Partials/Search";
import Input from "./Partials/Input";
export default {
    components: {Input, Search, MenuUser, Logout, MenuNavList },
    props: {
    },
};
</script>
