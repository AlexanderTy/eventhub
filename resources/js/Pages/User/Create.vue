<template>
    <DefaultLayout>
        <form
            class="flex flex-col p-12 space-y-4 min-w-[350px] h-full gap-6"
            @submit.prevent="submit"
        >
            <div class="flex gap-12">
                <div class="flex flex-col">
                    <label class="text-sm text-g mb-2">Email</label>
                    <Input v-model="form.email"/>
                </div>
                <div class="flex flex-col w-full h-full">
                    <label class="text-sm text-g mb-2">Password </label>
                    <Input v-model="form.password"/>
                </div>
            </div>

            <div class="flex gap-12">
                <div class="flex flex-col">
                    <label class="text-sm text-g mb-2">First name</label>
                    <Input v-model="form.first_name"/>
                </div>
                <div class="flex flex-col">
                    <label class="text-sm text-g mb-2">Last name</label>
                    <Input v-model="form.last_name"/>
                </div>
            </div>
            <div class="flex flex-col w-full h-full">
                <label class="text-sm text-g mb-2">Role </label>
                <Select v-model="form.role" :options="roles"/>
            </div>
            <div class="flex justify-between">
                <Btn :type="'back'"/>

                <Btn :text="'save'" :type="'submit'"/>
            </div>
            {{ form.errors }}
            {{ roles }}
        </form>
    </DefaultLayout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import DefaultLayout from "../../Layouts/DefaultLayout";
import Btn from "../../Components/Partials/Btn";
import Input from "../../Components/Partials/Input";
import Select from "../../Components/Partials/Select";

export default {
    // included child components
    components: {
        Select,
        Input,
        Btn,
        DefaultLayout,
        Link,
    },
    // passed from controller
    props: {
        roles: Object,
    },
    // custom set
    data() {
        return {
            form: this.$inertia.form({
                email: null,
                password: null,
                first_name: null,
                last_name: null,
                role: "user",
            }),
        };
    },
    // actions on init

    // methods
    methods: {
        submit() {
            this.form.post(this.$route("users.store"));
        },
    },
};
</script>
