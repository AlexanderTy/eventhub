<template>
    <div
        class="h-full fixed bg-b justify-between flex flex-col py-12 pl-4"
    >
        <div class="flex flex-col space-y-24">
            <MenuUser />
            <MenuNavList />
        </div>
        <Logout />
    </div>
</template>

<script>
import MenuNavList from "./Partials/MenuNavList.vue";
import MenuUser from "./Partials/MenuUser";
import Logout from "./Partials/Logout";
export default {
    components: { Logout, MenuUser, MenuNavList },
    props: {
    },
};
</script>
