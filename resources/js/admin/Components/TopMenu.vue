<template>
    <div class="z-30 w-full text-white h-16 fixed bg-white shadow-[-3px_-3px_30px_rgba(216,208,208,0.75)] justify-end flex items-center transition-all duration-500"
         :class="$page.props.profile.settings?.closeSidemenu ? 'pl-32' : 'pl-[17rem]'">
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
