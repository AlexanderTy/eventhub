<template>
    <DefaultLayout currentRoute="artists">
        <form class="flex flex-col min-w-[350px] h-full" @submit.prevent="submit">
            <div class="flex justify-between">
                <div class="flex items-center mb-12">
                        <h2 class="font-bold text-2xl capitalize">
                         {{ artist.name }}
                        </h2>
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

            <ul class="flex flex-row gap-2.5 z-0">
                <Tab type="general" text="General" @tabClick="this.activeTab = 'general'"  :activeTab="activeTab"/>
                <Tab type="social media" text="Social Media" @tabClick="this.activeTab = 'social media'"  :activeTab="activeTab"/>
                <Tab type="seo" text="SEO" @tabClick="this.activeTab = 'seo'"  :activeTab="activeTab"/>
            </ul>
            <div class="relative mt-[-10px] z-10 w-full max-w-6xl h-[625px] bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                <div v-show="activeTab === 'general'" class=" absolute top-0 left-0 h-full w-full grid grid-cols-5 gap-12 flex-col p-10">
                    <div class="col-span-2 pr-10">
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Upload image</label>
                            <div class="pb-5 flex flex-col justify-center items-center text-gray-600 bg-white-secondary h-60 rounded border border-dashed border-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" fill="currentColor" class="w-24 h-24 text-tab-secondary">
                                        <path fill-rule="evenodd" d="M10.5 3.75a6 6 0 00-5.98 6.496A5.25 5.25 0 006.75 20.25H18a4.5 4.5 0 002.206-8.423 3.75 3.75 0 00-4.133-4.303A6.001 6.001 0 0010.5 3.75zm2.03 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.94a.75.75 0 001.5 0v-4.94l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <p>Drag & drop image</p>
                                <p class="text-xs">Or <span class="text-primary cursor-pointer hover:underline underline-offset-2">upload an image</span> from the computer</p>
                            </div>
                        </div>
                        <div class="px-3 flex flex-row items-center mt-4 justify-between text-gray-600">
                            <div class="flex flex-row gap-3 items-center">
                                <div class="bg-[url('/images/artist.png')] col-span-2 bg-cover w-11 h-11 rounded-full"></div>
                                <div>
                                    <p class="text-sm mb-1">nikolaj_stokholm_2022.jpg</p>
                                    <p class="text-xs">749,23 Mb</p>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex flex-col my-7">
                            <label class="text-xs text-g mb-2">Name</label>
                            <Input v-model="form.name" />
                        </div>
                        <div class="flex flex-col mb-7">
                                <label class="text-xs text-g mb-2">Press link</label>
                                <Input v-model="form.link_press"/>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">Short description</label>
                            <TextArea v-model="form.description_short" class="h-28 resize-none" placeholder="Write a short description here..." />
                        </div>
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">Long discription</label>
                            <TextArea v-model="form.description_long" class="h-[19rem] resize-none" placeholder="Write a long description here..." />

                        </div>
                    </div>
                </div>
                <div v-show="activeTab === 'social media'" class="absolute top-0 left-0 w-full h-full p-10 overflow-y-auto flex flex-col gap-7">
                    <div class="flex flex-col">
                        <label class="text-xs mb-1">Website url</label>
                        <Input v-model="form.link_website" />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs mb-1">Facebook link</label>
                        <Input v-model="form.link_facebook" />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs mb-1">Instagram link</label>
                        <Input v-model="form.link_instagram" />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs mb-1">YouTube link</label>
                        <Input v-model="form.link_youtube" />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs mb-1">Spotify link</label>
                        <Input v-model="form.link_spotify" />
                    </div>
                </div>
                <div v-show="activeTab === 'seo'" class="absolute top-0 left-0 w-full grid grid-cols-5 gap-12 flex-col p-10">
                    <div class="col-span-3 pr-10">
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">SEO Title</label>
                            <Input v-model="form.seo_title" />
                        </div>
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2 ">SEO Discription</label>
                            <TextArea v-model="form.seo_description" class="h-72 resize-none" placeholder="Write a SEO description here..." />
                        </div>
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
import TextArea from "../../Components/Partials/TextArea";
import Tab from "../../Components/Partials/Tab";

export default {
    // included child components
    components: {
        TextArea,
        Tab,
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
                description_short: this.artist.description_short,
                description_long: this.artist.description_long,
                link_facebook: this.artist.link_facebook,
                link_youtube: this.artist.link_youtube,
                link_spotify: this.artist.link_spotify,
                link_instagram: this.artist.link_instagram,
                link_website: this.artist.link_website,
                link_press: this.artist.link_press,
                seo_title: this.artist.seo_title,
                seo_description: this.artist.seo_description,
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
                    this.$route("artists.update", {
                        artist: this.artist.id,
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
