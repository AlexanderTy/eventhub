<template>
    <DefaultLayout currentRoute="artists">
        <form class="flex flex-col p-12 space-y-4 min-w-[350px] h-full gap-6" @submit.prevent="submit">
            <div class="flex justify-between">
                <div class="flex items-center mb-12">
                    <div class="">
                        <h2 class="font-bold text-2xl capitalize">
                         {{ artist.name }}
                        </h2>
                    </div>
                </div>
                <div v-click-away="onClickAway" class="relative">
                    <button class="hover:bg-gray-100 rounded py-1" type="button" @click="open = !open">
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                    <div
                        v-show="open"
                        class="absolute right-0 border rounded p-1 whitespace-nowrap flex flex-col gap-2 text-left"
                    >
                        <button
                            class="text-left hover:bg-gray-100 w-full px-2 py-1 rounded text-sm"
                        >
                            Option 1
                        </button>
                        <button
                            class="text-left hover:bg-gray-100 w-full px-2 py-1 rounded text-sm"
                        >
                            Option 2
                        </button>
                        <button
                            class="text-left hover:bg-gray-100 w-full px-2 py-1 rounded text-red-700 text-sm"
                            type="button"
                            @click="openModal = true"
                        >
                            Delete
                        </button>
                        <Teleport to="#app">
                            <Modal
                                v-show="openModal"
                                :text="'Are you sure you want to delete'"
                                :type="'event'"
                                @close-modal="openModal = false"
                                @action-modal="deleteEvent"
                            />
                        </Teleport>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <LinkBtn :type="'back'" to="artists.index"/>

                <Btn :text="'save'" :type="'submit'" />
            </div>
            {{ form.errors }}
            {{artist}}
        </form>
    </DefaultLayout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import DefaultLayout from "../../Layouts/DefaultLayout";
import Btn from "../../Components/Partials/Btn";
import Input from "../../Components/Partials/Input";
import Select from "../../Components/Partials/Select";
import { directive } from "vue3-click-away";
import Modal from "../../Components/Modal";
import LinkBtn from "../../Components/Partials/LinkBtn";

export default {
    // included child components
    components: {
        LinkBtn,
        Modal,
        Select,
        Input,
        Btn,
        DefaultLayout,
        Link,
    },
    // passed from controller
    props: {
        artist: Object,
    },
    // custom set
    data() {
        return {
            form: this.$inertia.form({
                name: this.artist.name,
            }),
            open: false,
            openModal: false,
        };
    },
    // actions on init
    mounted() {
        this.myFirstFunction();
    },
    // methods
    methods: {
        myFirstFunction() {
            console.log(this.openModal);
        },
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    _method: "patch",
                }))
                .post(
                    this.$route("events.update", {
                        event: this.event.id,
                    })
                );
        },

        deleteEvent() {
            this.$inertia.delete(
                this.$route("events.destroy", {
                    user: this.user.id,
                })
            );
        },
        onClickAway(event) {
            this.open = false;
        },
    },
    directives: {
        ClickAway: directive,
    },
};
</script>
