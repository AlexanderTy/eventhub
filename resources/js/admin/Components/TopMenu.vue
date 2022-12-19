<template>
    <div class="z-30 w-full text-white h-16 fixed bg-white shadow-[7px_7px_13px_rgba(167,167,167,0.25)] justify-between flex items-center transition-all duration-500"
         :class="$page.props.profile.settings?.closeSidemenu ? 'pl-32' : 'pl-[17rem]'">
        <Input type="search" placeholder="Search for events, artists, venues, users" class="w-[484px] h-9"/>
        <MenuUser />
    </div>
</template>

<script>
import MenuNavList from "./Partials/MenuNavList.vue";
import MenuUser from "./Partials/MenuUser";
import Search from "./Partials/Search";
import Input from "./Partials/Input";
export default {
    components: {Input, Search, MenuUser, MenuNavList },
    props: {
    },
};
</script>
