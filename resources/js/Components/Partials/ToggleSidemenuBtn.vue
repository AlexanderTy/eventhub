<template>
    <button class="w-full h-full text-primary">
        <CloseSidemenuSvg v-show="!close" />
        <OpenSidemenuSvg v-show="close" />
    </button>
</template>

<script>
import CloseSidemenuSvg from "../Svgs/CloseSidemenuSvg";
import OpenSidemenuSvg from "../Svgs/OpenSidemenuSvg";

export default {
    components: {
        OpenSidemenuSvg,
        CloseSidemenuSvg,
    },
    props: {
        close: Boolean
    }
};
</script>
