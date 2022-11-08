<template>
    <div class="flex relative" id="content">
        <SideMenu />
        <TopMenu />
        <main class="bg-white-secondary  pt-36 pl-80 pr-12  min-h-screen h-full w-full">
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
    },
    data() {
        return {};
    },
};
</script>
