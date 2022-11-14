<template>
    <DefaultLayout>
        HIIIII
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../Layouts/DefaultLayout";

export default {
    // included child components
    components: {
        DefaultLayout,
    },
    // passed from controller
    props: {
    },
    // custom set
    data() {
        return {};
    },
    // actions on init
    mounted() {
        this.myFirstFunction();
    },
    // methods
    methods: {
        myFirstFunction() {
            console.log("works");
        },
    },
};
</script>
