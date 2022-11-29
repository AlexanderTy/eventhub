<template>
    <div class="grid gap-4 grid-cols-4 items-center col-span-1 px-12 text-sm bg-white w-full h-24 rounded-2xl shadow-[0px_8px_21px_rgba(0,0,0,0.25)] cursor-pointer">
    </div>
</template>

<script>
import CreateModal from "../CreateModal";
import DefaultLayout from "../../Layouts/DefaultLayout";
import PublishedStatus from "./PublishedStatus";
import {Link} from "@inertiajs/inertia-vue3";
import {directive} from "vue3-click-away";

export default {
    // included child components
    components: {
        CreateModal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        artist: Object,
        status: Boolean,
    },
    // custom set
    data() {
        return {
            open: false,
            currentRoute: "",
            openModal: false,
        };
    },
    // methods
    methods: {
        onClickAway(event) {

            this.open = false;
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
}
</script>
