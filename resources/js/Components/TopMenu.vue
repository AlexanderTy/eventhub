<template>
    <div class="z-20 w-full text-white h-14 fixed bg-white shadow-[7px_7px_13px_rgba(167,167,167,0.25)] justify-between flex flex-row-reverse">
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
