<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex flex-col min-w-[350px] h-full">
            <div class="grid grid-cols-3 justify-between max-w-6xl mb-5">
                <h2 class="font-bold text-2xl capitalize">
                    {{ artist.name }}
                </h2>
                <LinkBtn class="ml-auto"
                         :type="'edit'"
                         :href="$route('admin::artists.edit', {artist:artist.id})"/>
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
                                <ArtistImage :artist="artist" size="large"/>
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
                        <EventCardSmall :event="event" v-for="event in artist.events" v-show="calcDatesLeft(event) > 0" />
                    </div>
                    <!-- event.dates.some(date => date > new Date())-->
                    <div v-show="secondaryActiveTab === 'previous'" class="absolute top-0 left-0 h-full w-full p-5 flex flex-col gap-4 overflow-scroll">
                        <EventCardSmall :event="event" v-for="event in artist.events" v-show="calcDatesLeft(event) === 0" />
                    </div>
                    <Btn type="create" @click="openModal = !openModal" class="absolute bottom-7 right-7" />
                    <Teleport to="#app">
                        <CreateModal
                            v-if="openModal"
                            @close-modal="openModal = false"
                        />
                    </Teleport>

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
import LinkBtn from "../../Components/Partials/LinkBtn";
import CreateModal from "../../Components/CreateModal";
import ArtistImage from "../../Components/Partials/ArtistImage";

export default {
    components: {
        ArtistImage,
        CreateModal,
        LinkBtn,
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
            remainingDates: 0,
        }
    },
    methods: {

        thing(){
            console.log("click");
        },
        onClickAway(artist) {
            this.open = false;

        },
        calcDatesLeft(e){
            let datesLeft = 0;
            e.dates.forEach(date =>{
                if(new Date(date.date) > new Date()) {
                    datesLeft++;
                }
            })
            return datesLeft;
        }
    },
    directives: {
        ClickAway: directive,
    },
};

</script>
