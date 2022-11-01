<template>
    <DefaultLayout>
        <form
            class="flex flex-col p-12 space-y-4 min-w-[350px] h-full w-full"
            @submit.prevent="submit"
        >
            <div class="flex flex-col">
                <label>Email</label>
                <Input v-model="form.email" />
            </div>
            <div class="flex gap-6">
                <div class="flex flex-col">
                    <label>First name</label>
                    <Input v-model="form.first_name" />
                </div>
                <div class="flex flex-col">
                    <label>Last name</label>
                    <Input v-model="form.last_name" />
                </div>
            </div>

            <div class="flex flex-col">
                <label>Role </label>
                <Select v-model="form.role" :roles="roles" />
            </div>
            <div class="flex justify-between">
                <Btn :type="'back'" />

                <Btn :type="'submit'"  :text="'save'"/>
            </div>
            {{ errors }}
            {{ roles }}
        </form>
    </DefaultLayout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
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
        errors: Object,
        user: Object,
        type: String,
        roles: Object,
    },
    // custom set
    data() {
        return {
            form: this.$inertia.form({
                email: this.user.email,
                first_name: this.user.first_name,
                last_name: this.user.last_name,
                role: this.user.role,
            }),
        };
    },
    // actions on init

    // methods
    methods: {
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    _method: "patch",
                }))
                .post(
                    this.$route("users.update", {
                        user: this.user.id,
                    })
                );
        },
    },
};
</script>
