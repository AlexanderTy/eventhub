<template>
    <div class="flex">
        <Menu class="w-80 text-white" />
        <main class="pl-4 ml-80 min-h-screen flex items-center justify-center flex-col h-full w-full">
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
