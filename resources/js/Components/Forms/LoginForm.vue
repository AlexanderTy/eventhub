<template>
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

</template>
<script>
import Input from "../Partials/Input";
import Btn from "../Partials/Btn";

export default {
    components: {Btn, Input},

    props:{
        errors: Object,
        type: String,
        text: String
    },

    data() {
        return {
            form: this.$inertia.form({
                email:null,
                password:null,
            })
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/login', this.form)
        }
    }
}
</script>
