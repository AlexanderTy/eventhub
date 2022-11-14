<template>
    <div>
        <div class="absolute w-full h-full z-10 bg-opacity-70 bg-black flex justify-center items-center">
            <div class="min-w-[350px] p-12  bg-white flex justify-center items-center flex-col">
                <div class="mt-4 mb-12">
                    <h2>Create new event</h2>

                    <div class="flex flex-col">
                        <label class="text-sm text-g mb-2">Title of the event</label>
                        <Input v-model="form.title"/>
                    </div>
                </div>
                <form class="mb-4 flex justify-between w-full" @submit.prevent="submit">
                    <Btn :text="'cancel'" :type="'cancel'" @click="$emit('closeModal')"/>
                    <Btn :text="'Create'" :type="'submit'" />
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import {Link} from "@inertiajs/inertia-vue3";

import Btn from "./Partials/Btn";
import DefaultLayout from "../Layouts/DefaultLayout";
import Input from "./Partials/Input";

export default {
    // included child components
    components: {
        Input,
        DefaultLayout,
        Btn,
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
                title: null,
            }),
        };
    },
    // actions on init

    // methods
    methods: {
        submit() {
            this.form.post(this.$route("events.store"));
        },
    },
};
</script>
