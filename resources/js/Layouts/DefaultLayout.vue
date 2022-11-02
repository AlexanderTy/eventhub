<template>
    <div class="flex relative" id="content">
        <Menu class="w-80 text-white" />
        <main class="px-12 ml-80 min-h-screen flex items-center flex-col h-full w-full pt-12">
            <slot />
        </main>
    </div>
</template>
<script>
import Menu from "../Components/Menu";
export default {
    components: { Menu },
    props: {
    },
    data() {
        return {};
    },
};
</script>
