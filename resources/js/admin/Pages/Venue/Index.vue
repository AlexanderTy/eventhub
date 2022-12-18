<template>
    <DefaultLayout currentRoute="venues">
        <div class="flex mb-8 w-full justify-between">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Venues</h1>
                <form class="flex flex-row gap-7" @submit.prevent="submit">
                    <Input
                        v-model="filter.search"
                        :class="'shrink-0 shadow w-96 2xl:w-[484px] h-9 shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]'"
                        bg="bg-white"
                        placeholder="Search for events, artists"
                        type="search"
                    />
                    <div class="relative" v-click-away="closeSort">
                        <Btn type="toggleDropdown"
                             text="Sort by"
                             @click="showSortBy = !showSortBy"
                             :open="showSortBy"/>
                        <CustomSelect
                            v-show="showSortBy"
                            :active="filter.sortOption"
                            :options="sortOptions"
                            :sortDirection="filter.order"
                            @selectOption="sortVenues"
                            :class="showSortBy ? 'rounded-b-md' : 'rounded-md'"
                        />
                    </div>
                </form>
            </div>
            <Btn type="create" @click="openModal = !openModal" />
            <Teleport to="#app">
                <CreateModal v-if="openModal" @close-modal="openModal = false" type="venue" label="Create new venue" />
            </Teleport>
        </div>
        <p class="mb-4 text-gray-600">
            We've found
            <span class="text-primary font-semibold"> {{ venues.length }} </span> <span> {{ venues.length === 1 ? "venue" : "venues" }}</span>
        </p>

        <div class="flex flex-wrap gap-3">
            <div class="grid gap-4 grid-cols-7 text-xs items-center px-12 w-full">
                <p class="col-span-2">Name</p>
                <p class="col-span-2">Address</p>
                <p class="col-span-2">Country</p>
            </div>
            <VenueList v-for="venue in venues" :venue="venue"/>
<!--            <div class="grid gap-4 grid-cols-7 text-sm items-center col-span-1 px-12 bg-white w-full h-16 rounded-2xl shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)] cursor-pointer transition duration-500 hover:scale-[1.01]"
                 v-for="venue in venues">
                <h2 class="col-span-2 font-semibold text-lg">{{ venue.name }}</h2>
                <div class="col-span-2">
                    <p class="capitalize">{{ venue.address }}</p>
                    <p>{{ venue.zipcode }} {{ venue.city }}</p>
                </div>
                <p class="col-span-2 capitalize">{{venue.country}}</p>
                <div class="col-span-1 relative justify-self-center">
                    <button class="text-black self-end hover:text-primary" type="button" @click.prevent="open = !open" v-click-away="onClickAway" >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div v-show="open" class="z-20 absolute p-3 left-4 top-6 flex flex-col justify-start text-left w-36 bg-white text-black rounded-md shadow-[-7px_7px_33px_rgba(114,121,125,0.25)]">
                        <Link class="text-left py-2.5 border-t flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('admin::venues.edit', { venue: venue.id, })" >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                            </svg>
                            Edit
                        </Link>
                        <button class="text-left py-2.5 border-t flex flex-row items-center gap-2.5 hover:text-primary"
                                type="button"
                                @click.prevent="openModal = true"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd"
                                      d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                      clip-rule="evenodd"/>
                            </svg>
                            Delete
                        </button>
                        <Teleport to="#app">
                            <Modal
                                v-show="openModal"
                                :type="'venue'"
                                :deleteItem="venue.name"
                                @close-modal="openModal = false"
                                @action-modal="deleteVenue"
                            />
                        </Teleport>
                    </div>
                </div>
            </div>-->

        </div>


    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import PublishedStatus from "../../Components/Partials/PublishedStatus";
import { Link } from "@inertiajs/inertia-vue3";
import CreateModal from "../../Components/CreateModal";
import {directive} from "vue3-click-away";
import EventCard from "../../Components/Partials/EventCard";
import Input from "../../Components/Partials/Input";
import Btn from "../../Components/Partials/Btn";
import CustomSelect from "../../Components/Partials/CustomSelect";
import Modal from "../../Components/Modal";
import VenueList from "../../Components/Partials/VenueList";

export default {
    // included child components
    components: {
        VenueList,
        Modal,
        CustomSelect,
        Btn,
        Input,
        EventCard,
        CreateModal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        venues: Object,
        request: Object,

    },
     // custom set
     data() {
        return {
            filter: this.$inertia.form({
                search: this.request.search,
                sortOption: this.request.sortOption ?? "",
                order: this.request.order,
            }),
            open: false,
            currentRoute: "",
            openModal: false,
            showSortBy: false,
            sortOptions:{
                "name": "Name",
                "address": "Address",
                "country": "Country",

            },
            previousSort: '',
        }
    },
    // methods
    methods: {
        deleteVenue() {
            this.$inertia.delete(
                this.$route("admin::venues.destroy", {
                    venue: this.venue.id,
                })
            );
        },
        onClickAway(event) {
            this.open = "";
        },
        submit() {
            this.filter.get(this.$route('admin::venues.index'));
        },
        closeSort(event) {
            this.showSortBy = false;
        },
        sortVenues(option) {
            // check if clicked sort is the same as previous sort
            // set previous sort to current sort
            this.previousSort = this.filter.sortOption;
            this.filter.sortOption = option;

            // check if current sort is the same as the previous sort
            if (this.filter.sortOption === this.previousSort) {
                // check if previous sort direction was descending
                if (this.filter.order === 'desc') {
                    // set sort direction to ascending
                    this.filter.order  = 'asc';
                    console.log("yo")
                } else {
                    // toggle sort direction
                    this.filter.order = this.filter.order === 'asc' ? 'desc' : 'asc';
                }
            } else {
                // set sort direction to ascending (default)
                this.filter.order = 'asc';
            }

            this.submit();
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
