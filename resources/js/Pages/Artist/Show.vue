<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex flex-col min-w-[350px] h-full">
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
<!--                        <Teleport to="#app">

                            <Modal
                                v-show="openModal"
                                :text="'Are you sure you want to delete'"
                                :type="'event'"
                                @close-modal="openModal = false"
                                @action-modal="deleteEvent"
                            />
                        </Teleport>-->
                    </div>
                </div>
            </div>
            <div class="w-full max-w-6xl z-10 flex flex-row gap-6 grid grid-cols-3">
                <div class="col-span-2">
                    <ul class="flex flex-row gap-2.5 z-0">
                        <Tab type="general" text="General" @tabClick="this.activeTab = 'general'"  :activeTab="activeTab"/>
                        <Tab type="social media" text="Social Media" @tabClick="this.activeTab = 'social media'"  :activeTab="activeTab"/>
                        <Tab type="seo" text="SEO" @tabClick="this.activeTab = 'seo'"  :activeTab="activeTab"/>
                    </ul>
                    <div class="relative mt-[-10px] h-[450px] 2xl:h-[550px] bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                        <div v-show="activeTab === 'general'" class="absolute overflow-scroll top-0 left-0 h-full w-full p-8 flex flex-col gap-4">
                            <div class="flex flex-row gap-6">
                                <div class="bg-[url('/images/artist.png')] bg-cover w-40 h-40 rounded-full shrink-0"></div>
                                <div>
                                    <h2 class="text-xl font-bold mb-2 mt-2.5" >{{artist.name}}</h2>
                                    <label class="text-xs text-g mb-2">Short Description</label>
                                    <p>{{artist.description_short}}</p>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">Long Description</label>
                                <p>{{artist.description_long}}</p>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">Press Link</label>
                                <p>{{artist.link_press}}</p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'social media'" class="absolute top-0 overflow-scroll left-0 h-full w-full p-8 flex flex-col gap-7">
                            <div>
                                <label class="text-xs text-g mb-2">Website url</label>
                                <p>{{ artist.link_website }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">Facebook Link</label>
                                <p>{{ artist.link_facebook }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">Instagram Link</label>
                                <p>{{ artist.link_instagram }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">YouTube Link</label>
                                <p>{{ artist.link_youtube }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">Spotify Link</label>
                                <p>{{ artist.link_spotify }}</p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'seo'" class="absolute top-0 left-0 overflow-scroll  h-full w-full p-8 flex flex-col gap-7">
                            <div>
                                <label class="text-xs text-g mb-2">SEO Title</label>
                                <p>{{ artist.seo_title }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">SEO Description</label>
                                <p>{{ artist.seo_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                <ul class="flex flex-row gap-2.5 z-0">
                    <Tab type="current" text="Current Events" @tabClick="this.secondaryActiveTab = 'current'"  :secondaryActiveTab="secondaryActiveTab"/>
                    <Tab type="previous" text="Previous Events" @tabClick="this.secondaryActiveTab = 'previous'"  :secondaryActiveTab="secondaryActiveTab"/>
                </ul>
                <div class="relative mt-[-10px] h-[450px] 2xl:h-[550px] bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                    <div v-show="secondaryActiveTab === 'current'" class="absolute top-0 left-0 h-full w-full p-5 flex flex-col gap-4 overflow-scroll">
                        <EventCardSmall :event="event" v-for="event in artist.events" />
                    </div>
                    <div v-show="secondaryActiveTab === 'previous'" class="absolute top-0 left-0 h-full w-full p-5 flex flex-col gap-4 overflow-scroll">
                        <EventCardSmall :event="event" v-for="event in artist.events" />
                    </div>
                    <button class="flex flex-row items-center justify-center gap-2 absolute bottom-7 right-7 text-white bg-primary rounded-full py-2 px-6 font-semibold">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.2 1.2C7.2 0.88174 7.07357 0.576516 6.84853 0.351472C6.62348 0.126428 6.31826 0 6 0C5.68174 0 5.37652 0.126428 5.15147 0.351472C4.92643 0.576516 4.8 0.88174 4.8 1.2V4.8H1.2C0.88174 4.8 0.576516 4.92643 0.351472 5.15147C0.126428 5.37652 0 5.68174 0 6C0 6.31826 0.126428 6.62348 0.351472 6.84853C0.576516 7.07357 0.88174 7.2 1.2 7.2H4.8V10.8C4.8 11.1183 4.92643 11.4235 5.15147 11.6485C5.37652 11.8736 5.68174 12 6 12C6.31826 12 6.62348 11.8736 6.84853 11.6485C7.07357 11.4235 7.2 11.1183 7.2 10.8V7.2H10.8C11.1183 7.2 11.4235 7.07357 11.6485 6.84853C11.8736 6.62348 12 6.31826 12 6C12 5.68174 11.8736 5.37652 11.6485 5.15147C11.4235 4.92643 11.1183 4.8 10.8 4.8H7.2V1.2Z" fill="white"/>
                            </svg>
                        Create
                    </button>
                </div>
                </div>

            </div>

        </div>
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import Modal from "../../Components/Modal";
import { directive } from "vue3-click-away";
import Tab from "../../Components/Partials/Tab";
import { Link } from "@inertiajs/inertia-vue3";
import Btn from "../../Components/Partials/Btn";
import EventCardSmall from "../../Components/Partials/EventCardSmall";

export default {
    components: {
        EventCardSmall,
        Btn,
        DefaultLayout,
        Modal,
        Tab,
        Link,

    },
    props: {
        artist: Object,
    },
    data() {
        return {
            open: false,
            openModal: false,
            activeTab: 'general',
            secondaryActiveTab: 'current',
            activeTabContent: false,
        }
    },
    methods: {
        thing(){
            console.log("click");
        },
        onClickAway(artist) {
            this.open = false;

        },
    },
    directives: {
        ClickAway: directive,
    },
};

</script>
