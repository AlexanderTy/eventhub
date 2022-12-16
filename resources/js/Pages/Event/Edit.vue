<template>
    <DefaultLayout currentRoute="events">
        <form
            class="flex flex-col min-w-[350px] h-full"
            @submit.prevent="submit"
        >
            <div class="flex justify-between">
                <div class="flex items-center mb-5">
                    <h2 class="font-bold text-2xl capitalize">
                        {{ event.title }}
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
                <Tab
                    :activeTab="activeTab"
                    text="General"
                    type="general"
                    @tabClick="this.activeTab = 'general'"
                />
                <Tab
                    :activeTab="activeTab"
                    text="Dates & Venues"
                    type="dates"
                    @tabClick="this.activeTab = 'dates'"
                />
                <Tab
                    :activeTab="activeTab"
                    text="SEO"
                    type="seo"
                    @tabClick="this.activeTab = 'seo'"
                />
            </ul>
            <div
                class="relative mt-[-10px] h-[450px] 2xl:h-[550px] z-10 w-full max-w-6xl h-full bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]"
            >
                <div
                    v-show="activeTab === 'general'"
                    class="absolute top-0 left-0 h-full w-full grid grid-cols-5 gap-12 flex-col px-10 py-6"
                >
                    <div class="col-span-3 pr-10 flex flex-col gap-6">
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Title</label>
                            <Input v-model="form.title"/>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2">Subtitle</label>
                            <Input v-model="form.sub_title"/>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-col">
                                <label class="text-xs text-g mb-2"
                                >Event starts</label
                                >
                                <div class="flex flex-row gap-5">
                                    <Input
                                        v-model="form.sale_start_date"
                                        type="date"
                                    />
                                    <Input
                                        v-model="form.sale_start_time"
                                        type="time"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-xs text-g mb-2"
                                >Event ends</label
                                >
                                <div class="flex flex-row gap-5">
                                    <Input
                                        v-model="form.sale_end_date"
                                        type="date"
                                    />
                                    <Input
                                        v-model="form.sale_end_time"
                                        type="time"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div>
                                <label class="text-xs text-g mb-2"
                                >Upload image</label
                                >
                                <div class="flex flex-row text-gray-600 gap-2">
                                    <svg
                                        class="self-center w-4 h-4"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            clip-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            fill-rule="evenodd"
                                        />
                                    </svg>
                                    <p>nikolaj_stokholm_2022.jpg</p>
                                </div>
                                <div
                                    class="flex flex-col justify-center items-center text-gray-600 bg-white-secondary h-24 rounded border border-dashed border-gray-400"
                                >
                                    <div class="flex flex-row gap-2">
                                        <svg
                                            class="w-6 h-6"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                clip-rule="evenodd"
                                                d="M10.5 3.75a6 6 0 00-5.98 6.496A5.25 5.25 0 006.75 20.25H18a4.5 4.5 0 002.206-8.423 3.75 3.75 0 00-4.133-4.303A6.001 6.001 0 0010.5 3.75zm2.03 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.94a.75.75 0 001.5 0v-4.94l1.72 1.72a.75.75 0 101.06-1.06l-3-3z"
                                                fill-rule="evenodd"
                                            />
                                        </svg>
                                        <p>Add image</p>
                                    </div>
                                    <p class="text-sm">
                                        Or simply just drop it here
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-click-away="closeSearch" class="col-span-2 h-fit">
                        <div class="flex flex-col mb-7 relative">
                            <label class="text-xs text-g mb-2"
                            >Add artists</label
                            >
                            <Search
                                v-model="artistFilter"
                                :open="showSearch"
                                placeholder="Search for artists here..."
                                @click="searchArtists"
                                @keyup="searchArtists"
                            />

                            <div
                                v-show="showSearch"
                                :class="
                                    showSearch ? 'rounded-b-md' : 'rounded-md '
                                "
                                class="absolute top-full bg-white-secondary w-full px-4 max-h-72 overflow-y-auto"
                            >
                                <div class="border-t border-white mb-2"></div>

                                <ul class="pb-2">
                                    <li
                                        v-for="(artist, index) in artistOptions"
                                        class="my-2"
                                    >
                                        <button
                                            type="button"
                                            @click="selectArtist(artist)"
                                            class="flex items-center gap-3.5"
                                        >

                                                <span class="text-tab-secondary bg-white w-8 h-8 rounded-full shrink-0 overflow-hidden">
                                                    <img v-show="artist.image" alt="" class="w-full" :src="'/images/artists/' + artist.image"/>
                                                    <svg v-show="!artist.image" class="w-full h-full" viewBox="0 0 167 167" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M140.751 144.279C149.05 136.482 155.661 127.065 160.176 116.611C164.69 106.156 167.013 94.8873 167 83.5C167 37.3823 129.618 0 83.5 0C37.3823 0 5.57455e-05 37.3823 5.57455e-05 83.5C-0.0131202 94.8873 2.30951 106.156 6.82436 116.611C11.3392 127.065 17.9503 136.482 26.249 144.279C41.7238 158.897 62.2126 167.029 83.5 167C104.787 167.029 125.276 158.897 140.751 144.279ZM55.6807 115.512C46.9999 119.681 39.3699 125.752 33.3572 133.275C39.9171 139.901 47.7273 145.158 56.3349 148.742C64.9425 152.326 74.176 154.166 83.5 154.154C92.824 154.166 102.058 152.326 110.665 148.742C119.273 145.158 127.083 139.901 133.643 133.275C127.63 125.752 120 119.681 111.319 115.512C102.639 111.343 93.1301 109.183 83.5 109.192C73.87 109.183 64.3615 111.343 55.6807 115.512ZM106.209 80.5167C112.232 74.4939 115.615 66.3252 115.615 57.8077C115.615 49.2901 112.232 41.1215 106.209 35.0987C100.186 29.0759 92.0175 25.6923 83.5 25.6923C74.9825 25.6923 66.8138 29.0759 60.791 35.0987C54.7682 41.1215 51.3846 49.2901 51.3846 57.8077C51.3846 66.3252 54.7682 74.4939 60.791 80.5167C66.8138 86.5395 74.9825 89.923 83.5 89.923C92.0175 89.923 100.186 86.5395 106.209 80.5167Z"/>
                                                    </svg>
                                                </span>
                                            {{ artist.name }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-xs text-g mb-2"
                            >Added artists</label
                            >
                            <div
                                class="max-h-[19.2rem] overflow-y-auto flex flex-col"
                            >
                                <ul class="">
                                    <li
                                        v-for="artist in selectedArtists"
                                        class="flex flex-row items-center justify-between my-4 mt-0"
                                    >
                                        <div class="flex items-center gap-3.5">
                                            <div class="text-tab-secondary w-8 h-8 rounded-full shrink-0 overflow-hidden">
                                                <img v-show="artist.image" alt="" class="w-full" :src="'/images/artists/' + artist.image"/>
                                                <svg v-show="!artist.image" class="w-full h-full" viewBox="0 0 167 167" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M140.751 144.279C149.05 136.482 155.661 127.065 160.176 116.611C164.69 106.156 167.013 94.8873 167 83.5C167 37.3823 129.618 0 83.5 0C37.3823 0 5.57455e-05 37.3823 5.57455e-05 83.5C-0.0131202 94.8873 2.30951 106.156 6.82436 116.611C11.3392 127.065 17.9503 136.482 26.249 144.279C41.7238 158.897 62.2126 167.029 83.5 167C104.787 167.029 125.276 158.897 140.751 144.279ZM55.6807 115.512C46.9999 119.681 39.3699 125.752 33.3572 133.275C39.9171 139.901 47.7273 145.158 56.3349 148.742C64.9425 152.326 74.176 154.166 83.5 154.154C92.824 154.166 102.058 152.326 110.665 148.742C119.273 145.158 127.083 139.901 133.643 133.275C127.63 125.752 120 119.681 111.319 115.512C102.639 111.343 93.1301 109.183 83.5 109.192C73.87 109.183 64.3615 111.343 55.6807 115.512ZM106.209 80.5167C112.232 74.4939 115.615 66.3252 115.615 57.8077C115.615 49.2901 112.232 41.1215 106.209 35.0987C100.186 29.0759 92.0175 25.6923 83.5 25.6923C74.9825 25.6923 66.8138 29.0759 60.791 35.0987C54.7682 41.1215 51.3846 49.2901 51.3846 57.8077C51.3846 66.3252 54.7682 74.4939 60.791 80.5167C66.8138 86.5395 74.9825 89.923 83.5 89.923C92.0175 89.923 100.186 86.5395 106.209 80.5167Z"/>
                                                </svg>
                                            </div>
                                            <p>{{ artist.name }}</p>
                                        </div>
                                        <button
                                            type="button"
                                            @click="removeArtist(artist)"
                                        >
                                            <svg
                                                class="w-5 h-5 cursor-pointer text-tab-secondary"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
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
                <div
                    v-show="activeTab === 'dates'"
                    class="absolute top-0 left-0 w-full h-full px-10 py-6 overflow-y-auto"
                >
                    <div
                        class="text-xs grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4 mb-1"
                    >
                        <label class="col-span-1"></label>
                        <label class="col-span-3">Release Date</label>
                        <label class="col-span-3">Venue</label>
                        <label class="col-span-3">Date & Time</label>
                        <label class="col-span-3">Duration</label>
                        <label class="col-span-3">Status</label>
                        <label class="col-span-3">Label</label>
                        <label class="col-span-3">Note</label>
                    </div>
                    <div
                        class="w-full grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4"
                    >
                        <div
                            v-for="(date, index) in form.dates"
                            :key="date.id"
                            class="col-span-full grid grid-cols-[repeat(22,_minmax(0,_1fr))] gap-4"
                        >
                            <!--                            <Input readonly class="col-span-1" :placeholder="index" />-->
                            <div
                                class="col-span-1 flex justify-center items-center text-placeholder bg-white-secondary rounded text-gray-600"
                            >
                                {{ index + 1 }}
                            </div>
                            <Input
                                v-model="date.release_date"
                                class="col-span-3"
                                type="datetime-local"
                            />
                            <div class="col-span-3 relative">
                                <!--
                                1. Wrapper/felt/div der viser navn baseret på venue_id (venueOptions) -> venue_id ? venueOptions[venue_id].name : ''
                                2. Klik på wrapper -> åbner en dropdown med muligheder
                                3. Klikker på mulighed -> sæt venue_id
                                -->
                                <!--
                                <Input class="col-span-3" :modelValue="date.venue?.name" @update:modelValue="date.venue.name = $event" />
-->

                                <Search
                                    v-model="venueSearchInputs[date.id]"
                                    placeholder="Search for venues here..."
                                    @click="searchVenues(date)"
                                    @keyup="searchVenues(date)"
                                />
                                <SearchResults
                                    v-show="this.showSearchVenues === date.id"
                                    :options="this.filteredVenueOptions"
                                    @selectOption="selectVenue($event, date)"
                                />
                            </div>
                            <Input
                                v-model="date.date"
                                class="col-span-3"
                                type="datetime-local"
                            />
                            <Input v-model="date.duration" class="col-span-3"/>
                            <Select
                                v-model="date.status"
                                :options="dateStatus"
                                class="col-span-3"
                            />

                            <Input v-model="date.label" class="col-span-3"/>
                            <Input v-model="date.note" class="col-span-3"/>
                        </div>
                        <Btn
                            class="col-[20/-1]"
                            text="Add row"
                            type="create"
                            @click="addDate"
                        ></Btn>
                    </div>
                </div>
                <div
                    v-show="activeTab === 'seo'"
                    class="absolute top-0 left-0 w-full grid grid-cols-5 gap-12 flex-col px-10 py-6"
                >
                    <div class="col-span-3 pr-10">
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">Slug</label>
                            <Input v-model="form.slug"/>
                        </div>
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2">SEO Title</label>
                            <Input v-model="form.meta_title"/>
                        </div>
                        <div class="flex flex-col mb-7">
                            <label class="text-xs text-g mb-2"
                            >SEO Discription</label
                            >
                            <TextArea
                                v-model="form.meta_description"
                                class="resize-none"
                                placeholder="Write a SEO description here..."
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <LinkBtn :type="'back'" to="events.index"/>

                <Btn :text="'save'" :type="'submit'"/>
            </div>
            {{ form.dates }}
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

export default {
    // included child components
    components: {
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
            }),
            artistFilter: null,
            open: false,
            openModal: false,
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
    },
    // methods
    methods: {
        updateActiveTab(e) {
            this.activeTab = e;
        },
        searchArtists() {
            axios
                .get(
                    this.$route("artists.search", {search: this.artistFilter})
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
            this.form.artists = this.form.artists.filter(
                (x) => x !== artist.id
            );
            this.selectedArtists = this.selectedArtists.filter(
                (x) => x.id !== artist.id
            );
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
