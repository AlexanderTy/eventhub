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
                <p class="col-span-2 justify-self-center">Country</p>
            </div>
            <VenueList v-for="venue in venues" :venue="venue"/>
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
