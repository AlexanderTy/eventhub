<template>
    <DefaultLayout currentRoute="users">
        <form class="flex flex-col min-w-[350px] h-full" @submit.prevent="submit">
            <div class="flex justify-between">
                <div class="flex items-center mb-8">
                        <h2 class="font-bold text-2xl capitalize">
                            {{ user.first_name }}
                            {{ user.last_name }}
                        </h2>
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

            <ul class="flex flex-row gap-2.5 z-0">
                <Tab type="general" text="General" @tabClick="this.activeTab = 'general'"  :activeTab="activeTab"/>
            </ul>
            <div class="relative mt-[-10px] z-10 w-full max-w-6xl min-h-[450px] 2xl:h-[550px] bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                <div v-show="activeTab === 'general'" class=" absolute top-0 left-0 h-full w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-3 flex flex-col gap-5 pr-10">
                        <div class="flex flex-row w-full gap-5">
                            <div class="flex flex-col w-full">
                                <label class="text-xs text-g mb-2">First name</label>
                                <Input v-model="form.first_name"/>
                            </div>
                            <div class="flex flex-col w-full">
                                <label class="text-xs text-g mb-2">Last name</label>
                                <Input v-model="form.last_name"/>
                            </div>
                            <div class="flex flex-col w-full">
                                <label class="text-xs text-g mb-2">Role</label>
                                <Select v-model="form.role" :options="roles" />
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Email</label>
                            <Input v-model="form.email"/>
                        </div>
                        <div>
                            <div class="flex flex-col">
                                <label class="text-xs text-g mb-2">Upload image</label>
                                <div class="pb-5 flex flex-col justify-center items-center text-gray-600 bg-white-secondary h-36 rounded border border-dashed border-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" fill="currentColor" class="w-16 h-16 text-tab-secondary">
                                        <path fill-rule="evenodd" d="M10.5 3.75a6 6 0 00-5.98 6.496A5.25 5.25 0 006.75 20.25H18a4.5 4.5 0 002.206-8.423 3.75 3.75 0 00-4.133-4.303A6.001 6.001 0 0010.5 3.75zm2.03 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.94a.75.75 0 001.5 0v-4.94l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <p>Drag & drop image</p>
                                    <p class="text-xs">Or <span class="text-primary cursor-pointer hover:underline underline-offset-2">upload an image</span> from the computer</p>
                                </div>
                            </div>
                            <div class="px-3 flex flex-row items-center mt-4 justify-between text-gray-600">
                                <div class="flex flex-row gap-3 items-center">
                                    <div class="bg-[url('/images/artist.png')] col-span-2 bg-cover w-10 h-10 rounded-full"></div>
                                    <div>
                                        <p class="text-sm mb-1">nikolaj_stokholm_2022.jpg</p>
                                        <p class="text-xs">749,23 Mb</p>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 flex flex-col gap-5">
                    </div>
                </div>
            </div>


            <div class="flex justify-end space-x-8 mt-8">
                <LinkBtn :type="'back'" to="admin::users.index" />

                <Btn :text="'save'" :type="'submit'" />
            </div>

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
import Tab from "../../Components/Partials/Tab";
import LinkBtn from "../../Components/Partials/LinkBtn";

export default {
    // included child components
    components: {
        LinkBtn,
        Tab,
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
                password: this.user.password,
                role: this.user.role,
            }),
            open: false,
            openModal: false,
            activeTab: 'general',
            activeTabContent: false,
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
        updateActiveTab(e){
            this.activeTab = e;
        },
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    _method: "patch",
                }))
                .post(
                    this.$route("admin::users.update", {
                        user: this.user.id,
                    })
                );
        },

        deleteUser() {
            this.$inertia.delete(
                this.$route("admin::users.destroy", {
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
