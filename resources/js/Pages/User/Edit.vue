<template>
    <DefaultLayout currentRoute="users">
        <form
            class="flex flex-col p-12 space-y-4 min-w-[350px] h-full gap-6"
            @submit.prevent="submit"
        >
            <div class="flex justify-between">
                <div class="flex items-center mb-12">
                    <div
                        class="w-16 h-16 rounded-full bg-lb hover:bg-br-h cursor-pointer mr-4 shadow-md"
                    ></div>
                    <div class="">
                        <h3 class="font-bold text-2xl capitalize">
                            {{ $page.props.profile.first_name }}
                            {{ $page.props.profile.last_name }}
                        </h3>
                        <p class="text-sm text-g">
                            {{ $page.props.profile.role }}
                        </p>
                    </div>
                </div>
                <div v-click-away="onClickAway" class="relative">
                    <button
                        class="hover:bg-gray-100 rounded py-1"
                        type="button"
                        @click="open = !open"
                    >
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
                                :deleteItem="
                                    form.first_name + ' ' + form.last_name
                                "
                                :text="'Are you sure you want to delete'"
                                :type="'user'"
                                @close-modal="openModal = false"
                                @action-modal="deleteUser"
                            />
                        </Teleport>
                    </div>
                </div>
            </div>

            <div class="flex gap-12">
                <div class="flex flex-col">
                    <label class="text-sm text-g mb-2">Email</label>
                    <Input v-model="form.email" />
                </div>
                <div class="flex flex-col w-full h-full">
                    <label class="text-sm text-g mb-2">Role </label>
                    <Select v-model="form.role" :options="roles" />
                </div>
            </div>

            <div class="flex gap-12">
                <div class="flex flex-col">
                    <label class="text-sm text-g mb-2">First name</label>
                    <Input v-model="form.first_name" />
                </div>
                <div class="flex flex-col">
                    <label class="text-sm text-g mb-2">Last name</label>
                    <Input v-model="form.last_name" />
                </div>
            </div>

            <div class="flex justify-between">
                <Btn :type="'back'" />

                <Btn :text="'save'" :type="'submit'" />
            </div>
            {{ form.errors }}
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
import { directive } from "vue3-click-away";
import Modal from "../../Components/Modal";

export default {
    // included child components
    components: {
        Modal,
        Select,
        Input,
        Btn,
        DefaultLayout,
        Link,
    },
    // passed from controller
    props: {
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
                    this.$route("users.update", {
                        user: this.user.id,
                    })
                );
        },

        deleteUser() {
            this.$inertia.delete(
                this.$route("users.destroy", {
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
