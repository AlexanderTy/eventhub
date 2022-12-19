<template>
        <div
            class="absolute w-screen h-screen z-40 bg-opacity-70 bg-black flex justify-center items-center"
        >
            <form
                class="min-w-[500px] bg-white rounded-xl p-6"
                @submit.prevent="submit"
            >
                <div class="flex gap-3 items-center">
                    <svg
                        v-if="type === 'event'"
                        class="w-7 h-7"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            clip-rule="evenodd"
                            d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                            fill-rule="evenodd"
                        />
                    </svg>
                    <svg
                        v-if="type === 'artist'"
                        class="w-7 h-7"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M12.32,2.79c-.77-.77-1.82-1.21-2.91-1.21s-2.15,.44-2.92,1.21c-.77,.77-1.21,1.82-1.21,2.92s.44,2.14,1.21,2.91c.77,.78,1.82,1.21,2.92,1.21s2.14-.43,2.91-1.21c.78-.77,1.21-1.82,1.21-2.91s-.43-2.15-1.21-2.92Zm-2.91,8.54c-1.89,0-3.71,.75-5.04,2.09-1.34,1.33-2.09,3.15-2.09,5.04v.12c0,.13,.04,.25,.1,.36,.07,.11,.16,.2,.27,.27,1.97,1.19,4.28,1.87,6.76,1.87,.57,0,1.15-.04,1.71-.11,.04-.22,.11-.44,.19-.65,.72-1.78,1.45-3.55,2.18-5.32l.74-1.77c-1.3-1.22-3.03-1.9-4.82-1.9Z"
                        ></path>
                        <path
                            d="M21.58,10.65c-.42-1.32-1.63-2.17-2.92-2.17-.3,0-.6,.04-.9,.14-1.59,.5-2.47,2.23-1.95,3.86,.41,1.32,1.62,2.17,2.92,2.17,.29,0,.6-.04,.89-.14,1.6-.5,2.47-2.23,1.96-3.86Z"
                        ></path>
                        <path
                            d="M18.99,15.2c-.45,.7-.85,1.36-1.27,2.02-.98,1.53-1.96,3.03-2.92,4.58-.12,.21-.26,.36-.42,.46-.08,.06-.17,.09-.26,.12-.09,.03-.17,.04-.27,.04-.07,0-.13,0-.21,0-.07,0-.48-.18-.87-.4-.34-.21-.16-.92-.07-1.13,.03-.08,.06-.16,.1-.24,.83-2.05,1.68-4.1,2.53-6.14,.12-.29,.24-.59,.36-.88,.01-.02,.02-.03,.06-.09,.77,1.16,1.85,1.66,3.24,1.67Z"
                        ></path>
                    </svg>
                    <svg
                        v-if="type === 'venue'"
                        class="w-7 h-7"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            clip-rule="evenodd"
                            d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                            fill-rule="evenodd"
                        ></path>
                    </svg>
                    <h2 class="font-semibold text-2xl">
                        Create new {{ type }}
                    </h2>
                </div>
                <div class="flex flex-col my-9 mx-1">
                    <label class="text-sm text-g mb-2">{{ label }}</label>
                    <Input
                        v-model="name"
                        :placeholder="
                            type === 'event'
                                ? 'Event title '
                                : type === 'artist'
                                ? 'Artist name'
                                : ''
                        "
                    />
                </div>
                <div class="flex gap-4 w-full justify-end">
                    <Btn
                        :text="'cancel'"
                        :type="'cancel'"
                        @click="$emit('closeModal')"
                    />
                    <Btn :text="'Create'" :type="'submit'" />
                </div>
            </form>
        </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

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
        type: String,
        label: String,
        artist: Object,
    },
    // custom set
    data() {
        return {
            name: "",
            titleForm: this.$inertia.form({
                title:null
            }),
            nameForm: this.$inertia.form({
                name:null
            }),
        };
    },
    // actions on init
    mounted() {
        // add a key to the form object where the key is title if event else name
    },

    // methods
    methods: {
        submit() {
            console.log("yo")
            if (this.type === 'event') {
                this.titleForm.title = this.name;
                this.titleForm.post(this.$route('admin::events.store'));
            } else if (this.type === 'artist' ) {
                this.nameForm.name = this.name;
                this.nameForm.post(this.$route('admin::artists.store'));
            } else if (this.type === 'venue') {
                this.nameForm.name = this.name;
                this.nameForm.post(this.$route('admin::venues.store'));
            }
        },


    },
};
</script>
