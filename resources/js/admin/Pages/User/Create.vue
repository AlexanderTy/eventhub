<template>
    <DefaultLayout currentRoute="users" type="tabpage">
        <form class="flex flex-col min-w-[350px] max-h-full mx-auto max-w-6xl" @submit.prevent="submit">

            <PageTitle class="mb-5" title="Create a new user"/>
            <TabPageLayout>
                <div class=" h-full w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-3 pr-10 flex flex-col gap-6">
                        <InputGroup :error="form.errors.email" label="E-mail">
                            <Input v-model="form.email" :error="form.errors.email" />
                        </InputGroup>
                        <InputGroup :error="form.errors.password" label="Password">
                            <Input v-model="form.password" :error="form.errors.password"/>
                        </InputGroup>
                        <div class="flex flex-row justify-between">
                            <InputGroup class="w-6/12" :error="form.errors.first_name" label="First name">
                                <Input v-model="form.first_name" :error="form.errors.first_name"/>
                            </InputGroup>
                            <InputGroup  class="w-6/12 ml-4" :error="form.errors.last_name" label="Last name">
                                <Input v-model="form.last_name" :error="form.errors.last_name"/>
                            </InputGroup>
                        </div>

                        <div class="flex flex-col w-full h-full">
                            <label class="text-sm text-g mb-2">Role </label>
                            <Select v-model="form.role" :options="roles"/>
                        </div>
                    </div>
                </div>
            </TabPageLayout>
            <div class="flex justify-end space-x-8 mt-8">
                <LinkBtn :type="'back'" to="admin::users.index"/>
                <Btn :text="'save'" :type="'submit'"/>
            </div>

        </form>
    </DefaultLayout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import DefaultLayout from "../../Layouts/DefaultLayout";
import Btn from "../../Components/Partials/Btn";
import Input from "../../Components/Partials/Input";
import Select from "../../Components/Partials/Select";
import PageTitle from "../../Components/Partials/PageTitle";
import TabPageLayout from "../../Layouts/TabPageLayout";
import LinkBtn from "../../Components/Partials/LinkBtn";
import InputGroup from "../../Components/Partials/InputGroup";

export default {
    // included child components
    components: {
        InputGroup,
        LinkBtn,
        TabPageLayout,
        PageTitle,
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
            this.form.post(this.$route("admin::users.store"));
        },
    },
};
</script>
