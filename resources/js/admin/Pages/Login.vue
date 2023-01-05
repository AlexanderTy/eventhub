<template>
    <LoginLayout>
        <div class="flex items-center justify-center h-4/5 px-8 lg:px-12 max-w-7xl m-auto">
            <div class="flex-1">
                <h1 class="text-primary font-medium text-xl lg:text-2xl">We are 1260. A digital bureau.</h1>
                <p class="text-black text-6xl font-bold">From digital potential to measurable results</p>
            </div>
            <div class="flex-1">
                <form class="flex flex-col p-10 mx-auto w-96 gap-4 rounded-xl bg-white shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]" @submit.prevent="submit">
                    <div class="flex flex-col">
                        <h2 class="py-10 text-2xl text-secondary font-bold self-center">Login</h2>
                        <label>E-mail</label>
                        <Input
                            v-model="form.email"
                        />
                    </div>

                    <div class="flex flex-col">
                        <label>
                            Password
                        </label>
                        <Input
                            v-model="form.password"
                            type="password"
                        />
                    </div>
                    <Btn :type="'submit'" :text="'login'" class="mt-8 m-auto px-16"/>
                    <p class="text-primary hover:underline cursor-pointer text-center text-sm mb-10">Forgot password?</p>
                </form>
            </div>
        </div>
    </LoginLayout>
</template>

<script>
import LoginLayout from "../Layouts/LoginLayout";
import Input from "../Components/Partials/Input";
import Btn from "../Components/Partials/Btn";

export default {
    // included child components
    components: {
        Btn,
        Input,
        LoginLayout,
    },
    // passed from controller
    props: {
        errors: Object
    },
    // custom set
    data() {
        return {
            form: this.$inertia.form({
                email:null,
                password:null,
            })
        }
    },
    // actions on init
    mounted() {
    },
    // methods
    methods: {
        submit() {
            this.$inertia.post('./login', this.form)
        }
    }
}
</script>
