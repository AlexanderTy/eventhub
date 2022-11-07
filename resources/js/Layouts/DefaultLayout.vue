<template>
    <div class="flex relative" id="content">
        <SideMenu />
        <TopMenu />
        <main class="bg-tertiary pl-64 pr-12  min-h-screen flex items-center flex-col h-full w-full pt-20">
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
