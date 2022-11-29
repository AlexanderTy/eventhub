<template>
    <div class="flex" id="content">

        <SideMenu :currentRoute="currentRoute" />
        <TopMenu />
        <main class="bg-white-secondary  py-36  pl-72 pr-20  min-h-screen h-full w-full">
            <slot />
        </main>
    </div>
</template>
<script>
import SideMenu from "../Components/SideMenu";
import TopMenu from "../Components/TopMenu";
export default {
    components: {TopMenu, SideMenu },
    props: {
        currentRoute:{
            type: String,
            default: null,
        }
    },
    data() {
        return {};
    },
};
</script>
