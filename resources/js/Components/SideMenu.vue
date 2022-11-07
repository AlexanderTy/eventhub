<template>
    <div
        class="w-60 text-white h-full fixed bg-secondary shadow-[7px_13px_13px_2px_rgba(0,0,0,0.25)] z-10 justify-between flex flex-col py-12 "
    >
        <nav class="flex flex-col space-y-24">
            <div class=" mx-auto ">
                <img width="120 " height="100%"  src="/images/logo.svg" alt="logo" />
            </div>
            <MenuNavList />
        </nav>
        <Logout />
    </div>
</template>

<script>
import MenuNavList from "./Partials/MenuNavList.vue";
import Logout from "./Partials/Logout";

export default {
    components: { Logout, MenuNavList },
    props: {},
};
</script>
