<template>
    <div
        class="w-full text-white h-24 fixed bg-tertiary shadow-[7px_7px_13px_rgba(0,0,0,0.25)] justify-between flex flex-row-reverse"
    >
        <MenuUser />

    </div>
</template>

<script>
import MenuNavList from "./Partials/MenuNavList.vue";
import Logout from "./Partials/Logout";
import MenuUser from "./Partials/MenuUser";
export default {
    components: {MenuUser, Logout, MenuNavList },
    props: {
    },
};
</script>
