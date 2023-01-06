<template>
    <DefaultLayout currentRoute="venues">
        <div class="flex mb-8 w-full justify-between">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Venues</h1>
                <form class="flex flex-row gap-7" @submit.prevent="submit">
                    <Input
                        v-model="filter.search"
                        :class="'shrink-0 w-96 2xl:w-[484px] h-9'"
                        bg="bg-white"
                        placeholder="Search for events, artists"
                        type="search"
                    />
                    <div class="relative" v-click-away="closeSort">
                        <Btn type="toggleDropdown"
                             text="Sort by"
                             @click="showSortBy = !showSortBy"
                             :open="showSortBy"
                             :class="filter.sortOption !==  '' ? 'border border-primary' : ''"

                        />
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

        <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
            <div
                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
            >
                <div class=" md:rounded-lg">
                    <table
                        class="min-w-full divide-y divide-white-secondary"
                    >
                        <thead class="bg-white bg-opacity-50">
                        <tr>
                            <th
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                scope="col"
                            >
                                Name
                            </th>
                            <th
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                scope="col"
                            >
                                Address
                            </th>
                            <th
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                scope="col"
                            >
                                Country
                            </th>
                            <th
                                class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                scope="col"
                            >
                                <span class="sr-only">Settings</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-white-secondary bg-white"
                        >
                        <VenueList v-for="venue in venues" :venue="venue"/>
                        </tbody>
                    </table>
                </div>
            </div>
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
