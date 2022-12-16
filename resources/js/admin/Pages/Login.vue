<template>
    <LoginLayout>
        <div class="flex items-center justify-center h-4/5 px-8 lg:px-12 max-w-7xl m-auto">
            <div class="flex-1">
                <h1 class="text-primary font-medium text-xl lg:text-2xl">We are 1260. A digital bureau.</h1>
                <p class="text-black text-6xl font-bold">From digital potential to measurable results</p>
            </div>
            <div class="flex-1">
                <LoginForm :errors="errors" />
            </div>
        </div>
    </LoginLayout>
</template>

<script>
import LoginLayout from "../Layouts/LoginLayout";
import LoginForm from "../Components/Forms/LoginForm";

export default {
    // included child components
    components: {
        LoginForm,
        LoginLayout,
    },
    // passed from controller
    props: {
        errors: Object
    },
    // custom set
    data() {
        return {

        };
    },
    // actions on init
    mounted() {
    },
    // methods
    methods: {
    },
}
</script>
