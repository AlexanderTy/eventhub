<template>
    <form class="flex flex-col p-12 space-y-4" @submit.prevent="submit">
        <div class="flex flex-col">
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
            />
        </div>
        <Btn :type="'back'" :text="'back'"/>
        <Btn :type="'submit'" :text="'login'"/>
        {{errors}}

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
