<template>
    <DefaultLayout currentRoute="artists">
        <form class="flex flex-col min-w-[350px] h-full" @submit.prevent="submit">
            <div class="flex justify-between">
                <div class="flex items-center mb-5">
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
            <div class="relative mt-[-10px] z-10 w-full max-w-6xl min-h-[450px] 2xl:h-[550px] bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                <div v-show="activeTab === 'general'" class=" absolute top-0 left-0 h-full w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-2 pr-10 flex flex-col gap-5">
                        <ImageUpload @imageUploaded="setImage" :image="this.form.image" @imageRemoved="this.form.image = ''" />
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Name</label>
                            <Input v-model="form.name" />
                        </div>
                        <div class="flex flex-col">
                                <label class="text-xs text-g mb-2">Press link</label>
                                <Input v-model="form.link_press"/>
                        </div>
                    </div>
                    <div class="col-span-3 flex flex-col gap-5">
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Short description</label>
                            <TextArea v-model="form.description_short" class="h-20 resize-none" placeholder="Write a short description here..." />
                        </div>
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Long discription</label>
                            <TextArea v-model="form.description_long" class="h-56 resize-none" placeholder="Write a long description here..." />
                        </div>
                    </div>
                </div>
                <div v-show="activeTab === 'social media'" class="absolute top-0 left-0 w-full h-full px-10 py-6 overflow-y-auto flex flex-col gap-7">
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
                <div v-show="activeTab === 'seo'" class="absolute top-0 left-0 w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
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
import ImageUpload from "../../Components/Partials/ImageUpload";

export default {
    // included child components
    components: {
        ImageUpload,
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
                image: this.artist.image,
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
            theImage: '',
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
        setImage(event) {
            this.form.image = event;
            this.theImage = event.name;
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
