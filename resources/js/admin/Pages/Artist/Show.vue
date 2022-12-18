<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex flex-col min-w-[350px] h-full">
            <div class="flex justify-between max-w-6xl mb-5">
                <h2 class="font-bold text-2xl capitalize">
                    {{ artist.name }}
                </h2>
                <LinkBtn class=""
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
                                <div class="text-tab-secondary w-36 h-36 rounded-full shrink-0 overflow-hidden">
                                    <img v-show="artist.image" alt="" class="w-full h-full object-cover object-top" :src="'/images/artists/' + artist.image"/>
                                    <svg v-show="!artist.image" class="w-full h-full object-cover object-top" viewBox="0 0 167 167" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M140.751 144.279C149.05 136.482 155.661 127.065 160.176 116.611C164.69 106.156 167.013 94.8873 167 83.5C167 37.3823 129.618 0 83.5 0C37.3823 0 5.57455e-05 37.3823 5.57455e-05 83.5C-0.0131202 94.8873 2.30951 106.156 6.82436 116.611C11.3392 127.065 17.9503 136.482 26.249 144.279C41.7238 158.897 62.2126 167.029 83.5 167C104.787 167.029 125.276 158.897 140.751 144.279ZM55.6807 115.512C46.9999 119.681 39.3699 125.752 33.3572 133.275C39.9171 139.901 47.7273 145.158 56.3349 148.742C64.9425 152.326 74.176 154.166 83.5 154.154C92.824 154.166 102.058 152.326 110.665 148.742C119.273 145.158 127.083 139.901 133.643 133.275C127.63 125.752 120 119.681 111.319 115.512C102.639 111.343 93.1301 109.183 83.5 109.192C73.87 109.183 64.3615 111.343 55.6807 115.512ZM106.209 80.5167C112.232 74.4939 115.615 66.3252 115.615 57.8077C115.615 49.2901 112.232 41.1215 106.209 35.0987C100.186 29.0759 92.0175 25.6923 83.5 25.6923C74.9825 25.6923 66.8138 29.0759 60.791 35.0987C54.7682 41.1215 51.3846 49.2901 51.3846 57.8077C51.3846 66.3252 54.7682 74.4939 60.791 80.5167C66.8138 86.5395 74.9825 89.923 83.5 89.923C92.0175 89.923 100.186 86.5395 106.209 80.5167Z"/>
                                    </svg>
                                </div>
<!--                                <div class="bg-[url('/images/artist.png')] bg-cover w-40 h-40 rounded-full shrink-0"></div>-->
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

                        <p v-if="calcDatesLeft(event) > 0">Penis</p>
                        <div>

                        </div>
                        <EventCardSmall :event="event" v-for="(event, index) in artist.events" v-show="calcDatesLeft(event) > 0">

                        </EventCardSmall>
                    </div>
                    <!-- event.dates.some(date => date > new Date())-->
                    <div v-show="secondaryActiveTab === 'previous'" class="absolute top-0 left-0 h-full w-full p-5 flex flex-col gap-4 overflow-scroll">
                        <EventCardSmall :event="event" v-for="event in artist.events" v-show="calcDatesLeft(event) === 0" />
                    </div>
<!--                    <button class="flex flex-row items-center justify-center gap-2 absolute bottom-7 right-7 text-white bg-primary rounded-full py-2 px-6 font-semibold">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.2 1.2C7.2 0.88174 7.07357 0.576516 6.84853 0.351472C6.62348 0.126428 6.31826 0 6 0C5.68174 0 5.37652 0.126428 5.15147 0.351472C4.92643 0.576516 4.8 0.88174 4.8 1.2V4.8H1.2C0.88174 4.8 0.576516 4.92643 0.351472 5.15147C0.126428 5.37652 0 5.68174 0 6C0 6.31826 0.126428 6.62348 0.351472 6.84853C0.576516 7.07357 0.88174 7.2 1.2 7.2H4.8V10.8C4.8 11.1183 4.92643 11.4235 5.15147 11.6485C5.37652 11.8736 5.68174 12 6 12C6.31826 12 6.62348 11.8736 6.84853 11.6485C7.07357 11.4235 7.2 11.1183 7.2 10.8V7.2H10.8C11.1183 7.2 11.4235 7.07357 11.6485 6.84853C11.8736 6.62348 12 6.31826 12 6C12 5.68174 11.8736 5.37652 11.6485 5.15147C11.4235 4.92643 11.1183 4.8 10.8 4.8H7.2V1.2Z" fill="white"/>
                            </svg>
                        Create
                    </button>-->

<!--                    <LinkBtn :type="'create'" to="admin::events.create" class="absolute bottom-7 right-7" />-->
                    <Btn type="create" @click="openModal = !openModal" class="absolute bottom-7 right-7" />
                    <Teleport to="#app">
                        <CreateModal
                            v-show="openModal"
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

export default {
    components: {
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
