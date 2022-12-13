<template>
    <div>
        <div class="absolute w-full h-full z-40 bg-opacity-70 bg-black flex justify-center items-center">
            <form class="min-w-[500px] bg-white rounded-xl p-6" @submit.prevent="submit">
                    <div class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                        </svg>
                        <h2 class="font-semibold text-2xl">Create new event</h2>
                    </div>
                    <div class="flex flex-col my-9 mx-1">
                        <label class="text-sm text-g mb-2">Title of the event</label>
                        <Input v-model="form.title" placeholder="Event title"/>
                    </div>
                <div class="flex gap-4 w-full justify-end" >
                    <Btn :text="'cancel'" :type="'cancel'" @click="$emit('closeModal')"/>
                    <Btn :text="'Create'" :type="'submit'" />
                </div>
            </form>
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
