<template>
    <DefaultLayout  currentRoute="events">
        <form class="flex flex-col min-w-[350px] h-full" @submit.prevent="submit">
            <div class="flex justify-between">
                <div class="flex items-center mb-5">
                    <h2 class="font-bold text-2xl capitalize">
                        {{ event.title }}
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
                        class="absolute right-0 border rounded p-1 whitespace-nowrap flex flex-col gap-2 text-left z-50"
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
                                @keyup.escape="openModal = false"

                            />
                        </Teleport>
                    </div>
                </div>
            </div>


            <ul class="flex flex-row gap-2.5 z-0">
                <Tab type="general" text="General" @tabClick="this.activeTab = 'general'"  :activeTab="activeTab"/>
                <Tab type="dates" text="Dates & Venues" @tabClick="this.activeTab = 'dates'"  :activeTab="activeTab"/>
                <Tab type="seo" text="SEO" @tabClick="this.activeTab = 'seo'"  :activeTab="activeTab"/>
            </ul>
            <div class="relative mt-[-10px] z-10 w-full max-w-6xl h-[450px] bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                <div v-show="activeTab === 'general'" class=" absolute top-0 left-0 h-full w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-3 pr-10 flex flex-col gap-6">
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Title</label>
                            <Input v-model="form.title" />
                        </div>
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Subtitle</label>
                            <Input v-model="form.sub_title" />
                        </div>
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-col">
                                <label class="text-xs text-g mb-2">Event starts</label>
                                <div class="flex flex-row gap-5">
                                    <Input type="date" v-model="form.sale_start_date" />
                                    <Input type="time" step="300" v-model="form.sale_start_time"  />
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-xs text-g mb-2">Event ends</label>
                                <div class="flex flex-row gap-5">
                                    <Input type="date" v-model="form.sale_end_date" />
                                    <Input type="time" step="300" v-model="form.sale_end_time"  />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div>
                                <label class="text-xs text-g mb-2">Upload image</label>
                                <div class="flex flex-row text-gray-600 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="self-center w-4 h-4">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                    <p>nikolaj_stokholm_2022.jpg </p>
                                </div>
                                <div class="flex flex-col justify-center items-center text-gray-600 bg-white-secondary h-24 rounded border border-dashed border-gray-400">
                                    <div class="flex flex-row gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M10.5 3.75a6 6 0 00-5.98 6.496A5.25 5.25 0 006.75 20.25H18a4.5 4.5 0 002.206-8.423 3.75 3.75 0 00-4.133-4.303A6.001 6.001 0 0010.5 3.75zm2.03 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.94a.75.75 0 001.5 0v-4.94l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                                        </svg>
                                        <p>Add image</p>
                                    </div>
                                    <p class="text-sm">Or simply just drop it here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 h-fit" v-click-away="closeSearch">
                        <div class="flex flex-col mb-7 relative">
                            <label class="text-xs text-g mb-2">Add artists</label>
                            <Search v-model="artistFilter"  placeholder="Search for artists here..." @keyup="searchArtists" @click="searchArtists" :open="showSearch"/>

                            <div v-show="showSearch" class="absolute top-full bg-white-secondary w-full px-4 max-h-72 overflow-y-auto " :class="showSearch ? 'rounded-b-md' : 'rounded-md ' ">
                                <div class="border-t border-white mb-2"></div>

                                <ul class="pb-2">
                                    <li class="my-2" v-for="(artist, index) in artistOptions"><button type="button" @click="selectArtist(artist)">{{artist.name}}</button></li>
                                </ul>
                            </div>



                        </div>
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Added artists</label>
                            <div class="max-h-[19.2rem] overflow-y-auto flex flex-col">
                                <div class="flex justify-between items-center">
                                    <ul class="">
                                        <li class="flex flex-row items-center" v-for="artist in selectedArtists">
                                            <div class="w-8 h-8 rounded-full bg-gray-500 mr-4"></div>
                                            <p>{{artist.name}}</p>
                                            <button type="button" @click="removeArtist(artist)">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 cursor-pointer">
                                                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div v-show="activeTab === 'dates'" class="absolute top-0 left-0 w-full h-full px-10 py-6 overflow-y-auto" >
                    <div class="text-xs grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4 mb-1">
                        <label class="col-span-1"></label>
                        <label class="col-span-3">Release Date</label>
                        <label class="col-span-3">Venue</label>
                        <label class="col-span-3">Date & Time</label>
                        <label class="col-span-3">Duration</label>
                        <label class="col-span-3">Status</label>
                        <label class="col-span-3">Label</label>
                        <label class="col-span-3">Note</label>
                    </div>
                    <div class="w-full grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4">

                        <div
                            class="col-span-full grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4"
                            v-for="(date, index) in form.dates"
                            :key="date.id"
                        >

<!--                            <Input readonly class="col-span-1" :placeholder="index" />-->
                            <div class="col-span-1 flex justify-center items-center text-placeholder bg-white-secondary rounded text-gray-600">{{ date.id }}</div>
                            <Input class="col-span-3" v-model="date.release_date" />
                            <Input class="col-span-3" />
                            <Input class="col-span-3" />
                            <Input class="col-span-3" />
                            <Input class="col-span-3" />
                            <Input class="col-span-3" />
                            <Input class="col-span-3" />
                        </div>
                        <Btn class="col-[20/-1]" type="create" text="Add row" @click="addDate"></Btn>
                    </div>
                </div>
                <div v-show="activeTab === 'seo'" class="absolute top-0 left-0 w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-3 pr-10">
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">SEO Title</label>
                            <Input />
                        </div>
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2 ">SEO Discription</label>
                            <TextArea class="h-72 resize-none" placeholder="Write a SEO description here..." />
                        </div>
                    </div>
                </div>
            </div>



            <div class="flex justify-between">
                <LinkBtn :type="'back'" to="events.index"/>

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
import LinkBtn from "../../Components/Partials/LinkBtn";
import Tab from "../../Components/Partials/Tab";
import TextArea from "../../Components/Partials/TextArea";
import axios from "axios";
import { v4 as uuidv4 } from 'uuid';
import Search from "../../Components/Partials/Search";

export default {
    // included child components
    components: {
        Search,
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
        event: Object,
        request: Object,
    },
    // custom set
    data() {
        return {
            form: this.$inertia.form({
                title: this.event.title,
                sub_title: this.event.sub_title,
                sale_start_date: this.$date(this.event.sale_start, 'YYYY-MM-DD'),
                sale_start_time: this.$time(this.event.sale_start),
                sale_end_date: this.$date(this.event.sale_end, 'YYYY-MM-DD'),
                sale_end_time: this.$time(this.event.sale_end),
                artists: this.event.artists?.map((x) => x.id) || [],
                dates: this.event.dates || [],
            }),
            artistFilter: null,
            open: false,
            openModal: false,
            activeTab: 'general',
            activeTabContent: false,
            showSearch: false,
            artistOptions: [],
            selectedArtists: this.event.artists || [],
        };
    },
    // actions on init
    mounted() {
        if (this.form.dates.length === 0) {
            this.addDate();
        }
    },
    // methods
    methods: {
        updateActiveTab(e){
          this.activeTab = e;
        },
        searchArtists() {
            axios
                .get(this.$route('artists.search', { search: this.artistFilter }))
                .then((res) => {
                    this.artistOptions = res.data;
                    // remove selected artists from options
                    this.artistOptions = this.artistOptions.filter(
                        (x) => !this.selectedArtists.some((y) => y.id === x.id)
                    );
                    // if this.artistoptions is empty, show 'no artists found' message
                        if (this.artistOptions.length === 0) {
                            this.artistOptions = [{ id: 0, name: 'No artists found' }];
                        }

                    this.showSearch = true;
                })
        },
        selectArtist(artist) {
            if (this.selectedArtists.some((x) => x.id === artist.id)) {
                return;
            }
            this.searchArtists();
            this.form.artists.push(artist.id);
            this.selectedArtists.push(artist);
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

        closeSearch(event) {
            this.showSearch = false;
        },

        removeArtist(artist) {
            this.form.artists = this.form.artists.filter((x) => x !== artist.id);
            this.selectedArtists = this.selectedArtists.filter((x) => x.id !== artist.id);
        },

        addDate() {
            this.form.dates.push({
                id: uuidv4(),
                is_new: true,
                release_date: null,
                time: null,
                duration: null,
                status: null,
                label: null,
                note: null,
            });
        },
    },
    directives: {
        ClickAway: directive,
    },
};
</script>
