<template>
    <DefaultLayout currentRoute="events" type="tabpage">
        <form class="flex flex-col min-w-[350px] max-h-full mx-auto max-w-6xl" @submit.prevent="submit">
            <PageTitle :title="event.title">
                <div class="flex justify-between items-center gap-4">
                    <h2 class="font-bold text-xl capitalize">Public</h2>
                    <div :class="form.public === true ? 'bg-primary' : 'bg-gray-300'"
                        class="cursor-pointer w-14 h-8 rounded-full flex-shrink-0 p-1 duration-300 ease-in-out"
                        @click="form.public = !form.public">
                        <div :class="form.public === true ? 'translate-x-6' : ''"
                             class="bg-white w-6 h-6 rounded-full shadow-md transform duration-300 ease-in-out"></div>
                    </div>
                </div>
            </PageTitle>

            <ul class="flex flex-row gap-2.5 z-0">
                <Tab :activeTab="activeTab" text="General" type="general" @tabClick="this.activeTab = 'general'" />
                <Tab :activeTab="activeTab" text="Dates & Venues" type="dates" @tabClick="this.activeTab = 'dates'" />
                <Tab :activeTab="activeTab" text="SEO" type="seo" @tabClick="this.activeTab = 'seo'" />
            </ul>

            <TabPageLayout>
                <div v-show="activeTab === 'general'" class=" h-full w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-3 pr-10 flex flex-col gap-6">
                        <InputGroup :error="form.errors.title" label="Title">
                            <Input v-model="form.title" :error="form.errors.title"
                                   placeholder="Title for the event..."/>
                        </InputGroup>
                        <InputGroup :error="form.errors.sub_title" label="Subtitle">
                            <Input v-model="form.sub_title" :error="form.errors.sub_title"
                                   placeholder="Subtitle for the event..."/>
                        </InputGroup>
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-row gap-5 items-end">
                                <InputGroup :error="form.errors.sale_start_date" label="Event starts">
                                    <Input v-model="form.sale_start_date" type="date"/>
                                </InputGroup>
                                <InputGroup :error="form.errors.sale_start_time">
                                    <Input v-model="form.sale_start_time" type="time"/>
                                </InputGroup>
                            </div>
                            <div class="flex flex-row gap-5 items-end">
                                <InputGroup :error="form.errors.sale_end_date" label="Event starts">
                                    <Input v-model="form.sale_end_date" type="date"/>
                                </InputGroup>
                                <InputGroup :error="form.errors.sale_end_time">
                                    <Input v-model="form.sale_end_time" type="time"/>
                                </InputGroup>
                            </div>
                        </div>
                        <ImageUpload :image="this.form.image" type="events" @imageRemoved="this.form.image = ''"
                                     @imageUploaded="setImage"/>
                    </div>
                    <div v-click-away="closeSearch" class="col-span-2 h-fit">
                        <div class="flex flex-col mb-7 relative">
                            <label class="text-xs text-g mb-2">Add artists</label>
                            <Search v-model="artistFilter" :open="showSearch" placeholder="Search for artists here..."
                                    @click="searchArtists" @keyup="searchArtists"/>
                            <SearchResults v-show="showSearch" :class="showSearch ? 'rounded-b-md' : 'rounded-md '"
                                           :options="this.artistOptions" type="artists" @selectOption="selectArtist"/>
                        </div>
                        <div v-if="form.artists.length > 0" class="flex flex-col">
                            <label class="text-xs text-g mb-2">Added artists</label>
                            <div class="max-h-[19.2rem] overflow-y-auto flex flex-col">
                                <ul class="">
                                    <li v-for="artist in selectedArtists"
                                        class="flex flex-row items-center justify-between my-4 mt-0">
                                        <div class="flex items-center gap-3.5">
                                            <CircleImage :artist="artist" size="small"/>
                                            <p>{{ artist.name }}</p>
                                        </div>
                                        <button class="hover:brightness-75" type="button" @click="removeArtist(artist)">
                                            <svg class="w-5 h-5 cursor-pointer text-tab-secondary" fill="currentColor"
                                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    clip-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                                    fill-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-show="activeTab === 'dates'" class="w-full h-full p-6 overflow-y-auto min-h-[50vh]">
                    <div class="text-xs grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4 mb-1">
                        <label class="col-span-1"></label>
                        <label class="col-span-3">Release Date</label>
                        <label class="col-span-4">Venue</label>
                        <label class="col-span-3">Date & Time</label>
                        <label class="col-span-2">Duration</label>
                        <label class="col-span-2">Status</label>
                        <label class="col-span-3">Label</label>
                        <label class="col-span-3">Note</label>
                    </div>
                    <div class="w-full grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4">
                        <div v-for="(date, index) in form.dates" :key="date.id"
                             class="col-span-full grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4">
                            <div
                                class="col-span-1 flex justify-center items-center text-placeholder bg-white-secondary rounded text-gray-600">
                                {{ index + 1 }}
                            </div>
                            <Input v-model="date.release_date" class="col-span-3" type="datetime-local"/>
                            <div class="col-span-4 relative">
                                <Search v-model="venueSearchInputs[date.id]" :open="this.showSearchVenues === date.id"
                                        placeholder="Search for venues here..." type="venue" @click="searchVenues(date)"
                                        @keyup="searchVenues(date)"/>
                                <SearchResults v-show="this.showSearchVenues === date.id"
                                               :class="this.showSearchVenues === date.id? 'rounded-b-md': 'rounded-md'"
                                               :options="this.filteredVenueOptions"
                                               type="venues" @selectOption="selectVenue($event, date)"
                                />
                            </div>
                            <Input v-model="date.date" class="col-span-3" type="datetime-local"/>
                            <Input v-model="date.duration" class="col-span-2" placeholder="Eg. 02:45:00" type="time"/>
                            <Select v-model="date.status" :options="dateStatus" class="col-span-2 h-full"/>
                            <Input v-model="date.label" class="col-span-3" placeholder="Write a label here..."/>
                            <Input v-model="date.note" class="col-span-3" placeholder="Write a note here..."/>
                            <button class="hover:brightness-75" type="button" @click="removeDate(date)">
                                <svg class="w-6 h-6 cursor-pointer text-tab-secondary" fill="currentColor"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd"
                                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                          fill-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        <Btn class="col-[19/22]" text="Add" type="create" @click="addDate"></Btn>
                    </div>
                </div>
                <div v-show="activeTab === 'seo'" class=" w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-3 pr-10">
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">Slug</label>
                            <Input v-model="form.slug"/>
                        </div>
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">SEO Title</label>
                            <Input v-model="form.meta_title" placeholder="Write a SEO title here..."/>
                        </div>
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">SEO Discription</label>
                            <TextArea v-model="form.meta_description" class="resize-none"
                                      placeholder="Write a SEO description here..."/>
                        </div>
                        <div class="flex">
                            <h3>Allow indexing?</h3>
                            <div :class="form.index === true ? 'bg-primary' : 'bg-gray-300'"
                                 class="ml-4 cursor-pointer w-12 h-6 rounded-full flex-shrink-0 p-1 duration-300 ease-in-out"
                                 @click="form.index = !form.index">
                                <div :class="form.index === true ? 'translate-x-6' : ''"
                                     class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </TabPageLayout>
            <div class="flex justify-end space-x-8 mt-8">
                <LinkBtn :type="'back'" to="admin::events.index"/>
                <Btn :text="'save'" :type="'submit'"/>
            </div>
        </form>
    </DefaultLayout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import DefaultLayout from "../../Layouts/DefaultLayout";
import Btn from "../../Components/Partials/Btn";
import Input from "../../Components/Partials/Input";
import Select from "../../Components/Partials/Select";
import {directive} from "vue3-click-away";
import Modal from "../../Components/Modal";
import LinkBtn from "../../Components/Partials/LinkBtn";
import Tab from "../../Components/Partials/Tab";
import TextArea from "../../Components/Partials/TextArea";
import axios from "axios";
import {v4 as uuidv4} from "uuid";
import Search from "../../Components/Partials/Search";
import SearchResults from "../../Components/Partials/SearchResults";
import ImageUpload from "../../Components/Partials/ImageUpload";
import CircleImage from "../../Components/Partials/CircleImage";
import PageTitle from "../../Components/Partials/PageTitle";
import InputGroup from "../../Components/Partials/InputGroup";
import TabPageLayout from "../../Layouts/TabPageLayout";

export default {
    // included child components
    components: {
        TabPageLayout,
        InputGroup,
        PageTitle,
        CircleImage,
        ImageUpload,
        SearchResults,
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
        dateStatus: Object,
        venueOptions: Object,
    },
    // custom set
    data() {
        return {
            form: this.$inertia.form({
                title: this.event.title,
                sub_title: this.event.sub_title,
                image: this.event.image,
                public: this.event.public,
                sale_start_date: this.$date(
                    this.event.sale_start,
                    "YYYY-MM-DD"
                ),
                sale_start_time: this.$time(this.event.sale_start),
                sale_end_date: this.$date(this.event.sale_end, "YYYY-MM-DD"),
                sale_end_time: this.$time(this.event.sale_end),
                artists: this.event.artists?.map((x) => x.id) || [],
                dates: this.event.dates || [],
                slug: this.event.slug?.slug || "",
                meta_title: this.event.slug?.meta_title || "",
                meta_description: this.event.slug?.meta_description || "",
                index: this.event.slug?.index || true,
            }),
            artistFilter: null,
            open: false,
            openModal: false,
            toggleActive: false,
            activeTab: "general",
            activeTabContent: false,
            showSearch: false,
            artistOptions: [],
            selectedArtists: this.event.artists || [],
            venueFilter: null,
            showSearchVenues: "",
            filteredVenueOptions: [],
            venueSearchInputs: {},
        };
    },
    // actions on init
    mounted() {
        if (this.form.dates.length === 0) {
            this.addDate();
        }
        // for each date in the form, add a key with the date id and value of the corresponding venue name to venueSearchInputs
        this.form.dates.forEach((date) => {
            this.venueSearchInputs[date.id] = date.venue?.name || "";
        });
    },
    // methods
    methods: {
        updateActiveTab(e) {
            this.activeTab = e;
        },
        searchArtists() {
            axios
                .get(
                    this.$route("admin::artists.search", {
                        search: this.artistFilter,
                    })
                )
                .then((res) => {
                    this.artistOptions = res.data;
                    // remove selected artists from options
                    this.artistOptions = this.artistOptions.filter(
                        (x) => !this.selectedArtists.some((y) => y.id === x.id)
                    );
                    // if this.artistoptions is empty, show 'no artists found' message
                    if (this.artistOptions.length === 0) {
                        this.artistOptions = [
                            {id: 0, name: "No artists found"},
                        ];
                    }
                    this.showSearch = true;
                });
        },
        selectArtist(artist) {
            if (this.selectedArtists.some((x) => x.id === artist.id)) {
                return;
            }
            this.searchArtists();
            this.form.artists.push(artist.id);
            this.selectedArtists.push(artist);
        },
        searchVenues(date) {
            let searchInput = this.venueSearchInputs[date.id] || "";
            //this.fillteredVenueOptions is an array from this.venueOptions where the name matches the search input
            this.filteredVenueOptions = this.venueOptions.filter((venue) =>
                venue.name.toLowerCase().includes(searchInput.toLowerCase())
            );
            this.showSearchVenues = date.id;
        },
        selectVenue(id, date) {
            this.form.dates = this.form.dates.map((x) => {
                if (x.id === date.id) {
                    x.venue_id = id;
                }
                return x;
            });
            this.showSearchVenues = "";
            this.venueSearchInputs[date.id] = this.venueOptions.find(
                (x) => x.id === id
            ).name;
        },

        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    _method: "patch",
                }))
                .post(
                    this.$route("admin::events.update", {
                        event: this.event.id,
                    })
                );
        },
        setImage(event) {
            this.form.image = event;
        },

        deleteEvent() {
            this.$inertia.delete(
                this.$route("admin::events.destroy", {
                    event: this.event.id,
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
            this.form.artists = this.form.artists.filter(
                (x) => x !== artist.id
            );
            this.selectedArtists = this.selectedArtists.filter(
                (x) => x.id !== artist.id
            );
        },
        removeDate(date) {
            this.form.dates = this.form.dates.filter((x) => x.id !== date.id);
        },

        addDate() {
            this.form.dates.push({
                id: uuidv4(),
                is_new: true,
                release_date: null,
                venue_id: null,
                date: null,
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
