<template>
    <LoginLayout class="items-center flex justify-center">

        <div class="w-96 rounded bg-white ">
            <LoginForm>
            </LoginForm>
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
    },
    // custom set
    data() {
        return {

        };
    },
    // actions on init
    mounted() {

        this.myFirstFunction();
    },
    // methods
    methods: {
        myFirstFunction() {
            console.log("works")

        },
    },
}
</script>
