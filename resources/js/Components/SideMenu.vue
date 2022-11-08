<template>
    <div
        class="z-20 w-52 text-white h-full fixed bg-secondary shadow-[7px_13px_13px_rgba(0,0,0,0.25)] justify-between flex flex-col pb-12 pt-6"
    >
        <nav class="flex flex-col space-y-16">
            <div class=" mx-auto ">
                <img width="98" height="100%"  src="/images/logo.svg" alt="logo" />
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
